<?php

include "../front/db.php";
session_start();

if(isset($_SESSION['userid'])){
    $userid = $_SESSION['userid'];
}else
    $userid = " ";

$select_support_email=mysqli_query($conn,"SELECT * FROM system_configuration WHERE Key_info='SupportEmail'");
$support_email_count=mysqli_num_rows($select_support_email);
while($row = mysqli_fetch_assoc($select_support_email)){
    $support_email_db = $row['Value'];
}

$select_phone=mysqli_query($conn,"SELECT * FROM system_configuration WHERE Key_info='SupportPhone'");
$phone_count=mysqli_num_rows($select_phone);
while($row = mysqli_fetch_assoc($select_phone)){
    $phone_count_db = $row['Value'];
}

$select_email=mysqli_query($conn,"SELECT * FROM system_configuration WHERE Key_info='EmailForNotify'");
$email_count=mysqli_num_rows($select_email);
while($row = mysqli_fetch_assoc($select_email)){
    $email_count_db = $row['Value'];
}

$select_facebook=mysqli_query($conn,"SELECT * FROM system_configuration WHERE Key_info='FacebookURL'");
$facebook_count=mysqli_num_rows($select_facebook);
while($row = mysqli_fetch_assoc($select_facebook)){
    $facebook_count_db = $row['Value'];
}

$select_twitter=mysqli_query($conn,"SELECT * FROM system_configuration WHERE Key_info='TwitterURL'");
$twitter_count=mysqli_num_rows($select_twitter);
while($row = mysqli_fetch_assoc($select_twitter)){
    $twitter_count_db = $row['Value'];
}

$select_linkedin=mysqli_query($conn,"SELECT * FROM system_configuration WHERE Key_info='LinkedinURL'");
$linkedin_count=mysqli_num_rows($select_linkedin);
while($row = mysqli_fetch_assoc($select_linkedin)){
    $linkedin_count_db = $row['Value'];
}

$select_note=mysqli_query($conn,"SELECT * FROM system_configuration WHERE Key_info='DefaultNote'");
$note_count=mysqli_num_rows($select_note);
while($row = mysqli_fetch_assoc($select_note)){
    $note_img_db = $row['Value'];
}

$select_profile_img =mysqli_query($conn,"SELECT * FROM system_configuration WHERE Key_info='DefaultProfile'");
$profile_count=mysqli_num_rows($select_profile_img);
while($row = mysqli_fetch_assoc($select_profile_img)){
    $profile_img_db = $row['Value'];
}



if(isset($_POST['submit']))
{
    $support_email=$_POST['support_email'];
    $phone=$_POST['phone'];
    $email=$_POST['email'];
    $fburl=$_POST['fburl'];
    $twiturl=$_POST['twiturl'];
    $linkurl=$_POST['linkurl'];
    $note_img=$_FILES['note_img']['name'];
    $profile_img=$_FILES['profile_img']['name'];

    if($support_email_count==0)
    {
       $insert =  mysqli_query($conn,"INSERT INTO system_configuration(Key_info, Value, CreatedDate,CreatedBy, ModifiedDate,ModifiedBy, IsActive) VALUES ('SupportEmail','$support_email',NOW(),$userid,NOW(),$userid,1)");
        if(!$insert){
            echo "not".mysqli_error($conn);
        }
    }
    else
    {
        mysqli_query($conn,"UPDATE system_configuration SET Value='$support_email' WHERE Key_info='SupportEmail'");
    }
    if($phone_count==0)
    {
        mysqli_query($conn,"INSERT INTO system_configuration(Key_info, Value, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy, IsActive) VALUES ('SupportPhone','$phone',NOW(),$userid,NOW(),$userid,1)");
    }
    else
    {
        mysqli_query($conn,"UPDATE system_configuration SET Value='$phone' WHERE Key_info='SupportPhone'");
    }
    if($email_count==0)
    {
        mysqli_query($conn,"INSERT INTO system_configuration(Key_info, Value, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy, IsActive) VALUES ('EmailForNotify','$email',NOW(),$userid,NOW(),$userid,1)");
    }
    else
    {
        mysqli_query($conn,"UPDATE system_configuration SET Value='$email' WHERE Key_info='EmailForNotify'");
    }
    if($facebook_count==0)
    {
        mysqli_query($conn,"INSERT INTO system_configuration(Key_info, Value, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy, IsActive) VALUES ('FacebookURL','$fburl',NOW(),$userid,NOW(),$userid,1)");
    }
    else
    {
        mysqli_query($conn,"UPDATE system_configuration SET Value='$fburl' WHERE Key_info='FacebookURL'");
    }
    if($twitter_count==0)
    {
        mysqli_query($conn,"INSERT INTO system_configuration(Key_info, Value, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy, IsActive) VALUES ('TwitterURL','$twiturl',NOW(),$userid,NOW(),$userid,1)");
    }
    else
    {
        mysqli_query($conn,"UPDATE system_configuration SET Value='$twiturl' WHERE Key_info='TwitterURL'");
    }
    if($linkedin_count==0)
    {
        mysqli_query($conn,"INSERT INTO system_configuration(Key_info, Value, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy, IsActive) VALUES ('LinkedinURL','$linkurl',NOW(),$userid,NOW(),$userid,1)");
    }
    else
    {
        mysqli_query($conn,"UPDATE system_configuration SET Value='$linkurl' WHERE Key_info='LinkedinURL'");
    }
    //default pic for note checker
    $display_pic = $_FILES['note_img'];
    $filename = $display_pic['name'];
    $filetmp = $display_pic['tmp_name'];
    $extention = explode('.', $filename);
    $filecheck = strtolower(end($extention));
    $fileextstored = array('jpg', 'png', 'jpeg');

    if (in_array($filecheck, $fileextstored)) {
        if (!is_dir("../Members/")) {
            mkdir('../Members/');
        }
        if (!is_dir("../Members/default")) {
            mkdir("../Members/default");
        }
        $destinationfile = '../Members/default/DP_default.jpg';
        move_uploaded_file($filetmp, $destinationfile);

        $default_note_check = mysqli_query($conn, "SELECT 1 FROM system_configuration WHERE Key_info='default_note'");
        if (mysqli_num_rows($default_note_check) == 0)
            mysqli_query($conn, "INSERT INTO system_configuration(Key_info,Value,CreatedDate,CreatedBy,ModifiedDate,ModifiedBy,IsActive) 
                                VALUES ('default_note','$destinationfile',NOW(),$userid,NOW(),$userid,1)");
        else
            mysqli_query($conn, "UPDATE system_configuration SET Value='$destinationfile',ModifiedDate=NOW(),ModifiedBy=$userid WHERE Key_info='default_note'");
    }

    //default pic for user profile checker
    $display_pic = $_FILES['profile_img'];
    $filename = $display_pic['name'];
    $filetmp = $display_pic['tmp_name'];
    $extention = explode('.', $filename);
    $filecheck = strtolower(end($extention));
    $fileextstored = array('jpg', 'png', 'jpeg');

    if (in_array($filecheck, $fileextstored)) {
        if (!is_dir("../Members/")) {
            mkdir('../Members/');
        }
        if (!is_dir("../Members/default")) {
            mkdir("../Members/default");
        }
        $destinationfile = '../Members/default/PP_default.jpg';
        move_uploaded_file($filetmp, $destinationfile);

        $default_user_pic_check = mysqli_query($conn, "SELECT 1 FROM system_configuration WHERE Key_info='default_profile_pic'");
        if (mysqli_num_rows($default_user_pic_check) == 0)
            mysqli_query($conn, "INSERT INTO system_configuration(Key_info,Value,CreatedDate,CreatedBy,ModifiedDate,ModifiedBy,IsActive) 
                                VALUES ('default_profile_pic','$destinationfile',NOW(),$userid,NOW(),$userid,1)");
        else
            mysqli_query($conn, "UPDATE system_configuration SET Value='$destinationfile',ModifiedDate=NOW(),ModifiedBy=$userid WHERE Key_info='default_profile_pic'");
    }
    
    header("Location:manage-system-configuration.php");
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
                                          <a class="dropdown-item active" href="manage-system-configuration.php">Manage System Configuration</a>
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
                                          <a class="dropdown-item active" href="manage-system-configuration.php">Manage System Configuration</a>
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



 <!-- manage sysytem config content-->   

    <div id="manage-system-config"> 
       <div class="content-box-lg">
            <div class="container">
                <div class="row no-gutters all-notes">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 text-left">
                        <p class="dashboard-heading">Manage System Configuration</p>
                    </div>
                </div>
            </div>
       </div> 
        <form action="manage-system-configuration.php" method="POST" enctype="multipart/form-data"> 
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="info-label">Support Email Adreess*</label>
                                <input type="email" name="support_email" class="form-control input-light-color" placeholder="Enter your email address" 
                                  value="<?php if($support_email_count==0)
                                                {
                                                    echo '';
                                                }
                                                else
                                                {
                                                    echo $support_email_db;
                                                }
                                         ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="info-label">Support Phone Number*</label>
                                <input type="text" name="phone" class="form-control input-light-color" placeholder="Enter your phone number"
                                value="<?php if($phone_count==0)
                                                {
                                                    echo '';
                                                }
                                                else
                                                {
                                                    echo $phone_count_db;
                                                }
                                         ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="info-label">Email Address(es)(For Various events system will send notification to these users)*</label>
                                <input type="email" name="email" class="form-control input-light-color" placeholder="Enter your Email-address"
                                value="<?php if($email_count==0)
                                                {
                                                    echo '';
                                                }
                                                else
                                                {
                                                    echo $email_count_db;
                                                }
                                         ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="info-label">Facebook Url</label>
                                <input type="text" name="fburl" class="form-control input-light-color" placeholder="Enter your facebook url"
                                value="<?php if($facebook_count==0)
                                                {
                                                    echo '';
                                                }
                                                else
                                                {
                                                    echo $facebook_count_db;
                                                }
                                         ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                               <label class="info-label">Twitter Url</label>
                                <input type="text" name="twiturl" class="form-control input-light-color" placeholder="Enter your Twitter url"
                                value="<?php if($twitter_count==0)
                                                {
                                                    echo '';
                                                }
                                                else
                                                {
                                                    echo $twitter_count_db;
                                                }
                                         ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                               <label class="info-label">Linkedin Url</label>
                                <input type="text" name="linkurl" class="form-control input-light-color" placeholder="Enter your Linkedin url"
                                value="<?php if($linkedin_count==0)
                                                {
                                                    echo '';
                                                }
                                                else
                                                {
                                                    echo $linkedin_count_db;
                                                }
                                         ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="info-label">Defualt image for notes(if seller do not upload)</label>
                                <div class="my-profile-photo-uploader">
                                    <label for="image-uploader"><img src="images/user-profile/upload.png" title="Click here to upload your photo" alt="Upload your photo here"></label>
                                    <input id="image-uploader" name="note_img" class="form-control" type="file">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="info-label">Defualt profile picture(if seller do not upload)</label>
                                <div class="my-profile-photo-uploader">
                                    <label for="image-uploader"><img src="images/user-profile/upload.png" title="Click here to upload your photo" alt="Upload your photo here"></label>
                                    <input id="image-uploader" name="profile_img" class="form-control" type="file">
                                </div>
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
             <?php include 'footer.php' ; ?>
         <!-- Footer End-->
    </div>
   
 <!-- manage-sys-config content End-->

    
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