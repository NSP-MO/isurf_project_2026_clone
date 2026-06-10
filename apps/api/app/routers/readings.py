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
    subq = db.query(
        SensorReading.sensor_id,
        func.max(SensorReading.recorded_at).label('max_recorded_at')
    ).group_by(SensorReading.sensor_id).subquery()
    
    latest_readings = db.query(SensorReading, Sensor).join(
        Sensor, SensorReading.sensor_id == Sensor.id
    ).join(
        subq, 
        (SensorReading.sensor_id == subq.c.sensor_id) & 
        (SensorReading.recorded_at == subq.c.max_recorded_at)
    ).filter(Sensor.is_active == True).all()

    results = {}
    for reading, sensor in latest_readings:
        results[sensor.name] = {
            "value": reading.value,
            "unit": sensor.unit,
            "recorded_at": reading.recorded_at,
            "sensor_type": sensor.sensor_type
        }
    return results
