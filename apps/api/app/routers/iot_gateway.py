from fastapi import APIRouter, Depends, HTTPException, BackgroundTasks
from sqlalchemy.orm import Session
from pydantic import BaseModel
from datetime import datetime
from typing import List

from ..database import get_db
from ..models.sensor import Sensor
from ..models.reading import SensorLog
from ..models.alert import Alert
from ..utils.aggregation import aggregate_sensor_data
from ..utils.automation import evaluate_conditions

router = APIRouter()

class SensorPayload(BaseModel):
    sensor_id: str
    value: float
    status: str = "Normal"

class IngestPayload(BaseModel):
    sensors: List[SensorPayload]

@router.post("/ingest")
def ingest_data(payload: IngestPayload, background_tasks: BackgroundTasks, db: Session = Depends(get_db)):
    now = datetime.now()
    current_date = now.date()
    current_time = now.time()

    processed_areas = set()

    for item in payload.sensors:
        sensor = db.query(Sensor).filter(Sensor.id == item.sensor_id).first()
        if not sensor:
            continue

        # Update heartbeat
        sensor.is_online = True
        sensor.updated_at = now

        # Check anomalies
        is_anomaly = False
        exceeded_val = 0.0
        if sensor.min_threshold is not None and item.value < sensor.min_threshold:
            is_anomaly = True
            exceeded_val = sensor.min_threshold
        if sensor.max_threshold is not None and item.value > sensor.max_threshold:
            is_anomaly = True
            exceeded_val = sensor.max_threshold

        log = SensorLog(
            date=current_date,
            time=current_time,
            reading=item.value,
            anomalies=is_anomaly,
            status=item.status if not is_anomaly else "Kritis",
            sensor_id=item.sensor_id
        )
        db.add(log)

        # Trigger alert if anomaly
        if is_anomaly:
            alert = Alert(
                sensor_id=sensor.id,
                alert_type="Threshold Violation",
                message=f"Sensor {sensor.name} membaca nilai {item.value}, melebihi batas wajar.",
                value=item.value,
                threshold_exceeded=exceeded_val,
                is_read=False
            )
            db.add(alert)
        
        if sensor.area_id:
            processed_areas.add((sensor.area_id, sensor.data_type))
            # Trigger automation rules evaluation
            background_tasks.add_task(evaluate_conditions, sensor.area_id, sensor.data_type, item.value)

    db.commit()

    # Trigger aggregation in background
    for area_id, data_type in processed_areas:
        background_tasks.add_task(aggregate_sensor_data, area_id, data_type, current_date, current_time)

    return {"status": "ok", "message": f"Ingested {len(payload.sensors)} readings"}
