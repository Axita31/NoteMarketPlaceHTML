 <?php
include "db.php";
$login_failed = false;

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    $query = "SELECT * FROM users WHERE emailid='$email' AND password='$password' AND isactive=1 AND (roleid=2 OR roleid=3)";
    $result = mysqli_query($conn, $query);
    $user_count = mysqli_num_rows($result);

    if ($user_count == 1) {
        header('Location:dashboard.php');
    } else {
        $login_failed = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<?php include 'head.php' ; ?>

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
                            <img class="image-fluid" src="images/logo/white-logo.png" alt="Notes Marketplace">
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
                              <input type="email" name="email" class="form-control input-box-style" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your email">
                            </div>
                            <div class="form-group">
                                <label class="info-label" for="exampleInputPassword1">Password</label>
                                <div class="forgot-password-label-box">
                                    <label><a class="forgot-password-label" href="forgot-password.html">Forgot Password?</a></label>
                                </div>
                                <input type="password"  name="password" class="form-control input-box-style" id="exampleInputPassword1" placeholder="Enter your password" autocomplete="on">
                                <div class="eye"><img class="eye-img" src="images/login/eye.png" alt="eye"></div>

                                <div class="incorrect-password-label">
                                <?php
                                        if ($login_failed)
                                            echo "<p style='color:red ;'>The password that you've entered is incorrect!<p/>";
                                        ?>
                                </div>
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label id="remember-me-label" class="form-check-label" for="exampleCheck1">Remember Me</label>
                            </div>
                            <div class="form-btn">
                                <button type="submit" class="btn btn-general btn-purple" name="login">Login</button>
                            </div>
                        </form>
                        <div class="toggle-btw-login-signup" class="text-center">
                            <p>Don't have an account? <span><a href="sign-up.html">Sign Up</a></span></p>
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