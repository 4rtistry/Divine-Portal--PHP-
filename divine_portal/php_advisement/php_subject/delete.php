<?php

if(isset($_GET['subject_id'])){
    $subject_id  = $_GET['subject_id'];
    include("../../php/connection.php");

    $sql = "DELETE FROM subjects WHERE subject_id=$subject_id";
    if(mysqli_query($con, $sql)){
        session_start();
        $_SESSION["delete"] = "<script type='text/javascript'>window.alert('Movie is Successfully Deleted');</script>";

        header("Location:subject_table.php");
    }
}   


?>