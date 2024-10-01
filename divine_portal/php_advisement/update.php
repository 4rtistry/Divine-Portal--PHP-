<?php include("../reuse_cmpnt/userinfo_v2.php")?>

<?php

if(isset($_POST["edit"])){
    $subject_code = mysqli_real_escape_string($con, $_POST['subject_code']);
    $subject_title = mysqli_real_escape_string($con, $_POST['subject_title']);
    $subject_units = mysqli_real_escape_string($con, $_POST['subject_units']);
    $subject_section = mysqli_real_escape_string($con, $_POST['subject_section']);
    $subject_start = mysqli_real_escape_string($con, $_POST['subject_start']);
    $subject_end = mysqli_real_escape_string($con, $_POST['subject_end']);
    $selected_days = implode($_POST['subject_day']);
    $subject_room = mysqli_real_escape_string($con, $_POST['subject_room']);
    $instructor_id = mysqli_real_escape_string($con, $_POST["instructor_id"]);

    $advisement_id = mysqli_real_escape_string($con, $_POST["advisement_id"]);
    
    $sql = "UPDATE advisement SET subject_code = '$subject_code', subject_title = '$subject_title', 
    subject_units = '$subject_units', subject_section = '$subject_section', subject_start = '$subject_start', subject_end = '$subject_end', subject_day =  '$selected_days',
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

    <?php include("../reuse_cmpnt/navigation_v2.php"); ?>

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

            <div class="row_three">

                <h1>Subject Schedule</h1>

                    <div class="subject_row">

                    <div class="form">
                        <input type="text" class="formcontrol" name="subject_start" value="<?php echo $row1["subject_start"]; ?>">
                    </div>

                    <div class="form">
                        <input type="text" class="formcontrol" name="subject_end" value="<?php echo $row1["subject_end"]; ?>">
                    </div>

                    <div class="form">
                    <select name="subject_day[]" multiple size="1">
                        <option value="M">Monday</option>
                        <option value="T">Tuesday</option>
                        <option value="W">Wednesday</option>
                        <option value="Th">Thursday</option>
                        <option value="F">Friday</option>
                        <option value="S">Saturday</option>
                    </select>
                </div>


                </div>

            </div>
            
            <div class="form">

                <label for="instructor_id">Instructor</label>
                <select name="instructor_id" id="UserId">
                 
                    <option value=""><?php echo $row1["instructor_fname"] . '&nbsp;' . $row1["instructor_mname"] . '&nbsp;' . $row1["instructor_lname"]; ?></option>
                    
                    <?php 
                        
                        foreach($result2 as $row) {
                            if ($row["instructor_id"] != $row1["instructor_id"]) { 
                                echo "<option value='" . $row["instructor_id"] . "'>" . $row["instructor_fname"] . '&nbsp;' . $row["instructor_mname"] . '&nbsp;' . $row["instructor_lname"] . "</option>";
                            }
                        }
                    ?>
                </select>

            </div>

            
            <input type="hidden" name="advisement_id" value='<?php echo $row1['advisement_id']; ?>'>

            <input type="submit" class="btn" name="edit" value="Edit">


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