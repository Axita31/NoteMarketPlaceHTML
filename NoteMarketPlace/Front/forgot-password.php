<?php
include "db.php";
$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
$password = substr( str_shuffle( $chars ), 0, 8 );
//echo $password;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

if(isset($_POST['submit'])){
	$email=$_POST['email'];
    
if(!empty($_POST['email'])){
    
	$query="SELECT * FROM users WHERE EmailID='$email'";
    $result=mysqli_query($conn, $query);
	if(mysqli_num_rows($result)>0){

        $p=md5($password);
	
	//mail function
        require 'PHPMailer/Exception.php';
        require 'PHPMailer/PHPMailer.php';
        require 'PHPMailer/SMTP.php';

            $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = PHPMailer :: ENCRYPTION_STARTTLS;
            $mail->Port = 587;  
            $mail->Username = "axita31.khunt@gmail.com";
            $mail->Password = 'axita31khunt';
            
            // Sender and recipient settings
            $mail->setFrom("axita31.khunt@gmail.com", 'NotesMarketPlace');
            $mail->addAddress($email);
            $mail->addReplyTo("axita31.khunt@gmail.com", 'NotesMarketPlace');
            $mail->IsHTML(true);

            $mail->Subject = "Forgot password";
            $mail->Body = " Hello,<br>
                            We have generated a new password for you<br>
                            Password: $password <br>
                            Email: $email <br>
                            Regards,<br>
                            Notes Marketplace<br>
                            <tr>
                            <td style='font-size: 16px;font-weight: 400; height: 25px; color: #333333;'>
                            Simply click below to login </td>
                             </tr>
                             <tr>
                             <td style='height: 50px;'><a href='http://localhost/NoteMarketPlace/front/login.php'>
                             <button style='width: 300px;background-color: #6255a5;height: 35px;border-radius: 3px;font-size: 18px; border:transparent;text-transform: uppercase;color: #fff;'>login</button></a></td>
                             </tr> ";
                            
            $mail->AltBody = '';
            $mail->send();
            $mail_sent = true;
            
			if($mail_sent=true){
				echo '<script type="text/javascript"> alert("Your password has been changed successfully and newly generated password is sent on your registered email address")</script>';
				$query="UPDATE users SET Password='$p' WHERE EmailId='$email'";
				$result=mysqli_query($conn, $query);
                if($result){
                    echo '<script type="text/javascript"> alert("updated")</script>';
                    header("Location:login.php");
                }
                    else echo"none";
            }
			
			
        } catch (Exception $e) {
            echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
        } }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<?php include 'head.php';?>

<body>

    <!-- forgot section-->
    <!-- Background image-->
    <img class="back-img" src="images/login/banner-with-overlay.jpg" alt="backimage">
    <!-- Background image-->
    <section id="forgot">
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
                    <div id="forgot-box">
                        <h2 class="text-center">Forgot Password?</h2>
                        <p class="user-instruction">Enter your email to reset your password</p>
                        <?php
                            if($mail_sent){
                                echo   "<p style='font-size:20px'>please check your emailid for new password</p>";
                            }
                        ?>

                        <!-- form elements-->
                        <form action = "forgot-password.php" method = "POST">
                            <div class="form-group">
                                <label class="info-label" for="exampleInputEmail1">Email</label>
                                <input type="email" name ="email" class="form-control input-box-style" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your email">
                            </div>
                            <div class="form-btn">
                                <button type="submit" name="submit" class="btn btn-general btn-purple">submit</button>
                            </div>
                        </form>


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