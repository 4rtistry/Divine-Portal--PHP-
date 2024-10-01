<?php

if(isset($_GET['instructor_id'])){
    $instructor_id  = $_GET['instructor_id'];
    include("../../php/connection.php");

    $sql = "DELETE FROM instructor WHERE instructor_id=$instructor_id";
    if(mysqli_query($con, $sql)){
        session_start();
        $_SESSION["delete"] = "<script type='text/javascript'>window.alert('Movie is Successfully Deleted');</script>";

        header("Location:instructor_table.php");
    }
}   


?>