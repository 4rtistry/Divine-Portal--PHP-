<?php include("../../reuse_cmpnt/userinfo_v3.php")?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="../../css/style.css?<?php echo time(); ?>" />
    <link rel="stylesheet" type="text/css" href="../../css/style2.css?<?php echo time(); ?>" />
    <link rel="stylesheet" type="text/css" href="../../css/advisement.css?<?php echo time(); ?>" />
</head>
<body>

<?php include("../../reuse_cmpnt/navigation_v3.php"); ?>

        <div class="main_content">

            <div class="advisement_crud">

                    <table id="data-table">

                        <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Middle Name</th>
                                <th>Last Name</th>
                                <th>Department</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $sql = "SELECT * FROM instructor";
                            $result = mysqli_query($con, $sql);

                            while($row = mysqli_fetch_array($result)){
                            ?>
                                <tr>
                                    <td><?php echo $row["instructor_fname"]; ?></td>
                                    <td><?php echo $row["instructor_mname"]; ?></td>
                                    <td><?php echo $row["instructor_lname"]; ?></td>
                                    <td><?php echo $row["instructor_department"]; ?></td>
                                    <td>

                                        <div class="actions">
                                        <a id="medit" href="update.php?instructor_id=<?php echo $row["instructor_id"]; ?>">Edit</a>
                                        <a id="mdelete" href="delete.php?instructor_id=<?php echo $row["instructor_id"]; ?>">Delete</a>
                                        </div>
                                    </td>
                                </tr>

                            <?php
                            }
                            ?>

                        </tbody>

                    </table>
              
            </div>

            <div class="pagination" id="pagination"></div>
        </div>

        <div class="crud_links">
            <h1>Operations</h1>
            <ul>
                <li><a href="../../php_advisement/php_teacher/create.php">Add Instructor</a></li>
            </ul>

            <h1>Tables</h1>
            <ul>
                <li><a id="mback" href="instructor_table.php">Instructors</a></li>
                <li><a href="../../php_advisement/php_subject/subject_table.php">Subjects</a></li>
            </ul>
        </div>

    </div>
    
    <!-- <script src="../../js/pagination.js"></script> -->
    
</body>
</html>