from sqlalchemy import Column, Integer, String, SmallInteger
from ..database import Base

class User(Base):
    __tablename__ = "users"

    id = Column(Integer, primary_key=True, index=True)
    username = Column(String(255), unique=True, index=True, nullable=False)
    email = Column(String(255), unique=True, index=True, nullable=False)
    password_hash = Column(String(255), nullable=False)
    auth_key = Column(String(32), nullable=False)
    status = Column(SmallInteger, default=10, nullable=False)
    
    # Custom fields for iSURF
    full_name = Column(String(255))
    role = Column(String(50), default="admin")
    avatar_url = Column(String(255))
