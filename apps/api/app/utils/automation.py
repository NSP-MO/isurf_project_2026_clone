from sqlalchemy.orm import Session
from ..database import SessionLocal
from ..models.irrigation import AreaConditionRule
from ..models.actuator import Actuator

def evaluate_conditions(area_id: int, data_type: str, current_value: float):
    db: Session = SessionLocal()
    try:
        rules = db.query(AreaConditionRule).filter(
            AreaConditionRule.area_id == area_id,
            AreaConditionRule.data_type == data_type
        ).all()

        if not rules:
            return

        for rule in rules:
            condition_met = False
            if rule.operator == ">" and current_value > rule.value:
                condition_met = True
            elif rule.operator == "<" and current_value < rule.value:
                condition_met = True
            elif rule.operator == "==" and current_value == rule.value:
                condition_met = True

            if condition_met:
                # Find the actuator for this area (assume 1 main pump for now)
                actuators = db.query(Actuator).filter(
                    Actuator.area_id == area_id,
                    Actuator.is_auto_enabled == True
                ).all()

                for actuator in actuators:
                    if actuator.valve_status != rule.action:
                        actuator.valve_status = rule.action
                        # Notice: To track exact water usage, we should record WaterUsageLog here if it turns OFF
                        # For simplicity in this background task, we just set the valve status.
                        # Real implementations would calculate duration and deduct water_remaining here.
                db.commit()

    except Exception as e:
        print(f"Automation error: {e}")
    finally:
        db.close()
