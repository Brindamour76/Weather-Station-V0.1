<!DOCTYPE html>
<html>

	<head> 
		<title>Weather Station</title>
        <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/reset.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/index.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&display=swap" rel="stylesheet"> 
	    <style></style>
    </head>
        
    

    <body>
    <!--Dummy script to fix error with Firefox -->
    <script>0</script>
        <header class="header-strip">
                <nav class="navbar">
                    <img src="/images/index-header.png" class="header-icon">
                    <ul>
                        <li><a href="index.php" class="header-box">HOME</a></li>
                        <li><a href="temperature.php" class="header-box">TEMPERATURE</a></li>
                        <li><a href="pressure.php" class="header-box">PRESSURE</a></li>
                        <li><a href="humidity.php" class="header-box">HUMIDITY</a></li>
                    </ul>
                </nav>
        </header>

        <main>
            <div class="wrapper-main">
                
                <section class="container temperature-container">
                    <div class="text">
                        Current <br>temperature 
                    </div>
                    
                    <div class="box temperature-box">
                        <?php //PHp script to read the last (current) value of temperature
                            $url = "http://192.168.0.45/esp32/read_last_value.php";

                            $curl = curl_init($url);
                            curl_setopt($curl, CURLOPT_URL, $url);
                            curl_setopt($curl, CURLOPT_POST, true);
                            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

                            $headers = array(
                                "Content-Type: application/x-www-form-urlencoded",
                            );
                            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

                            $data = "api_key=tabbimobile&sensor_type=temperature";

                            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

                            $resp = curl_exec($curl);
                            curl_close($curl);
                            echo $resp;
                            //echo "<br>"; //Maybe create 2 divs inside for internal and external temps
                            //echo $resp; //Just creating the layout, would use this for the External temp
                        ?>  
                    </div>

                    <div class="text">
                        Todays<br>minimum
                        </div>
                
                    <div class="box temperature-box">
                        <?php //reads the current days minimum temperture so far
                            $url = "http://192.168.0.45/esp32/read_minmax_value.php";

                            $curl = curl_init($url);
                            curl_setopt($curl, CURLOPT_URL, $url);
                            curl_setopt($curl, CURLOPT_POST, true);
                            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

                            $headers = array(
                                "Content-Type: application/x-www-form-urlencoded",
                            );
                            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

                            $data = "api_key=tabbimobile&minormax=min&sensor_type=temperature";

                            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

                            $resp = curl_exec($curl);
                            curl_close($curl);
                            echo $resp;
                        ?>            
                    </div>
                    <div class="text">
                        Todays<br>maximum
                    </div>
                    <div class="box temperature-box">
                        <?php //reads the current days maximum temperature so far
                            $url = "http://192.168.0.45/esp32/read_minmax_value.php";

                            $curl = curl_init($url);
                            curl_setopt($curl, CURLOPT_URL, $url);
                            curl_setopt($curl, CURLOPT_POST, true);
                            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

                            $headers = array(
                                "Content-Type: application/x-www-form-urlencoded",
                            );
                            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

                            $data = "api_key=tabbimobile&minormax=max&sensor_type=temperature";

                            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

                            $resp = curl_exec($curl);
                            curl_close($curl);
                            echo $resp;
                        ?>

                    </div>

                </section>
                <br>
                <section class="container pressure-container">
                    <div class="text">
                        Current<br>barometer 
                    </div>
                    
                    <div class="box pressure-box">
                        <?php //Reads the last (current) pressure value recorded
                            $url = "http://192.168.0.45/esp32/read_last_value.php";

                            $curl = curl_init($url);
                            curl_setopt($curl, CURLOPT_URL, $url);
                            curl_setopt($curl, CURLOPT_POST, true);
                            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

                            $headers = array(
                                "Content-Type: application/x-www-form-urlencoded",
                            );
                            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

                            $data = "api_key=tabbimobile&sensor_type=pressure";

                            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

                            $resp = curl_exec($curl);
                            curl_close($curl);
                            echo $resp;
                            //echo "<br>"; //Maybe create 2 divs inside for internal and external temps
                            //echo $resp; //Just creating the layout, would use this for the External temp
                        ?>  
                    </div>

                    <div class="text">
                        Todays<br>minimum
                    </div>
                
                    <div class="box pressure-box">
                        <?php //reads the current days minimum pressure value so far
                            $url = "http://192.168.0.45/esp32/read_minmax_value.php";

                            $curl = curl_init($url);
                            curl_setopt($curl, CURLOPT_URL, $url);
                            curl_setopt($curl, CURLOPT_POST, true);
                            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

                            $headers = array(
                                "Content-Type: application/x-www-form-urlencoded",
                            );
                            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

                            $data = "api_key=tabbimobile&minormax=min&sensor_type=pressure";

                            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

                            $resp = curl_exec($curl);
                            curl_close($curl);
                            echo $resp;
                        ?>            
                    </div>
                    
                    <div class="text">
                        Todays<br>maximum
                    </div>
                    
                    <div class="box pressure-box">
                        <?php //reads the current days maximum temperature so far
                            $url = "http://192.168.0.45/esp32/read_minmax_value.php";

                            $curl = curl_init($url);
                            curl_setopt($curl, CURLOPT_URL, $url);
                            curl_setopt($curl, CURLOPT_POST, true);
                            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

                            $headers = array(
                                "Content-Type: application/x-www-form-urlencoded",
                            );
                            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

                            $data = "api_key=tabbimobile&minormax=max&sensor_type=pressure";

                            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

                            $resp = curl_exec($curl);
                            curl_close($curl);
                            echo $resp;
                        ?>

                    </div>

                </section>
                <br>
                <section class="container humidity-container">
                    <div class="text">
                        Current<br>humidity 
                    </div>
                    
                    <div class="box humidity-box">
                        <?php //reads the last (current) humidity value
                            $url = "http://192.168.0.45/esp32/read_last_value.php";

                            $curl = curl_init($url);
                            curl_setopt($curl, CURLOPT_URL, $url);
                            curl_setopt($curl, CURLOPT_POST, true);
                            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

                            $headers = array(
                                "Content-Type: application/x-www-form-urlencoded",
                            );
                            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

                            $data = "api_key=tabbimobile&sensor_type=humidity";

                            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

                            $resp = curl_exec($curl);
                            curl_close($curl);
                            echo $resp;
                            //echo "<br>"; //Maybe create 2 divs inside for internal and external temps
                            //echo $resp; //Just creating the layout, would use this for the External temp
                        ?>  
                    </div>

                    <div class="text">
                        Todays<br>minimum
                    </div>
                
                    <div class="box humidity-box">
                        <?php //reads the current days minimum humidity value so far
                            $url = "http://192.168.0.45/esp32/read_minmax_value.php";

                            $curl = curl_init($url);
                            curl_setopt($curl, CURLOPT_URL, $url);
                            curl_setopt($curl, CURLOPT_POST, true);
                            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

                            $headers = array(
                                "Content-Type: application/x-www-form-urlencoded",
                            );
                            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

                            $data = "api_key=tabbimobile&minormax=min&sensor_type=humidity";

                            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

                            $resp = curl_exec($curl);
                            curl_close($curl);
                            echo $resp;
                        ?>            
                    </div>
                    
                    <div class="text">
                        Todays<br>maximum
                    </div>
                    
                    <div class="box humidity-box">
                        <?php //reads the current days maximum humidity value so far
                            $url = "http://192.168.0.45/esp32/read_minmax_value.php";

                            $curl = curl_init($url);
                            curl_setopt($curl, CURLOPT_URL, $url);
                            curl_setopt($curl, CURLOPT_POST, true);
                            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

                            $headers = array(
                                "Content-Type: application/x-www-form-urlencoded",
                            );
                            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

                            $data = "api_key=tabbimobile&minormax=max&sensor_type=humidity";

                            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

                            $resp = curl_exec($curl);
                            curl_close($curl);
                            echo $resp;
                        ?>

                    </div>

                </section>
            </div>
        </main>
    </body>
</html>

