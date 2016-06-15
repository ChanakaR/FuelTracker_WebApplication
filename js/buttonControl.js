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