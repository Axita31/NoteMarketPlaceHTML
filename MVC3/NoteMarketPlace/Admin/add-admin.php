<?php
include "../front/db.php";
session_start();

if(isset($_SESSION['userid'])){
    $userid = $_SESSION['userid'];
}else{
    $userid = " ";
}

if(isset($_POST['submit'])){
    
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $emailid = $_POST['email'];
    $code = $_POST['code'];
    $number = $_POST['number'];

     if(isset($_GET['id'])){
        $adminid = $_GET['id'];
        
    $update_admin = mysqli_query($conn, "UPDATE users SET FirstName='$fname',LastName='$lname',EmailID='$emailid',ModifiedDate=NOW() WHERE ID=$adminid");

    $update_profile = mysqli_query($conn, "UPDATE users_details SET Phone_No_Country_Code='$code',Phone_No='$number',ModifiedDate=NOW(),ModifiedBy=$adminid WHERE UserID=$adminid");

        header("Location:manage-administrator.php");
    
    }else{ 
        $insert_admin ="INSERT INTO users(RoleID, FirstName, LastName, EmailID, Password, IsEmailVerified, 
        CreatedDate, CreatedBy, ModifiedDate, ModifiedBy, IsActive) VALUES 
        (2,'$fname','$lname','$emailid',password,1,now(),'$userid',now(),'$userid',1)";
        $insert_admin_result = mysqli_query($conn , $insert_admin) ;
        
        // to get last instred id
        $new_inserted_adminid = mysqli_insert_id($conn);        
        echo $new_inserted_adminid;
        $detail_insert = mysqli_query($conn, "INSERT INTO users_details(UserID,Phone_No_Country_Code,
        Phone_No,Profile_Pic)VALUES('$new_inserted_adminid ',$code,$number,'../Member/default/DP_Default.jpg')");
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
    
 <!-- profile content-->   

    <div id="add-admin">  
        <div class="container">
                <div class="row no-gutters all-notes">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12 text-left">
                        <p class="admin-heading">Add Administration</p>
                    </div>
                </div>
            </div>
<?php


?>
        <form action="add-admin.php" method='POST'>
            <div class="container">
                <div class="row">
                    <?php //Get category
                        if(isset($_GET['id'])){
                            $adminid = $_GET['id'];

                            $select_admin="SELECT users.FirstName,users.LastName,users.EmailID,
                            users_details.Phone_No_Country_code,users_details.Phone_No,users_details.SecondaryEmailAddress FROM users 
                            LEFT JOIN users_details ON users.ID = users_details.UserID WHERE users.ID='{$adminid}' ";
                            $select_admin_result = mysqli_query($conn,$select_admin) or die("not".mysqli_error($conn));
                        
                            while ($row = mysqli_fetch_assoc($select_admin_result)){
                                $fname_db = $row['FirstName'];
                                $lname_db = $row['LastName'];
                                $emailid_db = $row['EmailID'];
                                $second_email_db = $row['SecondaryEmailAddress'];
                                $code_db = $row['Phone_No_Country_code'];
                                $number_db = $row['Phone_No'];
                            }
                        }
                    ?>
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>First Name *</label>
                                <input type="text" name="fname" value= "<?php echo (isset($_GET['id']))?$fname_db:'';?>" class="form-control input-light-color" placeholder="Enter your first name">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Last Name *</label>
                                <input type="text" value= "<?php echo (isset($_GET['id']))?$lname_db:'';?>"class="form-control input-light-color" name="lname" placeholder="Enter your last name">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Email *</label>
                                <input type="email" value= "<?php echo (isset($_GET['id']))?$emailid_db:'';?>" class="form-control input-light-color" name="email" placeholder="Enter your Email-address">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Phone Number</label>
                                <div class="form-row">
                                    <div class="col-4">
                                        <select class="form-control input-light-color options-arrow-down" name="code">
                                        <?php
                                            $country_code_number = mysqli_query($conn, "SELECT * FROM country");
                                            while ($row = mysqli_fetch_assoc($country_code_number)) {
                                                $country_code = $row['Country_Code'];
                                                $countryid = $row['ID'];
                                                if ($exist != 0) {
                                                    if ($countryid)
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
                                        <input type="tel" name="number" value= "<?php echo (isset($_GET['id']))?$number_db:'';?>" class="form-control" placeholder="Enter your phone number">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-row">
                            <button type="submit" name="submit" id="add-admin-btn" class="btn btn-primary btn-purple">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    
         <!-- Footer-->
         <?php include 'footer.php' ;?>
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