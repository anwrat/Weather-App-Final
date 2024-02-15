                                        <!--Student Name: Anwesh Rawat
                                            Student ID: 2408634
THIS PAGE SAVES DATA AND DISPLAYS DATA OF PAST WEEK-->
<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Anwesh_Rawat_2408634.css?v=<?php echo time(); ?>"><!--If CSS doesnot refresh press ctrl+f5-->
    <title>Weather API</title>
</head>
<body>
    <h1 class="toph">WEATHER FORECAST</h1>
    <div class="display">
        <div class="search">
            <iframe name="testframe" id="dummyframe" style="display: none;"></iframe>
            <form method="GET" id="mainform" action="savetodatabase.php" target="testframe">
                <input type="text" id="searchText" placeholder="Enter a city to search" name="city">
                <input type="submit" value="Search" id="btn_search">
                <input type="submit" value="Save data from API" id="savebtn">
            </form>
        </div>
        <h1 id="cityname"></h1>
        <div id="middledis">
            <img id="icon">
            <h1 id="temperature"></h1>
            <h2 id="desc"></h2>
            <hr class="smallline">
            <h2 id="day"></h2>
            <h2 id="date"></h2>
        </div>
        <div id="bottom">
            <div class="pressure">
                <h2>Pressure</h2>
                <hr class="fline">
                <h2 id="Pressure"></h2>
            </div>
            <div class="wind_speed">
                <h2>Wind Speed</h2>
                <hr class="sline">
                <h2 id="Wind_Speed"></h2>
            </div>
            <div class="humid">
                <h2>Humidity</h2>
                <hr class="tline">
                <h2 id="humidity"></h2>
            </div>
        </div>
    </div>
    <footer>
        <p>&copy;Anwesh Rawat 2408634</p>
    </footer>
    <?php 
        include("displaysaveddata.php");
    ?>
    <script src="./Anwesh_Rawat_2408634.js"></script>   
</body>
</html>