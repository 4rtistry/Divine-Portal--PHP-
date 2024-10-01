<?php
    include("../php/connection.php");
    session_start();

    if (empty($_SESSION["user_fname"]) || empty($_SESSION["user_mname"]) || empty($_SESSION["user_lname"]) ||
     empty($_SESSION["user_email"]) || empty($_SESSION["user_type"])) {
        header('Location: login.php');
    }

?>

<?php
if(isset($_POST['create'])){
    $subject_id = mysqli_real_escape_string($con, $_POST['subject_id']);
    $subject_section = mysqli_real_escape_string($con, $_POST['subject_section']);
    $subject_room = mysqli_real_escape_string($con, $_POST['subject_room']);

    $sql = "INSERT INTO advisement_try (subject_id, subject_section, subject_room)
    VALUES ('$subject_id','$subject_section', '$subject_room')";

    if(mysqli_query($con, $sql)){
        session_start();
        echo "<script> alert('Succesful'); </script>";
        header("Location:../advisement.php"); 
    }else{
        die("Connection Blocked");
    }     

}
?>

<?php

$sql1 = "SELECT t.*, m.*
FROM advisement_try t
INNER JOIN subjects m ON t.subject_id = m.subject_id";


$result = $con->query($sql1);
$row = $result->fetch_assoc();

$sql3 = "SELECT *
FROM subjects";

$result3 = $con->query($sql3);
$row3 = $result3->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="../css/style.css?<?php echo time(); ?>" />
    <link rel="stylesheet" type="text/css" href="../css/style2.css?<?php echo time(); ?>" />
    <link rel="stylesheet" type="text/css" href="../css/advisementv2.css?<?php echo time(); ?>"/>
    
</head>
<body>

    <div class="background">

        <div class="nav">

                <div class="margin">

                    <div class="logo">
                        <img src="../img/dwcl.png" alt="">

                        <div class="text">

                            <h1> <?php echo $_SESSION['user_fname'] . '&nbsp;' . $_SESSION['user_mname'] . '&nbsp;' .  $_SESSION['user_lname'] ?></h1>
                            <span class="utype"><?php echo $_SESSION['user_type'] ?></span>
                            <span class="mail"><i class='bx bx-envelope'></i><?php echo $_SESSION['user_email'] ?></span>
                    
                        </div>
                    </div>

                    <div class="links">
                        <i class='bx bxs-user-circle'></i>

                        <form action="php/logout.php" method="post">
                            <input type="submit" value="Logout" name="logout">
                        </form>
                    </div>

                </div>
        </div>

        <div class="divine">

                <div class="margin2">
                    <ul>
                        <li><a href="../dashboard.php">Dashboard</a></li>
                        <li>My Profile</li>
                        <li>Grades</li>
                        <li>Prospectus</li>
                        <li><a href="../advisement.php">Advisement</a></li>
                        <li>Assessment</li>
                        <li>Evaluation</li>
                        <li>Inbox</li>
                    </ul>
                </div>
        
        </div>

        <div class="main_content">

            <div class="advisement_crud">

                <form action="" method="post">

                <!-- <div class="crud_header">

                <h1>Assign Subjects</h1>
                <a id="mback" href="../advisement.php"><i class='bx bx-arrow-back'></i> Back</a>

                </div> -->

                <div class="row_one">

                    <div class="form">
                    <label for="subject_id">Catalog No</label>
                    <select name="subject_id" id="subject_id">
                        <option value="">-</option>
                        <?php 
                        foreach($result3 as $row) {
                            echo "<option value='" . $row["subject_id"] . "'>" . $row["subject_code"] . "</option>";
                        }
                        ?>
                    </select>
                    </div>

                    <div class="form">
                    <label for="subject_title">Descriptive Title</label>
                    <input type="text" class="formcontrol" id="subject_title" name="subject_title" placeholder="subject title" readonly>

                    </div>

                </div>

                <div class="row_two">

                <div class="form">
                <label for="subject_units">Units</label>
                <input type="text" class="formcontrol" id="subject_units" name="subject_units" placeholder="subject units" readonly>
                </div>

                <div class="form">
                    <label for="subject_section">Section</label>
                    <input type="text" class="formcontrol" name="subject_section" placeholder="subject room">
                
                </div>

                <div class="form">
                <label for="subject_units">Units</label>
                <input type="text" class="formcontrol" id="subject_units" name="subject_units" placeholder="subject units" readonly>
                </div>

                </div>


                <input type="submit" class="btn" name="create" value="Add subject">
            
            </form>


            </div>

        </div>



        </div>
    </div>

    <script src="scripttry.js"></script>
    
</body>
</html>