/***************WEATHER STATION************************************/
/*
Place functions into this file.
*/
/******************************************************************/


//readFromSensors
void readFromSensors() {
  Serial.println("readFromSensors function");
  humidity_internal = dht.getHumidity();
  temperature_internal = dht.getTemperature();
  pressure_internal = get_pressure();
  Serial.println(humidity_internal);
  Serial.println(pressure_internal);
  Serial.println(temperature_internal);
  return;
}


//outputToScreens
void outputToScreens() {
  //UNsure of what screens I will be using yet
  Serial.println("outputToScreens function");
  return;
}


//uploadToDB
void uploadToDB() {
  Serial.println("uploadToDB function");

  HTTPClient http;
  Serial.println("httpClient");
  http.begin(post_servername);
  Serial.println("HTTP Server has begun");
  
  http.addHeader("Content-Type", "application/x-www-form-urlencoded");
  String httpRequestData = "api_key="+api_key_value+"&temperature="+temperature_internal+"&pressure="+pressure_internal+"&humidity="+humidity_internal;

  //POST data
  int httpResponseCode = http.POST(httpRequestData);
  
  if (httpResponseCode != 200) {
     Serial.println(httpResponseCode);
  } else {
    Serial.println("Data written to DB OK.");
    digitalWrite(LED_pin, HIGH);
    delay(500);
    digitalWrite(LED_pin, LOW);
  }
  
  return;
}