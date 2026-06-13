from app.database import engine
from sqlalchemy import text

tables = ['sensor_readings', 'zone_readings', 'irrigation_logs', 'irrigation_schedules', 'water_usage_logs', 'water_resources', 'devices', 'zones', 'sensors', 'plants', 'areas', 'actuators', 'sensor_logs', 'area_aggregations', 'irrigation_rules', 'data_requests']

with engine.connect() as conn:
    conn.execute(text('SET FOREIGN_KEY_CHECKS=0;'))
    for t in tables:
        conn.execute(text(f'DROP TABLE IF EXISTS {t}'))
    conn.execute(text('SET FOREIGN_KEY_CHECKS=1;'))
    conn.commit()
