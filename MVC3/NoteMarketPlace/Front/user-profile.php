<?php
include "db.php";
session_start();

if(isset($_SESSION['email'])){
    $email = $_SESSION['email'];

    $query = mysqli_query($conn , "SELECT * FROM users WHERE EmailID = '$email' ");
    
    
    while($row = mysqli_fetch_assoc($query)){
        $userid = $row['ID'];
        $fname = $row['FirstName'];
        $lname = $row['LastName'];
    }
}else
    header('Location:login.php');

?>

<!DOCTYPE html>
<html lang="en">

<?php include 'head.php';?>


<body>
    <div id="user-profile">
    <!-- header-->
        <div class="only-white-nav  extra-style-nav">
            <header class="site-header">
                <div class="header-wrapper">

                    <!-- Mobile Menu Open Button-->
                    <span id="mobile-nav-open-btn">&#9776;</span>

                    <div class="logo-wrapper">
                        <a href="home.php" title="Site Logo">
                            <img src="images/logo/dark-logo.png" alt="Logo">
                        </a>
                    </div>
                    <div class="navigation-wrapper">
                        <nav class="main-nav">
                            <ul class="menu-navigation">
                                <li>
                                    <a href="search-notes.php">Search Notes</a>
                                </li>
                                <li>
                                    <a href="Dashboard-1.php">Sell Your Notes</a>
                                </li>
                                <li>
                                    <a href="buyer-request.php">Buyer Request</a>
                                </li>
                                <li>
                                    <a href="faq.php">FAQ</a>
                                </li>
                                <li>
                                    <a href="contact-us.php">Contact Us</a>
                                </li>
                                <li class="logged-in-user-photo-li">
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
                                    $dp_path = mysqli_query($conn, "SELECT Profile_Pic FROM users_details WHERE UserID=$userid");
                                    while ($row = mysqli_fetch_assoc($dp_path)) {
                                        $profilepic_path = $row['Profile_Pic'];
                                    }
                                    echo "
                                    <a href='#' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                        <div class='logged-in-user-photo'>
                                        <img style='height:50px;width,50px;' src='$profilepic_path' alt='PIC-$full_name' class='rounded-circle img-fluid'>
                                        </div>
                                    </a>";
                                } else
                                    echo "
                                    <a href='#' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                        <div class='logged-in-user-photo'>
                                        <img style='height:50px;width,50px;' src='../Members/default/PP_default.jpg' alt='PIC-$full_name' class='rounded-circle img-fluid'>
                                        </div>
                                    </a>";
                                } else {
                                }
                            ?>

                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <a class="dropdown-item active" href="user-profile.php">My Profile</a>
                                            <a class="dropdown-item" href="my-downloads.php">My Downloads</a>
                                            <a class="dropdown-item" href="my-sold-notes.php">My Sold Notes</a>
                                            <a class="dropdown-item" href="my-rejected-notes.php">My Rejected Notes</a>
                                            <a class="dropdown-item" href="change-password.php">Change Password</a>
                                            <?php if (isset($_SESSION['email'])) { ?>
                                         <a class="dropdown-item logout-btn-dropdown" href="logout.php">Logout</a>
                                         <?php
                                        } else {
                                        ?>
                                         <a class="dropdown-item logout-btn-dropdown" href="login.php">LOGIN</a>

                                        <?php } ?>
                                </div>
                            </div>
                            </li>
                            <li><?php if (isset($_SESSION['email'])) { ?>
                                <a class="btn btn-general btn-purple" href="logout.php" title="Download" role="button">Logout</a>
                                <?php } else {
                                ?>
                                <a class="btn btn-general btn-purple" href="login.php" title="Download" role="button">Logout</a>

                                <?php } ?>
                            </li>
                            </ul>
                        </nav>
                    </div>

                    <!-- Mobile Menu-->
                    <div id="mobile-nav">
                        <img class="logo-in-mobile-menu" src="images/logo/dark-logo.png" alt="Notes Logo">
                        <!-- Mobile Menu Close Button -->
                        <span id="mobile-nav-close-btn">&times;</span>

                        <div id="mobile-nav-content">
                            <ul class="nav">
                                <li>
                                    <a href="search-notes.php">Search Notes</a>
                                </li>
                                <li>
                                    <a href="dashboard-1.php">Sell Your Notes</a>
                                </li>
                                <li>
                                    <a href="buyer-request.php">Buyer Request</a>
                                </li>
                                <li>
                                    <a href="faq.php">FAQ</a>
                                </li>
                                <li>
                                    <a href="contact-us.php">Contact Us</a>
                                </li>
                                <li class="logged-in-user-photo-li">
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
                                    $dp_path = mysqli_query($conn, "SELECT Profile_Pic FROM users_details WHERE UserID=$userid");
                                    while ($row = mysqli_fetch_assoc($dp_path)) {
                                        $profilepic_path = $row['Profile_Pic'];
                                    }
                                    echo "
                                    <a href='#' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                        <div class='logged-in-user-photo'>
                                        <img style='height:50px;width,50px;' src='$profilepic_path' alt='PIC-$full_name' class='rounded-circle img-fluid'>
                                        </div>
                                    </a>";
                                } else
                                    echo "
                                    <a href='#' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                        <div class='logged-in-user-photo'>
                                        <img style='height:50px;width,50px;' src='../Members/default/PP_default.jpg' alt='PIC-$full_name' class='rounded-circle img-fluid'>
                                        </div>
                                    </a>";
                                } else {
                                }
                            ?>

                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <a class="dropdown-item active" href="user-profile.php">My Profile</a>
                                            <a class="dropdown-item" href="my-downloads.php">My Downloads</a>
                                            <a class="dropdown-item" href="my-sold-notes.php">My Sold Notes</a>
                                            <a class="dropdown-item" href="my-rejected-notes.php">My Rejected Notes</a>
                                            <a class="dropdown-item" href="change-password.php">Change Password</a>
                                            <?php if (isset($_SESSION['email'])) { ?>
                                         <a class="dropdown-item logout-btn-dropdown" href="logout.php">Logout</a>
                                         <?php
                                        } else {
                                        ?>
                                         <a class="dropdown-item logout-btn-dropdown" href="login.php">LOGIN</a>

                                        <?php } ?>
                                </div>
                            </div>
                            </li>
                            <li><?php if (isset($_SESSION['email'])) { ?>
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
        <!-- background-->
        <!-- back img-->
        <div class="small-height-bg">
            <p class="text-center">User Profile</p>
        </div>
        <!-- back img-->

        <!-- Heading-1-->
        <div id="form-heading-1">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        Basic Profile Details
                    </div>
                </div>
            </div>
        </div>

        
<!-- for getting users details -->
<?php
$query = mysqli_query($conn, "SELECT 1 FROM users_details WHERE UserID='$userid'");
$exist = mysqli_num_rows($query);

if ($exist != 0) { //check if user exist or not

    $query = mysqli_query($conn, "SELECT Country,Gender,Phone_No_Country_Code  FROM users_details WHERE UserID=$userid");
    while ($row = mysqli_fetch_assoc($query)) {
        $country_id = $row['Country'];
        $gender_id = $row['Gender'];
        $phone_code = $row['Phone_No_Country_Code'];
    }
    $profile_pic_path_getter = mysqli_query($conn, "SELECT Profile_Pic FROM users_details WHERE UserID='$userid'");
    while ($row = mysqli_fetch_assoc($profile_pic_path_getter)) {
        $profile_pic_path = $row['Profile_Pic'];
    }
}
?>
        <!--Form-1-->
        <form action="user-profile.php" method="POST" enctype = "multipart/form-data" > 
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>First Name *</label>
                                <input type="text" class="form-control input-light-color" name="fname" <?php echo "value='$fname'"; ?> placeholder="Enter your first name" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="right-content">Last Name *</label>
                                <input type="text" class="form-control input-light-color right-content" name="lname" <?php echo "value='$lname'"; ?> placeholder="Enter your last name" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Email *</label>
                                <input type="email" class="form-control input-light-color"name="email" <?php echo "value='$email'"; ?> placeholder="Enter your email address" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="right-content">Date Of Birth</label>
                                <?php
                                $result = mysqli_query($conn, "SELECT Dob FROM users_details WHERE UserID=$userid");
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $dob = $row['Dob'];
                                 }
                                echo ($exist != 0) ? "<input type='date' value='$dob' class='form-control input-light-color right-content' name='dob'>" : "<input type='date' class='form-control input-light-color right-content' name='dob' required>";
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <div class="form-group">
                                    <label>Gender</label>
                                    <select class="form-control options-arrow-down input-light-color" name="gender">
                                    <?php
                                        $gender = mysqli_query($conn, "SELECT * FROM referencedata WHERE RefCategory='Gender'");
                                        if ($gender_id == 0)
                                            echo " <option selected>Select your gender</option>";
                                        while ($row = mysqli_fetch_assoc($gender)) {
                                            $genderid = $row['ID'];
                                            $gender_name = $row['Value'];
                                            if ($exist != 0) {
                                                if ($genderid == $gender_id) //$gender_id is current gender id
                                                    echo " <option value='$genderid' selected >$gender_name</option>";
                                                else
                                                    echo " <option value='$genderid'>$gender_name</option>";
                                            } else
                                                echo " <option value='$genderid'>$gender_name</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="right-content">Phone Number</label>
                                <div class="form-row number-box">
                                    <div class="col-4">
                                        <select class="form-control input-light-color options-arrow-down right-content" name="code">
                                        <?php
                                            $code_getter = mysqli_query($conn, "SELECT * FROM country");
                                            while ($row = mysqli_fetch_assoc($code_getter)) {
                                                $country_code = $row['Country_Code'];
                                                $countryid = $row['ID'];
                                                if ($exist != 0) {
                                                    if ($countryid == $phone_code)
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
                                        <?php
                                            $query = mysqli_query($conn, "SELECT phone_no FROM users_details WHERE UserID=$userid");
                                            while ($row = mysqli_fetch_assoc($query)) {
                                                $number = $row['phone_no'];
                                            }
                                            echo ($exist != 0) ? " <input type='tel' value='$number' class='form-control right-content' name='phone_no' placeholder='Enter your phone number'> ": "<input type='tel' class='form-control right-content' name='phone_no' placeholder='Enter your phone number' required>";

                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Profile Picture</label>
                                <div class="user-profile-photo-uploader">
                                    <label for="image-uploader"><img src="images/user-profile/upload.png" title="Click here to upload your photo" alt="Upload your photo here"></label>
                                    <input id="image-uploader" class="form-control" type="file" name="profile_pic">
                                    <div style="font-size: 14px;margin-top:23px;font-weight: 600;" id="file-upload-filename3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Address part-->
            <div id="form-heading-2">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            Address details
                        </div>
                    </div>
                </div>
            </div>
            <!--Form-2-->
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Address Line 1 *</label>
                               <?php
                                $query = mysqli_query($conn, "SELECT Address_1 FROM users_details WHERE UserID=$userid");
                                while ($row = mysqli_fetch_assoc($query)) {
                                    $add_1 = $row['Address_1'];
                                }
                                echo ($exist != 0) ? "<input type='text' name='address_1' value='$add_1' class='form-control input-light-color' placeholder='Enter your address'>":"<input type='text' name='address_1' class='form-control input-light-color' placeholder='Enter your address' required>";
                                ?>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="right-content">Address Line 2</label>
                                <?php
                                $query = mysqli_query($conn, "SELECT Address_2 FROM users_details WHERE UserID=$userid");
                                while ($row = mysqli_fetch_assoc($query)) {
                                    $add_2 = $row['Address_2'];
                                }
                                echo ($exist != 0) ? "<input type='text' name='address_2' value='$add_2' class='form-control input-light-color' placeholder='Enter your address'>":"<input type='text' name='address_2' class='form-control input-light-color' placeholder='Enter your address' required>";
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>City *</label>
                                <?php
                                $query = mysqli_query($conn, "SELECT City FROM users_details WHERE USerID=$userid");
                                while ($row = mysqli_fetch_assoc($query)) {
                                    $city_temp = $row['City'];
                                }
                                echo ($exist != 0) ? "<input type='text' value='$city_temp' name='city' class='form-control input-light-color' placeholder='Enter your city'>":"<input type='text' name='city' class='form-control input-light-color' placeholder='Enter your city' required>";
                                ?>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="right-content">State *</label>
                                <?php
                                $query = mysqli_query($conn, "SELECT State FROM users_details WHERE UserID=$userid");
                                while ($row = mysqli_fetch_assoc($query)) {
                                    $state = $row['State'];
                                }
                                echo ($exist != 0) ? "<input type='text' value='$state' name='state' class='form-control input-light-color right-content' placeholder='Enter your state'>":"                                <input type='text' name='state' class='form-control input-light-color right-content' placeholder='Enter your state' required >";
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>ZipCode *</label>
                                <?php
                                $query = mysqli_query($conn, "SELECT Zip_Code FROM users_details WHERE UserID=$userid");
                                while ($row = mysqli_fetch_assoc($query)) {
                                    $zipcode = $row['Zip_Code'];
                                }
                                echo ($exist != 0) ? "<input type='number' value='$zipcode' name='zipcode' class='form-control input-light-color' placeholder='Enter your zipcode'>":"<input type='number' name='zipcode' class='form-control input-light-color' placeholder='Enter your zipcode' required>";
                                ?>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="right-content">Country *</label>
                                <select class="form-control input-light-color options-arrow-down right-content" name="country" required>
                                <?php
                                    $get_country = mysqli_query($conn, "SELECT * FROM country");
                                    if ($country_id == 0)
                                        echo " <option selected>Select your country</option>";
                                    while ($row = mysqli_fetch_assoc($get_country)) {
                                        $country = $row['Country_Name'];
                                        $countryid = $row['ID'];
                                        if ($exist != 0) {
                                            if ($countryid == $country_id)
                                                echo "<option selected value='$countryid'>$country</option>";
                                            else
                                                echo "<option value='$countryid'>$country</option>";
                                        } else
                                            echo "<option value='$countryid'>$country</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
   
            <!--University infomation-->
            <div id="form-heading-3">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            university and college infomation
                        </div>
                    </div>
                </div>
            </div>
            <!--Form-3-->

            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>University</label>
                                <?php
                                $query = mysqli_query($conn, "SELECT University FROM users_details WHERE UserID=$userid");
                                while ($row = mysqli_fetch_assoc($query)) {
                                    $university = $row['University'];
                                }
                                echo ($exist != 0) ? "<input type='text' name='university' value='$university' class='form-control input-light-color' placeholder='Enter your university'>":"<input type='text' name='university' class='form-control input-light-color' placeholder='Enter your university' required>";
                                ?>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="right-content">College</label>
                                <?php
                                $query = mysqli_query($conn, "SELECT College FROM users_details WHERE UserID=$userid");
                                while ($row = mysqli_fetch_assoc($query)) {
                                    $college = $row['College'];
                                }
                                echo ($exist != 0) ? "<input type='text' value='$college' name='college' class='form-control input-light-color right-content' placeholder='Enter your college' required>":"<input type='text' name='college' class='form-control input-light-color right-content' placeholder='Enter your college' required>";
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" name="submit" id="user-profile-submit-btn" class="btn btn-primary">Submit</button>
            </div>
        </form>
  </div>
    <!-- background-->

<?php

if (isset($_POST['submit'])) {

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $phone_code = $_POST['code'];
    $phone_no = $_POST['phone_no'];
    $add_1 = $_POST['address_1'];
    $add_2 = $_POST['address_2'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zipcode = $_POST['zipcode'];
    $country = $_POST['country'];
    $university = $_POST['university'];
    $college = $_POST['college'];
    $destinationfile = "../Members/default/PP_default.jpg";

    $update_name = mysqli_query($conn, "UPDATE users SET FirstName='$fname',LastName='$lname' WHERE UserID=$userid");

    if ($exist == 0)
        $insert_query = mysqli_query($conn, "INSERT INTO  users_details (Profile_Pic,UserID,Phone_No_Country_Code,CreatedDate,CreatedBy) VALUES('$destinationfile',$userid,$phone_code,NOW(),$userid)");
        /*if($insert_query){
            echo "connected";
        }else{
            echo "not".mysqli_error($conn);
        }*/

    $update = "UPDATE users_details SET Dob='$dob',Gender='$gender',Phone_No_Country_Code='$phone_code',
                     Phone_No='$phone_no',Address_1='$add_1',
                     Address_2='$add_2',Zip_Code='$zipcode',State='$state',City='$city',
                     Country='$country',University='$university',College='$college',ModifiedDate=NOW(),
                     ModifiedBy='$userid' WHERE UserID='$userid'";

    $update_query_result = mysqli_query($conn, $update);
  
    //User profile picture
    $profile_pic = $_FILES['profile_pic'];
    $filename = $profile_pic['name'];
    $filetmp = $profile_pic['tmp_name'];
    $extention = explode('.', $filename);
    $filecheck = strtolower(end($extention));
    $fileextstored = array('png', 'jpg', 'jpeg');

    if (in_array($filecheck, $fileextstored)) {
        if (!is_dir("../Members/")) {
            mkdir('../Members/');
        }
        if (!is_dir("../Members/default")) {
            mkdir("../Members/default");
        }
        if (!is_dir("../Members/" . $userid)) {
            mkdir("../Members/" . $userid);
        }

        //to delete file
        if ($exist != 0) {
            if ($profile_pic_path != "../Members/default/profile_pic-default.png")
                unlink($profile_pic_path);
        }
        $destinationfile = '../Members/' . $userid . '/' . "DP_" . time() . '.' . $filecheck;
        move_uploaded_file($filetmp, $destinationfile);

        $set_profile_pic = mysqli_query($conn, "UPDATE users_details SET Profile_Pic='$destinationfile' WHERE UserID=$userid");
    }
}
?>
    
    <!-- Footer-->
    <?php include 'footer.php'; ?>
    <!-- Footer End-->


    <!-- JQuery -->
    <script src="js/jquery.min.js"></script>

    <!-- Popper Js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <!-- Custom JS -->
    <script src="js/script.js"></script>
    
    <script>
    var input3 = document.getElementById("image-uploader");
    var infoArea3 = document.getElementById("file-upload-filename3");
    input3.addEventListener("change", showFileName3);

    function showFileName3(event) {
        var input3 = event.srcElement;
        var fileName3 = input3.files[0].name;
        infoArea3.textContent = "File name: " + fileName3;
    }
    </script>

</body>

</html>