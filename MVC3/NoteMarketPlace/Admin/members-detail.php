<?php
include "../front/db.php";
session_start();

if(isset($_GET['id']))
    $userid = $_GET['id'];
else 
    $userid = 1;

//download notes
if (isset($_GET['dnote_id'])) {
    $dnote_id = $_GET['dnote_id'];
    $download_query = mysqli_query($conn, "SELECT NoteTitle, AttachmentPath FROM downloads WHERE NoteID=$dnote_id");

    while ($row = mysqli_fetch_assoc($download_query)) {
        $note_path = $row['AttachmentPath'];
        $note_title = $row['NoteTitle'];
        
        $download_count = mysqli_num_rows($download_query);
        
        if ($download_count == 1) {
            header('Cache-Control: public');
            header('Content-Description: File Transfer');
            header('Content-Disposition: attachment; filename=' . $note_title . '.pdf');
            header('Content-Type: application/pdf');
            header('Content-Transfer-Encoding:binary');
            readfile($note_path);
        }
        if ($download_count > 1) {
            $zipname = $note_title . '.zip';
            $zip = new ZipArchive;
            $zip->open($zipname, ZipArchive::CREATE);
            $zip->addFile($note_path);
            $zip->close();

            header('Content-Type: application/zip');
            header('Content-disposition: attachment; filename=' . $zipname);
            header('Content-Length: ' . filesize($zipname));
            readfile($zipname);
        }
    }
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

<?php

$select_profile = "SELECT users.FirstName,users.LastName,users.EmailID,users_details.Dob,users_details.Phone_No,
                   users_details.Profile_Pic,users_details.University,users_details.Address_1,users_details.Address_2,
                   users_details.City,users_details.State,country.Country_Name,users_details.Zip_Code
                   FROM users LEFT JOIN users_details ON users.ID = users_details.UserID 
                   LEFT JOIN country ON users_details.Country = Country.ID WHERE users.ID = $userid";

$profile_result = mysqli_query($conn , $select_profile);

if($profile_result){
    echo "select";
}else{
    echo "not".mysqli_error($conn);
}
while($row = mysqli_fetch_assoc($profile_result)){
    $fname = $row['FirstName'];
    $lname = $row['LastName'];
    $email = $row['EmailID'];
    $dob = $row['Dob'];
    $phone = $row['Phone_No'];
    $profile = $row['Profile_Pic'];
    $university = $row['University'];
    $add1 = $row['Address_1'];
    $add2 = $row['Address_2'];
    $city = $row['City'];
    $state = $row['State'];
    $country = $row['Country_Name'];
    $code = $row['Zip_Code'];
}

?>

    <div id="member-details">
        <!-- member details box -->
        <div class="container">
            <div class="content-box-lg">
                <p class="member-heading">Member Details</p>
                <div class="row no-gutters member-details-wrapper">
                    <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12">
                        <div class="member-photo">
                          <?php  echo "<img style='height:200px; width:auto;' src='$profile' alt='profile'>" ; ?>
                        </div>
                    </div>

                    <div class="col-xl-10 col-lg-10 col-md-12 col-sm-12 col-12 ">
                        <div class="row no-gutters detail-part">

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="member-personal-details-wrapper">
                                    <div class="row no-gutters">
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                                            <div class="member-single-detail-left-wrapper">
                                                <p class="member-single-detail-left">First Name: </p>
                                                <p class="member-single-detail-left">Last Name:</p>
                                                <p class="member-single-detail-left">Email:</p>
                                                <p class="member-single-detail-left">DOB:</p>
                                                <p class="member-single-detail-left">Phone Number:</p>
                                                <p class="member-single-detail-left">College/University:</p>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                                            <div class="member-single-detail-right-wrapper">
                                                <p class="member-single-detail-right"><?php echo $fname; ?></p>
                                                <p class="member-single-detail-right"><?php echo $lname; ?></p>
                                                <p class="member-single-detail-right"><?php echo $email; ?></p>
                                                <p class="member-single-detail-right"><?php echo $dob; ?></p>
                                                <p class="member-single-detail-right"><?php echo $phone; ?></p>
                                                <p class="member-single-detail-right"><?php echo $university; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="member-address-wrapper">
                                    <div class="row no-gutters">
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                                            <div class="member-single-detail-left-wrapper">
                                                <p class="member-single-detail-left">Address 1:</p>
                                                <p class="member-single-detail-left">Address 2:</p>
                                                <p class="member-single-detail-left">City:</p>
                                                <p class="member-single-detail-left">State:</p>
                                                <p class="member-single-detail-left">Country:</p>
                                                <p class="member-single-detail-left">Zip Code:</p>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                                            <div class="member-single-detail-right-wrapper">
                                                <p class="member-single-detail-right"><?php echo $add1; ?></p>
                                                <p class="member-single-detail-right"><?php echo $add2; ?></p>
                                                <p class="member-single-detail-right"><?php echo $city; ?></p>
                                                <p class="member-single-detail-right"><?php echo $state; ?></p>
                                                <p class="member-single-detail-right"><?php echo $country; ?></p>
                                                <p class="member-single-detail-right"><?php echo $code; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- member details box -->
        
        <div class="notes-detail-border-bottom"></div>
        
        <!-- manage-administrator table -->
        <div style="padding-top:30px" class="content-box-lg">

            <div class="container">
                <div class="row no-gutters">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 text-left">
                        <p class="member-note-heading">Notes</p>
                    </div>                    
                </div>
            </div>    
            
            <div class="container">

                <div class="member-notes-table general-table-responsive">
                    <div class="table-responsive-xl">

                        <table class="table table-bordered" id="myTable">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">sr no.</th>
                                    <th scope="col">Note Title</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" class="text-center">Downloaded Notes</th>
                                    <th scope="col" class="text-center">Total Earnings</th>
                                    <th scope="col">Date Added</th>
                                    <th scope="col">Published Date</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php
                                if(isset($_SESSION['search']))
                                    $search_data  = $_POST['search_data'];
                                
                                $user_notes_query = "SELECT notes.ID,notes.Note_Title,notes.CreatedDate,notes.PublishedDate,
                                referencedata.Value,notes.Price,category.Category_Name
                                FROM notes LEFT JOIN category ON notes.Category=category.ID
                                LEFT JOIN referencedata ON notes.Status = referencedata.ID WHERE notes.SellerID = $userid ";
                                $users_result = mysqli_query($conn ,$user_notes_query);

                           
                                $sr_no =1;
                                while($row = mysqli_fetch_assoc($users_result)){
                                    $noteid = $row['ID'];
                                    $title = $row['Note_Title'];
                                    $category = $row['Category_Name'];
                                    $status = $row['Value'];
                                    $createddate = $row['CreatedDate'];
                                    $publishdate = $row['PublishedDate'];
                                    $price = $row['Price'];
                                    
                            ?>

                                <tr>
                                    <td class="text-center"><?php echo $sr_no; ?></td>
                                    <td class="purple-td">
                                        <a style="color:#6255a5;" href="note-detail.php?noteid=<?php echo $noteid; ?>">
                                        <?php echo $title; ?>
                                        </a>
                                    </td>
                                    <td><?php echo $category; ?></td>
                                    <td><?php echo $status; ?></td>
                                    <td class="text-center">
                                        <a href="downloaded-notes.php?note=<?php echo $noteid; ?>">
                                            <?php
                                                $download_note = mysqli_query($conn,"SELECT DISTINCT DownloaderID FROM downloads WHERE 
                                                                NoteID = $noteid AND IsSellerHasAllowedDownload = 1");
                                                $download_note_count = mysqli_num_rows($download_note);

                                                echo $download_note_count;

                                            ?>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <?php
                                        $total_earning=$download_note_count*$price;
                                            echo $total_earning;
                                        ?>
                                    </td>
                                    <td><?php echo $createddate; ?></td>
                                    <td><?php echo $publishdate; ?></td>
                                    <td class="text-center visible-overflow-for-dropdown">
                                        <div class="dropdown dropdown-dots-table">
                                            <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <img class="dots-in-table" src="images/Dashboard/dots.png" alt="edit">
                                            </a>
                                          
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                              <a class="dropdown-item" href="dashboard.php?dnote_id=<?php echo $noteid  ?>">Download Notes</a>
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
        <!-- published note table -->


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
    <script>
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