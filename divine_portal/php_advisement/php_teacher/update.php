<?php include("../../reuse_cmpnt/userinfo_v3.php")?>

<?php

if(isset($_POST["edit"])){
    $instructor_fname = mysqli_real_escape_string($con, $_POST['instructor_fname']);
    $instructor_mname = mysqli_real_escape_string($con, $_POST['instructor_mname']);
    $instructor_lname = mysqli_real_escape_string($con, $_POST['instructor_lname']);
    $instructor_department = mysqli_real_escape_string($con, $_POST['instructor_department']);

    $instructor_id = mysqli_real_escape_string($con, $_POST["instructor_id"]);
    
    $sql = "UPDATE instructor SET instructor_fname = '$instructor_fname', instructor_mname = '$instructor_mname', instructor_lname = '$instructor_lname', instructor_department = '$instructor_department' WHERE instructor_id = $instructor_id";

    if(mysqli_query($con, $sql)){
        session_start();
        $_SESSION["edit"] = "<script type='text/javascript'>window.alert('Movie is Successfully Updated');</script>";
        header("Location:instructor_table.php");
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
    <link rel="stylesheet" type="text/css" href="../../css/style.css?<?php echo time(); ?>" />
    <link rel="stylesheet" type="text/css" href="../../css/style2.css?<?php echo time(); ?>" />
    <link rel="stylesheet" type="text/css" href="../../css/advisementv2.css?<?php echo time(); ?>"/>
</head>
<body>

    <?php include("../../reuse_cmpnt/navigation_v3.php"); ?>

        <div class="main_content">

            <div class="advisement_crud">

                <?php
                if(isset($_GET["instructor_id"])){
                    $instructor_id = $_GET["instructor_id"];

                    $sql = "SELECT * FROM instructor WHERE instructor_id=$instructor_id";
                    $result = mysqli_query($con, $sql);
                    $row = mysqli_fetch_array($result);

                ?>

            <form action="" method="post">

            <div class="crud_header">

                    <h1>Edit Instructor</h1>
                    <a id="mback" href="instructor_table.php">Back</a>

            </div>

            <div class="form">
                <label for="instructor_fname">Catalog No</label>
                <input type="text" class="formcontrol" name="instructor_fname" value="<?php echo $row["instructor_fname"]; ?>">
            </div>
            
            <div class="form">
                <label for="instructor_mname">Descriptive Title</label>
                <input type="text" class="formcontrol" name="instructor_mname" value="<?php echo $row["instructor_mname"]; ?>">
            </div>


            <div class="form">
                <label for="instructor_lname">Units</label>
                <input type="text" class="formcontrol" name="instructor_lname" value="<?php echo $row["instructor_lname"]; ?>">
            </div>

            <div class="form">
                <label for="instructor_department">Section</label>
                <input type="text" class="formcontrol" name="instructor_department" value="<?php echo $row["instructor_department"]; ?>">
            </div>

            
            <input type="hidden" name="instructor_id" value='<?php echo $row['instructor_id']; ?>'>

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