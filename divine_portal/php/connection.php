<?php

    $dbHost = "localhost";
    $dbUser = "root";
    $dbPass = "";
    $dbName = "divine_portal";

    $con = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

    if(!$con){
        die("No connection");
    }
    
?>