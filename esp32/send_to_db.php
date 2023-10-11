<!--

PHP file used to write to and read from a MySQL Databse.

Write PHP functions to be accessed from other PHP files.

Initial function will write weather sensor variables to a database.

Later functions will be written to read from the database to provide data for display
on a local html page.

NOTE TODO: Determine OO or Procedural style MYSQLI.

--->


<?php

//Set database variables

$servername = "localhost";
$db_name = "sensor_data";
$username = "sensor_data";
$password = "Server123!";
$db_table_name = "TPH_data";

//********************************************************//
//Create as a function to write to DB
function writeDatabase($temperature, $pressure, $humidity) {
	global $servername, $username, $password, $db_name;
        //Connect to database

        $conn = new mysqli($servername, $username, $password, $db_name);

        if ($conn->connect_error){
                echo "No Connection to DB";
                //Add error logging here
        } else{
                //echo "Connection Successful";
        }

//Create query
        $sql_query = "INSERT INTO TPH_data (`temperature`, `pressure`, `humidity`) VALUES ($temperature, $pressure, $humidity)";
	

//Write to database
	if ($conn->query($sql_query) === TRUE){
		return "Record created successfully";
	} else {
		echo "Error: " . $sql_query . "<br>" . $conn->error;
	}
// Close mysql connection
	$conn->close();

}
//***********************************************************************//



//***********************************************************************//
//Create a function to get latest value from DB
function getLastValue($sensor){
	global $servername, $username, $password, $db_name;
        //Connect to database

        $conn = new mysqli($servername, $username, $password, $db_name);

        if ($conn->connect_error){
                echo "No Connection to DB";
                //Add error logging here
		return;
        } else{
                //echo "Connection Successful";
        }

	//Create query
        $sql_query = "SELECT " .  $sensor . " FROM TPH_data ORDER by id DESC LIMIT 1";
	//echo $sql_query;

	//Read data from database
	if ($result = $conn->query($sql_query)){
		$result1 = $result->fetch_assoc();
		//echo $result;
		return $result1;
 		
	} else {
		echo "Error: " . $sql_query . "<br>" . $conn->error;
	} 

}
//*****************************************************************//



//****************************************************************//
//Create a function to read last X values and return a trend
//Returns 'rising' or 'falling'
//NOT IN USE - Too difficult at the moment
//Need to create data functions to perform linear regression
function trendingData($sensor, $readings){
	global $servername, $username, $password, $db_name;
	
	//Connect to DB
	$conn = new mysqli($servername, $username, $password, $db_name);

        if ($conn->connect_error){
                echo "No Connection to DB";
                //Add error logging here
        } else{
                //echo "Connection Successful";
				//echo "\n";

        }

	//Create Query
	$sql_query = "SELECT MINUTE(time), " . $sensor . " FROM TPH_data ORDER by id DESC limit " . $readings;
	//echo $sql_query;

	//Fetch data from DB
	if ($result = $conn->query($sql_query)){
		//$result1 = $result->fetch_assoc();
		$result1 = $result->fetch_all();
		//echo "sendtoDB";
		//echo "\n";
		//print_r($result);
		//echo "\n";
		return $result1;
 		
	} else {
		echo "Error: " . $sql_query . "<br>" . $conn->error;
	}

	

}
//****************************************************************//


//****************************************************************//
//Create a function to read MIN value from the current day
//
function getMinValue($sensor_type){
	global $servername, $username, $password, $db_name;
	
	//Connect to DB
	$conn = new mysqli($servername, $username, $password, $db_name);

        if ($conn->connect_error){
                echo "No Connection to DB";
                //Add error logging here
        } else{
                //echo "Connection Successful";
        }

	//Create Query
	$sql_query = "SELECT MIN(" . $sensor_type . ") AS minval FROM TPH_data WHERE DATE(time) = CURRENT_DATE";
	//echo $sql_query;

	if ($result = $conn->query($sql_query)){
		$result1 = $result->fetch_assoc();
		//echo $result;
		return $result1;
 		
	} else {
		echo "Error: " . $sql_query . "<br>" . $conn->error;
	}

	

}
//****************************************************************//

//****************************************************************//
//Create a function to read MAX value from the current day
//
function getMaxValue($sensor_type){
	global $servername, $username, $password, $db_name;
	
	//Connect to DB
	$conn = new mysqli($servername, $username, $password, $db_name);

        if ($conn->connect_error){
                echo "No Connection to DB";
                //Add error logging here
        } else{
                //echo "Connection Successful";
        }

	//Create Query
	$sql_query = "SELECT MAX(" . $sensor_type . ") AS maxval FROM TPH_data WHERE DATE(time) = CURRENT_DATE";
	//echo $sql_query;

	if ($result = $conn->query($sql_query)){
		$result1 = $result->fetch_assoc();
		//echo $result1;
		return $result1;
 		
	} else {
		echo "Error: " . $sql_query . "<br>" . $conn->error;
	}

	

}
//****************************************************************//

//****************************************************************//
//Create a function to read MIN value from the Yesterday
//
function getMinValueYes($sensor_type){
	global $servername, $username, $password, $db_name;
	
	//Connect to DB
	$conn = new mysqli($servername, $username, $password, $db_name);

        if ($conn->connect_error){
                echo "No Connection to DB";
                //Add error logging here
        } else{
                //echo "Connection Successful";
        }

	//Create Query
	$sql_query = "SELECT MIN(" . $sensor_type . ") AS minval FROM TPH_data WHERE DATE(time) = CURRENT_DATE -1";
	//echo $sql_query;

	if ($result = $conn->query($sql_query)){
		$result1 = $result->fetch_assoc();
		//echo $result;
		return $result1;
 		
	} else {
		echo "Error: " . $sql_query . "<br>" . $conn->error;
	}

	

}
//****************************************************************//

//****************************************************************//
//Create a function to read MAX value from the yesterday
//
function getMaxValueYes($sensor_type){
	global $servername, $username, $password, $db_name;
	
	//Connect to DB
	$conn = new mysqli($servername, $username, $password, $db_name);

        if ($conn->connect_error){
                echo "No Connection to DB";
                //Add error logging here
        } else{
                //echo "Connection Successful";
        }

	//Create Query
	$sql_query = "SELECT MAX(" . $sensor_type . ") AS maxval FROM TPH_data WHERE DATE(time) = CURRENT_DATE - 1";
	//echo $sql_query;

	if ($result = $conn->query($sql_query)){
		$result1 = $result->fetch_assoc();
		//echo $result1;
		return $result1;
 		
	} else {
		echo "Error: " . $sql_query . "<br>" . $conn->error;
	}

	

}
//****************************************************************//

//Next Function


