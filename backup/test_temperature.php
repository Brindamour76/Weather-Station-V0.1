<?php
    function outputArray(){    
                include_once('esp32/send_to_db.php');

                //Number of readings
                $readings = 50;

                //Neutralise data
                $api_key = $trend = $sensor = " ";

                //Needed I think
                $data_array = array();
                $sensor = "temperature";
                $trend = trendingData($sensor, $readings);
                $title_array = array("Time", $sensor);
                array_push($data_array, $title_array);
                foreach ($trend as $values){
                    $temp_array = array();
                    array_push($temp_array, intval($values[0]), floatval($values[1]));
                    array_push($data_array, $temp_array);
                }

                $json = json_encode($data_array);
                $result_json = $json;

                echo $result_json;
    }            
?>


<!DOCTYPE html>
<html>

	<head> 
		<title>Weather Station</title>
        <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/reset.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/temperature.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&display=swap" rel="stylesheet"> 
	    <style></style>
    <!--Testing some Google charts scripts for graphing some data --->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable(
            outputArray();

        );

        var options = {
          title: 'Past 20 minutes',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
        


    </head>
        
    

    <body>
    <!--Dummy script to fix error with Firefox -->
    <script>0</script>
        <header class="header-strip">
                <nav class="navbar">
                    <img src="/images/temp-header.png" class="header-icon">
                    <ul>
                        <li><a href="index.php" class="header-box">HOME</a></li>
                        <li><a href="temperature.php" class="header-box">TEMPERATURE</a></li>
                        <li><a href=# class="header-box">PRESSURE</a></li>
                        <li><a href=# class="header-box">HUMIDITY</a></li>
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
                        <?php
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
                        <?php
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
                        <?php
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

                <section class="container yesterday-temperature-container">
                    

                    <div class="text">
                        Yeasterdays<br>minimum
                        </div>
                
                    <div class="box temperature-box">
                        <?php
                            $url = "http://192.168.0.45/esp32/read_minmax_value-1.php";

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
                        Yesterdays<br>maximum
                    </div>
                    <div class="box temperature-box">
                        <?php
                            $url = "http://192.168.0.45/esp32/read_minmax_value-1.php";

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

                <section class="container temperature-graph">
                <div id="curve_chart" style="width: 700px; height: 500px"></div>
                  
                </section>

   
                
 
            </div>
            <?php    
                include_once('esp32/send_to_db.php');

                //Number of readings
                $readings = 50;

                //Neutralise data
                $api_key = $trend = $sensor = " ";

                //Needed I think
                $data_array = array();
                $sensor = "temperature";
                $trend = trendingData($sensor, $readings);
                $title_array = array("Time", $sensor);
                array_push($data_array, $title_array);
                foreach ($trend as $values){
                    $temp_array = array();
                    array_push($temp_array, intval($values[0]), floatval($values[1]));
                    array_push($data_array, $temp_array);
                }

                $json = json_encode($data_array);
                $result_json = $json;

                echo $result_json;

        ?>

        </main>
        
    </body>
</html>

