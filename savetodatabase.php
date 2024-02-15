<?php    //This page saves data to database
        //Student Name:Anwesh Rawat
        //Student ID: 2408634
                         
    if(isset($_GET['city']) && !empty($_GET['city'])){
        $city=$_GET['city'];
    }
    else{
        $city="Bardhaman";
    }
    $apiUrl = "https://api.openweathermap.org/data/2.5/weather?q=${city}&appid=76af7d074cf1b74aa95f44c65eac5942&units=metric";
    $json = file_get_contents($apiUrl);
    $data = json_decode($json,true); 
    if(isset($data)){
        $cityn=$data['name'];
        $desc=$data['weather'][0]['description'];
        $icon=$data['weather'][0]['icon'];
        $hum = $data['main']['humidity'];
        $pressure=$data['main']['pressure'];
        $wind=$data['wind']['speed'];
        $tempr=$data['main']['temp'];
        $date = date("Y-m-d");
        $day=date('l');
        $country=$data['sys']['country'];
    }
    $servername="localhost";
    $username="root";
    $password="";
    $database="weather_data";

    $conn=mysqli_connect($servername,$username,$password,$database);
    $selectCheck="SELECT * FROM weatherdata WHERE city='$cityn' AND wdate='$date'";
    $result=mysqli_query($conn,$selectCheck);
    if(mysqli_num_rows($result)>0){
        $updateData = "UPDATE weatherdata SET `wcondition`='$desc', temp=$tempr, humidity=$hum, wind=$wind, pressure=$pressure, icon='$icon',wday='$day'
        WHERE city='$cityn' AND wdate='$date'";
        $upd=mysqli_query($conn, $updateData);
    }
    else {
        $insertData = "INSERT INTO weatherdata(city, wcondition, temp, humidity, wind, pressure, icon, wdate,wday,wcountry) 
            VALUES ('$cityn', '$desc', $tempr, $hum, $wind, $pressure, '$icon', '$date','$day','$country')";
        $ins=mysqli_query($conn, $insertData);

    }
    mysqli_close($conn);
    ?>