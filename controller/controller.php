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
if($_GET['path']=='chart'){
    header("Location: ../view/chart.php");
}

if($_GET['path']=='profile'){
    header("Location: ../view/profile.php");
}


