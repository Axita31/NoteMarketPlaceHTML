<?php
include "../front/db.php";
session_start();

if(isset($_POST['deactive-yes'])){
      $get_country_id=$_POST['get_country_id'];
      $deactive_query=mysqli_query($conn,"UPDATE country SET IsActive=0 WHERE ID=$get_country_id");
      header("location:manage-country.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<?php include 'head.php' ; ?>

<body>

?>

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
                                    <a class="dropdown-item active" href="manage-country.php">Manage Countries</a>
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
                        <?php if (isset($_SESSION['email'])) { ?>
                        <a class="btn btn-general btn-purple" href="logout.php" title="Download" role="button">Logout</a>
                        <?php } else {
                        ?>
                        <a class="btn btn-general btn-purple" href="login.php" title="Download" role="button">Logout</a>

                        <?php } ?>
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
                                    <a class="dropdown-item active" href="manage-country.php">Manage Countries</a>
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
                        <?php if (isset($_SESSION['email'])) { ?>
                        <a class="btn btn-general btn-purple" href="logout.php" title="Download" role="button">Logout</a>
                        <?php } else {
                        ?>
                        <a class="btn btn-general btn-purple" href="login.php" title="Download" role="button">Logout</a>

                        <?php } ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
</div>
<!-- Header ends -->



    
 <!-- manage country content-->   

    <div id="manage-country">    
    <!-- Progress Notes Box-->      
        <div class="content-box-lg">
            <div class="container">
                <div class="row no-gutters">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 text-left">
                        <p class="dashboard-heading">Manage Country</p>
                    </div>
                </div>
                <div class="row">   
                    <div class="col-lg-5 col-md-5 col-sm-5 col-12 text-left box-heading-wrapper">
                        <button onclick="window.location.href='add-country.php'" class="btn btn-general btn-purple add-type-btn">Add Country</button>
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-7 col-12">
                        <form action="manage-country.php" method="POST">
                            <div class="row no-gutters text-right general-search-bar-btn-wrapper">
                                <div class="form-group has-search">
                                    <span class="fa fa-search form-control-feedback"></span>
                                    <input type="text" name="search_country" class="form-control search-bar" placeholder="Search">
                                </div> 
                                <button name="search" class="btn btn-general btn-purple progress-btn">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>  
            
            <!--My-sold-note table-->
            <div class="container">
                <div class="manage-country-table general-table-responsive">
                    <div class="table-responsive-xl">
                         <table class="table table-bordered" id="myTable">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">sr no.</th>
                                    <th scope="col">Country Name</th>
                                    <th scope="col" class="text-center">Country Code</th>
                                    <th scope="col">Date Added</th>
                                    <th scope="col">Added By</th>
                                    <th scope="col" class="text-center">Active</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                if(isset($_POST['search'])){
                                    $search_country  = $_POST['search_country'];                                  
    
                                    $country_data = "SELECT country.ID,country.Country_Name,country.Country_Code,country.CreatedDate,country.IsActive,
                                    users.FirstName,users.LastName FROM country LEFT JOIN users ON country.CreatedBy = users.ID  WHERE (country.Country_Name LIKE '%$search_country%'  OR country.Country_Code LIKE '%$search_country%' OR 
                                    users.FirstName LIKE '%$search_country%' OR users.LastName LIKE '%$search_country%' OR  country.CreatedDate LIKE '%$search_country%') ORDER BY country.CreatedDate desc ";
                                   
                                    $country_result = mysqli_query($conn , $country_data);
                
                                }else{
                                    $country_data ="SELECT country.ID,country.Country_Name,country.Country_Code,country.CreatedDate,country.IsActive,
                                    users.FirstName,users.LastName FROM country LEFT JOIN users ON country.CreatedBy = users.ID  ORDER BY country.CreatedDate desc ";
                                    $country_result = mysqli_query($conn , $country_data);
                                    
                                }
    
                                $sr_no = 1;

                                while($row = mysqli_fetch_assoc($country_result)){
                                    $id = $row['ID'];
                                    $country_name = $row['Country_Name'];
                                    $code = $row['Country_Code'];
                                    $fname = $row['FirstName'];
                                    $lname = $row['LastName'];
                                    $createddate = $row['CreatedDate'];
                                    $isactive = $row['IsActive']
                                
                            ?>


                                <tr>
                                    <td class="text-center"><?php echo $sr_no; ?></td>
                                    <td><?php echo $country_name; ?></td>
                                    <td class="text-center"><?php echo $code; ?></td>
                                    <td><?php echo $createddate; ?></td>
                                    <td><?php echo $fname ." ".  $lname; ?></td>
                                    <td class="text-center"><?php 
                                                    if($isactive == 1){
                                                        echo "Yes";
                                                    }else{
                                                        echo "No";
                                                    }?>
                                    </td>
                                    <td class="text-center">
                                        <a href = "add-country.php?id=<?php echo $id ?>">
                                        <img class="edit-img-in-table" src="images/Dashboard/edit.png" alt="edit">
                                        </a>
                                        <a data-toggle="modal" data-target="#confirm-deactive" data-userid=<?php echo $id; ?> id="inactive-user">
                                        <img class="delete-img-in-table" src="images/Dashboard/delete.png" alt="edit"></a> 
                                    </td>
                                </tr>
                                <?php $sr_no++; } ?>   
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
                    <form action="manage-country.php" method="POST">
                        <div style="margin-top: 20px;" class="modal-body">
                            <p class="title">Are you sure you want to make this category inactive ? </p>

                                <input type="hidden" name="get_country_id" id="get_country_id">
                                <button class="btn btn-purple" style="width: 60px;" name="deactive-yes">YES</button>
                                <button class="btn btn-purple" style="width: 60px;">No</button>
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> 
    
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
               var cat_id = $(this).data('userid');
               $("#get_country_id").val( cat_id );
        });

    $(document).ready(function () {

        var admin_table = $('#myTable').DataTable({
            "order": [[3,"desc" ]],
            "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                
            },
            'sDom': '"top"i',
            "iDisplayLength": 8,
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