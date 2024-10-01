<?php include("../../reuse_cmpnt/userinfo_v3.php")?>

<?php

if(isset($_POST["edit"])){
    $subject_code = mysqli_real_escape_string($con, $_POST['subject_code']);
    $subject_title = mysqli_real_escape_string($con, $_POST['subject_title']);
    $subject_units = mysqli_real_escape_string($con, $_POST['subject_units']);

    $subject_id = mysqli_real_escape_string($con, $_POST["subject_id"]);
    
    $sql = "UPDATE subjects SET subject_code = '$subject_code', subject_title = '$subject_title', subject_units = '$subject_units' WHERE subject_id = $subject_id";

    if(mysqli_query($con, $sql)){
        session_start();
        $_SESSION["edit"] = "<script type='text/javascript'>window.alert('Movie is Successfully Updated');</script>";
        header("Location:subject_table.php");
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
                if(isset($_GET["subject_id"])){
                    $subject_id = $_GET["subject_id"];

                    $sql = "SELECT * FROM subjects WHERE subject_id=$subject_id";
                    $result = mysqli_query($con, $sql);
                    $row = mysqli_fetch_array($result);

                ?>

            <form action="" method="post">

            <div class="crud_header">

                <h1>Edit Subjects</h1>
                <a id="mback" href="subject_table.php"><i class='bx bx-arrow-back'></i> Back</a>

            </div>

            <div class="form">
                <label for="subject_code">Catalog No</label>
                <input type="text" class="formcontrol" name="subject_code" value="<?php echo $row["subject_code"]; ?>">
            </div>

            <div class="form">
                <label for="subject_title">Descriptive Title</label>
                <input type="text" class="formcontrol" name="subject_title" value="<?php echo $row["subject_title"]; ?>">
            </div>

            <div class="form">
                <label for="subject_units">Units</label>
                <input type="text" class="formcontrol" name="subject_units" value="<?php echo $row["subject_units"]; ?>">
            </div>
            
            <input type="hidden" name="subject_id" value='<?php echo $row['subject_id']; ?>'>

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