<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="css/style.css?<?php echo time(); ?>" />
    <link rel="stylesheet" type="text/css" href="css/style2.css?<?php echo time(); ?>" />
</head>
<body>

<div class="background">
        <div class="nav">

                <div class="margin">

                    <div class="logo">
                        <img src="img/dwcl.png" alt="">

                        <div class="text">

                            <h1> <?php echo $user_fname . '&nbsp;' . $user_mname . '&nbsp;' .  $user_lname ?></h1>
                            <span class="utype"><?php echo $user_type ?></span>
                            <span class="mail"><i class='bx bx-envelope'></i><?php echo $user_email ?></span>
                    
                        </div>
                    </div>

                    <div class="links">
                        <a href="profile.php"><i class='bx bxs-user-circle'></i></a>

                        <form action="php/logout.php" method="post">
                            <input type="submit" value="Logout" name="logout">
                        </form>
                    </div>
        </div>
    </div>

    <div class="divine">

            <div class="margin2">
                <ul>
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li>My Profile</li>
                    <li>Grades</li>
                    <li>Prospectus</li>
                    <li><a href="advisement.php">Advisement</a></li>
                    <li>Assessment</li>
                    <li>Evaluation</li>
                    <li>Inbox</li>
                </ul>
        </div>
    
    </div>
    
</body>
</html>