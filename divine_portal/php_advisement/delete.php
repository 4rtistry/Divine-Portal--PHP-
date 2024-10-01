<?php

if(isset($_GET['advisement_id'])){
    $advisement_id = $_GET['advisement_id'];
    include("../php/connection.php");

    $sql = "DELETE FROM advisement WHERE advisement_id=$advisement_id";
    if(mysqli_query($con, $sql)){
        session_start();
        $_SESSION["delete"] = "<script type='text/javascript'>window.alert('Movie is Successfully Deleted');</script>";

        header("Location:../advisement.php");
    }
}   


?>