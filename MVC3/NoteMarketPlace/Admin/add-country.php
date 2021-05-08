<?php
include "../front/db.php";
session_start();

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    //echo $email;
    $query = mysqli_query($conn , "SELECT ID FROM users WHERE EmailID = '$email' ");
    while($row = mysqli_fetch_assoc($query)){
        $userid = $row['ID'];
    }


if(isset($_GET['id']))
    $country_id = $_GET['id'];

if(isset($_POST['update_submit'])){
    $country = $_POST['country'];
    $code = $_POST['code'];

$update_country = mysqli_query($conn ," UPDATE country SET Country_Name='$country',Country_Code='$code',ModifiedBy=$userid,
                    ModifiedDate=now() WHERE ID=$country_id");
header("Location:manage-country.php");
}
}
?>

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

    
 <!-- add country content-->   

    <div id="add-country">  
        <div class="container">
                <div class="row no-gutters all-notes">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12 text-left">
                        <p class="country-heading">Add Country</p>
                    </div>
                </div>
            </div>

<?php

if(isset($_POST['submit'])){
    $country = $_POST['country'];
    $code = $_POST['code'];

    $insert_country= "INSERT INTO country (Country_Name, Country_Code, CreatedBy, CreatedDate, IsActive) VALUES ('$country' ,'$code',$userid ,now(),1)";
    $result = mysqli_query($conn , $insert_country) ;
    if(!$result){
        echo "not".mysqli_error($conn);
    }else{
        echo "insert";
    }
    
}
?>
        <form action="" method="POST">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Country Name *</label>

                                <?php //Get country
                                    if(isset($_GET['id'])){
                                        $country_id = $_GET['id'];
                                    $select_country = mysqli_query($conn, "SELECT Country_Name,Country_Code FROM country WHERE ID=$country_id");
                                        while($row = mysqli_fetch_assoc($select_country)){
                                            $country_name = $row['Country_Name'];
                                            $country_code = $row['Country_Code'];
                                        }
                                    }
                                ?>
                                <input type="text" name="country" value= "<?php echo (isset($_GET['id']))?$country_name:'';?>" class="form-control input-light-color"
                                    placeholder="Enter your country" >
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-6 code-detail">
                                <label>Country Code *</label>
                                <input type="text" name="code" value= "<?php echo (isset($_GET['id']))?$country_code:'';?>" class="form-control input-box input-light-color"
                                    placeholder="Enter your code" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-row">
                        <?php
                        if(isset($_GET['id'])){ ?>
                            <button type="submit" name="update_submit" id="my-profile-submit-btn" class="btn btn-primary">Submit</button>
                        <?php 
                        }else{ ?>
                            <button type="submit" name="submit" id="my-profile-submit-btn" class="btn btn-primary">Submit</button>
                        <?php } ?>
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