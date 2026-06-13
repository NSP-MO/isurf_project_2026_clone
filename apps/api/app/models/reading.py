from sqlalchemy import Column, Integer, BigInteger, String, Float, Boolean, Date, Time, ForeignKey
from sqlalchemy.orm import relationship
from ..database import Base

class SensorLog(Base):
    __tablename__ = "sensor_logs"

    id = Column(BigInteger, primary_key=True, index=True, autoincrement=True)
    date = Column(Date, index=True, nullable=False)
    time = Column(Time, nullable=False)
    reading = Column(Float, nullable=False)
    anomalies = Column(Boolean, default=False)
    status = Column(String(50), nullable=True) # "Normal", "Kritis"
    sensor_id = Column(String(50), ForeignKey("sensors.id", ondelete="CASCADE"), nullable=False)

    sensor = relationship("Sensor", back_populates="logs")

class AreaAggregation(Base):
    __tablename__ = "area_aggregations"

    id = Column(BigInteger, primary_key=True, index=True, autoincrement=True)
    date = Column(Date, index=True, nullable=False)
    time = Column(Time, nullable=False)
    data_type = Column(String(100), nullable=False)
    min_value = Column(Float, nullable=True)
    max_value = Column(Float, nullable=True)
    avg_value = Column(Float, nullable=True)
    area_id = Column(Integer, ForeignKey("areas.id", ondelete="CASCADE"), nullable=False)

    area = relationship("Area", back_populates="aggregations")
