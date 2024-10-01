<?php include("../../reuse_cmpnt/userinfo_v3.php")?>

<?php
if(isset($_POST['create'])){
    $instructor_fname = mysqli_real_escape_string($con, $_POST['instructor_fname']);
    $instructor_mname = mysqli_real_escape_string($con, $_POST['instructor_mname']);
    $instructor_lname = mysqli_real_escape_string($con, $_POST['instructor_lname']);
    $instructor_department = mysqli_real_escape_string($con, $_POST['instructor_department']);

    $sql = "INSERT INTO instructor (instructor_fname, instructor_mname, instructor_lname, instructor_department)
    VALUES ('$instructor_fname', '$instructor_mname', '$instructor_lname', '$instructor_department')";

    if(mysqli_query($con, $sql)){
        session_start();
        echo "<script> alert('Succesful'); </script>";
        header("Location:instructor_table.php");
    }else{
        die("Connection Blocked");
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
    <link rel="stylesheet" type="text/css" href="../../css/style.css?<?php echo time(); ?>" />
    <link rel="stylesheet" type="text/css" href="../../css/style2.css?<?php echo time(); ?>" />
    <link rel="stylesheet" type="text/css" href="../../css/advisementv2.css?<?php echo time(); ?>"/>
    
</head>
<body>

    <?php include("../../reuse_cmpnt/navigation_v3.php"); ?>

        <div class="main_content">

            <div class="advisement_crud">

                <form action="" method="post">

                <div class="crud_header">

                <h1>Add Instructor</h1>
                <a id="mback" href="instructor_table.php"><i class='bx bx-arrow-back'></i> Back</a>

                </div>

                <div class="form">
                    <label for="instructor_fname">Enter First Name</label>
                    <input type="text" class="formcontrol" name="instructor_fname" placeholder="First name">
                </div>

                <div class="form">
                    <label for="instructor_mname">Enter Middle Name</label>
                    <input type="text" class="formcontrol" name="instructor_mname" placeholder="Middle name">
                </div>

                <div class="form">
                    <label for="instructor_lname">Enter Last Name</label>
                    <input type="text" class="formcontrol" name="instructor_lname" placeholder="Last name">
                </div>

                <div class="form">
                    <label for="instructor_department">Choose Department</label>
                    <input type="text" class="formcontrol" name="instructor_department" placeholder="Choose department">
                </div>

                <input type="submit" class="btn" name="create" value="Add">
            
            </form>


            </div>

        </div>



        </div>
    </div>
    
</body>
</html>