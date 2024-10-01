<?php

include("connection.php");

if(isset($_POST["create"])){
    $subject_code = mysqli_real_escape_string($con, $_POST["subject_code"]);
    $subject_title = mysqli_real_escape_string($con, $_POST["subject_title"]);
    $subject_units = mysqli_real_escape_string($con, $_POST["subject_units"]);
    $subject_section = mysqli_real_escape_string($con, $_POST["subject_section"]);
    $subject_schedule = mysqli_real_escape_string($con, $_POST["subject_schedule"]);
    $subject_room = mysqli_real_escape_string($con, $_POST["subject_room"]);
    $subject_instructor = mysqli_real_escape_string($con, $_POST["subject_instructor"]);
    
    $sql = "INSERT INTO advisement (subject_code, subject_title, subject_units, subject_section, subject_schedule, subject_room, subject_instructor)
    VALUES ('$subject_code', '$subject_title', '$subject_units', $subject_section, '$subject_schedule', '$subject_room', '$subject_instructor')";

    if(mysqli_query($con, $sql)){
        session_start();
        $_SESSION["create"] = "<script type='text/javascript'>window.alert('Movies is Successfully Added');</script>";

        header("Location:../advisement.php");
    }else{
        die("wrong");
    }

}

if(isset($_POST["edit"])){
    $MovieTitle = mysqli_real_escape_string($conn, $_POST["MovieTitle"]);
    $MovieDescription = mysqli_real_escape_string($conn, $_POST["MovieDescription"]);
    $MovieType = mysqli_real_escape_string($conn, $_POST["MovieType"]);
    $MoviePrice = mysqli_real_escape_string($conn, $_POST["MoviePrice"]);
    $MovieStatus = mysqli_real_escape_string($conn, $_POST["MovieStatus"]);
    $StartTime = mysqli_real_escape_string($conn, $_POST["StartTime"]);
    $CompletionTime = mysqli_real_escape_string($conn, $_POST["CompletionTime"]);

    $MovieId = mysqli_real_escape_string($conn, $_POST["MovieId"]);
    
    $sql = "UPDATE movies SET MovieTitle = '$MovieTitle', MovieDescription = '$MovieDescription', 
    MovieType = '$MovieType', MoviePrice = $MoviePrice, MovieStatus = '$MovieStatus', 
    StartTime = '$StartTime', CompletionTime = '$CompletionTime' WHERE MovieId=$MovieId";

    if(mysqli_query($conn, $sql)){
        session_start();
        $_SESSION["edit"] = "<script type='text/javascript'>window.alert('Movie is Successfully Updated');</script>";
        header("Location:../moviespage.php");
    }else{
        die("wrong");
    }

}

?>