<!DOCTYPE html>
<html lang="en">

<?php include 'head.php'?>

<body>
    
     <!-- Header -->
        <div class="only-white-nav extra-style-nav only-white-nav-with-mb">
            <header class="site-header">
                <div class="header-wrapper">
        
                    <!-- Mobile Menu Open Button -->
                    <span id="mobile-nav-open-btn">&#9776;</span>
        
                    <div class="logo-wrapper">
                        <a href="dashboard.html" title="Site Logo">
                            <img src="images/logo/dark-logo.png" alt="Logo">
                        </a>
                    </div>
                    <div class="navigation-wrapper">
                        <nav class="main-nav">
                            <ul class="menu-navigation">
                                <li>
                                    <a href="dashboard.html">Dashboard</a>
                                </li>
                                <li>                                    
                                    <div class="dropdown notes-btn-dropdown">
                                        <a role="button" id="notes-dropdown-lable" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Notes</a>
                                      
                                        <div class="dropdown-menu" aria-labelledby="notes-dropdown-lable">
                                          <a class="dropdown-item" href="notes-under-review.html">Notes Under Review</a>
                                          <a class="dropdown-item" href="published-notes.html">Published Notes</a>
                                          <a class="dropdown-item" href="downloaded-notes.html">Downloaded Notes</a>
                                          <a class="dropdown-item" href="rejected-notes.html">Rejected Notes</a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <a href="members.html">Members</a>
                                </li>
                                <li>
                                    <div class="dropdown reports-btn-dropdown">
                                        <a role="button" id="reports-dropdown-lable" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Reports</a>
                                      
                                        <div class="dropdown-menu" aria-labelledby="reports-dropdown-lable">
                                          <a class="dropdown-item" href="spam-reports.html">Spam Reports</a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown settings-btn-dropdown">
                                        <a role="button" id="settings-dropdown-lable" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Settings</a>
                                      
                                        <div class="dropdown-menu" aria-labelledby="settings-dropdown-lable">
                                          <a class="dropdown-item" href="manage-system-configuration.html">Manage System Configuration</a>
                                          <a class="dropdown-item" href="manage-administrator.html">Manage Administrator</a>
                                          <a class="dropdown-item" href="manage-category.html">Manage Category</a>
                                          <a class="dropdown-item" href="manage-type.html">Manage Type</a>
                                          <a class="dropdown-item" href="manage-country.html">Manage Countries</a>
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
                                          <a class="dropdown-item" href="my-profile.html">Update Profile</a>
                                          <a class="dropdown-item" href="change-password.html">Change Password</a>
                                          <a class="dropdown-item logout-btn-dropdown" href="login.html">Logout</a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <a class="btn btn-general btn-purple" href="login.html" title="Download"
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
                                    <a href="dashboard.html">Dashboard</a>
                                </li>
                                <li>                                    
                                    <div class="dropdown notes-btn-dropdown">
                                        <a role="button" id="notes-dropdown-lable" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Notes</a>
                                      
                                        <div class="dropdown-menu" aria-labelledby="notes-dropdown-lable">
                                          <a class="dropdown-item" href="notes-under-review.html">Notes Under Review</a>
                                          <a class="dropdown-item" href="published-notes.html">Published Notes</a>
                                          <a class="dropdown-item" href="downloaded-notes.html">Downloaded Notes</a>
                                          <a class="dropdown-item" href="rejected-notes.html">Rejected Notes</a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <a href="members.html">Members</a>
                                </li>
                                <li>
                                    <div class="dropdown reports-btn-dropdown">
                                        <a role="button" id="reports-dropdown-lable" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Reports</a>
                                      
                                        <div class="dropdown-menu" aria-labelledby="reports-dropdown-lable">
                                          <a class="dropdown-item" href="spam-reports.html">Spam Reports</a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown settings-btn-dropdown">
                                        <a role="button" id="settings-dropdown-lable" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Settings</a>
                                      
                                        <div class="dropdown-menu" aria-labelledby="settings-dropdown-lable">
                                          <a class="dropdown-item" href="manage-system-configuration.html">Manage System Configuration</a>
                                          <a class="dropdown-item" href="manage-administrator.html">Manage Administrator</a>
                                          <a class="dropdown-item" href="manage-category.html">Manage Category</a>
                                          <a class="dropdown-item" href="manage-type.html">Manage Type</a>
                                          <a class="dropdown-item" href="manage-country.html">Manage Countries</a>
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
                                          <a class="dropdown-item" href="my-profile.html">Update Profile</a>
                                          <a class="dropdown-item" href="change-password.html">Change Password</a>
                                          <a class="dropdown-item logout-btn-dropdown" href="login.html">Logout</a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <a class="btn btn-general btn-purple" href="login.html" title="Download" role="button">Logout</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </header>
        </div>
        <!-- Header ends -->
    
 <!-- add category content-->   

    <div id="add-category">  
        <div class="container">
                <div class="row no-gutters all-notes">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12 text-left">
                        <p class="category-heading">Add Category</p>
                    </div>
                </div>
            </div>
        <form>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Category Name *</label>
                                <input type="text" name="categoryname" class="form-control input-light-color"
                                    placeholder="Enter your category" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-6 desc-detail">
                                <label>Description *</label>
                                <input type="text" name="description" class="form-control input-box input-light-color"
                                    placeholder="Enter your description" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-row">
                            <button type="submit" name="submit" id="my-profile-submit-btn" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    
        <!-- Footer-->
        <?php include 'footer.php'?>
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