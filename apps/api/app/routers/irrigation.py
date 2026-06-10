from fastapi import APIRouter, Depends, HTTPException
from sqlalchemy.orm import Session
from pydantic import BaseModel
from typing import Optional
from datetime import datetime
from ..database import get_db
from ..utils.auth import get_current_user
from ..utils.rbac import require_operator, require_admin

router = APIRouter(prefix="/irrigation", tags=["irrigation"])

class TriggerRequest(BaseModel):
    device_id: int
    action: str # "ON" or "OFF"
    duration_minutes: Optional[int] = 30

# Viewers can see status
@router.get("/status")
def get_status(db: Session = Depends(get_db), current_user: dict = Depends(get_current_user)):
    return {"status": "System Operational", "main_valve": "OFF"}

# Only operators and admins can trigger irrigation
@router.post("/trigger", dependencies=[Depends(require_operator)])
def manual_trigger(request: TriggerRequest, db: Session = Depends(get_db)):
    # In a real system, this would send an MQTT message to the IoT Gateway/Device
    action_text = "turned ON" if request.action == "ON" else "turned OFF"
    return {
        "status": "success", 
        "message": f"Manual override triggered: Pump {action_text} for device {request.device_id}"
    }

# Only admins can delete schedules
@router.delete("/schedules/{schedule_id}", dependencies=[Depends(require_admin)])
def delete_schedule(schedule_id: int, db: Session = Depends(get_db)):
    # logic to delete schedule
    return {"status": "success", "message": f"Schedule {schedule_id} deleted"}
