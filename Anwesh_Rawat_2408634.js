                        /*Student Name: Anwesh Rawat
                          Student ID: 2408634
                        */ 
//function to save to local storage
function savetolocal(city,data){
    localStorage.setItem(city,data);
}

//Accessing DOM elements 
let searchInput = document.getElementById("searchText");
let searchBtn = document.getElementById("btn_search");
let saveBtn=document.getElementById("savebtn");
let city = document.getElementById("cityname");
let descW = document.getElementById("desc");
let icon = document.getElementById("icon");
let hum = document.getElementById("humidity");
let tempr = document.getElementById("temperature");
let pressure = document.getElementById("Pressure");
let wind = document.getElementById("Wind_Speed");
let dates = document.getElementById("date");
let days = document.getElementById("day");

//Getting Today's Date
var today = new Date();
var dd = String(today.getDate()).padStart(2, '0');
var mm = String(today.getMonth() + 1).padStart(2, '0'); 
var yyyy = today.getFullYear();
today = yyyy + '-' + mm + '-' + dd;//This is today's date

//Creating function to display data from localstorage if present
function displayfromLocal(cityname){
    datafromStrg=localStorage.getItem(cityname);
    data=JSON.parse(datafromStrg);//Convert to js Object
    city.innerHTML=data.city+", "+data.wcountry;
    descW.innerHTML =data.wcondition;
    icon.src="http://openweathermap.org/img/w/"+data.icon+".png";
    dates.innerHTML= data.wdate;
    days.innerHTML= data.wday;
    hum.innerHTML = data.humidity+"%";
    tempr.innerHTML=data.temp+"°C";
    pressure.innerHTML=data.pressure+" hPa";
    wind.innerHTML=data.wind+" m/s";
}

//Creating a custom url
let baseUrl = "http://localhost/Weather%20App/Prototype%202/index.php"

if(localStorage.getItem("Bardhaman")){
    displayfromLocal("Bardhaman");
}
else{
    //On loading, the assigned city is displayed due to this code
    fetch(baseUrl).then(async (response)=>{
            if (response.ok) {
                let data = await response.json();
                for(i=0;i<data.length;i++){
                    if (data[i].wdate===today){
                        document.getElementById("middledis").style.display='block';
                        document.getElementById("bottom").style.display='block';
                        city.innerHTML=data[i].city+", "+data[i].wcountry;
                        descW.innerHTML =data[i].wcondition;
                        icon.src="http://openweathermap.org/img/w/"+data[i].icon+".png";
                        dates.innerHTML= data[i].wdate;
                        days.innerHTML= data[i].wday;
                        hum.innerHTML = data[i].humidity+"%";
                        tempr.innerHTML=data[i].temp+"°C";
                        pressure.innerHTML=data[i].pressure+" hPa";
                        wind.innerHTML=data[i].wind+" m/s";
                        savetolocal(data[i].city,JSON.stringify(data[i]));
                    }
                    else{
                        city.innerHTML="Today's Weather data of this city not saved in database<br>Click save button to save latest data";
                        document.getElementById("middledis").style.display='none';
                        document.getElementById("bottom").style.display='none';
                    }
                }
            }
    
        }).catch((err)=>{
            console.log(err)
            alert("Network Error")
    });
}

if(localStorage.getItem(searchInput.value)){
    displayfromLocal(searchInput.value);
}
else{
    //when we click search, the code under this executes
    searchBtn.addEventListener("click", (event) => {
        event.preventDefault(); // This prevents the search button from refreshing the page.
        let searchT = "?city=" + searchInput.value;
        let apiurl = baseUrl + searchT;
        fetch(apiurl).then((response)=>response.json())
            .then(data=>{
                for(i=0;i<data.length;i++){
                    if (data[i].wdate===today){
                        document.getElementById("middledis").style.display='block';
                        document.getElementById("bottom").style.display='block';
                        city.innerHTML=data[i].city+", "+data[i].wcountry;
                        descW.innerHTML =data[i].wcondition;
                        icon.src="http://openweathermap.org/img/w/"+data[i].icon+".png";
                        dates.innerHTML= data[i].wdate;
                        days.innerHTML= data[i].wday;
                        hum.innerHTML = data[i].humidity+"%";
                        tempr.innerHTML=data[i].temp+"°C";
                        pressure.innerHTML=data[i].pressure+" hPa";
                        wind.innerHTML=data[i].wind+" m/s";
                        savetolocal(data[i].city,JSON.stringify(data[i]));
                    }
                    else{
                        city.innerHTML="Today's Weather data of this city not saved in database<br>Click save button to save latest data";
                        document.getElementById("middledis").style.display='none';
                        document.getElementById("bottom").style.display='none';
                    }
                }
        }).catch((err)=>{
            console.log(err)
            alert("Data of "+searchInput.value+" not saved in database")
        });
    })
}

//This event is trigerred when user decides to save data for a city
saveBtn.addEventListener("click",()=>{
    alert("Data has been saved successfully.")
})

