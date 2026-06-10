#ifndef SENSOR_MANAGER_H
#define SENSOR_MANAGER_H

#include <Arduino.h>

class SensorManager {
private:
    float tdsValue;
    float phValue;
    float temperature; // Defaults to 25.0 if no real sensor

    // Moving average buffers (simplified)
    int tdsAnalogRaw;
    int phAnalogRaw;

public:
    SensorManager();
    void begin();
    
    void readAllSensors();
    float getTdsValue();
    float getPhValue();
    float getTemperature();
    
    void updateDisplay(bool wifiConnected, bool pumpOn, bool fanOn);
    String buildJsonPayload();
};

#endif // SENSOR_MANAGER_H
