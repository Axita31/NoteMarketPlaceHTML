<?php
include "../front/db.php";
session_start();

$login = true;

//session check
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
  

    $users_query = mysqli_query($conn, "SELECT FirstName,LastName,ID FROM users WHERE EmailID='$email' ");
    while ($row = mysqli_fetch_assoc($users_query)) {
        $fname = $row['FirstName'];
        $lname = $row['LastName'];
        $adminid = $row['ID'];
    }

    $user_detail_query = mysqli_query($conn, "SELECT SecondaryEmailAddress,Phone_No_Country_Code,Phone_No,Profile_Pic FROM users_details WHERE UserID=$adminid");
    while ($row = mysqli_fetch_assoc($user_detail_query)) {
        $second_email = $row['SecondaryEmailAddress'];
        $country_code = $row['Phone_No_Country_Code'];
        $number = $row['Phone_No'];
        $profile_pic = $row['Profile_Pic'];
    }
} else
    $login = false;

//store values in db
if (isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $another_email = $_POST['semail'];
    $phone_code = $_POST['code'];
    $phone_no = $_POST['phone'];

    //update name
    $name_update = mysqli_query($conn, "UPDATE users SET FirstName='$fname',LastName='$lname',ModifiedDate=NOW() WHERE ID=$adminid");

    //update user profile
    $update_info = mysqli_query($conn, "UPDATE users_details SET SecondaryEmailAddress='$another_email',Phone_No_Country_Code='$phone_code',Phone_No='$phone_no',ModifiedDate=NOW(),ModifiedBy=$adminid WHERE UserID=$adminid");

/*     //profile picture
    $profile_pic = $_FILES['profile'];
    $filename = $profile_pic['name'];
    $filetmp = $profile_pic['tmp_name'];
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
        if (!is_dir("../Members/" . $adminid)) {
            mkdir("../Members/" . $adminid);
        }

        //to delete file
        if ($profile_pic != "../Members/default/PP_default.jpg")
            unlink($profile_pic);

        $destinationfile = '../Members/' . $adminid . '/' . "DP_" . time() . '.' . $filecheck;
        move_uploaded_file($filetmp, $destinationfile);

        $set_profile_pic = mysqli_query($conn, "UPDATE users_details SET Profile_Pic='$destinationfile' WHERE UserID=$adminid");
        if(!$set_profile_pic){
            echo "not".mysqli_error($conn);
        }
    }
    //header("Refresh:0");
} */
 
//profile picture
$profile_pic = $_FILES['profile_pic'];
$filename = $profile_pic['name'];
$filetmp = $profile_pic['tmp_name'];
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
    if (!is_dir("../Members/" . $adminid)) {
        mkdir("../Members/" . $adminid);
    }

    //to delete file
    if ($profile_pic != "../Members/default/PP_default.jpg")
        unlink($profile_pic);

    $destinationfile = '../Members/' . $adminid . '/' . "DP_" . time() . '.' . $filecheck;
    move_uploaded_file($filetmp, $destinationfile);

    $set_profile_pic = mysqli_query($conn, "UPDATE users_details SET Profile_Pic='$destinationfile' WHERE UserID=$adminid");
}
//header("Refresh:0");
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
                                    <a class="dropdown-item active" href="my-profile.php">Update Profile</a>
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
                                        <a class="dropdown-item active" href="my-profile.php">Update Profile</a>
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

 <!-- profile content-->   

    <div id="my-profile">  
        <div class="content-box-md">
            <div class="container">
                <div class="row no-gutters all-notes">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12 text-left">
                        <p class="profile-heading">My Profile</p>
                    </div>
                </div>
            </div>
       </div> 
        <form action="my-profile.php" method="POST" enctype = "multipart/form-data">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="info-label">First Name *</label>
                                <input type="text" class="form-control input-light-color" value="<?php echo $fname ?>"
                                    name="fname" placeholder="Enter your first name">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="info-label">Last Name *</label>
                                <input type="text" class="form-control input-light-color" value="<?php echo $lname ?>"
                                    name="lname" placeholder="Enter your last name">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="info-label">Email *</label>
                                <input type="email" class="form-control input-light-color" value="<?php echo $email ?>"
                                    name="email" placeholder="Enter your Email-address">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="info-label">Secondary Email</label>
                                <input type="text" class="form-control input-light-color" value="<?php echo $second_email ?>"
                                    name="semail" placeholder="Enter your email address">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="info-label">Phone Number</label>
                                <div class="form-row">
                                    <div class="col-4">
                                        <select name="code" class="form-control input-light-color options-arrow-down ">
                                        <?php
                                            $country_code_number = mysqli_query($conn, "SELECT * FROM country");
                                            while ($row = mysqli_fetch_assoc($country_code_number)) {
                                                $country_code = $row['Country_Code'];
                                                $countryid = $row['ID'];
                                                if ($exist != 0) {
                                                    if ($countryid == $country_code)
                                                        echo "<option value='$countryid' selected>+$country_code</option>";
                                                    else
                                                        echo "<option value='$countryid'>+$country_code</option>";
                                                } else
                                                    echo "<option value='$countryid'>+$country_code</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <input type="tel" name="phone" value="<?php echo $number ?>" class="form-control" placeholder="Enter your phone number">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="info-label">Profile Picture</label>
                                <div class="my-profile-photo-uploader">
                                    <label for="image-uploader"><img src="images/user-profile/upload.png" title="Click here to upload your photo" alt="Upload your photo here"></label>
                                    <input id="image-uploader" type="file" name="profile_pic" class="form-control" >
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