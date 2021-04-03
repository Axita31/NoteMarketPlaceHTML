<!DOCTYPE html>
<html lang="en">  

 <?php include 'head.php' ; ?>
 

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
                        <form>
                            <div class="form-group">
                                <label class="info-label" for="exampleInputPassword1">Old Password</label>
                                <input type="password" class="form-control input-box-style" id="exampleInputPassword1" placeholder="Enter your old password" autocomplete="on">
                                <div class="eye"><img class="eye-img" src="images/login/eye.png" alt="eye"></div>
                            </div>
                            <div class="form-group">
                                <label class="info-label" for="exampleInputPassword1">New Password</label>
                                <input type="password" class="form-control input-box-style" id="exampleInputPassword1" placeholder="Enter your new password" autocomplete="on">
                                <div class="eye"><img class="eye-img" src="images/login/eye.png" alt="eye"></div>
                            </div>
                            <div class="form-group">
                                <label class="info-label" for="exampleInputPassword1">Confirm Password</label>
                                <input type="password" class="form-control input-box-style" id="exampleInputPassword1" placeholder="Enter your confirm password" autocomplete="on">
                                <div class="eye"><img class="eye-img" src="images/login/eye.png" alt="eye"></div>
                            </div>
                            <div class="form-btn">
                                <button type="submit" class="btn btn-general btn-purple" form action="/user-profile.html">Submit</button>
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