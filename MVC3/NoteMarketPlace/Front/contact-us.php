<?php
include 'db.php';
session_start();

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

$mail_sent = false;

if (isset($_SESSION['email'])) {
    $user_email = $_SESSION['email'];
    $query = mysqli_query($conn, "SELECT EmailID,FirstName,LastName FROM users WHERE EmailID = '$user_email'");
    
    /*if($query){
        echo 'connected';
    }else{
        echo 'not'.mysqli_error($conn);
    }*/

    while ($row = mysqli_fetch_assoc($query)) {
        $user_email = $row['EmailID'];
        $user_name = $row['FirstName'] . " " . $row['LastName'];
    }
}


if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $comments = $_POST['comments'];
    
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
        $mail->addAddress("axita31.khunt@gmail.com");

        $mail->IsHTML(true);
        $mail->Subject = "Email verification";
       // $mail->AddEmbeddedImage('images/blue-logo.png', 'logo');

        $mail->Body = "Name: <b>$name</b><br><br>Email: <b>$email</b><br><br>
                      subject: <b>$subject</b><br>Comment: <b>$comments</b>";
        $mail->AltBody = '';

        $mail->send();
        $mail_sent = true;
        $alert = '<div class = "alert-sucess">
                <p style="font-size:20px; color:#6255a5" >Message sent ! Thank you for contacting us.</span>
                </div>';
    } catch (Exception $e) {
            echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<?php include 'head.php';?>

<body>

    <!-- Header -->
    <div class="only-white-nav extra-style-nav">
        <header class="site-header">
            <div class="header-wrapper">

                <!-- Mobile Menu Open Button -->
                <span id="mobile-nav-open-btn">&#9776;</span>

                <div class="logo-wrapper">
                    <a href="home.php" title="Site Logo">
                        <img src="images/logo/dark-logo.png" alt="Logo">
                    </a>
                </div>
                <div class="navigation-wrapper">
                    <nav class="main-nav">
                        <ul class="menu-navigation">
                            <li>
                                <a href="search-notes.php">Search Notes</a>
                            </li>
                            <li>
                                <a href="add-notes.php">Sell Your Notes</a>
                            </li>
                            <li>
                                <a href="faq.php">FAQ</a>
                            </li>
                            <li class="active">
                                <a href="contact-us.php">Contact Us</a>
                            </li>
                            <li>
                                <a class="btn btn-general btn-purple" href="login.php" title="Download" role="button">Login</a>
                            </li>
                        </ul>
                    </nav>
                </div>

                <!-- Mobile Menu -->
                <div id="mobile-nav">
                    <img class="logo-in-mobile-menu" src="images/logo/dark-logo.png" alt="Notes Logo">
                    <!-- Mobile Menu Close Button -->
                    <span id="mobile-nav-close-btn">&times;</span>

                    <div id="mobile-nav-content">
                        <ul class="nav">
                            <li>
                                <a href="search-notes.php">Search Notes</a>
                            </li>
                            <li>
                                <a href="add-notes.php">Sell Your Notes</a>
                            </li>
                            <li>
                                <a href="faq.php">FAQ</a>
                            </li>
                            <li class="active">
                                <a href="contact-us.php">Contact Us</a>
                            </li>
                            <li>
                                <a class="btn btn-general btn-purple" href="login.php" title="Download" role="button">Login</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
    </div>
    <!-- Header ends -->

    <!-- background-->
    <div id="contact-us">
        <!-- back img-->
        <div class="small-height-bg">
            <p class="text-center">Contact Us</p>
        </div>
        <!-- back img-->

        <!-- Heading-1-->
        <div id="form-heading-1">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h4>Get in Touch</h4>
                        <h6>Let us know how to get back to you</h6>
                    </div>
                    <div class="col-md-6 alert-sucess">
                        <?php
                            if($mail_sent){
                                echo  $alert ;
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <!--Form-1-->
        <div class="container">
            <form action="contact-us.php" method="POST">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Full Name *</label>
                     
                        <?php
                        if (isset($_SESSION['email'])) {
                            echo "<input type='text' name='name' value='$user_name' class='form-control input-light-color' placeholder='Enter your full name'>";
                        } else
                            echo "<input type='text' name='name' class='form-control input-light-color' placeholder='Enter your full name' required>";
                        ?>
                        <div class="incorrect-password-label">
                            <?php
                            /*if (!$name_check) {
                                echo "Please enter your name";
                            }*/
                            ?>
                        </div>
                        
                        <div class="form-group">
                            <label>Email Address *</label>
                            <?php
                            if (isset($_SESSION['email']))
                                echo " <input type='email' value='$user_email' name='email' class='form-control input-light-color' placeholder='Enter your email address'>";
                            else echo "<input type='email' name='email' class='form-control input-light-color' placeholder='Enter your email address' required>";
                            ?>
                            <div class="incorrect-password-label">
                                <?php
                                /*if (!$mail_check) {
                                    echo "Please enter your correct email address";
                                }*/
                            ?>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="s3">Subject *</label>
                            <input type="text" name="subject" class="form-control input-light-color" placeholder="Enter your subject" required>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="right-content">Comments / Questions</label>
                        <textarea id="contact-textarea" name="comments" placeholder="comments...." class="form-control input-light-color right-content"></textarea>
                    </div>
                </div>
                <button type="submit" name="submit" id="contact-btn" class="btn btn-primary btn-purple">Submit</button>
            </form>
        </div>
    </div>

    <!-- background-->

    <!-- Footer-->
    <?php include 'footer.php'; ?>
    <!-- Footer End-->

    <!-- JQuery -->
    <script src="js/jquery.min.js"></script>

    <!-- Popper Js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <!-- Custom JS -->
    <script src="js/script.js"></script>

</body>

</html>