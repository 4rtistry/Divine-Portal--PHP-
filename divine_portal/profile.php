<?php include("reuse_cmpnt/userinfo.php")?>

<?php

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

<?php

if (isset($_POST['user_birthdate'])) {
    $birthdate = new DateTime($_POST['user_birthdate']);
    $today = new DateTime('today');
    $age = $today->diff($birthdate)->y;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="css/style.css?<?php echo time(); ?>" />
    <link rel="stylesheet" type="text/css" href="css/style2.css?<?php echo time(); ?>" />

</head>
<body>

    <?php include("reuse_cmpnt/navigation.php"); ?>

    <div class="container">
    <form action="" method="POST">
        <input type="text" name="user_id" value="<?php echo $user_id ?>" readonly>
        <input type="text" name="user_type" value="<?php echo $user_type ?>" readonly>
        <input type="text" name="user_fname" value="<?php echo $user_fname ?>" readonly>
        <input type="text" name="user_mname" value="<?php echo $user_mname ?>" readonly>
        <input type="text" name="user_lname" value="<?php echo $user_lname ?>" readonly>
        <input type="text" name="user_username" value="<?php echo $user_username ?>" readonly>
        <input type="text" name="user_email" value="<?php echo $user_email ?>" readonly>
        <input type="text" name="user_age" value="<?php echo $user_age ?>" readonly>
        <input type="text" name="user_birthdate" value="<?php echo $user_birthdate ?>" readonly>
    </form>
    <button id="editBtn">Edit Information</button>
</div>

<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>

        <form method="POST" class="uptform">

            <label for="user_fname" class="disappear">First Name:</label>
            <input type="text" name="user_fname" class="disappear" value="<?php echo $user_fname ?>" ><br>

            <label for="user_mname" class="disappear">Middle Name:</label>
            <input type="text" name="user_mname" class="disappear" value="<?php echo $user_mname ?>" ><br>

            <label for="user_lname" class="disappear">Last Name:</label>
            <input type="text" name="user_lname" class="disappear" value="<?php echo $user_lname ?>" ><br>

            <label for="user_age" class="disappear">user_age:</label>
            <input type="number" id="user_age" name="user_age" class="disappear" value="<?php echo $user_age ?>" readonly><br>

            <label for="user_birthdate" class="disappear">Birthdate:</label>
            <input type="date" id="user_birthdate" name="user_birthdate" class="disappear" value="<?php echo $user_birthdate ?>"><br>

            <label for="user_username" class="disappear">user_username</label>
            <input type="text" name="user_username" class="disappear" value="<?php echo $user_username ?>" ><br>

            <label for="user_email" class="disappear">user_email:</label>
            <input type="text" name="user_email" class="disappear" value="<?php echo $user_email ?>" ><br>

            <input type="hidden" name="registration_id" class="regid" value="<?php echo $registration_id ?>">
            
            <label for="user_password" style="display:none;" class="labelclass">Confirm Password</label>
            
            <input type="hidden" name="user_password" id="user_password" class="user_password" required>

            <p class="wrongpass" style="color: red; display: none; ">Wrong password</p>

            <button type="submit" name="edit" id="submitbtn">Save Changes</button>

        </form>
    </div>
</div>



<script src="js/script.js"></script>

<script src="js/script2.js"></script>



</body>
</html>