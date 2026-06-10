from pydantic import BaseModel
from typing import Optional, List
from datetime import datetime, date

class DataRequestCreate(BaseModel):
    full_name: str
    email: str
    nim_nip: str
    reason: str
    data_type: str
    requested_sensors: List[str]
    date_start: date
    date_end: date

class DataRequestReview(BaseModel):
    status: str
    admin_notes: Optional[str] = None

class DataRequestResponse(BaseModel):
    id: int
    tracking_code: str
    full_name: str
    email: str
    nim_nip: str
    reason: str
    document_path: str
    data_type: str
    requested_sensors: Optional[List[str]] = None
    date_start: Optional[date] = None
    date_end: Optional[date] = None
    status: str
    admin_notes: Optional[str] = None
    download_token: Optional[str] = None
    created_at: datetime
    reviewed_at: Optional[datetime] = None
    reviewed_by: Optional[int] = None

    class Config:
        from_attributes = True
