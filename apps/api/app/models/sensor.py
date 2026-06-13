from sqlalchemy import Column, Integer, String, Float, Boolean, DateTime, ForeignKey, func
from sqlalchemy.orm import relationship
from ..database import Base

class Sensor(Base):
    __tablename__ = "sensors"

    id = Column(String(50), primary_key=True, index=True) # ID unik alat
    name = Column(String(100), nullable=False)
    data_type = Column(String(100), nullable=False) # e.g. Kelembaban Tanah, pH
    min_threshold = Column(Float, nullable=True)
    max_threshold = Column(Float, nullable=True)
    is_online = Column(Boolean, default=False)
    area_id = Column(Integer, ForeignKey("areas.id", ondelete="CASCADE"), nullable=True)
    created_at = Column(DateTime, default=func.now())
    updated_at = Column(DateTime, default=func.now(), onupdate=func.now())

    area = relationship("Area", back_populates="sensors")
    logs = relationship("SensorLog", back_populates="sensor", cascade="all, delete-orphan")
