<?php
include "../front/db.php";
session_start();

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    //echo $email;
    $query = mysqli_query($conn , "SELECT ID FROM users WHERE EmailID = '$email' ");
    while($row = mysqli_fetch_assoc($query)){
        $userid = $row['ID'];
    }
}

if(isset($_POST['unpublish_yes'])){
    $get_note_id=$_POST['get_note_id'];
    $remark=$_POST['remark'];
    
    $unpublish_query=mysqli_query($conn,"UPDATE `notes` SET `Status`=11,`Actioned_By`=$userid,`Admin_Remarks`='$remark' WHERE ID=$get_note_id");  

    $get_user_data=mysqli_query($conn,"SELECT notes.Note_Title,notes.Admin_Remarks,users.EmailID,users.FirstName,users.LastName FROM notes LEFT JOIN users  ON users.ID=notes.SellerID WHERE notes.ID=$get_note_id");
 
    while($row = mysqli_fetch_assoc($get_user_data)){
        $get_email=$row['EmailID'];
        $remarks=$row['Admin_Remarks'];
        $first_name=$row['FirstName'];
        $last_name=$row['LastName'];
        $title=$row['Note_Title'];  
    }

    //mail function
    require 'PHPMailer/Exception.php';
    require 'PHPMailer/PHPMailer.php';
    require 'PHPMailer/SMTP.php';

    $mail = new PHPMailer(true);

    $alert = '';
    try {
        
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = PHPMailer :: ENCRYPTION_STARTTLS;
        $mail->Port = 587;  
        $mail->Username = "axita31.khunt@gmail.com";
        $mail->Password = 'axita31khunt';
        
        $mail->setFrom('axita31.khunt@gmail.com', 'NoteMarketPlace');  
        
        $mail->addAddress($get_email);  
        $mail->addReplyTo('axita31.khunt@gmail.com');   

        $mail->IsHTML(true); 
        $mail->Subject = " Sorry! We need to remove your notes from our portal. ";      
        $mail->Body = "Hello ".$first_name." ".$last_name.","."<br><br> We want to inform you that, your note ".$title." has been removed from the portal.Please find our remarks as below - <br><b>".$remarks."</b>
        <br><br>Regards,<br>NoteMarketPlace";   
        

        $mail->send();
    } 
    catch (Exception $e) {
        echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
    }
}

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
                                <li class="active">
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
                                 <li><?php if (isset($_SESSION['email'])) { ?>
                                    <a class="btn btn-general btn-purple" href="logout.php" title="Download" role="button">Logout</a>
                                    <?php } 
                                    ?>
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
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12 text-left">
                        <p class="dashboard-heading">Dashboard</p>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row dashboard-content">
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                        <div class="number-of-notes dashboard-box">
                        <?php
                            $query = "SELECT ID FROM notes WHERE Status=7 OR Status=8";
                            $result = mysqli_query($conn,$query);
                            $result_count = mysqli_num_rows($result);
                        ?>
                            <p class="dashboard-single-details text-center"><?php echo $result_count ; ?></p>
                            <a href="published-notes.php">
                            <p class="dashboard-detail-heading text-center">Numbers of Notes in Review for Publish </p></a>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                        <div class="number-of-download dashboard-box">
                        <?php
                            $download_note = "SELECT * FROM downloads WHERE AttachmentDownloadedDate > now() - INTERVAL 7 DAY AND IsAttachmentDownloaded=1";
                            $download_result = mysqli_query($conn , $download_note);
                            $download_count = mysqli_num_rows($download_result);
                        ?>
                            <p class="dashboard-single-details text-center"><?php echo $download_count; ?></p>
                            <a href = "downloaded-notes.php">
                            <p class="dashboard-detail-heading text-center">Number of New Notes Downloaded (Last 7 Days)</p></a>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                        <div class="number-of-registration dashboard-box">
                        <?php 
                            $num_register = "SELECT * FROM users WHERE RoleID=1 AND CreatedDate > now() - INTERVAL 7 DAY AND IsActive=1";
                            $num_register_result = mysqli_query($conn,$num_register);
                            $num_register_count = mysqli_num_rows($num_register_result);
                           
                        ?>
                            <p class="dashboard-single-details text-center"><?php  echo $num_register_count; ?></p>
                            <a href="members.php">
                            <p class="dashboard-detail-heading text-center">Number of New Registration (Last 7 Days)</p></a>
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
                    <div class="col-lg-4 col-md-4 col-sm-12 col-12 text-left box-heading-wrapper">
                        <p class="progress-heading">Published Notes</p>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-12 col-12">
                        <div class="row no-gutters text-right general-search-bar-btn-wrapper">
                            <div class="form-group has-search">
                                <span class="fa fa-search form-control-feedback"></span>
                                <input type="text" id="search_data" class="form-control search-bar" placeholder="Search">
                            </div>
                            <button onclick="filterData();" class="btn btn-general btn-purple progress-btn">Search</button>
                            <select id="month" onchange="filterData();" class="form-control options-arrow-down input-light-color month-box">
                                <option value='0' disabled selected>Select Month</option>
                    
                                <?php	
                                for ($i = 0; $i <= 5; $i++) {
                                $month= date('M Y', strtotime('last day of ' . -$i . 'month'));
                                $date= date('Y-m', strtotime('last day of ' . -$i . 'month'));
                                

                                echo "<option value=' $date'> $month</option>";
                                }
                                ?>
                            </select>
                                
                        </div>
                    </div>
                </div>
            </div>

           <div class="container">
            <div id="tabledata"></div>
            
            </div> 
            </div>
        </div> <!-- Progress Notes Box End-->
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

    <script type="text/javascript">
        $(function() {
            filterData();
        });

        function filterData() {
            var search_data = $("#search_data").val();
            var month = $("#month").val();

            $.ajax({
                
                url: "dashboard-ajax.php",
                type: "GET",
                data: {
                    search: search_data, 
                    search_month:month,
                },
                success: function(data) {
                    $("#tabledata").html(data);
                }
            });
        }
    </script>
    
    <!-- Custom JS -->
    <script src="js/script.js"></script>

</body>

</html>