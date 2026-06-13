from sqlalchemy import Column, Integer, String, DateTime, func
from sqlalchemy.orm import relationship
from ..database import Base

class Area(Base):
    __tablename__ = "areas"

    id = Column(Integer, primary_key=True, index=True)
    name = Column(String(100), unique=True, index=True, nullable=False)
    plant = Column(String(100), nullable=True) # "Tomat", "Selada"
    description = Column(String(500), nullable=True)
    created_at = Column(DateTime, default=func.now())
    updated_at = Column(DateTime, default=func.now(), onupdate=func.now())

    sensors = relationship("Sensor", back_populates="area", cascade="all, delete-orphan")
    actuators = relationship("Actuator", back_populates="area", cascade="all, delete-orphan")
    aggregations = relationship("AreaAggregation", back_populates="area", cascade="all, delete-orphan")
    conditions = relationship("AreaConditionRule", back_populates="area", cascade="all, delete-orphan")
    schedules = relationship("AreaScheduleRule", back_populates="area", cascade="all, delete-orphan")
