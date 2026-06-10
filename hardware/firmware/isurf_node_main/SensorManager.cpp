#include "SensorManager.h"
#include "config.h"

// If OLED libraries are available:
// #include <Wire.h>
// #include <Adafruit_GFX.h>
// #include <Adafruit_SSD1306.h>
// Adafruit_SSD1306 display(SCREEN_WIDTH, SCREEN_HEIGHT, &Wire, -1);

SensorManager::SensorManager() {
    tdsValue = 0.0;
    phValue = 7.0;
    temperature = 25.0; // Default compensation temp
}

void SensorManager::begin() {
    pinMode(PIN_TDS_SENSOR, INPUT);
    pinMode(PIN_PH_SENSOR, INPUT);

    // Initialize OLED if used
    // if(!display.begin(SSD1306_SWITCHCAPVCC, 0x3C)) {
    //   Serial.println(F("SSD1306 allocation failed"));
    // }
    // display.clearDisplay();
    // display.setTextColor(WHITE);
}

void SensorManager::readAllSensors() {
    // 1. Read TDS (DFRobot Analog TDS)
    tdsAnalogRaw = analogRead(PIN_TDS_SENSOR);
    float voltage = tdsAnalogRaw * (5.0 / 1024.0); // 5V ADC
    // Temperature compensation formula
    float compensationCoefficient = 1.0 + 0.02 * (temperature - 25.0);
    float compensationVoltage = voltage / compensationCoefficient;
    // Convert voltage to TDS value
    tdsValue = (133.42 * compensationVoltage * compensationVoltage * compensationVoltage 
             - 255.86 * compensationVoltage * compensationVoltage 
             + 857.39 * compensationVoltage) * 0.5;

    // 2. Read Soil pH
    phAnalogRaw = analogRead(PIN_PH_SENSOR);
    float phVoltage = phAnalogRaw * (5.0 / 1024.0);
    // Dummy conversion (need actual sensor calibration logic)
    phValue = 3.5 * phVoltage; 
    
    // Constraint values
    if(tdsValue < 0) tdsValue = 0;
    if(phValue < 0) phValue = 0;
    if(phValue > 14) phValue = 14;

    Serial.print("TDS: "); Serial.print(tdsValue); Serial.print(" ppm | ");
    Serial.print("pH: "); Serial.print(phValue); Serial.println("");
}

float SensorManager::getTdsValue() { return tdsValue; }
float SensorManager::getPhValue() { return phValue; }
float SensorManager::getTemperature() { return temperature; }

void SensorManager::updateDisplay(bool wifiConnected, bool pumpOn, bool fanOn) {
    // Dummy display logic
    // display.clearDisplay();
    // display.setCursor(0,0);
    // display.print("iSURF: "); display.println(wifiConnected ? "WIFI OK" : "NO WIFI");
    // display.print("TDS: "); display.print(tdsValue); display.println(" ppm");
    // display.print("pH : "); display.println(phValue);
    // display.print("Pump:"); display.print(pumpOn ? "ON " : "OFF");
    // display.print(" Fan:"); display.println(fanOn ? "ON" : "OFF");
    // display.display();
}

String SensorManager::buildJsonPayload() {
    // Create JSON payload for FastAPI endpoint
    String json = "{\"readings\": [";
    
    // TDS Reading
    json += "{\"sensor_type\": \"tds\", \"value\": " + String(tdsValue) + "},";
    // pH Reading
    json += "{\"sensor_type\": \"ph\", \"value\": " + String(phValue) + "},";
    // Temp Reading
    json += "{\"sensor_type\": \"temperature\", \"value\": " + String(temperature) + "}";
    
    json += "]}";
    return json;
}
