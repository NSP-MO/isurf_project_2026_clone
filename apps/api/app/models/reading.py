from sqlalchemy import Column, BigInteger, Integer, Float, DateTime, ForeignKey, func
from sqlalchemy.orm import relationship
from ..database import Base

class SensorReading(Base):
    __tablename__ = "sensor_readings"

    id = Column(BigInteger, primary_key=True, index=True)
    sensor_id = Column(Integer, ForeignKey("sensors.id", ondelete="CASCADE"), nullable=False)
    device_id = Column(Integer, ForeignKey("devices.id", ondelete="CASCADE"), nullable=False)
    value = Column(Float, nullable=False)
    recorded_at = Column(DateTime, default=func.now(), index=True)

    sensor = relationship("Sensor", back_populates="readings")
