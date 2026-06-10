from pydantic import BaseModel, ConfigDict
from typing import Optional
from datetime import datetime, time

class IrrigationScheduleBase(BaseModel):
    name: str
    start_time: time
    duration_minutes: int
    days_of_week: str
    is_active: bool = True

class IrrigationScheduleCreate(IrrigationScheduleBase):
    device_id: int

class IrrigationScheduleResponse(IrrigationScheduleBase):
    id: int
    device_id: int
    created_at: datetime
    updated_at: datetime

    model_config = ConfigDict(from_attributes=True)

class IrrigationLogResponse(BaseModel):
    id: int
    schedule_id: Optional[int] = None
    device_id: int
    trigger_type: str
    started_at: datetime
    ended_at: Optional[datetime] = None
    status: str
    water_volume_liters: Optional[float] = None

    model_config = ConfigDict(from_attributes=True)
