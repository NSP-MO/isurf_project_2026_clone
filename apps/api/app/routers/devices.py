from fastapi import APIRouter, Depends, HTTPException
from sqlalchemy.orm import Session
from typing import List
from ..database import get_db
from ..models.device import Device
from ..models.sensor import Sensor
from ..schemas.device import DeviceResponse
from ..schemas.sensor import SensorResponse, SensorThresholdUpdate

router = APIRouter(prefix="/devices", tags=["devices"])

@router.get("/", response_model=List[DeviceResponse])
def read_devices(skip: int = 0, limit: int = 100, db: Session = Depends(get_db)):
    devices = db.query(Device).offset(skip).limit(limit).all()
    return devices

@router.get("/{device_id}", response_model=DeviceResponse)
def read_device(device_id: int, db: Session = Depends(get_db)):
    device = db.query(Device).filter(Device.id == device_id).first()
    if device is None:
        raise HTTPException(status_code=404, detail="Device not found")
    return device

@router.put("/{device_id}/sensors/{sensor_id}/thresholds", response_model=SensorResponse)
def update_sensor_thresholds(device_id: int, sensor_id: int, payload: SensorThresholdUpdate, db: Session = Depends(get_db)):
    device = db.query(Device).filter(Device.id == device_id).first()
    if device is None:
        raise HTTPException(status_code=404, detail="Device not found")
    
    sensor = db.query(Sensor).filter(Sensor.id == sensor_id, Sensor.device_id == device_id).first()
    if sensor is None:
        raise HTTPException(status_code=404, detail="Sensor not found")
    
    sensor.min_threshold = payload.min_threshold
    sensor.max_threshold = payload.max_threshold
    
    db.commit()
    db.refresh(sensor)
    return sensor
