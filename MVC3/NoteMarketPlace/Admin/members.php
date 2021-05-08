<?php
include "../front/db.php";
session_start();

if(isset($_POST['deactive-yes']))
{
      $get_user_id=$_POST['get_user_id'];
      $deactive_query=mysqli_query($conn,"UPDATE users SET IsActive=0 WHERE ID=$get_user_id");
      header("location:members.php");
}
?>


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
                                <?php
                                    if(isset($_SESSION['email'])){
                                        $email = $_SESSION['email'];
                                        $query = mysqli_query($conn,"SELECT RoleID,ID FROM users WHERE EmailID='$email' ");
                                        while($row = mysqli_fetch_assoc($query)){
                                                $roleid = $row['RoleID'];
                                        }
                                    }
                                ?>
                                <li>
                                    <div class="dropdown settings-btn-dropdown">
                                        <a role="button" id="settings-dropdown-lable" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Settings</a>
                                      
                                        <div class="dropdown-menu" aria-labelledby="settings-dropdown-lable">
                                        <?php
                                            if($roleid==3)
                                            { ?>
                                                <a class="dropdown-item" href="manage-system-configuration.php">Manage System Configuration</a>
                                                <a class="dropdown-item" href="manage-administrator.php">Manage Administrator</a>
                                         <?php } ?>                                          
                                          <a class="dropdown-item" href="manage-category.php">Manage Category</a>
                                          <a class="dropdown-item" href="manage-type.php">Manage Type</a>
                                          <a class="dropdown-item" href="manage-country.php">Manage Countries</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="logged-in-user-photo-li">
                                    <div class="dropdown user-picture-dropdown">
                                    <?php
                                        if (isset($_SESSION['email'])) {
                                            $email = $_SESSION['email'];
                                            $userid_getter = mysqli_query($conn, "SELECT ID,FirstName,LastName FROM users WHERE EmailID='$email'");
                                            while ($row = mysqli_fetch_assoc($userid_getter)) {
                                                $userid = $row['ID'];
                                                $full_name = $row['FirstName'] . $row['LastName'];
                                            }
        
                                            $exist_userid_in_profile_checker = mysqli_query($conn, "SELECT 1 FROM users_details WHERE UserID=$userid");
                                            $userid_count = mysqli_num_rows($exist_userid_in_profile_checker);
        
                                            if ($userid_count != 0) {
                                                $dp_path_getter = mysqli_query($conn, "SELECT Profile_Pic FROM users_details WHERE UserID=$userid");
                                                while ($row = mysqli_fetch_assoc($dp_path_getter)) {
                                                    $dp_path = $row['Profile_Pic'];
                                                }
                                                echo "
                                                <a href='#' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                    <div class='logged-in-user-photo'>
                                                    <img style='height:50px;width,50px;' src='$dp_path' alt='$full_name' class='rounded-circle img-fluid'>
                                                    </div>
                                                </a>";
                                            } else
                                                echo "
                                                <a href='#' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                    <div class='logged-in-user-photo'>
                                                    <img style='height:50px;width,50px;' src='../Members/default/PP_default.jpg' alt='$full_name' class='rounded-circle img-fluid'>
                                                    </div>
                                                </a>";
                                            } else {
                                            }
                                        ?>
                                      
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
                                <?php
                                    if(isset($_SESSION['email'])){
                                        $email = $_SESSION['email'];
                                        $query = mysqli_query($conn,"SELECT RoleID,ID FROM users WHERE EmailID='$email' ");
                                        while($row = mysqli_fetch_assoc($query)){
                                                $roleid = $row['RoleID'];
                                        }
                                    }
                                ?>
                                <li>
                                    <div class="dropdown settings-btn-dropdown">
                                        <a role="button" id="settings-dropdown-lable" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Settings</a>
                                      
                                        <div class="dropdown-menu" aria-labelledby="settings-dropdown-lable">
                                        <?php
                                        if($roleid==3)
                                        { ?>
                                            <a class="dropdown-item" href="manage-system-configuration.php">Manage System Configuration</a>
                                            <a class="dropdown-item" href="manage-administrator.php">Manage Administrator</a>
                                        <?php } ?>
                                          <a class="dropdown-item" href="manage-category.php">Manage Category</a>
                                          <a class="dropdown-item" href="manage-type.php">Manage Type</a>
                                          <a class="dropdown-item" href="manage-country.php">Manage Countries</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="logged-in-user-photo-li">
                                    <div class="logged-in-user-photo">
                                        <div class="dropdown">
                                        <?php
                                        if (isset($_SESSION['email'])) {
                                            $email = $_SESSION['email'];
                                            $userid_getter = mysqli_query($conn, "SELECT ID,FirstName,LastName FROM users WHERE EmailID='$email'");
                                            while ($row = mysqli_fetch_assoc($userid_getter)) {
                                                $userid = $row['ID'];
                                                $full_name = $row['FirstName'] . $row['LastName'];
                                            }
        
                                            $exist_userid_in_profile_checker = mysqli_query($conn, "SELECT 1 FROM users_details WHERE UserID=$userid");
                                            $userid_count = mysqli_num_rows($exist_userid_in_profile_checker);
        
                                            if ($userid_count != 0) {
                                                $dp_path_getter = mysqli_query($conn, "SELECT Profile_Pic FROM users_details WHERE UserID=$userid");
                                                while ($row = mysqli_fetch_assoc($dp_path_getter)) {
                                                    $dp_path = $row['Profile_Pic'];
                                                }
                                                echo "
                                                <a href='#' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                    <div class='logged-in-user-photo'>
                                                    <img style='height:50px;width,50px;' src='$dp_path' alt='$full_name' class='rounded-circle img-fluid'>
                                                    </div>
                                                </a>";
                                            } else
                                                echo "
                                                <a href='#' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                    <div class='logged-in-user-photo'>
                                                    <img style='height:50px;width,50px;' src='../Members/default/PP_default.jpg' alt='$full_name' class='rounded-circle img-fluid'>
                                                    </div>
                                                </a>";
                                            } else {
                                            }
                                        ?>
                                        
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
                        <form action="members.php" method="POST">
                            <div class="row no-gutters text-right general-search-bar-btn-wrapper">
                                <div class="form-group has-search">
                                    <span class="fa fa-search form-control-feedback"></span>
                                    <input type="text" name="search_data" class="form-control search-bar" placeholder="Search">
                                </div> 
                                <button name="search" class="btn btn-general btn-purple progress-btn">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>  
            
            <div class="container">
                <div class="in-progress-notes-table general-table-responsive">
                    <div class="table-responsive-xl">
                       <table class="table table-bordered" id="myTable">   
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

                            <?php

                            if(isset($_POST['search'])){
                                $search_data  = $_POST['search_data'];

                                $member_query = "SELECT users.ID,users.FirstName,users.LastName,users.EmailID,users.CreatedDate 
                                FROM users WHERE users.RoleID=1  AND (users.FirstName LIKE '%$search_data%' OR users.LastName
                                LIKE '%$search_data%' OR users.EmailID LIKE '%$search_data%' OR users.CreatedDate LIKE '%$search_data%') ORDER BY users.ID desc";
                                $member_result = mysqli_query($conn ,$member_query);
                             /*    if($member_result){
                                    echo "select";
                                }else{
                                    echo "not".mysqli_error($conn);
                                }*/
                               
                            }else{
                                $member_query = "SELECT users.ID,users.FirstName,users.LastName,users.EmailID,users.CreatedDate 
                                FROM users WHERE RoleID=1 AND users.IsActive=1 ";
                                $member_result = mysqli_query($conn ,$member_query);
                             
                            }

                            $sr_no = 1;

                            while($row = mysqli_fetch_assoc($member_result)){

                                $id = $row['ID'];
                                $fname = $row['FirstName'];
                                $lname = $row['LastName'];
                                $email = $row['EmailID'];
                                $createddate = $row['CreatedDate'];

                            ?>
                                <tr>
                                    <td class="text-center"><?php echo $sr_no; ?></td>
                                    <td><?php echo $fname ; ?></td>
                                    <td><?php echo $lname ; ?></td>
                                    <td><?php echo $email ; ?></td>
                                    <td><?php echo $createddate ; ?></td>
                                    <td class="purple-td text-center">
                                        <a style="color:#6255a5;" href="notes-under-review.php?id=<?php echo $id ?>">
                                        <?php

                                            $under_review_query = "SELECT * FROM notes WHERE SellerID = $id AND Status=7 OR Status=8";
                                            $review_result = mysqli_query($conn,$under_review_query); 
                                            $review_count = mysqli_num_rows($review_result);

                                            echo $review_count;
                                        ?>
                                        </a>
                                    </td>
                                    <td class="purple-td text-center">
                                        <a style="color:#6255a5;" href="published-notes.php?id=<?php echo $id ?>">
                                        <?php

                                            $publish_query = "SELECT * FROM notes WHERE SellerID = $id AND Status=9";
                                            $publish_result = mysqli_query($conn,$publish_query); 
                                            $publish_count = mysqli_num_rows($publish_result);

                                            echo $publish_count;
                                        ?>
                                        </a>
                                    </td>
                                    <td class="purple-td text-center">
                                        <a style="color:#6255a5;" href="downloaded-notes.php?id=<?php echo $id ?>">
                                            <?php
                                                $download_query = "SELECT DISTINCT NoteID FROM downloads WHERE DownloaderID = $id AND IsSellerHasAllowedDownload= 1";
                                                $result = mysqli_query($conn,$download_query);
                                                $download_count = mysqli_num_rows($result);

                                                echo $download_count;
                                            ?>
                                        </a>
                                    </td>
                                    <td class="purple-td text-center">
                                        <?php

                                            $expense_query = "SELECT DISTINCT NoteID , PurchasedPrice FROM downloads WHERE IsSellerHasAllowedDownload=1 AND DownloaderID=$id";
                                            $expense_result = mysqli_query($conn , $expense_query);

                                            while($row = mysqli_fetch_assoc($expense_result)){
                                                $price = $row['PurchasedPrice'];                                              

                                                $sum_expense = 0;
                                                $sum_expense += $price;
                                            }
                                            if($download_count == 0){
                                                echo "$0";

                                            }else{
                                                echo "$".$sum_expense;
                                            }
                                        ?>                                       
                                    </td>
                                    <td class="text-center">
                                        <?php

                                            $earning_query = "SELECT DISTINCT NoteID , PurchasedPrice FROM downloads WHERE IsSellerHasAllowedDownload=1 AND SellerID=$id";
                                            $earning_result = mysqli_query($conn , $earning_query);

                                            while($row = mysqli_fetch_assoc($earning_result)){
                                                $price = $row['PurchasedPrice'];

                                                $sum_earning = 0;
                                                $sum_earning += $price;
                                            }
                                            if($download_count == 0){
                                                echo "$0";

                                            }else{
                                            echo "$".$sum_earning;
                                            }
                                        ?>
                                    </td>
                                    <td class="text-center visible-overflow-for-dropdown">
                                        <div class="dropdown dropdown-dots-table">
                                            <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                <img class="dots-in-table" src="images/Dashboard/dots.png" alt="edit">
                                            </a>
                                    
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <?php  echo  "<a class='dropdown-item' href='members-detail.php?id=$id'>View More Details</a>"; ?>
                                                <a class="dropdown-item" data-toggle="modal" data-target="#confirm-deactive" data-userid=<?php echo $id; ?> id="inactive-user">Deactivate</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php $sr_no ++ ; } ?>

                            </tbody>
                          </table>
                        
                    </div>
                </div>
            </div>            
        </div>
        <!-- Progress Notes Box End-->
        
<!-- confirm Pop up -->
<div class="popup">
        <div style="margin-top: 200px;" class="modal fade " id="confirm-deactive" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <img src="images/notes-detail/close.png" alt="">
                        </button>
                    </div>
                    <form action="members.php" method="POST">
                        <div style="margin-top: 20px;" class="modal-body">
                            <p class="title">“Are you sure you want to make this member inactive? </p>

                            <input type="hidden" name="get_user_id" id="get_user_id">
                            <button class="btn btn-purple" style="width: 60px;" name="deactive-yes">YES</button>
                            <button class="btn btn-purple" style="width: 60px;">No</button>
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> 
<!-- popup end  -->  

       
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

    <script>
     $(document).on("click", "#inactive-user", function () {
               var spam_id = $(this).data('userid');
               $("#get_user_id").val( spam_id );
        });

    $(document).ready(function () {

        var admin_table = $('#myTable').DataTable({
            //"order": [[4 ,"desc" ]],
            "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                
            },
            'sDom': '"top"i',
            "iDisplayLength": 5,
            "bInfo": false,
            language: {
                "zeroRecords": "No record found",
                paginate: {
                    next: "<img src='images/pagination/right-arrow.png' alt='next'>",
                    previous: "<img src='images/pagination/left-arrow.png' alt='prev'>"
                }
            }
        });
    });
    </script>

    <!--  datatable js -->
    <script src="js/datatables.js"></script>
      
    <!-- Custom JS -->
    <script src="js/script.js"></script>
    
</body>

</html>