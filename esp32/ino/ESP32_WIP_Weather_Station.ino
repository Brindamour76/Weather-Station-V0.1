/***************WEATHER STATION************************************/
/*
VERSION 0.1


This is to be the code (Work In Progress) to be used on an ESP32
and run a weather station. It will take inputs from a number of 
environment sensors and upload to a MySQL DB (through a PHP webserver)
for use with a local web page.

Initial sensor will include a DHT11 temperature and humidity sensor,
as well as SPL06-007 barometric pressure sensor. I intend to make this
code scalable to add more sensors at a later stage. Also try to ensure
that code accomodates change in sensor to another type (eg a different
library and commands).

TODO: Also try to add a 'trending' feature to the sensor readings to determine
if they are going up or down.

11OCT2023: This version is currently in operation writing to a mysql 
database through a number of PHP files located on a linux webserver.


*/
/**********************************************************************/

//LED 
int LED_pin = 18;

//DHT11 Temp Humidty sensor variables
#include "DHTesp.h"
#define DHTpin 4    //D15 of ESP32 DevKit - Testing using pin 2NO use 4!!
DHTesp dht;
float temperature_internal;
float humidity_internal;


//SPL06-007 Barometric Pressure sensor variables
#include <SPL06-007.h>
#include <Wire.h>
float pressure_internal;


//WiFi Variables
//will update this to WiFiManager to allow for 
//non-hard-coding of SSID and WiFi password
#include <WiFi.h>
const char* ssid     = "********";
const char* password = "********";


//HTTP Client/Server Variables 
#include <HTTPClient.h>
String post_servername = "http://192.168.0.45/esp32/get_post_data.php";


//NTP
#include "time.h"
const char* ntp_server = "oceania.pool.ntp.org";
const long gmt_offset_sec = 28800;
const long dst_offset_sec = 0;


//System variables
const String api_key_value = "********";
unsigned long upload_timer = 60; //time in seconds, needs to be converted to ms
unsigned long current_time = 0;
unsigned long last_upload_time = 0;

/**********************************************************************/
void setup() {
  // put your setup code here, to run once:
  //Initialise serial for debugging
  Serial.begin(115200);

  //LED****************************
  //This illuminates on every sucessful upload
  pinMode(LED_pin, OUTPUT);
  digitalWrite(LED_pin, HIGH);
  delay(2000);
  digitalWrite(LED_pin, LOW);
  
  //Initialise Screen(s)***********
  //no screens yet

  //Inistialise DHT11**************
  dht.setup(DHTpin, DHTesp::DHT11);

  //Initialise SPL06***************
  Wire.begin();
  SPL_init();

  //Initialise WiFi****************
  Serial.println();
  Serial.print("[WiFi] Connecting to ");
  Serial.println(ssid);

  WiFi.begin(ssid, password);
  Serial.println("Connecting");
  while(WiFi.status() != WL_CONNECTED) { 
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.print("Connected to WiFi network with IP Address: ");
  Serial.println(WiFi.localIP());

  //Config NTP*********************
  //need further reading to use properly though
  configTime(gmt_offset_sec, dst_offset_sec, ntp_server);
  delay(3000);
  time_t now;
  Serial.println(time(&now));
  

//End Setup
}
/**********************************************************************/


/**********************************************************************/
void loop() {
  // put your main code here, to run repeatedly:
  //Timing: want to take readings every minute for upload
  current_time = millis();
  Serial.print("Millis Time: ");
  Serial.println(current_time/1000);
  /* EDIT: I have already done this without knowing, I think.
  Need to update the timing to acount for the rollover until RTC is added.
  unsigned long currentMillis = millis();
  if ((unsigned long)(currentMillis - previousMillis) >= interval) {
  https://www.baldengineer.com/arduino-how-do-you-reset-millis.html */
  
  
  //Function uploadToDB*****************
  //Upload every minute
  if ((unsigned long)(current_time - last_upload_time) >= upload_timer*1000){
    uploadToDB();
    last_upload_time = current_time; //Changed from last_upload_time = millis();
  }

  
  //NTP Time for testing and debugging
  time_t now;
  Serial.print("Epoch Time: ");
  Serial.println(time(&now));
  

  //Function readFromSensors************
  readFromSensors();


  //Confirm WiFi status*****************
  //Use this to display WiFi connected symbol
  Serial.print("WiFi Status: ");
  Serial.println(WiFi.status());


  //Function outputToScreens************
  outputToScreens();

  
  //for debug timing only, to be removed in final code
  delay(2000); 

//End Loop
}
/**********************************************************************/
