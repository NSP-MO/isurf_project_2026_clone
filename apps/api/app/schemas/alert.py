from pydantic import BaseModel, ConfigDict
from typing import Optional
from datetime import datetime

class AlertBase(BaseModel):
    alert_type: str
    message: str
    value: Optional[float] = None
    threshold_exceeded: Optional[float] = None

class AlertCreate(AlertBase):
    device_id: int
    sensor_id: Optional[int] = None

class AlertResponse(AlertBase):
    id: int
    device_id: int
    sensor_id: Optional[int] = None
    is_read: bool
    created_at: datetime
    resolved_at: Optional[datetime] = None

    model_config = ConfigDict(from_attributes=True)
