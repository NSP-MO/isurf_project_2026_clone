from app.database import engine
from app.models.irrigation import IrrigationRule

print("Dropping irrigation_rules table...")
IrrigationRule.__table__.drop(engine, checkfirst=True)
print("Table dropped successfully.")
