<?php 
    echo"<h2 class='disHis'>Saved Data of Bardhaman</h2>";?>
    <div class="his">
        <?php
        $servername="localhost";
        $username="root";
        $password="";
        $database="weather_data";
    
        $conn=mysqli_connect($servername,$username,$password,$database);
        $currentDate = date("Y-m-d");
        $befSeven=date("Y-m-d",strtotime("-7 days"));//this gives the date 7 days prior
        $display="SELECT* FROM weatherdata where city='Bardhaman' AND wdate>='$befSeven' AND wdate<'$currentDate' ORDER BY wdate ";
        $citydata=mysqli_query($conn,$display);
        if (mysqli_num_rows($citydata)>0){
            while ($cityrow=mysqli_fetch_assoc($citydata)){
                echo"<div style='background-color:#6b8eb0;float:left;padding:3px;border-radius:10px;margin-left:10px;'>";
                $iconUrl = "http://openweathermap.org/img/wn/{$cityrow['icon']}.png";
                echo"<img src='$iconUrl'>";
                echo"<h3>".$cityrow['temp']."°C"."</h3>";
                echo"<hr style=' border: 1px solid #ffffff;margin-left: 20px;margin-right: 20px;'";
                echo"<h4 style='font-weight:900;'>".$cityrow['wdate']."</h4>";
                echo"<h5>".$cityrow['wday']."</h5>";
                echo"</div>";
            }
        }
        else{
            echo"<h2>No saved data found</h2>";
        }
        mysqli_close($conn);
        ?>
    </div>