from fastapi import APIRouter, Depends, HTTPException
from sqlalchemy.orm import Session
from typing import List
from datetime import datetime, timedelta

from ..database import get_db
from ..models.reading import AreaAggregation

router = APIRouter()

@router.get("/latest")
def get_latest_readings(db: Session = Depends(get_db)):
    """Returns the most recent aggregated data for each area and data_type."""
    # A simple approach: query the last 24 hours and get the latest
    yesterday = datetime.now() - timedelta(days=1)
    
    recent_aggs = db.query(AreaAggregation).filter(
        AreaAggregation.date >= yesterday.date()
    ).order_by(AreaAggregation.date.desc(), AreaAggregation.time.desc()).all()

    latest_map = {}
    for agg in recent_aggs:
        key = f"{agg.area_id}_{agg.data_type}"
        if key not in latest_map:
            latest_map[key] = {
                "id": agg.id,
                "area_id": agg.area_id,
                "data_type": agg.data_type,
                "min_value": agg.min_value,
                "max_value": agg.max_value,
                "avg_value": agg.avg_value,
                "date": str(agg.date),
                "time": str(agg.time)
            }
            
    return list(latest_map.values())

@router.get("/history/{area_id}/{data_type}")
def get_history(area_id: int, data_type: str, hours: int = 24, db: Session = Depends(get_db)):
    """Get history for a specific area and data_type."""
    cutoff = datetime.now() - timedelta(hours=hours)
    
    # Needs complex datetime filter, simplifying for SQLite
    aggs = db.query(AreaAggregation).filter(
        AreaAggregation.area_id == area_id,
        AreaAggregation.data_type == data_type,
        AreaAggregation.date >= cutoff.date()
    ).order_by(AreaAggregation.date.asc(), AreaAggregation.time.asc()).all()
    
    return [
        {
            "id": a.id,
            "avg_value": a.avg_value,
            "min_value": a.min_value,
            "max_value": a.max_value,
            "timestamp": f"{a.date} {a.time}"
        } for a in aggs
    ]
