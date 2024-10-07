#include <ESP8266WiFi.h>
#include <DHT.h>
#include <ThingSpeak.h>

#define DHTPIN D2
#define DHTTYPE DHT11
#define SOIL_MOISTURE_PIN A0
#define LDR_PIN D8
#define RELAY_PIN D1

DHT dht(DHTPIN, DHTTYPE);

const char* ssid = "YOUR_WIFI_SSID";       
const char* password = "YOUR_WIFI_PASSWORD"; 

WiFiClient client;
unsigned long myChannelNumber = YOUR_CHANNEL_NUMBER_THINGSPEAK; 
const char* myWriteAPIKey = "YOUR_WRITE_API_THINGSPEAK";

// Interval Decision Relay ON/OFF
const unsigned long wateringInterval = 60000; // 1 menit
// const unsigned long wateringInterval = 10000; / 10 detik
// const unsigned long wateringInterval = 3600000; / 1 jam
// const unsigned long wateringInterval = 7200000; / 2 jam

unsigned long previousMillis = 0;

// Konstanta untuk menghitung persentase kelembapan tanah
const int soilMoistureMin = 250; // Nilai minimum dari sensor kelembapan tanah
const int soilMoistureMax = 1023; // Nilai maksimum dari sensor kelembapan tanah

void setup() {
  Serial.begin(115200);
  dht.begin();
  pinMode(RELAY_PIN, OUTPUT);
  digitalWrite(RELAY_PIN, HIGH);  // Relay off by default
  pinMode(LDR_PIN, INPUT);

  // Menghubungkan ke WiFi
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("\nConnected to WiFi");
  
  ThingSpeak.begin(client);
}

void loop() {
  unsigned long currentMillis = millis();

  float humidity = dht.readHumidity();
  float temperature = dht.readTemperature();
  int soilMoistureValue = analogRead(SOIL_MOISTURE_PIN);
  int ldrValue = digitalRead(LDR_PIN);
  ldrValue = !ldrValue;

  // Menghitung kelembapan tanah dalam persentase
  float soilMoisturePercent = map(soilMoistureValue, soilMoistureMin, soilMoistureMax, 100, 0);

  Serial.print("Humidity: ");
  Serial.print(humidity);
  Serial.print(" %\t");
  Serial.print("Temperature: ");
  Serial.print(temperature);
  Serial.print(" *C\t");
  Serial.print("Soil Moisture: ");
  Serial.print(soilMoisturePercent);
  Serial.print(" %\t");
  Serial.print("LDR Value: ");
  Serial.println(ldrValue);

  String weatherCondition = determineWeatherCondition(humidity, temperature, ldrValue);
  Serial.print("Weather Condition: ");
  Serial.println(weatherCondition);

  int relayStatus = digitalRead(RELAY_PIN);

  // Mengirim data ke ThingSpeak
  ThingSpeak.setField(1, humidity);
  ThingSpeak.setField(2, temperature);
  ThingSpeak.setField(3, soilMoisturePercent);
  ThingSpeak.setField(4, ldrValue);
  ThingSpeak.setField(5, relayStatus == LOW ? 1 : 0);
  // ThingSpeak.setField(5, digitalRead(RELAY_PIN) == LOW ? 1 : 0);
  // ThingSpeak.setField(5, digitalRead(RELAY_PIN) == HIGH ? 1 : 0);
  int x = ThingSpeak.writeFields(myChannelNumber, myWriteAPIKey);
  if (x == 200) {
    Serial.println("Data successfully sent to ThingSpeak");
  } else {
    Serial.println("Error sending data to ThingSpeak: " + String(x));
  }

  // Mengecek apakah interval waktu telah berlalu
  if (currentMillis - previousMillis >= wateringInterval) {
    previousMillis = currentMillis;  // Simpan waktu saat ini

    bool shouldWater = determineWatering(humidity, temperature, soilMoisturePercent, weatherCondition);
    if (shouldWater) {
      digitalWrite(RELAY_PIN, LOW);
      ThingSpeak.setField(5, relayStatus == LOW ? 0 : 1);
      delay(4000);  // Menyiram selama 4 detik
      digitalWrite(RELAY_PIN, HIGH);  // Matikan pompa
    }
  }

  delay(1000);  // Tunggu 1 detik sebelum membaca lagi
}

String determineWeatherCondition(float humidity, float temperature, int ldrValue) {
  if (ldrValue == LOW && humidity > 80) {
    return "Hujan";
  } else if (ldrValue == LOW && humidity <= 80) {
    return "Berawan";
  } else if (ldrValue == HIGH && temperature >= 33) {
    return "Panas";
  } else {
    return "Cerah";
  }
}

bool determineWatering(float humidity, float temperature, float soilMoisturePercent, String weatherCondition) {
  if (weatherCondition == "Panas") {
    if (temperature >= 33) {
      if (humidity < 60 && soilMoisturePercent < 65) {
        return true;  // Pompa Air ON
      } else if (humidity < 60 && soilMoisturePercent >= 65) {
        return false; // Pompa Air OFF
      } else if (humidity >= 60 && soilMoisturePercent < 65) {
        return true;  // Pompa Air ON
      } else if (humidity >= 60 && soilMoisturePercent >= 65) {
        return false; // Pompa Air OFF
      }
    }
  } else if (weatherCondition == "Cerah") {
    if (temperature >= 25 && temperature <= 33) {
      if (humidity < 60 && soilMoisturePercent < 65) {
        return true;  // Pompa Air ON
      } else if (humidity < 60 && soilMoisturePercent >= 65) {
        return false; // Pompa Air OFF
      } else if (humidity >= 60 && soilMoisturePercent < 65) {
        return true;  // Pompa Air ON
      } else if (humidity >= 60 && soilMoisturePercent >= 65) {
        return false; // Pompa Air OFF
      }
    }
  } else if (weatherCondition == "Berawan") {
    if (temperature >= 25 && temperature <= 30) {
      if (humidity < 60 && soilMoisturePercent < 65) {
        return true;  // Pompa Air ON
      } else if (humidity >= 60 && soilMoisturePercent >= 65) {
        return false; // Pompa Air OFF
      }
    }
  } else if (weatherCondition == "Hujan") {
    if (temperature < 25) {
      if (soilMoisturePercent < 65) {
        return true;  // Pompa Air ON
      } else if (soilMoisturePercent >= 65) {
        return false; // Pompa Air OFF
      }
    }
  }
  return false;
}
