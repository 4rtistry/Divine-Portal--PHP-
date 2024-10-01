<?php
require_once("php/connection.php");
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $updated_fname = htmlspecialchars($_POST['user_fname']);
    $updated_mname = htmlspecialchars($_POST['user_mname']);
    $updated_lname = htmlspecialchars($_POST['user_lname']);
    $updated_age = htmlspecialchars($_POST['user_age']);
    $updated_birthdate = htmlspecialchars($_POST['user_birthdate']);
    $user_username = htmlspecialchars($_POST['user_username']);
    $user_email = htmlspecialchars($_POST['user_email']);
    $registration_id = mysqli_real_escape_string($con, $_POST["registration_id"]);

    mysqli_begin_transaction($con);

    try {
        $sql1 = "UPDATE user_registration 
                 SET user_fname = ?, user_mname = ?, user_lname = ?, user_age = ?, user_birthdate = ?
                 WHERE registration_id = ?";
        $stmt1 = $con->prepare($sql1);
        $stmt1->bind_param("sssssi", $updated_fname, $updated_mname, $updated_lname, $updated_age, $updated_birthdate, $registration_id);
        $stmt1->execute();

        $sql2 = "UPDATE user_login 
                 SET user_username = ?, user_email = ?
                 WHERE registration_id = ?";
        $stmt2 = $con->prepare($sql2);
        $stmt2->bind_param("ssi", $user_username, $user_email, $registration_id);
        $stmt2->execute();

        mysqli_commit($con);

        $_SESSION["edit"] = "<script type='text/javascript'>window.alert('Successfully Updated');</script>";
        header("Location: profile.php");
    } catch (Exception $e) {
        mysqli_rollback($con);
        die("Error updating records: " . $e->getMessage());
    }

    $stmt1->close();
    $stmt2->close();
    $con->close();
}
?>
