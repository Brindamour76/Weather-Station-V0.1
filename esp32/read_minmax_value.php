<?php
/*
Used with Arduino based weather station to return the min or max
temperature, pressure, or humidity value from the current day.
will extend this to allow a particular day to be entered
*/

//Variables
$api_key_value = "tabbimobile";
include_once('send_to_db.php');

$api_key = $sensor_type = $minormax = " ";

//Read POSTed data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $api_key = $_POST["api_key"];
    $minormax = $_POST["minormax"];
    $sensor_type = $_POST["sensor_type"];
} 
else {
    echo "No post Data.";
}

//Test API key correct
if ($api_key == $api_key_value){
    switch($minormax){
        case "min":
            //echo "MIN";
            $result_min = getMinValue($sensor_type);
            echo $result_min["minval"];
            //echo "TURD";
            break;
        case "max":
            //echo "MAX";
            $result_max = getMaxValue($sensor_type);
            echo $result_max["maxval"];
            //echo "Bruv";
            break;


    }
    //echo $result[$sensor_type];
}
