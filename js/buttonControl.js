/**
 * Created by bmCSoft on 2016-05-17.
 */


function showVStatInDetail(){
    var v_id = document.getElementById("selected-row-id").val;
    var v_summary = document.getElementById("selected-vehicle-stat-summary").val;
    var url = "../controller/controller.php?path=stat&id="+v_id+"&"+v_summary;
    openURL(url);
}

function showAvailableVehicles(){

    var url = "../controller/controller.php?path=av_vehicle";
    openURL(url);
}

function showAvailableDrivers(){
    var url = "../controller/controller.php?path=av_driver";
    openURL(url);
}

function openURL(url){
    var win = window.open(url, '_blank');
    win.focus();
}

function logMe(){
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    var info_message = document.getElementById("log_info");
    if(username == "" || password == ""){
        info_message.innerHTML = "All fields are required."
    }
    else{

    }
}

function check_user(){
    var url = "http://localhost/FTApplicationServer/requestHandler.php?method=vehicle-stat&vehicle_id="+v_id;

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            var jo = JSON.parse(xhttp.responseText);
            document.getElementById("selected-vehicle-stat-summary").val += "&fd=" + jo["fav_driver"]+"&bfc="+jo["best_fuel_consumption"];
            var stat = "<b>Last trip</b> <br> distance : " + jo["ls_t_length"]+"km<br>date : "+ jo["ls_t_date"]+"<br>description :"+ jo["ls_t_description"]+"<br>-------------------";
            stat += "<br><b>Longest trip</b> <br> distance : " + jo["lg_t_length"]+"km<br>date : "+ jo["lg_t_date"]+"<br>description :"+ jo["lg_t_description"]+"<br>-------------------";
            stat += "<br><b>Shortest trip</b> <br> distance : " + jo["sh_t_length"]+"km<br>date : "+ jo["sh_t_date"]+"<br>description :"+ jo["sh_t_description"];

            var b_d_fc = "Favourite driver : " + jo["fav_driver"] + "<br> Best fuel consumption : "+jo["best_fuel_consumption"]+" kilometers per liter";

            document.getElementById("vehicle_stat_stat").innerHTML = stat;
            document.getElementById("best-driver-fc").innerHTML = b_d_fc;
        }
    };
    xhttp.open("GET",url,true);
    xhttp.send();
}