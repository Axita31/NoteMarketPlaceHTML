<?php
include "../front/db.php";
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
    $passworddb = $row['Password'];
    $userid = $row['ID'];
}

$new_password = "";
$old_password = "";
$confirm_password = "";

if(isset($_POST['submit'])){
    $old_password = md5($_POST['old_password']);
    $new_password = $_POST['new_password'];
    $confirm_password =$_POST['confirm_password'];

    $new_pass = md5($new_password);
    $confirm_pass = md5($confirm_password);

    $upper_pwd = preg_match('@[A-Z]@', $new_password);
    if (!$upper_pwd)
        $upper_pwd_check = false;

    $lower_pwd = preg_match('@[a-z]@', $new_password);
    if (!$lower_pwd)
        $lower_pwd_check = false;

    $number_check = preg_match('@[0-9]@', $new_password);
    if (!$number_check)
        $number_pwd_check = false;

    if (strlen($new_password) < 6) {
        $length_check = false;
    }

    if ($passworddb != $old_password) {
        $password_match = false;
    }

    if($password_match && $upper_pwd_check && $lower_pwd_check && $number_pwd_check && $length_check && $new_password == $confirm_password){
        $update_password = mysqli_query($conn , "UPDATE users SET Password ='$new_pass',ModifiedDate=now(), ModifiedBy=$userid WHERE ID=$userid");
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
                                <label class="info-label" for="oldpassword">Old Password</label>
                                <input type="password" name="old_password" class="form-control input-box-style" id="oldpassword" placeholder="Enter your old password" autocomplete="on">
                                <div class="eye"><img class="eye-img" src="images/login/eye.png" alt="eye" onclick="Toggle1()"></div>
                                <div class="incorrect-password-label">
                                    <?php
                                    if (!$password_match)
                                    echo "<p style='color:red;'>Please enter corrct old password </p>";
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="info-label" for="newpassword">New Password</label>
                                <input type="password" name="new_password" class="form-control input-box-style" id="newpassword" placeholder="Enter your new password" autocomplete="on">
                                <div class="eye"><img class="eye-img" src="images/login/eye.png" alt="eye" onclick="Toggle2()"></div>
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
                                <label class="info-label" for="confirmpassword">Confirm Password</label>
                                <input type="password" name="confirm_password" class="form-control input-box-style" id="confirmpassword" placeholder="Enter your confirm password" autocomplete="on">
                                <div class="eye"><img class="eye-img" src="images/login/eye.png" alt="eye" onclick="Toggle3()"></div>
                                <div class="ncorrect-password-label">
                                        <?php
                                        if ($new_password != $confirm_password)
                                        echo "<p style='color:red;'>Password and confirm password does not match</p>";
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

    <script>
    /* show/hide password*/
function Toggle() {
	var temp = document.getElementById("exampleInputPassword1");
	if (temp.type === "password") {
		temp.type = "text";
	} else {
		temp.type = "password";
	}
}

function Toggle1() {
	var temp = document.getElementById("oldpassword");
	if (temp.type === "password") {
		temp.type = "text";
	} else {
		temp.type = "password";
	}
}

function Toggle2() {
	var temp = document.getElementById("newpassword");
	if (temp.type === "password") {
		temp.type = "text";
	} else {
		temp.type = "password";
	}
}

function Toggle3() {
	var temp = document.getElementById("confirmpassword");
	if (temp.type === "password") {
		temp.type = "text";
	} else {
		temp.type = "password";
	}
}

function Toggle4() {
	var temp = document.getElementById("spassword");
	if (temp.type === "password") {
		temp.type = "text";
	} else {
		temp.type = "password";
	}
}

function Toggle5() {
	var temp = document.getElementById("cpassword");
	if (temp.type === "password") {
		temp.type = "text";
	} else {
		temp.type = "password";
	}
}
    </script>

    <!-- Custom JS -->
    <script src="js/script.js"></script>
</body>

</html>