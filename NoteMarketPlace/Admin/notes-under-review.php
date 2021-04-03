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
                                          <a class="dropdown-item active" href="notes-under-review.php">Notes Under Review</a>
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
                                          <a class="dropdown-item active" href="notes-under-review.php">Notes Under Review</a>
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


 <!-- note content-->   
    
    <div id="note-under-review"> 
       <!--  popup -->       
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <img src="images/notes-detail/close.png" alt="">
                        </button>
                    </div>
                    <div class="modal-body">   

                        <p class="note-name-reject-popup">Human Body - Science</p> 
                        
                        <form>
                            <div class="form-group">
                                <label class="info-label" for="comment-questions">Remarks</label>
                                <textarea class="form-control input-box-style" id="" placeholder="Write remarks"></textarea>
                            </div>

                            <div class="reject-popup-btns">
                                <div class="row no-gutters">
                                    <button class="btn action-btn-in-table" id="reject-btn">Reject</button>
                                <button class="btn action-btn-in-table" id="cancel-btn">Cancel</button>
                                </div>
                            </div>
                        </form>                      

                    </div>                    
                </div>
            </div>
        </div>
        <!-- popup -->
        
        <!-- note-under-review content -->
        <div class="content-box-md">
            <div class="container">
                <div class="row no-gutters all-notes">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12 text-left">
                        <p class="note-heading">Note Under Review</p>
                    </div>
                </div>
            </div>
        </div>
            
    <!-- seller Notes Box-->
          
        <div class="content-box-lg">
            <div class="container">
                <div class="row no-gutters">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-4 text-left box-heading-wrapper">
                       <label for="" class="info-label">Seller</label>
                        <select class="form-control options-arrow-down input-light-color seller-box">
                            <option selected disabled>Seller</option>
                                <option selected>Khyati</option>
                                <option>Rahul</option>
                                <option>Suman</option>
                                <option>Ravi</option>
                        </select>
    
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-12 ">
                        <div class="row no-gutters text-right general-search-bar-btn-wrapper search-bar-btn-box">
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
                                    <th scope="col" class="text-center">Sr no.</th>
                                    <th scope="col">Note title</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Seller</th>
                                    <th scope="col"></th>
                                    <th scope="col">Date Added</th>
                                    <th scope="col">status</th>
                                    <th scope="col" class="text-center">action</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td class="text-center">1</td>
                                    <td class="purple-td">Softwere Engineer</td>
                                    <td>IT</td>
                                    <td>Khyati Patel</td>
                                    <td class="text-center">
                                        <img class="eye-img-in-table" src="images/Dashboard/eye.png" alt="edit">
                                    </td>
                                    <td>09-10-2020, 10:45</td>
                                    <td>InReview</td>
                                    <td>
                                        <button class="btn action-btn-in-table" id="approve-btn">Approve</button>
                                        <button class="btn action-btn-in-table" id="reject-btn" data-toggle="modal" data-target="#exampleModal">Reject</button>
                                        <button class="btn action-btn-in-table" id="inreview-btn">InReview</button>
                                    </td>
                                    <td class="text-center visible-overflow-for-dropdown">
                                        <div class="dropdown dropdown-dots-table">
                                            <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <img class="dots-in-table" src="images/Dashboard/dots.png" alt="edit">
                                            </a>
                                          
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="#">View More Details</a>
                                                <a class="dropdown-item" href="#">Download Notes</a>
                                            </div>
                                        </div>                                            
                                    </td>
                                </tr>

                                <tr>
                                    <td class="text-center">2</td>
                                    <td class="purple-td">Computer Basic</td>
                                    <td>Computer Basic</td>
                                    <td>Khyati Patel</td>
                                    <td class="text-center">
                                        <img class="eye-img-in-table" src="images/Dashboard/eye.png" alt="edit">
                                    </td>
                                    <td>10-10-2020, 04:45</td>
                                    <td>Submitted For Review</td>
                                    <td>
                                        <button class="btn action-btn-in-table" id="approve-btn">Approve</button>
                                        <button class="btn action-btn-in-table" id="reject-btn" data-toggle="modal" data-target="#exampleModal">Reject</button>
                                        <button class="btn action-btn-in-table" id="inreview-btn">InReview</button>
                                    </td>
                                    <td class="text-center visible-overflow-for-dropdown">
                                        <div class="dropdown dropdown-dots-table">
                                            <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <img class="dots-in-table" src="images/Dashboard/dots.png" alt="edit">
                                            </a>
                                          
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="#">View More Details</a>
                                              <a class="dropdown-item" href="#">Download Notes</a>
                                            </div>
                                        </div>                                            
                                    </td>
                                </tr>

                                <tr>
                                    <td class="text-center">3</td>
                                    <td class="purple-td">Human Body</td>
                                    <td>Science</td>
                                    <td>Khyati Patel</td>
                                    <td class="text-center">
                                        <img class="eye-img-in-table" src="images/Dashboard/eye.png" alt="edit">
                                    </td>
                                    <td>11-10-2020, 12:45</td>
                                    <td>InReview</td>
                                    <td>
                                        <button class="btn action-btn-in-table" id="approve-btn">Approve</button>
                                        <button class="btn action-btn-in-table" id="reject-btn" data-toggle="modal" data-target="#exampleModal">Reject</button>
                                        <button class="btn action-btn-in-table" id="inreview-btn">InReview</button>
                                    </td>
                                    <td class="text-center visible-overflow-for-dropdown">
                                        <div class="dropdown dropdown-dots-table">
                                            <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <img class="dots-in-table" src="images/Dashboard/dots.png" alt="edit">
                                            </a>
                                          
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="#">View More Details</a>
                                              <a class="dropdown-item" href="#">Download Notes</a>
                                            </div>
                                        </div>                                            
                                    </td>
                                </tr>

                                <tr>
                                    <td class="text-center">4</td>
                                    <td class="purple-td">World war 2</td>
                                    <td>History</td>
                                    <td>Khyati Patel</td>
                                    <td class="text-center">
                                        <img class="eye-img-in-table" src="images/Dashboard/eye.png" alt="edit">
                                    </td>
                                    <td>12-10-2020, 10:10</td>
                                    <td>InReview</td>
                                    <td>
                                        <button class="btn action-btn-in-table" id="approve-btn">Approve</button>
                                        <button class="btn action-btn-in-table" id="reject-btn" data-toggle="modal" data-target="#exampleModal">Reject</button>
                                        <button class="btn action-btn-in-table" id="inreview-btn">InReview</button>
                                    </td>
                                    <td class="text-center visible-overflow-for-dropdown">
                                        <div class="dropdown dropdown-dots-table">
                                            <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <img class="dots-in-table" src="images/Dashboard/dots.png" alt="edit">
                                            </a>
                                          
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="#">View More Details</a>
                                              <a class="dropdown-item" href="#">Download Notes</a>
                                            </div>
                                        </div>                                            
                                    </td>
                                </tr>

                                <tr>
                                    <td class="text-center">5</td>
                                    <td class="purple-td">Accounting</td>
                                    <td>Account</td>
                                    <td>Khyati Patel</td>
                                    <td class="text-center">
                                        <img class="eye-img-in-table" src="images/Dashboard/eye.png" alt="edit">
                                    </td>
                                    <td>13-10-2020, 11:25</td>
                                    <td>InReview</td>
                                    <td>
                                        <button class="btn action-btn-in-table" id="approve-btn">Approve</button>
                                        <button class="btn action-btn-in-table" id="reject-btn" data-toggle="modal" data-target="#exampleModal">Reject</button>
                                        <button class="btn action-btn-in-table" id="inreview-btn">InReview</button>
                                    </td>
                                    <td class="text-center visible-overflow-for-dropdown">
                                        <div class="dropdown dropdown-dots-table">
                                            <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <img class="dots-in-table" src="images/Dashboard/dots.png" alt="edit">
                                            </a>
                                          
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="#">View More Details</a>
                                              <a class="dropdown-item" href="#">Download Notes</a>
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