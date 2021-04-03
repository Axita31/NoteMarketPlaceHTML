<?php

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

//mail function
require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

$mail = new PHPMailer(true);

$alert = '';

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $comments = $_POST['comments'];

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
                      subject: <b>$subject</b> Comment: <b>$comments</b>";
        $mail->AltBody = '';

        $mail->send();
        $mail_sent = true;
        $alert = '<div class = "alert-sucess">
                <p style="font-size:20px;" >Message sent ! Thank you for contacting us.</span>
                </div>';
    } catch (Exception $e) {
        $alert = '<div class = "alert-sucess">
                <span>'.$e -> getMessage().'</span>
                </div>';
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
                                <li >
                                    <a href="faq.php">FAQ</a>
                                </li>
                                <li class="active">
                                    <a href="contact-us.php">Contact Us</a>
                                </li>
                                <li>
                                    <a class="btn btn-general btn-purple" href="login.php" title="Download"
                                        role="button">Login</a>
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
                                <li >
                                    <a href="faq.php">FAQ</a>
                                </li>
                                <li class="active">
                                    <a href="contact-us.php">Contact Us</a>
                                </li>
                                <li>
                                    <a class="btn btn-general btn-purple" href="login.php" title="Download"
                                        role="button">Login</a>
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
                         <?php echo  $alert ; ?>
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
                        <input type="text" name="name" class="form-control input-light-color" placeholder="Enter your full name">
                        <div class="form-group">
                            <label>Email Address *</label>
                            <input type="email" name="email" class="form-control input-light-color" placeholder="Enter your email address">
                        </div>
                        <div class="form-group">
                            <label class="s3">Subject *</label>
                            <input type="text" name="subject" class="form-control input-light-color" placeholder="Enter your subject">
                        </div>                
                    </div>
                    <div class="form-group col-md-6">
                        <label class="right-content">Comments / Questions</label>
                        <textarea id="contact-textarea" name="comments" placeholder="comments...." class="form-control input-light-color right-content"></textarea>
                    </div>
                </div> 
                <button type="submit"  name="submit" id="contact-btn" class="btn btn-primary btn-purple">Submit</button>            
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