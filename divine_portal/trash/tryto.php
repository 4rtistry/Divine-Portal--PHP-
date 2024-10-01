<?php

include("php/connection.php");
if(isset($_POST['submit'])){
    $user_fname = mysqli_real_escape_string($con, $_POST['user_fname']);
    $user_mname = mysqli_real_escape_string($con, $_POST['user_mname']);
    $user_lname = mysqli_real_escape_string($con, $_POST['user_lname']);
    $user_email = mysqli_real_escape_string($con, $_POST['user_email']);
    $user_birthdate = mysqli_real_escape_string($con, $_POST['user_birthdate']);
    $user_type = mysqli_real_escape_string($con, $_POST['user_type']);
    $user_password = mysqli_real_escape_string($con, $_POST['user_password']);

    $sql = "INSERT INTO users (user_fname, user_mname, user_lname, user_email, user_birthdate, user_type, user_password)
    VALUES ('$user_fname', '$user_mname', '$user_lname', '$user_email', '$user_birthdate', '$user_type', '$user_password')";

    if(mysqli_query($con, $sql)){
        session_start();
        echo "<script> alert('Succesful'); </script>";
        header("Location:login.php");
    }else{
        die("Connection Blocked");
    }     

}
?>

<?php

    function generateuserID() {

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

        $userID = generateuserID();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/styleeee2.css">
</head>
<body>

    <div class="background">
        <div class="container">

            <div class="main_content">
                
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
            
                    <h1>Student Name</h1>
                    
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

                    <div class="input_email">
                        <label for="user_email">School Email Address</label>
                        <input class="emailadd" type="email" name="user_email" value="<?php echo $userID; ?>" required readonly>
                    </div>

                    <div class="input_two">
                        <div class="input_two_sub">
                            <label for="user_birthdate">Birthdate</label>
                            <input class="bday" type="date" name="user_birthdate" placeholder="Enter birthdate" required>
                        </div>

                        <div class="input_two_sub">
                            <label for="user_type">User Type</label>
                            <select name="user_type">
                                <option value="student">Student</option>
                                <option value="faculty">Faculty</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>   
                    </div>
                    
                    <div class="input_password">
                        <label for="user_password">Password</label>
                        <input type="password" name="user_password" placeholder="Student account password" required>
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
    
</body>
</html>