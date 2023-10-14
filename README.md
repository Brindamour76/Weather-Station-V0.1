#WIP Weather Station

**AIM:** To create an ESP32 based weather station and upload the data to a MySQL database.
The data stored will be displayed both on screen(s) attached to the ESP32 and, on a webpage.


##14th October, 2023:

**ESP32 Hardware:** Initial setup is an ESP32 sitting on a breadboard with a DHT11 temperature 
and humidity sensor and, an SPL06 baromatric pressure sensor. An LED flashes to indicate a 
sucessful upload to the database.

**PHP Files:** ability to upload the data from the ESP32. Can read back the last (current)
value from each sensor. Can read back the current days maximum and minimums as well as the
maximum and minimums from the previous day. Can also return the last 20 (or X) values for 
future use with trends.

**HTML and CSS:** basic web page can display current values as well as minimums and
maximums. Not a dynamoc web page, needs to be constantly refreshed to see updated values.





