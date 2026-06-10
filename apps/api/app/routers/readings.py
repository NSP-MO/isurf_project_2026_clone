from fastapi import APIRouter, Depends
from sqlalchemy.orm import Session
from sqlalchemy import func
from typing import List, Dict, Any
from ..database import get_db
from ..models.reading import SensorReading
from ..models.sensor import Sensor
from ..schemas.reading import ReadingResponse

router = APIRouter(prefix="/readings", tags=["readings"])

@router.get("/latest", response_model=Dict[str, Any])
def read_latest_readings(db: Session = Depends(get_db)):
    # Simple implementation to get the latest reading for each sensor
    sensors = db.query(Sensor).filter(Sensor.is_active == True).all()
    results = {}
    for sensor in sensors:
        latest = db.query(SensorReading).filter(SensorReading.sensor_id == sensor.id).order_by(SensorReading.recorded_at.desc()).first()
        if latest:
            results[sensor.name] = {
                "value": latest.value,
                "unit": sensor.unit,
                "recorded_at": latest.recorded_at,
                "sensor_type": sensor.sensor_type
            }
    return results
