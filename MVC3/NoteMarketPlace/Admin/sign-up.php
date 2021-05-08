<?php

include 'db.php' ;
session_start();

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

$mail_sent = false;

$name_pattern = '/^[a-zA-Z ]{3,49}$/';

//email validation
$mail_exist = false;
$mail_sent = false;
$mail_check = true;

$fname_check = true;
$lname_check = true;

// Password validation 
$upper_pwd_check = true;
$lower_pwd_check = true;
$number_pwd_check = true;
$length_check = true;
$password_match = true;

//variables
$firstName = "checked";
$lastName = "checked";

if(isset($_POST['signup'])){
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);
    $p=md5($password);
    $cp=md5($cpassword);

    $query = "SELECT * FROM users WHERE emailid ='$email' ";
    $result = mysqli_query($conn,$query);
    $emailcount = mysqli_num_rows($result);
  
    if($emailcount > 0){
        echo '<script>alert("email already exists")</script>';
    }
    
    $email_checker = mysqli_query($conn, "SELECT * FROM users WHERE emailid='$email'");
    $email_count = mysqli_num_rows($email_checker);

    $check_fname = preg_match($name_pattern, $fname);
    if (!$check_fname) {
        $fname_check = false;
    }

    $check_lname = preg_match($name_pattern, $lname);
    if (!$check_lname) {
        $lname_check = false;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $mail_check = false;
    }
    
    $upper_pwd = preg_match('@[A-Z]@', $password);
    if (!$upper_pwd)
        $upper_pwd_check = false;

    $lower_pwd = preg_match('@[a-z]@', $password);
    if (!$lower_pwd)
        $lower_pwd_check = false;

    $number_check = preg_match('@[0-9]@', $password);
    if (!$number_check)
        $number_pwd_check = false;

    if (strlen($password) < 6) {
        $length_check = false;
    }

    if ($password != $cpassword) {
        $password_match = false;
    }

    if(strlen($fname) < 3 && strlen($lname)){
        $error = "<p>your firstname and lastname must be at-least 3 character <p>"; 

    }else{
         if ($emailcount == 0 && $password_match && $length_check && $lname_check && $fname_check && $mail_check && $upper_pwd_check && $lower_pwd_check && $number_pwd_check) {

            $insertquery = "INSERT INTO users(roleid,firstname,lastname,emailid,password,isemailverified,createddate,isactive)VALUES(2,'$fname','$lname','$email','$p',0,now(),1)";
            $iquery = mysqli_query($conn, $insertquery);

            //userid getter
            $id = mysqli_insert_id($conn);

            //mail function
            require 'PHPMailer/Exception.php';
            require 'PHPMailer/PHPMailer.php';
            require 'PHPMailer/SMTP.php';

            $mail = new PHPMailer(true);
            $alert = '';

            try{
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = PHPMailer :: ENCRYPTION_STARTTLS;
                $mail->Port = 587;  
                $mail->Username = "axita31.khunt@gmail.com";
                $mail->Password = 'axita31khunt';

                // Sender and recipient settings
                $mail->setFrom("axita31.khunt@gmail.com", 'NotesMarketPlace');
                $mail->addAddress($email, $fname . $lname);
                $mail->addReplyTo("axita31.khunt@gmail.com", 'NotesMarketPlace');
                $mail->IsHTML(true);
                $mail->Subject = "Email verification";
                $mail->AddEmbeddedImage('images/logo/dark-logo.png', 'logo');

                $mail->Body = "<table>
                    <tr>
                        <td style='height: 75px;'><img src='cid:logo' alt='NMP-logo'></td>
                    </tr>
                    <tr>
                        <td
                            style='color: #6255a5; font-size: 26px; font-weight: 600; line-height: 30px; height: 50px;'>
                            Email Verification</td>
                    </tr>
                    <tr>
                        <td style='height: 30px; font-size: 18px; color: #333333;font-weight: 400;'>
                        <php
                        <b>Dear $fname  $lname,</b>
                        </td>
                    </tr>
                    <tr>
                        <td style='font-size: 16px;font-weight: 400; height: 25px; color: #333333;'>
                            Thanks for signing up</td>
                    </tr>
                    <tr>
                        <td style='font-size: 16px;font-weight: 400; height: 25px; color: #333333;'>
                            Simply click below for email verification.</td>
                    </tr>
                    <tr>
                        <td style='height: 50px;'><a href='http://localhost/NoteMarketPlace/front/email-checker.php?ID=$id'>
                        <button style='width: 300px;background-color: #6255a5;height: 35px;border-radius: 3px;font-size: 18px; border:transparent;text-transform: uppercase;color: #fff;' name='submit'>verify email address</button></a></td>
                    </tr>
                </table>";
                $mail->AltBody = '';

                $mail->send();
                $mail_sent = true;
            } catch (Exception $e) {
                 echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
            }
        } if ($emailcount > 0) {
            $mail_exist = true;
        }
    }

}
?>

<!DOCTYPE html>
<html lang="en">

<?php include 'head.php';?>

<body>
    <!-- Sign-up section-->
    <!-- Background image-->
    <img class="back-img" src="images/login/banner-with-overlay.jpg" alt="backimage">
    <!-- Background image-->

    <section id="sign-up">
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
                    <div id="sign-up-box">
                        <h2 class="text-center">Create an Account</h2>
                        <p class="user-instruction">Enter your details to signup</p>
                        <div class="sucess-msg">
                        <?php
                            if ($mail_sent)
                            echo " <center><p style='color:green';><span><i class='fa fa-check-circle'></i></span> Your account has been successfully created.</p></center>";
                        ?>                    
                         </div>
                      
                        <!-- form elements-->
                        <form action="sign-up.php" method="POST">
                            <div class="form-group">
                                <label class="info-label" for="exampleInputEmail1">First Name</label>
                                <input type="text" name="fname" class="form-control input-box-style" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your first name" required>
                                
                            </div>
                            <div class="form-group">
                                <label class="info-label" for="exampleInputEmail1">Last Name</label>
                                <input type="text" name="lname" class="form-control input-box-style" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your last name" required>
                                
                            </div>
                            <div class="form-group">
                                <label class="info-label" for="exampleInputEmail1">Email</label>
                                <input type="email" name="email" class="form-control input-box-style" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your email" required>
                                
                            </div>
                            <div class="form-group">
                                <label class="info-label" for="spassword">Password</label>
                                <input type="password" name="password" class="form-control input-box-style" id="spassword" placeholder="Enter your password" autocomplete="on" required>
                                <div class="eye"><img class="eye-img" src="images/login/eye.png" alt="eye" onclick="Toggle4()"></div>
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
                                <label class="info-label" for="cpassword">Confirm Password</label>
                                <input type="password" name="cpassword" class="form-control input-box-style" id="cpassword" placeholder="Enter your confirm password" autocomplete="on" required> 
                                <div class="eye"><img class="eye-img" src="images/login/eye.png" alt="eye" onclick="Toggle5()"></div>
                                
                            </div>
                            <div class="form-btn">
                                <button type="submit" name="signup" class="btn btn-general btn-purple">Sign Up</button>
                            </div>
                        </form>
                        <div class="toggle-btw-login-signup" class="text-center">
                            <p>Already have an account? <span><a href="login.php">Login</a></span></p>
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