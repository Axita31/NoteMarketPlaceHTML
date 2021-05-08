<?php
include "db.php";
session_start();

$login_failed = false;
$email_verify = true;
$correct_email = true;
$admin_login = false;
$password_verify = true;

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];
    $p=md5($password);

    $query = "SELECT * FROM users WHERE EmailID='$email' AND Password='$p' AND IsActive=1 AND RoleID=1 AND IsEmailVerified=1";
    $result = mysqli_query($conn, $query);
    $user_count = mysqli_num_rows($result);
  
    if ($user_count == 1) {
        $_SESSION['email'] = $email;
        if (isset($_POST['remember'])) {
            setcookie('Email', $email, time() + 60 * 60 * 24 * 7);
            setcookie('Password', $password, time() + 60 * 60 * 24 * 7);
        }
        $get_user = mysqli_query($conn, "SELECT ID FROM users WHERE emailid='$email'");
        while ($row = mysqli_fetch_assoc($get_user)) {
            $userid = $row['ID'];
        }
        $exist_user = mysqli_query($conn, "SELECT 1 FROM users_details WHERE UserID=$userid");
        $userid_count = mysqli_num_rows($exist_user);

        //count user exist or not
        if ($userid_count == 0)
            header('Location:user-profile.php');
        else
            header('Location:search-notes.php');
    } else {
        $login_failed = true;
    }

    //email verfication 
    $email_check = mysqli_query($conn, "SELECT IsEmailVerified FROM users WHERE EmailID='$email' AND IsEmailVerified=0");
    $email_count = mysqli_num_rows($email_check);
    //echo $email_count;
    if ($email_count == 1) {
        $email_verify = false;
    }
    
    //password 
    $password_check= mysqli_query($conn, "SELECT Password FROM users WHERE Password='$p' AND EmailID='$email'");
    $password_count = mysqli_num_rows($password_check);

    if ($password_count == 0) {
        $password_verify = false;
    }

    //correct email
    $correct_email = mysqli_query($conn, "SELECT EmailID FROM users WHERE EmailID='$email'");
    $correct_email_count = mysqli_num_rows($correct_email);

    if ($correct_email_count == 0) {
        $correct_email = false;
    }

    // admin checker
    $admin_check = mysqli_num_rows(mysqli_query($conn, "SELECT 1 FROM users WHERE EmailID='$email' AND Password='$password' AND roleid IN (2,3)"));
    if($admin_check == 1){
        header('Location:../admin/dashboard.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<?php include 'head.php';?>

<body>
   
<!-- Login section-->
    <!-- Background image-->
       <img class="back-img" src="images/login/banner-with-overlay.jpg" alt="backimage">
    <!-- Background image-->
    <section id="login">
        <div class="conntainer">
            <div class="row text-center">
                <div class="col-md-12">
                    <div class="main-logo">
                         <a href="#">
                            <img class="image-fluid" src="images/login/top-logo.png" alt="Notes Marketplace">
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <div id="login-box">
                        <h2 class="text-center">Login</h2>
                        <p class="user-instruction">Enter your email address and password to login</p>
                           
                        <!-- form elements-->
                        <form action="login.php" method="POST">
                            <div class="form-group">
                              <label class="info-label" for="exampleInputEmail1">Email</label>
                               <?php
                                   
                                    if (isset($_COOKIE['Email'])) {
                                        $cookie_email = $_COOKIE['Email'];
                                        echo "<input type='email' name='email' class='form-control input-box-style' value='$cookie_email' id='exampleInputEmail1' aria-describedby='emailHelp' placeholder='Enter your email'>";
                                    } else {
                                        echo "<input type='email' name='email' class='form-control input-box-style' id='exampleInputEmail1' aria-describedby='emailHelp' placeholder='Enter your email'> ";
                                    }
                                ?>
                                    <div class="incorrect-password-label">
                                        <?php 
                                            if(!$correct_email)
                                            echo "<p>Please Enter a valid Email Address</p>";
                                        ?>
                                     </div>
                                </div>
                            <div class="form-group">
                                <label class="info-label" for="exampleInputPassword1">Password</label>
                                <div class="forgot-password-label-box">
                                    <label><a class="forgot-password-label" href="forgot-password.php">Forgot Password?</a></label>
                                </div>
                                <?php
                                   
                                    if (isset($_COOKIE['Password'])) {
                                        $cookie_password = $_COOKIE['Password'];
                                        echo "<input type='password' class='form-control input-box-style' name='password' value='$cookie_password' id='exampleInputPassword1' placeholder='Enter your password' autocomplete='on'>";
                                    } else {
                                        echo "<input type='password' class='form-control input-box-style' name='password' id='exampleInputPassword1' placeholder='Enter your password' autocomplete='on'>";
                                    }
                                ?>
                                <div class="eye"><img class="eye-img" src="images/login/eye.png" alt="eye" onclick="Toggle()"></div>
                                
                                <div class="incorrect-password-label">
                                   <?php 
                                    if (!$email_verify)
                                        echo "<p>Please Verify your email first</p>";
                                    else if(!$password_verify)
                                        echo "<p>The password that you've entered is incorrect</p>";
                                    ?>
                                </div>
                            </div>
                            <div class="form-group form-check">
                                <input name="remember" type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label id="remember-me-label" class="form-check-label" for="exampleCheck1">Remember Me</label>
                            </div>
                            <div class="form-btn">
                                <input type="submit" name="login" class="btn btn-general btn-purple" value="LOGIN">
                            </div>
                        </form>
                        <div class="toggle-btw-login-signup" class="text-center">
                            <p>Don't have an account? <span><a href="sign-up.php">Sign Up</a></span></p>
                        </div>
                     </div> 
                </div>
            </div>
            
        </div>
    </section>
   
   
    <!-- JQuery -->
    <script src="js/jquery.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <!-- Custom JS -->
    <script src="js/script.js"></script>
</body>
</html>