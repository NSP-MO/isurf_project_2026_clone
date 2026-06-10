from fastapi import APIRouter, Depends, HTTPException, status
from fastapi.security import OAuth2PasswordRequestForm
from sqlalchemy.orm import Session
from sqlalchemy import text
from ..database import get_db
from ..utils.auth import create_access_token, get_current_user
import bcrypt

router = APIRouter(prefix="/auth", tags=["auth"])

@router.post("/login")
def login(form_data: OAuth2PasswordRequestForm = Depends(), db: Session = Depends(get_db)):
    # Raw SQL query to check user (matching Yii2 users table structure)
    user_query = text("SELECT id, username, password_hash, role FROM users WHERE username = :username")
    result = db.execute(user_query, {"username": form_data.username}).fetchone()
    
    if not result:
        raise HTTPException(status_code=400, detail="Incorrect username or password")
    
    # In Yii2, passwords usually use bcrypt
    try:
        # Python bcrypt expects bytes
        if not bcrypt.checkpw(form_data.password.encode('utf-8'), result.password_hash.encode('utf-8')):
             raise HTTPException(status_code=400, detail="Incorrect username or password")
    except ValueError:
         raise HTTPException(status_code=400, detail="Invalid password hash format in DB")

    access_token = create_access_token(
        data={"sub": result.username, "role": result.role or "viewer"}
    )
    return {"access_token": access_token, "token_type": "bearer", "role": result.role}

@router.get("/me")
def get_me(current_user: dict = Depends(get_current_user)):
    return {"username": current_user["username"], "role": current_user["role"]}
