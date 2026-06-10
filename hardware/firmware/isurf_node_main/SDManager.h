#ifndef SD_MANAGER_H
#define SD_MANAGER_H

#include <Arduino.h>

class SDManager {
private:
    bool isAvailable;

public:
    SDManager();
    void begin();
    
    void logData(float tds, float ph, float temp);
};

#endif // SD_MANAGER_H
