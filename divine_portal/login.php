<?php
include("php/connection.php");

if(isset($_POST['submit'])){
    $identifier = mysqli_real_escape_string($con, $_POST['identifier']);
    $Password = mysqli_real_escape_string($con, $_POST['user_password']);

    $query = "SELECT user_registration.registration_id
            FROM user_registration
            JOIN user_login ON user_registration.registration_id = user_login.registration_id
            WHERE (user_login.user_username='$identifier' OR user_login.user_email='$identifier')
            AND user_login.user_password='$Password'";

    $result = mysqli_query($con, $query);

    if(mysqli_num_rows($result) == 1) {
        session_start();
        $row = $result->fetch_assoc();
        $_SESSION["registration_id"] = $row['registration_id'];
        header("Location: dashboard.php");
        exit();
    } else {
        die("Login failed! Invalid credentials.");
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="css/style.css?<?php echo time(); ?>" />
    <link rel="stylesheet" type="text/css" href="css/userlog.css?<?php echo time(); ?>" />

</head>
<body>

<div class="background">

<div class="container">

     <div class="top_header">
         <div class="left_header">
             <h1>DWCL Student Portal</h1>
         </div>

         <div class="right_header">
             <ul>
                <li>Connect with us:</li>
                <li><a href="#" class="tooltip-bottom" data-tooltip="(052) 480 2148"><i class='bx bx-phone'></a></i></li>

                <li><a href="#" class="tooltip-bottom" data-tooltip="dwclinfo@dwc-legazpi.edu"><i class='bx bx-envelope'></a></i></li>

                <li><a href="#" class="tooltip-bottom" data-tooltip="dwc-legazpi.edu"><i class='bx bx-globe'></a></i></li>
        
             </ul>
         </div>
     </div>

    <div class="content_two">

         <!-- Image section -->
         <div class="box">
            <div class="img"></div>
        </div>

        <!-- Form Section -->
        <form action="" method="post">

            <div class="form_header">  
                <img src="img/dwcl.png" alt="">
                <h1>Divine Word College of Legazpi</h1>
                <span>Sign in your DWCL account</span>  
            </div>

            <div class="input_design">
    
            <div class="input_identifier">
                <label for="identifier">Username or Email Address</label>
                <input class="identifier" type="text" name="identifier" placeholder="Enter your username or email" required>
            </div>
            
            <div class="input_password">
                <label for="user_password">Password</label>
                <input type="password" name="user_password"placeholder="Enter your password" required>
            </div>

            </div>

            <div class="links">
                <div class="termsandcond">
                    <a href="">Forgot password?</a>
                </div>

                <div class="loginpage">
                    <a href="register.php">Student Register</a>
                </div>
            </div>

            <button type="submit" name="submit">Login</button>

        </form>

        </div>
    </div>

</div>

</div>
    
</body>
</html>