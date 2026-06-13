from app.database import engine
from sqlalchemy import text

with engine.connect() as conn:
    print(conn.execute(text('SHOW TABLES')).fetchall())
