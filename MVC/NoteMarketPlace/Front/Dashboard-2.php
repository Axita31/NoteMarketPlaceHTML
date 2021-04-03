<!DOCTYPE html>
<html lang="en">

<?php include 'head.php';?>

<body>

    <!-- Header -->
    <div class="only-white-nav  extra-style-nav">
        <header class="site-header">
            <div class="header-wrapper">

                <!-- Mobile Menu Open Button-->
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
                                <a href="dashboard-1.php">Sell Your Notes</a>
                            </li>
                            <li>
                                <a href="buyer-request.php">Buyer Request</a>
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
                    </nav>
                </div>

                <!-- Mobile Menu-->
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
                                <a href="dashboard-1.php">Sell Your Notes</a>
                            </li>
                            <li>
                                <a href="buyer-request.php">Buyer Request</a>
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

    <!-- Dashboard content-->

    <div id="dashboard">
        <!-- Dashboard box-->
        <div class="content-box-lg">
            <div class="container">
                <div class="row no-gutters all-notes">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6 text-left">
                        <p class="dashboard-heading">Dashboard</p>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6 text-right">
                        <button class="btn btn-general btn-purple add-note-btn" onclick="window.location.href='add-notes.php'" >Add Note</button>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="row no-gutters dashboard-left">

                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
                                <div class="my-earning-heading dashboard-box">
                                    <img src="images/Dashboard/earning-icon.svg" alt="">
                                    <p class="box-heading text-center">My Earning</p>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
                                <div class="numbers-of-notes dashboard-box">
                                    <p class="dashboard-single-details text-center">100</p>
                                    <p class="dashboard-detail-heading text-center">Numbers of Notes Sold</p>
                                </div>
                            </div>

                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
                                <div class="money-earned dashboard-box">
                                    <p class="dashboard-single-details text-center">$10,00,000</p>
                                    <p class="dashboard-detail-heading text-center">Money Earned</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dashboard box End -->

        <!-- Progress Notes Box-->

        <div class="content-box-lg">
            <div class="container">
                <div class="row no-gutters">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12 text-left box-heading-wrapper">
                        <p class="progress-heading">In Progress Notes</p>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="row no-gutters text-right general-search-bar-btn-wrapper">
                            <div class="form-group has-search">
                                <span class="fa fa-search form-control-feedback"></span>
                                <input type="text" class="form-control search-bar" placeholder="Search">
                            </div>
                            <button class="btn btn-general btn-purple progress-btn">Search</button>
                        </div>

                    </div>
                </div>
            </div>

            <div class="container">
                <div class="in-progress-notes-table general-table-responsive">
                    <div class="table-responsive-xl">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Added Date</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>09-10-2020</td>
                                    <td>Data Science</td>
                                    <td>Science</td>
                                    <td>Draft</td>
                                    <td class="text-center">
                                        <img class="edit-img-in-table" src="images/Dashboard/edit.png" alt="edit">
                                        <img class="delete-img-in-table" src="images/Dashboard/delete.png" alt="edit">
                                    </td>
                                </tr>
                                <tr>
                                    <td>10-10-2020</td>
                                    <td>Accounts</td>
                                    <td>Commerce</td>
                                    <td>In Review</td>
                                    <td class="text-center"><img class="eye-img-in-table" src="images/Dashboard/eye.png" alt="eye"></td>
                                </tr>
                                <tr>
                                    <td>10-10-2020</td>
                                    <td>Accounts</td>
                                    <td>Commerce</td>
                                    <td>In Review</td>
                                    <td class="text-center"><img class="eye-img-in-table" src="images/Dashboard/eye.png" alt="eye"></td>
                                </tr>
                                <tr>
                                    <td>11-10-2020</td>
                                    <td>Social Studies</td>
                                    <td>Scocial</td>
                                    <td>Submitted</td>
                                    <td class="text-center"><img class="eye-img-in-table" src="images/Dashboard/eye.png" alt="eye"></td>
                                </tr>
                                <tr>
                                    <td>12-10-2020</td>
                                    <td>AI</td>
                                    <td>IT</td>
                                    <td>Submitted</td>
                                    <td class="text-center"><img class="eye-img-in-table" src="images/Dashboard/eye.png" alt="eye"></td>
                                </tr>
                                <tr>
                                    <td>13-10-2020</td>
                                    <td>Lorem ipsum dolor sit amet</td>
                                    <td>Lorem</td>
                                    <td>Draft</td>
                                    <td class="text-center">
                                        <img class="edit-img-in-table" src="images/Dashboard/edit.png" alt="edit">
                                        <img class="delete-img-in-table" src="images/Dashboard/delete.png" alt="edit">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Progress Notes Box End-->
        <!-- pagination -->
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item">
                    <a class="page-link" href="" aria-label="Previous">
                        <img src="images/pagination/left-arrow.png" alt="">
                    </a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">4</a></li>
                <li class="page-item"><a class="page-link" href="#">5</a></li>
                <li class="page-item">
                    <a class="page-link" href="" aria-label="Next">
                        <img style="color: white;" src="images/pagination/right-arrow.png" alt="">
                    </a>
                </li>
            </ul>
        </nav>
        <!-- pagination -->

        <!-- published note table -->
        <div class="content-box-lg">
            <div class="container">
                <div class="row no-gutters">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12 text-left box-heading-wrapper">
                        <p class="progress-heading">Published Notes</p>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="row no-gutters text-right general-search-bar-btn-wrapper">
                            <div class="form-group has-search">
                                <span class="fa fa-search form-control-feedback"></span>
                                <input type="text" class="form-control search-bar" placeholder="Search">
                            </div>
                            <button class="btn btn-general btn-purple progress-btn">Search</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="in-progress-notes-table general-table-responsive">
                    <div class="table-responsive-xl">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Added date</th>
                                    <th scope="col">title</th>
                                    <th scope="col">category</th>
                                    <th scope="col">sell type</th>
                                    <th scope="col">price</th>
                                    <th scope="col" class="text-center">action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>09-10-2020</td>
                                    <td>Data Science</td>
                                    <td>Science</td>
                                    <td>Paid</td>
                                    <td>$575</td>
                                    <td class="text-center"><img class="eye-img-in-table" src="images/Dashboard/eye.png" alt="eye"></td>
                                </tr>
                                <tr>
                                    <td>10-10-2020</td>
                                    <td>Accounts</td>
                                    <td>Commerce</td>
                                    <td>Free</td>
                                    <td>$0</td>
                                    <td class="text-center"><img class="eye-img-in-table" src="images/Dashboard/eye.png" alt="eye"></td>
                                </tr>
                                <tr>
                                    <td>11-10-2020</td>
                                    <td>Social Studies</td>
                                    <td>Scocial</td>
                                    <td>Free</td>
                                    <td>$0</td>
                                    <td class="text-center"><img class="eye-img-in-table" src="images/Dashboard/eye.png" alt="eye"></td>
                                </tr>
                                <tr>
                                    <td>12-10-2020</td>
                                    <td>AI</td>
                                    <td>IT</td>
                                    <td>Paid</td>
                                    <td>$3542</td>
                                    <td class="text-center"><img class="eye-img-in-table" src="images/Dashboard/eye.png" alt="eye"></td>
                                </tr>
                                <tr>
                                    <td>13-10-2020</td>
                                    <td>Lorem ipsum dolor sit amet</td>
                                    <td>Lorem</td>
                                    <td>Free</td>
                                    <td>$0</td>
                                    <td class="text-center"><img class="eye-img-in-table" src="images/Dashboard/eye.png" alt="eye"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- published note table -->

        <!-- pagination -->
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item">
                    <a class="page-link" href="" aria-label="Previous">
                        <img src="images/pagination/left-arrow.png" alt="">
                    </a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">4</a></li>
                <li class="page-item"><a class="page-link" href="#">5</a></li>
                <li class="page-item">
                    <a class="page-link" href="" aria-label="Next">
                        <img style="color: white;" src="images/pagination/right-arrow.png" alt="">
                    </a>
                </li>
            </ul>
        </nav>
        <!-- pagination -->

        <!-- Footer-->
            <?php include 'footer.php'; ?>
        <!-- Footer End-->
    </div>

    <!-- Dashboard content End-->


    <!-- Popper Js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>

    <!-- JQuery -->
    <script src="js/jquery.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <!-- Custom JS -->
    <script src="js/script.js"></script>

</body>

</html>