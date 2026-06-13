from sqlalchemy import Column, Integer, String, Text, ForeignKey, Time, DateTime, func, Float
from sqlalchemy.orm import relationship
from ..database import Base

class AreaConditionRule(Base):
    __tablename__ = "area_condition_rules"

    id = Column(Integer, primary_key=True, index=True)
    data_type = Column(String(100), nullable=False) # e.g. "Suhu Udara"
    operator = Column(String(10), nullable=False) # e.g. ">", "<", "=="
    value = Column(Float, nullable=False)
    action = Column(String(20), nullable=False) # "ON", "OFF"
    area_id = Column(Integer, ForeignKey("areas.id", ondelete="CASCADE"), nullable=False)
    created_at = Column(DateTime, default=func.now())
    updated_at = Column(DateTime, default=func.now(), onupdate=func.now())

    area = relationship("Area", back_populates="conditions")

class AreaScheduleRule(Base):
    __tablename__ = "area_schedule_rules"

    id = Column(Integer, primary_key=True, index=True)
    time = Column(Time, nullable=False)
    action = Column(String(20), nullable=False) # "ON", "OFF"
    area_id = Column(Integer, ForeignKey("areas.id", ondelete="CASCADE"), nullable=False)
    created_at = Column(DateTime, default=func.now())
    updated_at = Column(DateTime, default=func.now(), onupdate=func.now())

    area = relationship("Area", back_populates="schedules")
