<!DOCTYPE html>
<html lang="en">

<?php include 'head.php' ; ?>

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
                        <div class="success-msg">
                            <p><span><i class="fa fa-check-circle"></i></span> Your account has been successfully created.</p>
                        </div>

                        <!-- form elements-->
                        <form>
                            <div class="form-group">
                                <label class="info-label" for="exampleInputEmail1">First Name</label>
                                <input type="text" class="form-control input-box-style" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your first name">
                            </div>
                            <div class="form-group">
                                <label class="info-label" for="exampleInputEmail1">Last Name</label>
                                <input type="text" class="form-control input-box-style" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your last name">
                            </div>
                            <div class="form-group">
                                <label class="info-label" for="exampleInputEmail1">Email</label>
                                <input type="email" class="form-control input-box-style" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your email">
                            </div>
                            <div class="form-group">
                                <label class="info-label" for="exampleInputPassword1">Password</label>
                                <input type="password" class="form-control input-box-style" id="exampleInputPassword1" placeholder="Enter your password" autocomplete="on">
                                <div class="eye"><img class="eye-img" src="images/login/eye.png" alt="eye"></div>
                            </div>
                            <div class="form-group">
                                <label class="info-label" for="exampleInputPassword1">Confirm Password</label>
                                <input type="password" class="form-control input-box-style" id="exampleInputPassword1" placeholder="Enter your confirm password" autocomplete="on">
                                <div class="eye"><img class="eye-img" src="images/login/eye.png" alt="eye"></div>
                            </div>
                            <div class="form-btn">
                                <button type="submit" class="btn btn-general btn-purple" form action="../html/user-profile.html">Sign Up</button>
                            </div>
                        </form>
                        <div class="toggle-btw-login-signup" class="text-center">
                            <p>Already have an account? <span><a href="login.html">Login</a></span></p>
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