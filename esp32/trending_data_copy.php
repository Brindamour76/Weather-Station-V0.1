<!--
PHP File created to read the last 20(?) entries in a database and create a trend.
This is for an ESP32 based weather station.
This PHP file will return 'rising' or 'falling' depending on the trending data.
The database entries are uploaded from the ESP32 weather station.

WORK IN PROGRESSS

boo--->



<?php

include_once('send_to_db.php');

//API Key
$api_key_value = "tabbimobile";

//Number of readings
$readings = 20;

//Neutralise data
$api_key = $trend = $sensor = " ";

//Needed I think
$data_array = array();

//Read POST data from ESP32
/*if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$api_key = $_POST["api_key"];
	
}

//Test API Key is correct
if ($api_key == $api_key_value){
	$sensor = $_POST["sensor"];
	$readings = $_POST["readings"];
	//Read last X amount of values
	$trend = trendingData($sensor, $readings);
}
else {
		echo "API Key is incorrect";
}*/

//Testing debug
//print_r($trend);
//print_r($trend[19]);
$title_array = array("Time", $sensor);
array_push($data_array, $title_array);
foreach ($trend as $values){
	/*data obtained from database is not in useable format, 
	use this foreach loop to change from arrays within an 
	array to a single array with just the last X values.
	There may be a better way to do this.*/
	//print_r($values[0]);
	//echo "\n";
	//echo "***********";
	//echo "\n";

	//Push data into neat array
	//Doing a double push to include the time
	$temp_array = array();
	array_push($temp_array, $values[0], $values[1]);
	array_push($data_array, $temp_array);
}

/*echo "\n";
echo "***********";
echo "\n";
print_r($data_array);
echo "\n";
echo "***********";
echo "\n";*/

//JSON Encode practice

$json = json_encode($data_array);
$result_json = $json;

print_r($result_json);

//return $result_json;
//Sanitise data - maybe



