from pydantic import BaseModel, ConfigDict
from typing import Optional
from datetime import datetime

class PlantBase(BaseModel):
    name: str
    description: Optional[str] = None
    optimal_temperature: Optional[float] = None
    optimal_moisture: Optional[float] = None
    optimal_light: Optional[float] = None

class PlantCreate(PlantBase):
    pass

class PlantResponse(PlantBase):
    id: int
    image_path: Optional[str] = None
    created_at: datetime
    updated_at: datetime

    model_config = ConfigDict(from_attributes=True)
