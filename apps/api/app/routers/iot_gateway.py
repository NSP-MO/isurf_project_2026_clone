from fastapi import APIRouter, Depends, HTTPException, BackgroundTasks
from sqlalchemy.orm import Session
from pydantic import BaseModel
from typing import Optional
from datetime import datetime
from ..database import get_db
from ..models.device import Device
from ..models.sensor import Sensor
from ..models.reading import SensorReading
from ..models.alert import Alert

router = APIRouter(prefix="/iot", tags=["iot_gateway"])

# Schema compatibility with the old ESP32 format
class IotIngestPayload(BaseModel):
    api_key: str
    device_code: str
    sensor_name: str
    value: float

class HeartbeatPayload(BaseModel):
    api_key: str
    device_code: str
    firmware_version: Optional[str] = None

# Dummy API Key for validation
API_KEY = "supersecure"

@router.post("/ingest")
def ingest_data(payload: IotIngestPayload, db: Session = Depends(get_db)):
    if payload.api_key != API_KEY:
        raise HTTPException(status_code=403, detail="Invalid API Key")
    
    device = db.query(Device).filter(Device.device_code == payload.device_code).first()
    if not device:
        # Auto register device for simplicity if not exists
        device = Device(device_code=payload.device_code, name=f"Auto Registered {payload.device_code}")
        db.add(device)
        db.commit()
        db.refresh(device)
    
    sensor = db.query(Sensor).filter(Sensor.device_id == device.id, Sensor.name == payload.sensor_name).first()
    if not sensor:
        # Auto register sensor if not exists
        sensor = Sensor(device_id=device.id, name=payload.sensor_name, sensor_type="unknown", unit="")
        db.add(sensor)
        db.commit()
        db.refresh(sensor)

    # Save Reading
    reading = SensorReading(sensor_id=sensor.id, device_id=device.id, value=payload.value)
    db.add(reading)
    
    # Simple Alert logic
    if sensor.min_threshold is not None and payload.value < sensor.min_threshold:
        alert = Alert(device_id=device.id, sensor_id=sensor.id, alert_type="warning", 
                      message=f"{sensor.name} is below threshold", value=payload.value, threshold_exceeded=sensor.min_threshold)
        db.add(alert)
    elif sensor.max_threshold is not None and payload.value > sensor.max_threshold:
        alert = Alert(device_id=device.id, sensor_id=sensor.id, alert_type="warning", 
                      message=f"{sensor.name} is above threshold", value=payload.value, threshold_exceeded=sensor.max_threshold)
        db.add(alert)

    # Update heartbeat
    device.last_heartbeat = datetime.utcnow()
    device.status = "online"

    db.commit()
    return {"status": "success", "message": "Data ingested"}

@router.post("/heartbeat")
def heartbeat(payload: HeartbeatPayload, db: Session = Depends(get_db)):
    if payload.api_key != API_KEY:
        raise HTTPException(status_code=403, detail="Invalid API Key")
    
    device = db.query(Device).filter(Device.device_code == payload.device_code).first()
    if not device:
        raise HTTPException(status_code=404, detail="Device not found")
    
    device.last_heartbeat = datetime.utcnow()
    device.status = "online"
    if payload.firmware_version:
        device.firmware_version = payload.firmware_version
        
    db.commit()
    return {"status": "success", "message": "Heartbeat received"}

@router.get("/config")
def get_device_config(device_code: str, api_key: str, db: Session = Depends(get_db)):
    if api_key != API_KEY:
        raise HTTPException(status_code=403, detail="Invalid API Key")
    
    device = db.query(Device).filter(Device.device_code == device_code).first()
    if not device:
        raise HTTPException(status_code=404, detail="Device not found")
        
    sensors = db.query(Sensor).filter(Sensor.device_id == device.id, Sensor.is_active == True).all()
    
    config_data = []
    for sensor in sensors:
        config_data.append({
            "sensor_name": sensor.name,
            "sensor_type": sensor.sensor_type,
            "min_threshold": sensor.min_threshold,
            "max_threshold": sensor.max_threshold
        })
        
    return {
        "status": "success",
        "device_code": device_code,
        "sensors": config_data
    }
