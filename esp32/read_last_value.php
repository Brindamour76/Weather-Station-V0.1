<?php

/*
Read last value from a column in a mysql database. Used to show the current temperature,
barometric pressure, or humidity.

WORK IN PROGRESSS
*/

include_once('send_to_db.php');

//API Key
$api_key_value = "tabbimobile";

//Neutralise Data to prevent esidual valiuse from last POST cycle
$api_key = $sensor_type = $input_value =  " ";

// Read data from POST request and test api_key
//if API key ok, then write data to variables
if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $api_key = $_POST["api_key"];
        //Test API key correct
        if ($api_key == $api_key_value){
		$sensor_type = $_POST["sensor_type"];
		
			if ($sensor_type == "temperature"){
				$input_value = $sensor_type;
				//echo "Temp   ";
			}
			elseif ($sensor_type == "pressure") {
				$input_value = $sensor_type;
				//echo "press";
			} 
			elseif ($sensor_type == "humidity") {
				$input_value = $sensor_type;
				//echo "humidity";
			}
			else {
				echo "Error no sensor specified";
			}
		
			//echo "    ";
			//echo $input_value;
            //Pass Variables to send_to_db.php file to read last value from DB
			$result1 = getLastValue($input_value);
            
		
			echo $result1[$input_value];
			//echo "Current " . $sensor_type . " is " . $result1[$input_value];
			//echo $result1;
			//return $result2; 
        }
        else {
        echo "API Key Incorrect";
        }
}
else { 
        echo "No POST Data";
}


// Sanitise data - maybe



