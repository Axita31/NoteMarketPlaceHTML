<!DOCTYPE html>
<html lang="en">

<?php include 'head.php';?>

<body data-spy="scroll" data-target=".navbar" data-offset="65">

    <!--<nav class="navbar">-->
    <div id="home-header">
        <!-- Header -->
        <div class="only-white-nav  extra-style-nav">
            <header class="site-header">
                <div class="header-wrapper">
                    <!-- Mobile Menu Open Button-->
                    <span id="mobile-nav-open-btn">&#9776;</span>

                    <div class="logo-wrapper">
                        <a href="home.php" title="Site Logo">
                            <img src="images/logo/white-logo.png" alt="Logo">
                        </a>
                    </div>
                    <div class="navigation-wrapper">
                        <nav class="main-nav">
                            <ul class="menu-navigation">
                                <li>
                                    <a href="search-notes.php">Search Notes</a>
                                </li>
                                <li>
                                    <a href="Dashboard-1.php">Sell Your Notes</a>
                                </li>
                                <li>
                                    <a href="faq.php">FAQ</a>
                                </li>
                                <li>
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
                            <ul class="menu-navigation">
                                <li>
                                    <a href="search-notes.php">Search Notes</a>
                                </li>
                                <li>
                                    <a href="dashboard-1.php">Sell Your Notes</a>
                                </li>
                                <li>
                                    <a href="faq.php">FAQ</a>
                                </li>
                                <li>
                                    <a href="contact-us.php">Contact Us</a>
                                </li>
                                <li class="logged-in-user-photo-li">
                                    <div class="dropdown">
                                        <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <div class="logged-in-user-photo">
                                                <img src="images/user-profile/user-img.png" alt="User Photo" class="rounded-circle">
                                            </div>
                                        </a>

                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <a class="dropdown-item active" href="user-profile.php">My Profile</a>
                                            <a class="dropdown-item" href="my-downloads.php">My Downloads</a>
                                            <a class="dropdown-item" href="my-sold-notes.php">My Sold Notes</a>
                                            <a class="dropdown-item" href="my-rejected-notes.php">My Rejected Notes</a>
                                            <a class="dropdown-item" href="change-password.php">Change Password</a>
                                            <a class="dropdown-item logout-btn-dropdown" href="login.php">Logout</a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <a class="btn btn-general btn-purple" href="login.php" title="Download" role="button">Logout</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </header>
        </div>
        <!-- Header ends -->
    </div>
    <!-- </nav>
    <!-- Home -->
    <section id="home">

        <!-- Background Image -->
        <img id="home-bg" src="images/Homepage/banner-with-overlay.jpg" alt="Background">

        <!-- overlay -->
        <div id="home-overlay"></div>

        <!-- Home Content-->
        <div id="home-content">
            <!-- Home content -->
            <div id="home-content text-left">
                <div id="home-heading">
                    <h1>Download Free/Paid Notes </h1>
                    <h1 class="heading1">or Sale your Book</h1>
                </div>
                <div id="home-text">
                    <p>Lorem ipsum has been the industry's standard text ever since the</p>
                    <p>1500s, when an unknown printer took a galley of type.</p>
                </div>
                <a class="btn btn-general btn-home" href="faq.php" title="Learn More" role="button">LEARN MORE</a>
            </div>
        </div>
    </section>
    <!-- Home Ends-->

    <!-- About-->
    <section id="about-note">
        <div class="content-box-lg">
            <div class="container">
                <div class="row">
                    <!-- About Left Side-->
                    <div class="col-md-6 col-sm-12 col-12 wow slideInLeft" data-wow-duration="1s">
                        <div id="about-left">
                            <div class="horizontal-heading">
                                <h5>About</h5>
                                <h2>NoteMarketPlace</h2>
                            </div>
                        </div>
                    </div>
                    <!-- About Right Side-->
                    <div class="col-md-6 col-sm-12 col-12 wow slideInRight" data-wow-duration="2s">
                        <div id="about-right">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente aspernatur harum libero et nostrum sequi consequatur, tempore accusamus ab esse, voluptatem laudantium voluptas rerum? Laborum id ad alias saepe nemo,alias saepe ne consequatur. </p>
                            <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente aspernatur harum libero et nostrum sequi consequatur, tempore accusamus ab esse, voluptatem.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- work-->
    <section id="work">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="horizontal-heading text-center">
                        <p>How it works</p>
                    </div>
                </div>
            </div>
            <div id="work-part">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="text-center">
                                <div id="download-logo"><img class="img-fluid" src="images/Homepage/download.png" alt=""></div>
                                <p id="download-title">Download Free/Paid Notes</p>
                                <p id="download-des">Get Material for Your<br>Course etc.</p>
                                <a class="btn btn-general btn-purple" href="search-notes.php" title="Download" role="button">Download</a>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="text-center">
                                <div id="sell-logo"><img class="img-fluid" src="images/Homepage/seller.png" alt=""></div>
                                <p id="sell-title">Sell Your Notes</p>
                                <p id="sell-des">Upload and Download Course<br>and Materials etc.</p>
                                <a class="btn btn-general btn-purple" href="#" title="Sell Book" role="button">SELL BOOK</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- work End-->

    <!-- Testinomial-->
    <section id="customer">

        <div class="content-box-md">

            <div class="container">

                <div class="row">
                    <div class="col-md-12">
                        <div class="horizontal-heading text-center">
                            <h2>What Our Customer are Saying</h2>
                        </div>
                    </div>
                </div>

                <div class="testinomial">
                    <div class="row">
                        <div class="col-md-6 home-box user-1">
                            <div class="home-box-effect">
                                <div class="row">
                                    <div class="col-md-3 col-sm-2 col-2 text-center">
                                        <img src="images/testimonial/customer-1.png" alt="Customer Photo" class="img-responsive img-circle">
                                    </div>
                                    <div class="col-md-9 col-sm-10 col-10">
                                        <h4>Walter Meller</h4>
                                        <h5>Founder & CEO, Matrix Group</h5>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 ">
                                            <p class="home-user-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil error,quodab! Libero similique facere consequatur.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 home-box user-2">
                            <div class="home-box-effect">
                                <div class="row">
                                    <div class="col-md-3 col-sm-2 col-2 text-center">
                                        <img src="images/testimonial/customer-2.png" alt="Customer Photo" class="img-responsive img-circle">
                                    </div>
                                    <div class="col-md-9 col-sm-10 col-10">
                                        <h4>Jonnie Riley</h4>
                                        <h5>Employee, Curious Snacks</h5>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p class="home-user-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil error,quodab! Libero similique facere consequatur.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 home-box user-3">
                            <div class="home-box-effect">
                                <div class="row">
                                    <div class="col-md-3 col-sm-2 col-2 text-center">
                                        <img src="images/testimonial/customer-3.png" alt="Customer Photo" class="img-responsive img-circle">
                                    </div>
                                    <div class="col-md-9 col-sm-10 col-10">
                                        <h4>Amilia Luna</h4>
                                        <h5>Teacher, Saint Joseph High School</h5>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p class="home-user-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil error,quodab! Libero similique facere consequatur.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 home-box">
                            <div class="home-box-effect">
                                <div class="row">
                                    <div class="col-md-3 col-sm-2 col-2 text-center">
                                        <img src="images/testimonial/customer-4.png" alt="Customer Photo" class="img-responsive img-circle">
                                    </div>
                                    <div class="col-md-9 col-sm-10 col-10">
                                        <h4>Daniel Cardos</h4>
                                        <h5>Software Engineer, Infinitum Company</h5>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p class="home-user-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil error,quodab! Libero similique facere consequatur.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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