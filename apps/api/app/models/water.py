from sqlalchemy import Column, Integer, BigInteger, Float, DateTime, ForeignKey, func, String
from sqlalchemy.orm import relationship
from ..database import Base

class WaterUsageLog(Base):
    __tablename__ = "water_usage_logs"

    id = Column(BigInteger, primary_key=True, index=True, autoincrement=True)
    timestamp = Column(DateTime, default=func.now(), index=True)
    water_discharged = Column(Float, nullable=False, default=0.0) # jumlah_air_yang_dikeluarkan
    water_remaining = Column(Float, nullable=False, default=0.0) # sisa_air
    actuator_id = Column(String(50), ForeignKey("actuators.id", ondelete="CASCADE"), nullable=False)

    actuator = relationship("Actuator", back_populates="water_logs")
