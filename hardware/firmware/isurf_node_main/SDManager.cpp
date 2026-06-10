#include "SDManager.h"
#include "config.h"

// If SD library is available
// #include <SPI.h>
// #include <SD.h>

SDManager::SDManager() {
    isAvailable = false;
}

void SDManager::begin() {
    // Serial.print("Initializing SD card...");
    // if (!SD.begin(PIN_SD_CS)) {
    //   Serial.println("initialization failed!");
    //   isAvailable = false;
    //   return;
    // }
    // Serial.println("initialization done.");
    // isAvailable = true;
    
    // File dataFile = SD.open("datalog.csv", FILE_WRITE);
    // if (dataFile) {
    //   dataFile.println("Timestamp,TDS,pH,Temp");
    //   dataFile.close();
    // }
}

void SDManager::logData(float tds, float ph, float temp) {
    if (!isAvailable) return;
    
    // File dataFile = SD.open("datalog.csv", FILE_WRITE);
    // if (dataFile) {
    //   dataFile.print(millis());
    //   dataFile.print(",");
    //   dataFile.print(tds);
    //   dataFile.print(",");
    //   dataFile.print(ph);
    //   dataFile.print(",");
    //   dataFile.println(temp);
    //   dataFile.close();
    //   Serial.println("Data saved to SD");
    // }
}
