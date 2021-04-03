<!DOCTYPE html>
<html lang="en">

<?php include 'head.php' ; ?>

<body>
    
    <!-- Header -->
 <div class="only-white-nav extra-style-nav only-white-nav-with-mb">
            <header class="site-header">
                <div class="header-wrapper">
        
                    <!-- Mobile Menu Open Button -->
                    <span id="mobile-nav-open-btn">&#9776;</span>
        
                    <div class="logo-wrapper">
                        <a href="dashboard.php" title="Site Logo">
                            <img src="images/logo/dark-logo.png" alt="Logo">
                        </a>
                    </div>
                    <div class="navigation-wrapper">
                        <nav class="main-nav">
                            <ul class="menu-navigation">
                                <li>
                                    <a href="dashboard.php">Dashboard</a>
                                </li>
                                <li>                                    
                                    <div class="dropdown notes-btn-dropdown">
                                        <a role="button" id="notes-dropdown-lable" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Notes</a>
                                      
                                        <div class="dropdown-menu" aria-labelledby="notes-dropdown-lable">
                                          <a class="dropdown-item" href="notes-under-review.php">Notes Under Review</a>
                                          <a class="dropdown-item" href="published-notes.php">Published Notes</a>
                                          <a class="dropdown-item" href="downloaded-notes.php">Downloaded Notes</a>
                                          <a class="dropdown-item" href="rejected-notes.php">Rejected Notes</a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <a href="members.php">Members</a>
                                </li>
                                <li>
                                    <div class="dropdown reports-btn-dropdown">
                                        <a role="button" id="reports-dropdown-lable" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Reports</a>
                                      
                                        <div class="dropdown-menu" aria-labelledby="reports-dropdown-lable">
                                          <a class="dropdown-item" href="spam-reports.php">Spam Reports</a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown settings-btn-dropdown">
                                        <a role="button" id="settings-dropdown-lable" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Settings</a>
                                      
                                        <div class="dropdown-menu" aria-labelledby="settings-dropdown-lable">
                                          <a class="dropdown-item" href="manage-system-configuration.php">Manage System Configuration</a>
                                          <a class="dropdown-item" href="manage-administrator.php">Manage Administrator</a>
                                          <a class="dropdown-item" href="manage-category.php">Manage Category</a>
                                          <a class="dropdown-item" href="manage-type.php">Manage Type</a>
                                          <a class="dropdown-item" href="manage-country.php">Manage Countries</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="logged-in-user-photo-li">
                                    <div class="dropdown user-picture-dropdown">
                                        <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <div class="logged-in-user-photo">
                                                <img src="images/Dashboard/user-img.png" alt="User Photo" class="rounded-circle">
                                            </div>
                                        </a>
                                      
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                          <a class="dropdown-item" href="my-profile.php">Update Profile</a>
                                          <a class="dropdown-item" href="change-password.php">Change Password</a>
                                          <a class="dropdown-item logout-btn-dropdown" href="login.php">Logout</a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <a class="btn btn-general btn-purple" href="login.php" title="Download"
                                        role="button">Logout</a>
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
                                    <a href="dashboard.php">Dashboard</a>
                                </li>
                                <li>                                    
                                    <div class="dropdown notes-btn-dropdown">
                                        <a role="button" id="notes-dropdown-lable" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Notes</a>
                                      
                                        <div class="dropdown-menu" aria-labelledby="notes-dropdown-lable">
                                          <a class="dropdown-item" href="notes-under-review.php">Notes Under Review</a>
                                          <a class="dropdown-item" href="published-notes.php">Published Notes</a>
                                          <a class="dropdown-item" href="downloaded-notes.php">Downloaded Notes</a>
                                          <a class="dropdown-item" href="rejected-notes.php">Rejected Notes</a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <a href="members.php">Members</a>
                                </li>
                                <li>
                                    <div class="dropdown reports-btn-dropdown">
                                        <a role="button" id="reports-dropdown-lable" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Reports</a>
                                      
                                        <div class="dropdown-menu" aria-labelledby="reports-dropdown-lable">
                                          <a class="dropdown-item" href="spam-reports.php">Spam Reports</a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown settings-btn-dropdown">
                                        <a role="button" id="settings-dropdown-lable" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Settings</a>
                                      
                                        <div class="dropdown-menu" aria-labelledby="settings-dropdown-lable">
                                          <a class="dropdown-item" href="manage-system-configuration.php">Manage System Configuration</a>
                                          <a class="dropdown-item" href="manage-administrator.php">Manage Administrator</a>
                                          <a class="dropdown-item" href="manage-category.php">Manage Category</a>
                                          <a class="dropdown-item" href="manage-type.php">Manage Type</a>
                                          <a class="dropdown-item" href="manage-country.php">Manage Countries</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="logged-in-user-photo-li">
                                    <div class="logged-in-user-photo">
                                        <div class="dropdown">
                                            <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">                                        
                                                <img src="images/Dashboard/user-img.png" alt="User Photo" class="rounded-circle">                                        
                                            </a>
                                        
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="my-profile.php">Update Profile</a>
                                                <a class="dropdown-item" href="change-password.php">Change Password</a>
                                                <a class="dropdown-item logout-btn-dropdown" href="login.php">Logout</a>
                                        </div>
                                    </div>
                                    </div>
                                </li>
                                <li>
                                    <a class="btn btn-general btn-purple" href="login.php" title="Download"
                                        role="button">Logout</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </header>
        </div>
        <!-- Header ends -->


   <!-- Thanks popup -->
    <div id="popup">
        <div class="modal fade" id="thanks-popup-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <img src="images/notes-detail/close.png" alt="">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="thank-img text-center">
                            <img src="images/notes-detail/SUCCESS.png" alt="">                            
                        </div>
                        <p class="thank-heading">Thank you for purchasing!</p>
                        <p class="dear-buyer-name">Dear Smith,</p>
                        <p>As this is paid notes - you need to pay to seller Rahil Shah offline. We will send him an emial that you want to download this note. He may contact you further for payment process completion.</p>
                        <p>In case, you have urgency,<br>Please contact us on +919658745692.</p>
                        <p>Once he receives the payment and acknowledgde us - selected notes you can see over my downloads tab for download.</p>
                        <p>Have a good day.</p>
                    </div>                    
                </div>
            </div>
        </div>
    </div> 
    <!-- Thanks popup -->


    <div id="note-detail">
        <!-- note details Upper Part -->
        <div class="container">
            <div class="note-upr content-box-md">
               <!-- note details Upper left Part -->
                <p class="note-heading-1">Note Details</p>
                <div class="row no-gutters">
                    <div class="note-detail-left col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="row no-gutters">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <img src="images/notes-detail/1.jpg" alt="note" class="note-img img-fluid">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="note-box-details">
                                    <p class="note-name">Computer Science</p>
                                    <p class="note-type">Sciences</p>
                                    <p class="note-desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque voluptatum sit, iusto temporibus ipsam. Nesciunt earum ipsam error, aut vitae molestiae sit. </p>
                                    <a class="btn btn-general btn-purple" href="#" role="button" data-toggle="modal" data-target="#thanks-popup-model">Download / $15</a>                               
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- note details Upper right Part -->
                    <div class="note-details-right col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="row no-gutters">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                               <div class="note-details-left-part">
                                    <p class="note-single-detail-tag">Institution:</p>
                                    <p class="note-single-detail-tag">Country:</p>
                                    <p class="note-single-detail-tag">Course Name:</p>
                                    <p class="note-single-detail-tag">Course Code</p>
                                    <p class="note-single-detail-tag">Professor:</p>
                                    <p class="note-single-detail-tag">Number Of Pages:</p>
                                    <p class="note-single-detail-tag">Approved Date:</p>
                                    <p class="note-single-detail-tag">Rating:</p>
                                </div>                            
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                               <div class="note-details-right-part">
                                    <p class="note-single-detail-tag">University of California</p>
                                    <p class="note-single-detail-tag">United State</p>
                                    <p class="note-single-detail-tag">Computer Engineering</p>
                                    <p class="note-single-detail-tag">248705</p>
                                    <p class="note-single-detail-tag">Mr.Richard Brown</p>
                                    <p class="note-single-detail-tag">277</p>
                                    <p class="note-single-detail-tag">November 25 2020</p>
                                    <p class="note-single-detail-tag">
                                        <span>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i id="star" class="fa fa-star-o" style="color:gray"></i>
                                        </span>120 Reviews
                                    </p>
                                </div>                            
                            </div>
                            <p class="note-red-text">5 Users marked this note as inappropriate</p>
                        </div>
                    </div>
                    <!-- note details Upper right Part End -->
                </div>
            </div>
        </div>
        <!-- note details Upper Part End -->  
        
        <div class="notes-detail-border-bottom"></div>
        
        <!-- note details lower Part  --> 
        <div class="container">
            <div class="content-box-lg">
                <div class="row no-gutters">
                    <div class="col-lg-5 col-md-5 col-sm-12 col-12">
                        <div class="note-preview-box">
                            <p class="note-heading">Note Preview</p>
                            <iframe src="images/notes-detail/sample.pdf"></iframe>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-12 col-12">
                        <div class="customer-review-box">
                            <p class="note-heading">Customer Review</p>
                            <div class="customer-review-detail-box">
                                <div class="customer-review-detail">
                                    <div class="row no-gutters">
                                        <div class="col-lg-2 col-md-3 col-sm-2 col-12">
                                            <img class="reviewer-img" src="images/notes-detail/reviewer-1.png" alt="customer">
                                        </div>
                                        <div class="col-lg-10 col-md-9 col-sm-10 col-12">
                                            <p class="reviewer-name">Richard Brown</p>
                                            <p class="reviewer-rating">
                                                <span>
                                                    <img src="images/notes-detail/star.png" alt="">
                                                    <img src="images/notes-detail/star.png" alt="">
                                                    <img src="images/notes-detail/star.png" alt="">
                                                    <img src="images/notes-detail/star.png" alt="">
                                                    <img src="images/notes-detail/star-white.png" alt="">
                                                </span>
                                            </p>
                                            <p class="reviewer-text">Lorem ipsum is simply dummy text of the perinting and type casting industry.it has been the industr standard dummy text ever since the 1500s.</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="customer-review-detail-border-bottom"></div>
                                
                                <div class="customer-review-detail">
                                    <div class="row no-gutters">
                                        <div class="col-lg-2 col-md-3 col-sm-2 col-12">
                                            <img class="reviewer-img" src="images/notes-detail/reviewer-2.png" alt="customer">
                                        </div>
                                        <div class="col-lg-10 col-md-9 col-sm-10 col-12">
                                            <p class="reviewer-name">Alice Ortiaz</p>
                                            <p class="reviewer-rating">
                                                <span>
                                                    <img src="images/notes-detail/star.png" alt="">
                                                    <img src="images/notes-detail/star.png" alt="">
                                                    <img src="images/notes-detail/star.png" alt="">
                                                    <img src="images/notes-detail/star.png" alt="">
                                                    <img src="images/notes-detail/star-white.png" alt="">
                                                </span>
                                            </p>
                                            <p class="reviewer-text">Lorem ipsum is simply dummy text of the perinting and type casting industry.it has been the industr standard dummy text ever since the 1500s, an unknown.</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="customer-review-detail-border-bottom"></div>
                                
                                <div class="customer-review-detail">
                                    <div class="row no-gutters">
                                        <div class="col-lg-2 col-md-3 col-sm-2 col-12">
                                            <img class="reviewer-img" src="images/notes-detail/reviewer-3.png" alt="customer">
                                        </div>
                                        <div class="col-lg-10 col-md-9 col-sm-10 col-12">
                                            <p class="reviewer-name">Sara Passmore</p>
                                            <p class="reviewer-rating">
                                                <span>
                                                    <img src="images/notes-detail/star.png" alt="">
                                                    <img src="images/notes-detail/star.png" alt="">
                                                    <img src="images/notes-detail/star.png" alt="">
                                                    <img src="images/notes-detail/star.png" alt="">
                                                    <img src="images/notes-detail/star-white.png" alt="">
                                                </span>
                                            </p>
                                            <p class="reviewer-text">Lorem ipsum is simply dummy text of the perinting and type casting industry.</p>
                                        </div>
                                    </div>
                                </div>                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        <!-- note details lower Part End -->  
    </div>
    
   
    <!-- Footer-->
    <?php include 'footer.php' ; ?>
    <!-- Footer End-->

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