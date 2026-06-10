import time
import random
import requests
import math

API_URL = "http://localhost:8000/iot/ingest"
API_KEY = "supersecure"

def send_data(device_code, sensor_name, value):
    payload = {
        "api_key": API_KEY,
        "device_code": device_code,
        "sensor_name": sensor_name,
        "value": round(value, 2)
    }
    try:
        requests.post(API_URL, json=payload)
        print(f"Sent {sensor_name}: {payload['value']}")
    except Exception as e:
        print(f"Failed to send data: {e}")

def main():
    print("Starting IoT Simulator...")
    step = 0
    while True:
        # Simulate Soil Moisture (Sine wave + noise)
        moisture = 60 + 20 * math.sin(step * 0.1) + random.uniform(-2, 2)
        send_data("ESP32_MAIN_01", "Soil Moisture Sensor 1", moisture)

        # Simulate Temperature
        temp = 25 + 5 * math.sin(step * 0.05) + random.uniform(-0.5, 0.5)
        send_data("ESP32_MAIN_01", "Air Temperature", temp)

        # Simulate Water Tank
        water = 80 - (step % 50) + random.uniform(-1, 1)
        send_data("ESP32_MAIN_01", "Water Tank Level", water)

        # Simulate TDS
        tds = 300 + 50 * math.sin(step * 0.2) + random.uniform(-10, 10)
        send_data("ESP32_MAIN_01", "Water Quality (TDS)", tds)

        step += 1
        time.sleep(30) # Send every 30 seconds

if __name__ == "__main__":
    main()
