from sqlalchemy import Column, BigInteger, String, Float, Boolean, Text, DateTime, ForeignKey, func
from sqlalchemy.orm import relationship
from ..database import Base

class Alert(Base):
    __tablename__ = "alerts"

    id = Column(BigInteger, primary_key=True, index=True)
    sensor_id = Column(String(50), ForeignKey("sensors.id", ondelete="CASCADE"), nullable=False)
    alert_type = Column(String(50), nullable=False)
    sensor = relationship("Sensor")
    message = Column(Text, nullable=False)
    value = Column(Float)
    threshold_exceeded = Column(Float)
    is_read = Column(Boolean, default=False, index=True)
    created_at = Column(DateTime, default=func.now(), index=True)
    resolved_at = Column(DateTime)
