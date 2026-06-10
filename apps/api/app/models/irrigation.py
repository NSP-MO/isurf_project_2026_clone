from sqlalchemy import Column, BigInteger, Integer, String, Float, Boolean, Time, DateTime, ForeignKey, func
from sqlalchemy.orm import relationship
from ..database import Base

class IrrigationSchedule(Base):
    __tablename__ = "irrigation_schedules"

    id = Column(Integer, primary_key=True, index=True)
    device_id = Column(Integer, ForeignKey("devices.id", ondelete="CASCADE"), nullable=False)
    name = Column(String(255), nullable=False)
    start_time = Column(Time, nullable=False)
    duration_minutes = Column(Integer, nullable=False)
    days_of_week = Column(String(50), nullable=False)
    is_active = Column(Boolean, default=True)
    created_at = Column(DateTime, default=func.now())
    updated_at = Column(DateTime, default=func.now(), onupdate=func.now())

    device = relationship("Device", back_populates="schedules")
    logs = relationship("IrrigationLog", back_populates="schedule", cascade="all, delete-orphan")

class IrrigationLog(Base):
    __tablename__ = "irrigation_logs"

    id = Column(BigInteger, primary_key=True, index=True)
    schedule_id = Column(Integer, ForeignKey("irrigation_schedules.id", ondelete="SET NULL"))
    device_id = Column(Integer, ForeignKey("devices.id", ondelete="CASCADE"), nullable=False)
    trigger_type = Column(String(50), nullable=False)
    started_at = Column(DateTime, nullable=False, index=True)
    ended_at = Column(DateTime)
    status = Column(String(50), nullable=False, default="running")
    water_volume_liters = Column(Float)

    schedule = relationship("IrrigationSchedule", back_populates="logs")
