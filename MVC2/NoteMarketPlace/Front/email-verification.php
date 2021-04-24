<?php
include "db.php";

$id = $_GET['ID'];
$id = mysqli_real_escape_string($conn, $id);

$query = "UPDATE users SET IsEmailVerified=1 WHERE ID=$id";
mysqli_query($conn, $query);

if($query){
    header('Loction:login.php');
}else{
    echo "not updated".mysqli_error($conn);
}

?>
<!DOCTYPE html>
<html lang="en">

<?php include 'head.php';?>

<body style="background: #000; font-family: 'Open Sans',sans-serif ">

    <!-- email-verification section-->
    <div id="email-verify">
        <section id="email">
            <div class="container">            
                <div id="email">
                   <form action="email-verification.php" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="email-box">
                                    <a href="#">
                                        <img class="image-fluid" src="images/logo/dark-logo.png" alt="Notes Marketplace">
                                    </a>
                                    <h2>Email Verification</h2>
                                    <h3>Dear <?php echo $_GET["username"]; ?></h3>
                                    <p>Thanks for Signing Up!</p>
                                    <p>Simply click below for email verification.</p>
                                    <div class="form-btn">
                                        <button type="submit" name="submit" class="btn btn-general btn-purple">Verify Email Address</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
         </section>    
     </div>
                
    <!-- JQuery -->
    <script src="js/jquery.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <!-- Custom JS -->
    <script src="js/script.js"></script>

    
    </body>
 </html>