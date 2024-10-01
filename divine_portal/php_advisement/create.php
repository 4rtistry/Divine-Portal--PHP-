<?php include("../reuse_cmpnt/userinfo_v2.php")?>

<?php

if(isset($_POST['create'])){
    $subject_code = mysqli_real_escape_string($con, $_POST['subject_code']);
    $subject_title = mysqli_real_escape_string($con, $_POST['subject_title']);
    $subject_units = mysqli_real_escape_string($con, $_POST['subject_units']);
    $subject_section = mysqli_real_escape_string($con, $_POST['subject_section']);
    $subject_start = mysqli_real_escape_string($con, $_POST['subject_start']);
    $subject_end = mysqli_real_escape_string($con, $_POST['subject_end']);
    $selected_days = implode($_POST['subject_day']);
    $subject_room = mysqli_real_escape_string($con, $_POST['subject_room']);
    $instructor_id = mysqli_real_escape_string($con, $_POST['instructor_id']);

    $sql = "INSERT INTO advisement (subject_code, subject_title, subject_units, subject_section, subject_start, subject_end, subject_day, subject_room, instructor_id)
     VALUES ('$subject_code', '$subject_title', '$subject_units', '$subject_section', '$subject_start', '$subject_end','$selected_days', '$subject_room', '$instructor_id')";

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
    FROM advisement t
    INNER JOIN instructor m ON t.instructor_id = m.instructor_id";

    $result = $con->query($sql1);
    $row = $result->fetch_assoc();

    $sql3 = "SELECT *
    FROM instructor";

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

<?php include("../reuse_cmpnt/navigation_v2.php"); ?>

        <div class="main_content">

            <div class="advisement_crud">

                <form action="" method="post">

                <div class="crud_header">

                <h1>Assign Subjects</h1>
                <a id="mback" href="../advisement.php"><i class='bx bx-arrow-back'></i> Back</a>

                </div>

                <div class="row_one">

                    <div class="form">
                        <label for="subject_code">Catalog No</label>
                        <input type="text" class="formcontrol" name="subject_code" placeholder="Subject code">
                    </div>

                    <div class="form">
                        <label for="subject_title">Descriptive Title</label>
                        <input type="text" class="formcontrol" name="subject_title" placeholder="Subject name">
                    </div>

                </div>

                <div class="row_two">

                <div class="form">
                    <label for="subject_units">Units</label>
                    <input type="text" class="formcontrol" name="subject_units" placeholder="Units">
                </div>

                <div class="form">
                    <label for="subject_units">Section</label>
                    <input type="text" class="formcontrol" name="subject_section" placeholder="Section">
                </div>

                <div class="form">
                    <label for="subject_room">Room</label>
                    <input type="text" class="formcontrol" name="subject_room" placeholder="Room">
                </div>

                </div>

                <div class="row_three">

                <h1>Subject Schedule</h1>

                <div class="subject_row">

                <div class="form">
                    <input type="text" class="formcontrol" name="subject_start" placeholder="Starting Time">
                </div>

                <div class="form">
                    <input type="text" class="formcontrol" name="subject_end" placeholder="Ending time">
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

                        <select name="instructor_id">
                            <option value="">-</option>
                            <?php 
                            foreach($result3 as $row) {
                                echo "<option value='" . $row["instructor_id"] . "'>" . $row["instructor_fname"] . '&nbsp;' . $row["instructor_mname"] . '&nbsp;' . $row["instructor_lname"] ."</option>";
                            }
                            ?>
                        </select>

                </div>

                <input type="submit" class="btn" name="create" value="Add">
            
            </form>


            </div>

        </div>



        </div>
    </div>
    
</body>
</html>