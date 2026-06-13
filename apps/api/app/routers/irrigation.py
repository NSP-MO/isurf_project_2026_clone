from fastapi import APIRouter, Depends, HTTPException
from sqlalchemy.orm import Session
from pydantic import BaseModel
from typing import List
from datetime import datetime

from ..database import get_db
from ..models.actuator import Actuator
from ..models.water import WaterUsageLog

router = APIRouter()

class OverridePayload(BaseModel):
    command: str  # 'ON' or 'OFF'

@router.get("/state/{actuator_id}")
def get_actuator_state(actuator_id: str, db: Session = Depends(get_db)):
    actuator = db.query(Actuator).filter(Actuator.id == actuator_id).first()
    if not actuator:
        raise HTTPException(status_code=404, detail="Actuator not found")

    # Failsafe: check remaining water
    latest_log = db.query(WaterUsageLog).order_by(WaterUsageLog.id.desc()).first()
    # Assuming max capacity is 100L for demo
    max_capacity = 100.0
    sisa_air = latest_log.water_remaining if latest_log else max_capacity

    if sisa_air < (0.05 * max_capacity):
        if actuator.valve_status == 'ON':
            # Force shut off to prevent dry run
            actuator.valve_status = 'OFF'
            db.commit()
        return {"status": "OFF", "reason": "Failsafe Cut-off: Water < 5%"}

    return {"status": actuator.valve_status}

@router.post("/override/{actuator_id}")
def manual_override(actuator_id: str, payload: OverridePayload, db: Session = Depends(get_db)):
    actuator = db.query(Actuator).filter(Actuator.id == actuator_id).first()
    if not actuator:
        raise HTTPException(status_code=404, detail="Actuator not found")
        
    old_status = actuator.valve_status
    new_status = payload.command.upper()
    
    if new_status not in ['ON', 'OFF']:
        raise HTTPException(status_code=400, detail="Invalid command")
        
    if old_status == 'ON' and new_status == 'OFF':
        # Calculate water used. Let's assume 1 minute passed for demo purposes
        # or we could track precise ON time. We'll simulate 1 minute duration.
        duration_sec = 60
        volume_used = duration_sec * actuator.flow_rate_per_sec
        
        latest_log = db.query(WaterUsageLog).order_by(WaterUsageLog.id.desc()).first()
        max_capacity = 100.0
        sisa_air = latest_log.water_remaining if latest_log else max_capacity
        
        new_sisa = max(0.0, sisa_air - volume_used)
        
        new_log = WaterUsageLog(
            water_discharged=volume_used,
            water_remaining=new_sisa,
            actuator_id=actuator.id
        )
        db.add(new_log)
        
    actuator.valve_status = new_status
    db.commit()
    
    return {"message": f"Actuator {actuator_id} forced {new_status}"}
