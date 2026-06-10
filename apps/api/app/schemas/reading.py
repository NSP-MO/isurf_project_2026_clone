from pydantic import BaseModel, ConfigDict
from typing import Optional
from datetime import datetime
from .sensor import SensorResponse

class ReadingBase(BaseModel):
    value: float

class ReadingCreate(ReadingBase):
    sensor_id: int
    device_id: int

class ReadingResponse(ReadingBase):
    id: int
    sensor_id: int
    device_id: int
    recorded_at: datetime

    model_config = ConfigDict(from_attributes=True)
