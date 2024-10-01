<?php

include("php/connection.php");
if(isset($_POST['submit'])){
    $user_id = mysqli_real_escape_string($con, $_POST['user_id']);
    $user_type = mysqli_real_escape_string($con, $_POST['user_type']);
    $user_fname = mysqli_real_escape_string($con, $_POST['user_fname']);
    $user_mname = mysqli_real_escape_string($con, $_POST['user_mname']);
    $user_lname = mysqli_real_escape_string($con, $_POST['user_lname']);
    $user_birthdate = mysqli_real_escape_string($con, $_POST['user_birthdate']);
    $user_age = mysqli_real_escape_string($con, $_POST['user_age']);

    $user_email = mysqli_real_escape_string($con, $_POST['user_email']);
    $user_username = mysqli_real_escape_string($con, $_POST['user_username']);
    $user_password = mysqli_real_escape_string($con, $_POST['user_password']);

    $sql = "INSERT INTO user_registration (user_id, user_type, user_fname, user_mname, user_lname, user_birthdate, user_age)
    VALUES ('$user_id', '$user_type', '$user_fname', '$user_mname', '$user_lname', '$user_birthdate', '$user_age')";

    mysqli_query($con, $sql);

    $lastId = mysqli_insert_id($con);

    $sqlv2 = "INSERT INTO user_login (registration_id, user_username, user_email, user_password)
    VALUES ('$lastId', '$user_username', '$user_email', '$user_password')";
    
    if(mysqli_query($con, $sqlv2)){
        session_start();
        echo "<script> alert('Succesful'); </script>";
        header("Location:login.php");
    }else{
        die("Connection Blocked");
    }     
    
}
?>

<?php

    function generateEmail() {

        $prefix = "07";
        $divineEmail = "@dwc-legazpi.edu";
        $idLength = 6; 
        $characters = '0123456789';
        $IDnumber = '';

            for ($i = 0; $i < $idLength; $i++) {
            $IDnumber .= $characters[rand(0, strlen($characters) - 1)];
            }
            return $prefix . $IDnumber . $divineEmail;
            }

        $userEmail = generateEmail();
?>

<?php

function generateUserId() {

        $prefixv1 = "10";
        $idLengthv1 = 4; 
        $charactersv1 = '0123456789';
        $IDnumberv1 = '';

            for ($i = 0; $i < $idLengthv1; $i++) {
            $IDnumberv1 .= $charactersv1[rand(0, strlen($charactersv1) - 1)];
            }
            return $prefixv1 . $IDnumberv1;
            }

        $userId = generateUserId();

?>

<?php

if (isset($_POST['user_birthdate'])) {
    $birthdate = new DateTime($_POST['user_birthdate']);
    $today = new DateTime('today');
    $age = $today->diff($birthdate)->y;
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="css/style.css?<?php echo time(); ?>" />
    <link rel="stylesheet" type="text/css" href="css/user.css?<?php echo time(); ?>" />
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
                        <span>Register an DWCL account</span>  
                    </div>
            
                    <h1>Full Name <span class="asterisk">*</span></h1>
                    <div class="input_names">
                        <div class="input_names_sub">
                            <input type="text" name="user_fname" placeholder="First name" required>
                        </div>
                    
                        <div class="input_names_sub">
                            <input type="text" name="user_mname"placeholder="Middle name" required>  
                        </div>
                        
                        <div class="input_names_sub">
                            <input type="text" name="user_lname" placeholder="Last name" required>
                        </div>
                    </div>

                    <div class="input_auto">

                        <div class="input_email">
                            <label for="user_id">User ID</label>
                            <input type="text" class="userid" name="user_id" value="<?php echo $userId; ?>" required readonly>
                        </div>

                        <div class="input_email">
                            <label for="user_email">School Email Address</label>
                            <input class="emailadd" type="email" name="user_email" value="<?php echo $userEmail; ?>" required readonly>
                        </div>

                    </div>

                    <div class="input_two">

                    <div class="input_two_sub">
                        <label for="user_birthdate">Birthdate <span class="asterisk">*</span></label>
                        <input class="bday" type="date" id="user_birthdate" name="user_birthdate" required>
                    </div>
                    
                    <div class="input_two_sub">
                        <label for="user_age">Age <span class="automated">(automated)</span></label>
                        <input class="bday" type="number" id="user_age" name="user_age" placeholder="" required readonly>
                    </div>

                        <div class="input_two_sub">
                            <label for="user_type">Select Type <span class="asterisk">*</span></label>
                            <select name="user_type" required>
                                <option value="">-</option>
                                <option value="Student">Student</option>
                                <option value="Faculty">Faculty</option>
                                <option value="Admin">Admin</option>
                            </select>
                        </div>   
                    </div>

                    <div class="input_username">
                        <label for="user_username">Username <span class="asterisk">*</span></label>
                        <input type="text" name="user_username" placeholder="Enter your username" required>
                    </div>
                    
                    <div class="input_password">
                        <label for="user_password">Password <span class="asterisk">*</span></label>
                        <input type="password" name="user_password" placeholder="Enter your password" required>
                    </div>
        

                    <div class="links">
                        <div class="termsandcond">
                            <input type="checkbox" name="checkbox" required> 
                            <a href="">Terms and Conditions</a>
                        </div>
    
                        <div class="loginpage">
                            <a href="login.php">Student Login</a>
                        </div>
                    </div>
        
                    <button type="submit" name="submit">Register</button>

                </form>

                </div>
            </div>

        </div>

    </div>

    <script src="js/script.js"></script>
    
</body>
</html>