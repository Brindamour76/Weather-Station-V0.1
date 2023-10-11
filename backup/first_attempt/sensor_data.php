<?php

//Database details
$servername = "localhost";
$database = "sensor_data";
$username = "sd";
$password = "Server123!";

//Create a Connection
$conn = mysqli_connect($servername, $username, $password, $database);

//Check the connection
if (!$conn) {
	die("Connection Failed: " . mysqli_connect_error());
}
echo "Connected Successfully";

//Create mysql query
$sql = "INSERT INTO TPH_data (temperature, pressure, humidity) VALUES (22.1, 1024.2, 12)";
echo $sql;


//Query mysql DB
if(mysqli_query($conn, $sql)) {
	echo "New record created successfully";
} else{
	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

//Close the connection to the database
mysqli_close($conn);
echo "Connection Closed";
?>

