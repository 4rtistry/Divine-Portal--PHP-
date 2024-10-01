<?php
require_once("../php/connection.php");
session_start();

    $registration_id = $_SESSION["registration_id"];

    $stmt = $con->prepare("SELECT * FROM user_registration WHERE registration_id = ?");
    $stmt->bind_param('i', $registration_id);
    $stmt->execute();
    $stmt->bind_result($registration_id, $user_id, $user_type, $user_fname, $user_mname, $user_lname, $user_age, $user_birthdate);
    $stmt->fetch();
    $stmt->close();

    $stmt_login = $con->prepare("SELECT * FROM user_login WHERE registration_id = ?");
    $stmt_login->bind_param('i', $registration_id);
    $stmt_login->execute();
    $stmt_login->bind_result($login_id, $registration_id , $user_username, $user_email, $user_password);
    $stmt_login->fetch();
    $stmt_login->close();

?>