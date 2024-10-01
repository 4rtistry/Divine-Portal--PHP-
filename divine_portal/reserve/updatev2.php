<?php
    include("../php/connection.php");
    session_start();

    if (empty($_SESSION["user_fname"]) || empty($_SESSION["user_mname"]) || empty($_SESSION["user_lname"]) ||
     empty($_SESSION["user_email"]) || empty($_SESSION["user_type"])) {
        header('Location: login.php');
    }

?>

<?php

if(isset($_POST["edit"])){
    $subject_code = mysqli_real_escape_string($con, $_POST['subject_code']);
    $subject_title = mysqli_real_escape_string($con, $_POST['subject_title']);
    $subject_units = mysqli_real_escape_string($con, $_POST['subject_units']);
    $subject_section = mysqli_real_escape_string($con, $_POST['subject_section']);
    $subject_schedule = mysqli_real_escape_string($con, $_POST['subject_schedule']);
    $subject_room = mysqli_real_escape_string($con, $_POST['subject_room']);
    $instructor_id = mysqli_real_escape_string($con, $_POST["instructor_id"]);

    $advisement_id = mysqli_real_escape_string($con, $_POST["advisement_id"]);
    
    $sql = "UPDATE advisement SET subject_code = '$subject_code', subject_title = '$subject_title', 
    subject_units = '$subject_units', subject_section = '$subject_section', subject_schedule = '$subject_schedule', 
    subject_room = '$subject_room', instructor_id = $instructor_id WHERE advisement_id = $advisement_id";

    if(mysqli_query($con, $sql)){
        session_start();
        $_SESSION["edit"] = "<script type='text/javascript'>window.alert('Movie is Successfully Updated');</script>";
        header("Location:../advisement.php");
    }else{
        die("wrong");
    }

}
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

                <?php
                 if(isset($_GET["advisement_id"])){
                    $advisement_id = $_GET["advisement_id"];

                    $sql1 = "SELECT t.*, m.*
                    FROM advisement t
                    INNER JOIN instructor m ON t.instructor_id = m.instructor_id
                    WHERE t.advisement_id=$advisement_id";

                    $result = mysqli_query($con, $sql1);
                    $row1 = mysqli_fetch_array($result);

                    $sql2 = "SELECT *
                    FROM instructor";
                    
                    $result2 = $con->query($sql2);
                    $row2 = $result2->fetch_assoc();

                ?>

            <form action="" method="post">

            <div class="crud_header">

                    <h1>Edit Subject</h1>
                    <a id="mback" href="../advisement.php">Back</a>

            </div>

            <div class="row_one">

            <div class="form">
                <label for="subject_code">Catalog No</label>
                <input type="text" class="formcontrol" name="subject_code" value="<?php echo $row1["subject_code"]; ?>">
            </div>
            
            <div class="form">
                <label for="subject_title">Descriptive Title</label>
                <input type="text" class="formcontrol" name="subject_title" value="<?php echo $row1["subject_title"]; ?>">
            </div>

            </div>

            <div class="row_two">

            <div class="form">
                <label for="subject_units">Units</label>
                <input type="text" class="formcontrol" name="subject_units" value="<?php echo $row1["subject_units"]; ?>">
            </div>

            <div class="form">
                <label for="subject_units">Section</label>
                <input type="text" class="formcontrol" name="subject_section" value="<?php echo $row1["subject_section"]; ?>">
            </div>

            <div class="form">
                <label for="subject_room">Room</label>
                <input type="text" class="formcontrol" name="subject_room" value="<?php echo $row1["subject_room"]; ?>">
            </div>

            </div>

            <div class="form">
                <label for="subject_units">Schedule</label>
                <input type="time" class="formcontrol" name="subject_schedule" value="<?php echo $row1["subject_schedule"]; ?>">
            </div>

            <div class="form">

                <label for="instructor_id">instructor_id</label>

                <select name="instructor_id" id="UserId">

                    <?php 
                        foreach($result2 as $row) {
                            echo "<option value='" . $row["instructor_id"] . "'>" . $row["instructor_fname"] . '&nbsp;' . $row["instructor_mname"] . '&nbsp;' . $row["instructor_lname"] . " </option>";
                        }
                    ?>
                </select>

            </div>

            
            <input type="hidden" name="advisement_id" value='<?php echo $row1['advisement_id']; ?>'>

            <input type="submit" class="btn" name="edit" value="Edit info">


            </form>

            <?php
                }

            ?>

            </div>

        </div>



        </div>
    </div>
    
</body>
</html>