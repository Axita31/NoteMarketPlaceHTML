<?php
include "db.php";
session_start();

if(!isset($_SESSION['email']))
   header('Location: login.php');


//boolean for proper Password validation 
$upper_pwd_check = true;
$lower_pwd_check = true;
$number_pwd_check = true;
$length_check = true;
$password_match = true;

$email = $_SESSION['email'];
$query =  mysqli_query($conn , "SELECT * FROM users WHERE EmailID = '$email' ");
while($row = mysqli_fetch_array($query)){
    $password = $row['Password'];
    $userid = $row['ID'];
}

$new_password = "";
$old_password = "";
$confirm_password = "";

if(isset($_POST['submit'])){
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    $upper_pwd = preg_match('@[A-Z]@', $password);
    if (!$upper_pwd)
        $upper_pwd_check = false;

    $lower_pwd = preg_match('@[a-z]@', $password);
    if (!$lower_pwd)
        $lower_pwd_check = false;

    $number_check = preg_match('@[0-9]@', $password);
    if (!$number_check)
        $number_pwd_check = false;

    if (strlen($new_password) < 6) {
        $length_check = false;
    }

    if ($password != $old_password) {
        $password_match = false;
    }

    if($password_match && $upper_pwd_check && $lower_pwd_check && $length_check && $new_password == $confirm_password){
        $update_password = mysqli_query($conn , "UPDATE users SET Password ='$new_password',ModifiedDate=now(), ModifiedBy=$userid WHERE ID=$userid");
        echo "<script>
               alert('Your password has been change sucessfully! ')
            </script> ";
        echo '<script>window.location.replace("logout.php")</script>';
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<?php include 'head.php';?>

<body>

    <!-- change password section-->
    <!-- Background image-->
    <img class="back-img" src="images/login/banner-with-overlay.jpg" alt="backimage">
    <!-- Background image-->
    <section id="change-pwd">
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
                    <div id="change-pwd-box">
                        <h2 class="text-center">Change Password</h2>
                        <p class="user-instruction">Enter your new password to change your password </p>

                        <!-- form elements-->
                        <form action="change-password.php" method="POST">
                            <div class="form-group">
                                <label class="info-label" for="exampleInputPassword1">Old Password</label>
                                <input type="password" name="old_password" class="form-control input-box-style" id="exampleInputPassword1" placeholder="Enter your old password" autocomplete="on">
                                <div class="eye"><img class="eye-img" src="images/login/eye.png" alt="eye"></div>
                                <div class="incorrect-password-label">
                                    <?php
                                    if (!$password_match)
                                    echo "<p style='color:red;'>Please enter corrct old password </p>";
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="info-label" for="exampleInputPassword1">New Password</label>
                                <input type="password" name="new_password" class="form-control input-box-style" id="exampleInputPassword2" placeholder="Enter your new password" autocomplete="on">
                                <div class="eye"><img class="eye-img" src="images/login/eye.png" alt="eye"></div>
                                <div class ="incorrect-password-label">
                                <?php
                                    if (!$length_check)
                                        echo "<p style='color:red;'>The Password Length Should be more then 6 characters</p>";
                                    else if (!$upper_pwd_check)
                                        echo "<p style='color:red;'>Please enter at least one uppercase letter </p>";
                                    else if (!$lower_pwd_check)
                                        echo "<p style='color:red;'>Please enter at least one lowercase letter </p>";
                                    else if (!$number_pwd_check)
                                        echo "<p style='color:red;'>Please enter at least one numeric letter </p>";
                                ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="info-label" for="exampleInputPassword1">Confirm Password</label>
                                <input type="password" name="confirm_password" class="form-control input-box-style" id="exampleInputPassword3" placeholder="Enter your confirm password" autocomplete="on">
                                <div class="eye"><img class="eye-img" src="images/login/eye.png" alt="eye"></div>
                                <div class="ncorrect-password-label">
                                        <?php
                                        if ($new_password != $confirm_password && $length_check && $upper_pwd_check && $lower_pwd_check && $number_pwd_check)
                                        echo "<p style='color:red;font-size:13px'>Password and confirm password does not match</p>";
                                        ?>
                                    </div>
                            </div>
                            <div class="form-btn">
                                <button type="submit" name="submit" class="btn btn-general btn-purple">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- change-password section End -->

    <!-- JQuery -->
    <script src="js/jquery.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <!-- Custom JS -->
    <script src="js/script.js"></script>
</body>

</html>