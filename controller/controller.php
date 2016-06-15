<?php

// request for home - redirect to home.php
if($_GET['path']=='home'){
    echo("home");
    header("Location: ../view/home.php");
}

// request for driver - redirect to driver.php
if($_GET['path']=='driver'){
    echo("article");
    header("Location: ../view/driver.php");
}

// request for vehicle - redirect to vehicle.php
if($_GET['path']=='vehicle'){
    header("Location: ../view/vehicle.php");
}

// request for charts - redirect to chart.php
if($_GET['path']=='stat'){
    $ur = 'Location: ../view/stat_viewer.php?id='.$_GET["id"].'&vehicle='.$_GET["vehicle"].'&fd='.$_GET["fd"].'&bfc='.$_GET["bfc"];
    header($ur);
}

if($_GET['path']=='profile'){
    header("Location: ../view/profile.php");
}

if($_GET['path']=='av_vehicle'){
    header("Location: ../view/available_vehicles.php");
}

if($_GET['path']=='av_driver'){
    header("Location: ../view/available_drivers.php");
}

if($_GET['path']=='officer'){
    header("Location: ../view/Officer.php");
}

if($_GET['path']=='trip'){
    header("Location: ../view/trip.php");
}
