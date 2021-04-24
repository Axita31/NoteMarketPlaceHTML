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
<style>
    #email-check-box{
    padding: 30px;
    margin: auto;
    min-height: 300px;
    max-width: 580px;
    background: white;
    border-radius: 3px;
    }
    
</style>
<body style="background: #000; font-family: 'Open Sans',sans-serif ">
<div id="email-verify">
    <section id="email">
        <div class="container">            
            <div id="email">                   
                <div class="row">
                    <div class="col-md-12">
                        <div id="email-check-box">
                            <a href="#">
                                <img class="image-fluid" src="images/logo/dark-logo.png" alt="Notes Marketplace">
                            </a>
                            <h2>Email verified</h2>
                            <button onclick = "window.location.href = 'login.php'" class="btn btn-general btn-purple">click here to login</button>
                        </div>
                    </div>
                </div>                  
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