from fastapi import APIRouter, Depends
from sqlalchemy.orm import Session
from ..database import get_db
from ..models.alert import Alert
from ..utils.auth import get_current_user

router = APIRouter(prefix="/alerts", tags=["alerts"])

# Anyone logged in can view alerts
@router.get("/")
def get_alerts(skip: int = 0, limit: int = 20, unread_only: bool = False, db: Session = Depends(get_db), current_user: dict = Depends(get_current_user)):
    query = db.query(Alert)
    if unread_only:
        query = query.filter(Alert.is_read == False)
    alerts = query.order_by(Alert.created_at.desc()).offset(skip).limit(limit).all()
    return alerts

@router.get("/unread-count")
def get_unread_count(db: Session = Depends(get_db), current_user: dict = Depends(get_current_user)):
    count = db.query(Alert).filter(Alert.is_read == False).count()
    return {"unread_count": count}

# Anyone logged in can mark as read
@router.patch("/{alert_id}/read")
def mark_read(alert_id: int, db: Session = Depends(get_db), current_user: dict = Depends(get_current_user)):
    alert = db.query(Alert).filter(Alert.id == alert_id).first()
    if alert:
        alert.is_read = True
        db.commit()
    return {"status": "success"}

@router.patch("/read-all")
def mark_all_read(db: Session = Depends(get_db), current_user: dict = Depends(get_current_user)):
    db.query(Alert).filter(Alert.is_read == False).update({"is_read": True})
    db.commit()
    return {"status": "success"}
