from app.database import engine
from sqlalchemy import text

with engine.connect() as conn:
    conn.execute(text('SET FOREIGN_KEY_CHECKS=0;'))
    conn.execute(text('DROP TABLE IF EXISTS alerts'))
    conn.execute(text('SET FOREIGN_KEY_CHECKS=1;'))
    conn.commit()
