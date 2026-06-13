from pydantic import BaseModel, ConfigDict
from typing import Optional
from datetime import datetime
from .plant import PlantResponse

class ZoneBase(BaseModel):
    name: str
    plant_id: Optional[int] = None
    description: Optional[str] = None

class ZoneCreate(ZoneBase):
    pass

class ZoneResponse(ZoneBase):
    id: int
    created_at: datetime
    updated_at: datetime
    plant: Optional[PlantResponse] = None

    model_config = ConfigDict(from_attributes=True)
