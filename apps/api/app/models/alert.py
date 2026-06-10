from sqlalchemy import Column, BigInteger, Integer, String, Float, Boolean, Text, DateTime, ForeignKey, func
from sqlalchemy.orm import relationship
from ..database import Base

class Alert(Base):
    __tablename__ = "alerts"

    id = Column(BigInteger, primary_key=True, index=True)
    device_id = Column(Integer, ForeignKey("devices.id", ondelete="CASCADE"), nullable=False)
    sensor_id = Column(Integer, ForeignKey("sensors.id", ondelete="SET NULL"))
    alert_type = Column(String(50), nullable=False)
    message = Column(Text, nullable=False)
    value = Column(Float)
    threshold_exceeded = Column(Float)
    is_read = Column(Boolean, default=False, index=True)
    created_at = Column(DateTime, default=func.now(), index=True)
    resolved_at = Column(DateTime)

    device = relationship("Device", back_populates="alerts")
