<?php include("../../reuse_cmpnt/userinfo_v3.php")?>

<?php
if(isset($_POST['create'])){
    $subject_code = mysqli_real_escape_string($con, $_POST['subject_code']);
    $subject_title = mysqli_real_escape_string($con, $_POST['subject_title']);
    $subject_units = mysqli_real_escape_string($con, $_POST['subject_units']);

    $sql = "INSERT INTO subjects (subject_code, subject_title, subject_units)
    VALUES ('$subject_code', '$subject_title', '$subject_units')";

    if(mysqli_query($con, $sql)){
        session_start();
        echo "<script> alert('Succesful'); </script>";
        header("Location:../../advisement.php");
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

                <h1>Assign Subjects</h1>
                <a id="mback" href="subject_table.php"><i class='bx bx-arrow-back'></i> Back</a>

                </div>

                <div class="row_one">

                    <div class="form">
                        <label for="subject_code">Catalog No</label>
                        <input type="text" class="formcontrol" name="subject_code" placeholder="subject code">
                    </div>

                    <div class="form">
                        <label for="subject_title">Descriptive Title</label>
                        <input type="text" class="formcontrol" name="subject_title" placeholder="subject title">
                    </div>

                </div>

                <div class="form">
                    <label for="subject_units">Units</label>
                    <input type="text" class="formcontrol" name="subject_units" placeholder="subject units">
                </div>

                <input type="submit" class="btn" name="create" value="Add subject">
            
            </form>


            </div>

        </div>



        </div>
    </div>
    
</body>
</html>