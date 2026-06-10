from pydantic import BaseModel, ConfigDict
from typing import Optional
from datetime import datetime

class SensorBase(BaseModel):
    name: str
    sensor_type: str
    unit: str
    min_threshold: Optional[float] = None
    max_threshold: Optional[float] = None
    is_active: bool = True

class SensorCreate(SensorBase):
    device_id: int

class SensorResponse(SensorBase):
    id: int
    device_id: int
    created_at: datetime

    model_config = ConfigDict(from_attributes=True)

class SensorThresholdUpdate(BaseModel):
    min_threshold: Optional[float] = None
    max_threshold: Optional[float] = None
