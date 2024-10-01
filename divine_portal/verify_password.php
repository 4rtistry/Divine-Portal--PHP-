<?php
    require_once('php/connection.php');
    session_start();

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $regid = mysqli_real_escape_string($con, $_POST["regid"]);
        $password =  mysqli_real_escape_string($con, $_POST["password"]);

        $stmt = $con->prepare("SELECT user_password FROM user_login WHERE registration_id = ?");
        $stmt->bind_param("i", $regid);
        $stmt->execute();
        $stmt->bind_result($dbpassword);

        if($stmt->fetch()) {
            if ($dbpassword == $password) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false]);
            }
        
        } else {
            echo json_encode(['success' => false]);
        }
    }

    mysqli_close($con);
    exit;
?>
