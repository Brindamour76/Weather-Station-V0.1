/* <!--
PHP file created to read data from a POST request passed from an ESP32 and send to another PHP which writes
the data to a MySQL database.

Data is passed from the ESP32 as weather variables, such as Temperature, Barometric Pressure, Humidity
to begin with. AS porject progresses may add other sensors such as rain guage, anenometer, wind vane.

WORK IN PROGRESSS

-->
*/


<?php

include_once('send_to_db.php');

// Variables
/*
$temperature;
$pressure;
$humidity;
$api_key;*/


//API Key

$api_key_value = "tabbimobile";


//Neutralise Data to prevent esidual valiuse from last POST cycle

$api_key = $temperature = $pressure = $humidity = " ";

//echo "You SUck";


// Read data from POST request and test api_key
//if API key ok, then write data to variables

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $api_key = $_POST["api_key"];
        //Test API key correct
       
}
else { 
        echo "No POST Data";
}

if ($api_key == $api_key_value){
        //Assign Data to variables
        $temperature = $_POST["temperature"];
        $pressure = $_POST["pressure"];
        $humidity = $_POST["humidity"];
        //Pass Variables to **.php file to write to DB
        writeDatabase($temperature, $pressure, $humidity);
        //TODO Write function in **.php file to 
        //echo "Back Here.";
}
else {
echo "API Key Incorrect";
}


// Sanitise data - maybe


