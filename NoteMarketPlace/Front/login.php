<?php 
 
include 'db.php';
session_start();
$session['login'] = true;

$email_verified = true;
$correct_email = true;
$login_failed = false;

if(isset($_POST['login'])){
     
    $email = $_POST['email'];
    $password = $_POST['password'];

    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);    
    
   $query = "SELECT * FROM users WHERE emailid ='$email' AND password = '$password' AND isactive=1 AND isemailverified = 1 ";
   $result = mysqli_query($conn,$query);
   $user_count = mysqli_num_rows($result);

   if($user_count == 1){
       $_SESSION['email'] = $email;
       if(isset($_POST['remember'])){
            setcookie('email',$email, time() + 60 * 60 *24 * 7);
            setcookie('password',$password, time() + 60 * 60 *24 * 7);
       }
       header('Location:search-notes.php');
    } else {
       $login_failed = true;
   }

   //email verification checker

   $email_verification_ckecker = mysqli_query($conn , "SELECT isemailverified FROM users WHERE emailid = 'email' AND isemailverified = 0");
   $email_count = mysqli_num_rows($email_verification_ckecker);

   if($email_count == 1){
       $email_verified = false;
   }

   //correct email

   $correct_email_checker = mysqli_query($conn , "SELECT emailid FROM users WHERE emailid = '$email' ");
   $correct_email_count = mysqli_num_rows($correct_email_checker);

   if($correct_email_count == 0){
       $correct_email = false;
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
        <div class="container">
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
                                    $cookie_error = $_COOKIE['email'];
                                    if (isset($_COOKIE['email'])) {
                                        echo "<input type='email' name='email' class='form-control input-box-style' value='$cookie_error' id='exampleInputEmail1' aria-describedby='emailHelp' placeholder='Enter your email'>";
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
                                    $cookie_error = $_COOKIE['password'];
                                    if (isset($_COOKIE['password'])) {
                                        echo "<input type='password' class='form-control input-box-style' name='password' value='$cookie_error' id='exampleInputPassword1' placeholder='Enter your password' autocomplete='on'>";
                                    } else {
                                        echo "<input type='password' class='form-control input-box-style' name='password' id='exampleInputPassword1' placeholder='Enter your password' autocomplete='on'>";
                                    }
                                ?>
                                <div class="eye"><img class="eye-img" src="images/login/eye.png" alt="eye"></div>
                                
                                <div class="incorrect-password-label">
                                   <?php 
                                    if (!$email_verified)
                                        echo "<p>Please Verify your email first</p>";
                                    else if($login_failed)
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