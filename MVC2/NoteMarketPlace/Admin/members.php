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
                                <li class="active">
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
                                <li class="active">
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

    
 <!-- members content-->   

    <div id="members">
        
    <!-- Member-age Box-->         
        <div class="content-box-lg">
            <div class="container">
                <div class="row no-gutters">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12 text-left box-heading-wrapper">
                        <p class="member-heading">Members</p>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12 right-part">
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
                                    <th scope="col" class="text-center">sr no.</th>
                                    <th scope="col">First Name</th>
                                    <th scope="col">Last Name</th>
                                    <th scope="col">email</th>
                                    <th scope="col">Joining Date</th>
                                    <th scope="col" class="text-center">Under Review<br>notes</th>
                                    <th scope="col" class="text-center">Published<br>notes</th>
                                    <th scope="col" class="text-center">Downloaded<br>notes</th>
                                    <th scope="col" class="text-center">Total<br>Expenses</th>
                                    <th scope="col" class="text-center">Total<br>Earnings</th>
                                    <th scope="col" class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td class="text-center">1</td>
                                    <td>Khyati</td>
                                    <td>Patel</td>
                                    <td>khyatipatel99@gmail.com</td>
                                    <td>09-10-2020, 10:10</td>
                                    <td class="purple-td text-center">19</td>
                                    <td class="purple-td text-center">10</td>
                                    <td class="purple-td text-center">22</td>
                                    <td class="purple-td text-center">$220</td>
                                    <td class="text-center">$177</td>
                                    <td class="text-center visible-overflow-for-dropdown">
                                        <div class="dropdown dropdown-dots-table">
                                            <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                <img class="dots-in-table" src="images/Dashboard/dots.png" alt="edit">
                                            </a>
                                    
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="#">View More Details</a>
                                                <a class="dropdown-item" href="#">Deactivate</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="text-center">2</td>
                                    <td>Rahul</td>
                                    <td>Shah</td>
                                    <td>rahulshah88@gmail.com</td>
                                    <td>10-10-2020, 04:45</td>
                                    <td class="purple-td text-center">4</td>
                                    <td class="purple-td text-center">5</td>
                                    <td class="purple-td text-center">4</td>
                                    <td class="purple-td text-center">$222</td>
                                    <td class="text-center">$177</td>
                                    <td class="text-center visible-overflow-for-dropdown">
                                        <div class="dropdown dropdown-dots-table">
                                            <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                <img class="dots-in-table" src="images/Dashboard/dots.png" alt="edit">
                                            </a>
                                    
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="#">View More Details</a>
                                                <a class="dropdown-item" href="#">Deactivate</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="text-center">3</td>
                                    <td>Suman</td>
                                    <td>Trivedi</td>
                                    <td>sumantrivedi23@gmail.com</td>
                                    <td>11-10-2020, 12:45</td>
                                    <td class="purple-td text-center">12</td>
                                    <td class="purple-td text-center">11</td>
                                    <td class="purple-td text-center">17</td>
                                    <td class="purple-td text-center">$886</td>
                                    <td class="text-center">$978</td>
                                    <td class="text-center visible-overflow-for-dropdown">
                                        <div class="dropdown dropdown-dots-table">
                                            <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                <img class="dots-in-table" src="images/Dashboard/dots.png" alt="edit">
                                            </a>
                                    
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="#">View More Details</a>
                                                <a class="dropdown-item" href="#">Deactivate</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="text-center">4</td>
                                    <td>Raj</td>
                                    <td>Malhotra</td>
                                    <td>rajmalhotra77@gmail.com</td>
                                    <td>12-10-2020, 10:10</td>
                                    <td class="purple-td text-center">2</td>
                                    <td class="purple-td text-center">123</td>
                                    <td class="purple-td text-center">28</td>
                                    <td class="purple-td text-center">$1248</td>
                                    <td class="text-center">$0</td>
                                    <td class="text-center visible-overflow-for-dropdown">
                                        <div class="dropdown dropdown-dots-table">
                                            <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                <img class="dots-in-table" src="images/Dashboard/dots.png" alt="edit">
                                            </a>
                                    
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="#">View More Details</a>
                                                <a class="dropdown-item" href="#">Deactivate</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="text-center">5</td>
                                    <td>Niya</td>
                                    <td>Patel</td>
                                    <td>niyapatel@gmail.com</td>
                                    <td>13-10-2020, 11:25</td>
                                    <td class="purple-td text-center">2</td>
                                    <td class="purple-td text-center">123</td>
                                    <td class="purple-td text-center">28</td>
                                    <td class="purple-td text-center">$1284</td>
                                    <td class="text-center">$15245</td>
                                    <td class="text-center visible-overflow-for-dropdown">
                                        <div class="dropdown dropdown-dots-table">
                                            <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                <img class="dots-in-table" src="images/Dashboard/dots.png" alt="edit">
                                            </a>
                                    
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="#">View More Details</a>
                                                <a class="dropdown-item" href="#">Deactivate</a>
                                            </div>
                                        </div>
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
    
         <!-- Footer-->
         <?php include 'footer.php' ; ?>
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