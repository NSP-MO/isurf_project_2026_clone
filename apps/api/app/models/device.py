from sqlalchemy import Column, Integer, String, DateTime, func
from sqlalchemy.orm import relationship
from ..database import Base

class Device(Base):
    __tablename__ = "devices"

    id = Column(Integer, primary_key=True, index=True)
    device_code = Column(String(100), unique=True, index=True, nullable=False)
    name = Column(String(255), nullable=False)
    type = Column(String(100))
    plant_type = Column(String(100), nullable=True)
    location = Column(String(255))
    status = Column(String(50), default="offline")
    last_heartbeat = Column(DateTime)
    firmware_version = Column(String(50))
    created_at = Column(DateTime, default=func.now())
    updated_at = Column(DateTime, default=func.now(), onupdate=func.now())

    sensors = relationship("Sensor", back_populates="device", cascade="all, delete-orphan")
    alerts = relationship("Alert", back_populates="device", cascade="all, delete-orphan")
    schedules = relationship("IrrigationSchedule", back_populates="device", cascade="all, delete-orphan")
