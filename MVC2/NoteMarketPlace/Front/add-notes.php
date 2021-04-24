<?php
include "db.php";
session_start();

if(isset($_SESSION['email'])){
    
    $title = "";
    $categories = "";
    $type = "";
    $note_pages = "";
    $description = "";
    $country = "";
    $institute_name = "";
    $course_name = "";
    $course_code = "";
    $professor_name = "";
    $sell_type = "";
    $sell_price = "";
    $category = "";
    
    $valid_format_1 = true;
    $valid_format_2 = true;
    $valid_format_3 = true;

    //seller id
    $email = $_SESSION['email'];
    $query = "SELECT ID FROM Users WHERE EmailID = '$email' ";
    $result = mysqli_query($conn , $query);
    
   /* if($result){
        echo "connected";
    }else{
        echo "not".mysqli_error();
    }*/
    
    while($row = mysqli_fetch_array($result)){
        $seller_id = $row['ID'];
    }
    
    if(isset($_POST['save'])){
        
        $title = $_POST['title'];
		$category = $_POST['category'];
		$type = $_POST['type'];
		$pages = $_POST['pages'];
		$description = $_POST['description'];
		$country = $_POST['country'];
	    $institute_name = $_POST['institute_name'];
		$course_name = $_POST['course_name'];
		$course_code = $_POST['course_code'];
		$professor_name = $_POST['professor_name'];
		$sell_type = $_POST['sell_type'];
		$sell_price = $_POST['sell_price'];
		$default_display_pic = "../Members/default/note-default.jpg";
        
        //status 8 for review
		$query="INSERT INTO notes(SellerID,Status,Note_Title,Category,Note_Display_Picture,Note_types,Note_pages,
                Description,University,Country,Course,Course_Code,Professor_Name,Is_Paid,Price,CreatedDate,
                CreatedBy,ModifiedDate,ModifiedBy,IsActive) VALUES 
                ('$seller_id',8, '$title','$category','$default_display_pic','$type','$pages','$description',
                '$institute_name','$country','$course_name','$course_code','$professor_name','$sell_type','$sell_price',
                NOW(),'$seller_id',NOW(),'$seller_id',1 )";

		$insert_result=mysqli_query($conn, $query);

		/*if($insert_result){
			echo "insersted";
		}
		else
			echo "not".mysqli_error($conn);*/
        
        //to get above note id
        $note_id = mysqli_insert_id($conn);
	
        $profile_pic = $_FILES["upload_profile"];	
	    $filename = $profile_pic['name'];
	    $filetmp = $profile_pic['tmp_name'];
        $extension = explode('.',$filename);
        $filecheck = strtolower(end($extension));
        $fileextstored = array('jpg','png','jpeg');	

		if (in_array($filecheck, $fileextstored)) {
            if (!is_dir("../Members/")) {
                mkdir('../Members/');
            }
            if (!is_dir("../Members/" . $seller_id)) {
                mkdir("../Members/" . $seller_id);
            }
            if (!is_dir("../Members/" . $seller_id . "/" . $note_id)) {
                mkdir('../Members/' . $seller_id . '/' . $note_id);
            }
            $destinationfile = '../Members/' . $seller_id . '/' . $note_id . '/' . "DP_" . time() . '.' . $filecheck;
            move_uploaded_file($filetmp, $destinationfile);
            $query_pic = "UPDATE notes SET Note_Display_Picture = '$destinationfile' WHERE ID= $note_id ";
            $result_pic = mysqli_query($conn, $query_pic);
        } else {
            $valid_format_1 = false;
        }
        
        //Note Preview
        $note_preview = $_FILES['note_preview'];
        $filename2 = $note_preview['name'];
        $filetmp2 = $note_preview['tmp_name'];
        $extention2 = explode('.', $filename2);
        $filecheck2 = strtolower(end($extention2));
        $fileextstored2 = array('jpg', 'png', 'jpeg');

        if (in_array($filecheck2, $fileextstored2)) {
            if (!is_dir("../Members/")) {
                mkdir('../Members/');
            }
            if (!is_dir("../Members/" . $seller_id)) {
                mkdir("../Members/" . $seller_id);
            }
            if (!is_dir("../Members/" . $seller_id . "/" . $note_id)) {
                mkdir('../Members/' . $seller_id . '/' . $note_id);
            }
            $destinationfile2 = '../Members/' . $seller_id . '/' . $note_id . '/' . "Preview_" . time() . '.' . $filecheck2;
            move_uploaded_file($filetmp2, $destinationfile2);
            $query_preview = "UPDATE notes SET notespreview='$destinationfile2' WHERE ID=$note_id";
            $result_preview = mysqli_query($conn, $query_preview);
        } else {
            $valid_format_3 = false;
        }

        //multiple files
        $upload_notes = count($_FILES['upload_notes']['name']);

        // Looping all files
        for ($i = 0; $i < $upload_notes; $i++) {

            $filename3 = $_FILES['upload_notes']['name'][$i];
            $extention3 = explode('.', $filename3);
            $filecheck3 = strtolower(end($extention3));
            $fileextstored3 = array('pdf');

            if (in_array($filecheck3, $fileextstored3)) {
                $query_multiple_path = "INSERT INTO notesattachment (`Note_ID`, `CreatedDate`, `CreatedBy`, `IsActive`) 
                                    VALUES ($note_id,NOW(),$seller_id,1)";
                $result_multiple_path = mysqli_query($conn, $query_multiple_path);

                $attach_id = mysqli_insert_id($conn);

                // Upload file
                if (!is_dir("../Members/")) {
                    mkdir('../Members/');
                }
                if (!is_dir("../Members/" . $seller_id)) {
                    mkdir("../Members/" . $seller_id);
                }
                if (!is_dir("../Members/" . $seller_id . "/" . $note_id)) {
                    mkdir('../Members/' . $seller_id . '/' . $note_id);
                }
                if (!is_dir("../Members/" . $seller_id . "/" . $note_id . "/" . "Attachements")) {
                    mkdir('../Members/' . $seller_id . '/' . $note_id . '/' . 'Attachements');
                }

                $multiple_file_name = '../Members/' . $seller_id . '/' . $note_id . '/' . 'Attachements/' . $attach_id . '_' . time() . '.' . $filecheck3;
                move_uploaded_file($_FILES['upload_notes']['tmp_name'][$i], $multiple_file_name);

                $attached_name = $attach_id . "_" . time() . $filecheck3;
                $query_multiple_final = "UPDATE notesattachment SET File_Name ='$attached_name',Path ='$multiple_file_name' WHERE ID =$attach_id";
                $result_multiple_final = mysqli_query($conn, $query_multiple_final);
            } else {
                $valid_format_2 = false;
            }
        }
        header('Location:Dashboard-1.php');

    }else if (isset($_GET['id'])) {
        $publish_note_id = $_GET['id'];
        $fetch_detail = mysqli_query($conn, "SELECT * FROM notes WHERE ID=$publish_note_id");

        while ($row = mysqli_fetch_assoc($fetch_detail)) {

            $categories_id = "";
            $countries_id = "";
            $sell_type_new = "";
            $title = $row['Note_Title'];
            $categories_id = $row['Category'];
            $type = $row['Note_types'];
            $pages = $row['Note_Pages'];
            $description = $row['Description'];
            $countries_id = $row['Country'];
            $institute_name = $row['University'];
            $course_name = $row['Course'];
            $course_code = $row['Course_Code'];
            $professor_name = $row['Professor_Name'];
            $sell_type_new = $row['Is_Paid'];
            $sell_price = $row['Price'];
        }

        $fetch_category = mysqli_query($conn, "SELECT Category_name FROM category WHERE ID=$categories_id");
        while ($row = mysqli_fetch_assoc($fetch_category)) {
            $category_name = $row['Category_name'];
        }

        $fetch_type = mysqli_query($conn, "SELECT Type_Name FROM type WHERE ID =$type");
        while ($row = mysqli_fetch_assoc($fetch_type)) {
            $category_name = $row['Type_Name'];
        }

        $fetch_country = mysqli_query($conn, "SELECT Country_Name FROM country WHERE ID=$countries_id");
        while ($row = mysqli_fetch_assoc($fetch_country)) {
            $country_name = $row['Country_Name'];
        }
    }
    if (isset($_POST['save2'])) {

        $dashboard_noteid = $_POST['id_getter'];
        $title = $_POST['title'];
        $category = $_POST['category'];
        $type = $_POST['type'];
        $pages = $_POST['pages'];
        $description = $_POST['description'];
        $country = $_POST['country'];
        $institute_name = $_POST['institute_name'];
        $course_name = $_POST['course_name'];
        $course_code = $_POST['course_code'];
        $professor_name = $_POST['professor_name'];
        $sell_type = $_POST['Sell_type'];
        $sell_price = $_POST['sell_price'];

        $query_insert_save = "UPDATE notes SET `Note_Title`=$title,`Category`=$category,`Note_types`=$type,
                            `Note_Pages`=$pages,`Description`=$description,`University`=$institute_name,
                            `Country`=$country,`Course`=$course_name,`Course_Code`=$course_code,
                            `Professor_Name`=$professor_name,`Is_Paid`=$sell_type,`Price`=$sell_price,`ModifiedDate`=now(),
                            `ModifiedBy`=$seller_id  WHERE noteid = $dashboard_noteid";
                                
        $result_insert_save = mysqli_query($conn, $query_insert_save);

        //Display Picture
        $profile_pic = $_FILES["upload_profile"];	
	    $filename = $profile_pic['name'];
	    $filetmp = $profile_pic['tmp_name'];
        $extension = explode('.',$filename);
        $filecheck = strtolower(end($extension));
        $fileextstored = array('jpg','png','jpeg');	

		if (in_array($filecheck, $fileextstored)) {
            if (!is_dir("../Members/")) {
                mkdir('../Members/');
            }
            if (!is_dir("../Members/" . $seller_id)) {
                mkdir("../Members/" . $seller_id);
            }
            if (!is_dir("../Members/" . $seller_id . "/" . $note_id)) {
                mkdir('../Members/' . $seller_id . '/' . $note_id);
            }
            $destinationfile = '../Members/' . $seller_id . '/' . $note_id . '/' . "DP_" . time() . '.' . $filecheck;
            move_uploaded_file($filetmp, $destinationfile);
            $query_pic = "UPDATE notes SET Note_Display_Picture = '$destinationfile' WHERE ID= $note_id ";
            $result_pic = mysqli_query($conn, $query_pic);
        } else {
            $valid_format_1 = false;
        }
        
        //Note Preview
        $note_preview = $_FILES['note_preview'];
        $filename2 = $note_preview['name'];
        $filetmp2 = $note_preview['tmp_name'];
        $extention2 = explode('.', $filename2);
        $filecheck2 = strtolower(end($extention2));
        $fileextstored2 = array('jpg', 'png', 'jpeg');

        if (in_array($filecheck2, $fileextstored2)) {
            if (!is_dir("../Members/")) {
                mkdir('../Members/');
            }
            if (!is_dir("../Members/" . $seller_id)) {
                mkdir("../Members/" . $seller_id);
            }
            if (!is_dir("../Members/" . $seller_id . "/" . $note_id)) {
                mkdir('../Members/' . $seller_id . '/' . $note_id);
            }
            $destinationfile2 = '../Members/' . $seller_id . '/' . $note_id . '/' . "Preview_" . time() . '.' . $filecheck2;
            move_uploaded_file($filetmp2, $destinationfile2);
            $query_preview = "UPDATE notes SET notespreview='$destinationfile2' WHERE ID=$note_id";
            $result_preview = mysqli_query($conn, $query_preview);
        } else {
            $valid_format_3 = false;
        }

        //multiple files
        $upload_notes = count($_FILES['upload_notes']['name']);

        // Looping all files
        for ($i = 0; $i < $upload_notes; $i++) {

            $filename3 = $_FILES['upload_notes']['name'][$i];
            $extention3 = explode('.', $filename3);
            $filecheck3 = strtolower(end($extention3));
            $fileextstored3 = array('pdf');

            if (in_array($filecheck3, $fileextstored3)) {
                $query_multiple_path = "INSERT INTO notesattachment (`Note_ID`, `CreatedDate`, `CreatedBy`, `IsActive`) 
                                    VALUES ($note_id,NOW(),$seller_id,1)";
                $result_multiple_path = mysqli_query($conn, $query_multiple_path);

                $attach_id = mysqli_insert_id($conn);

                // Upload file
                if (!is_dir("../Members/")) {
                    mkdir('../Members/');
                }
                if (!is_dir("../Members/" . $seller_id)) {
                    mkdir("../Members/" . $seller_id);
                }
                if (!is_dir("../Members/" . $seller_id . "/" . $note_id)) {
                    mkdir('../Members/' . $seller_id . '/' . $note_id);
                }
                if (!is_dir("../Members/" . $seller_id . "/" . $note_id . "/" . "Attachements")) {
                    mkdir('../Members/' . $seller_id . '/' . $note_id . '/' . 'Attachements');
                }

                $multiple_file_name = '../Members/' . $seller_id . '/' . $note_id . '/' . 'Attachements/' . $attach_id . '_' . time() . '.' . $filecheck3;
                move_uploaded_file($_FILES['upload_notes']['tmp_name'][$i], $multiple_file_name);

                $attached_name = $attach_id . "_" . time() . $filecheck3;
                $query_multiple_final = "UPDATE notesattachment SET File_Name ='$attached_name',Path ='$multiple_file_name' WHERE ID =$attach_id";
                $result_multiple_final = mysqli_query($conn, $query_multiple_final);
            } else {
                $valid_format_2 = false;
            }
        }
        header('Location:Dashboard-1.php');
    }
    if(isset($_POST['publish'])){

        $dashboard_noteid = $_POST['id_getter'];
        $title = $_POST['title'];
        $category = $_POST['category'];
        $type = $_POST['type'];
        $pages = $_POST['pages'];
        $description = $_POST['description'];
        $country = $_POST['country'];
        $institute_name = $_POST['institute_name'];
        $course_name = $_POST['course_name'];
        $course_code = $_POST['course_code'];
        $professor_name = $_POST['professor_name'];
        $sell_type = $_POST['Sell-type'];
        $sell_price = $_POST['sell_price'];

        $query_insert_publish = "UPDATE notes SET Status=6,PublishedDate=NOW(),`Note_Title`=$title,`Category`=$category,
                        `Note_types`=$type,`Note_Pages`=$pages,`Description`=$description,
                        `University`=$institute_name,`Country`=$country,`Course`=$course_name,`Course_Code`=$course_code,
                        `Professor_Name`=$professor_name,`Is_Paid`=$sell_type,`Price`=$sell_price,`ModifiedDate`=now(),
                        `ModifiedBy`=$seller_id  WHERE noteid=$dashboard_noteid";

        $result_insert_pubhlish = mysqli_query($conn, $query_insert_publish);

        //Display Picture
        $profile_pic = $_FILES["upload_profile"];	
        $filename = $profile_pic['name'];
        $filetmp = $profile_pic['tmp_name'];
        $extension = explode('.',$filename);
        $filecheck = strtolower(end($extension));
        $fileextstored = array('jpg','png','jpeg');	

        if (in_array($filecheck, $fileextstored)) {
            if (!is_dir("../Members/")) {
                mkdir('../Members/');
            }
            if (!is_dir("../Members/" . $seller_id)) {
                mkdir("../Members/" . $seller_id);
            }
            if (!is_dir("../Members/" . $seller_id . "/" . $note_id)) {
                mkdir('../Members/' . $seller_id . '/' . $note_id);
            }
            $destinationfile = '../Members/' . $seller_id . '/' . $note_id . '/' . "DP_" . time() . '.' . $filecheck;
            move_uploaded_file($filetmp, $destinationfile);
            $query_pic = "UPDATE notes SET Note_Display_Picture = '$destinationfile' WHERE ID= $note_id ";
            $result_pic = mysqli_query($conn, $query_pic);
        } else {
            $valid_format_1 = false;
        }
        
        //Note Preview
        $note_preview = $_FILES['note_preview'];
        $filename2 = $note_preview['name'];
        $filetmp2 = $note_preview['tmp_name'];
        $extention2 = explode('.', $filename2);
        $filecheck2 = strtolower(end($extention2));
        $fileextstored2 = array('jpg', 'png', 'jpeg');

        if (in_array($filecheck2, $fileextstored2)) {
            if (!is_dir("../Members/")) {
                mkdir('../Members/');
            }
            if (!is_dir("../Members/" . $seller_id)) {
                mkdir("../Members/" . $seller_id);
            }
            if (!is_dir("../Members/" . $seller_id . "/" . $note_id)) {
                mkdir('../Members/' . $seller_id . '/' . $note_id);
            }
            $destinationfile2 = '../Members/' . $seller_id . '/' . $note_id . '/' . "Preview_" . time() . '.' . $filecheck2;
            move_uploaded_file($filetmp2, $destinationfile2);
            $query_preview = "UPDATE notes SET notespreview='$destinationfile2' WHERE ID=$note_id";
            $result_preview = mysqli_query($conn, $query_preview);
        } else {
            $valid_format_3 = false;
        }

        //multiple files
        $upload_notes = count($_FILES['upload_notes']['name']);

        // Looping all files
        for ($i = 0; $i < $upload_notes; $i++) {

            $filename3 = $_FILES['upload_notes']['name'][$i];
            $extention3 = explode('.', $filename3);
            $filecheck3 = strtolower(end($extention3));
            $fileextstored3 = array('pdf');

            if (in_array($filecheck3, $fileextstored3)) {
                $query_multiple_path = "INSERT INTO notesattachment (`Note_ID`, `CreatedDate`, `CreatedBy`, `IsActive`) 
                                    VALUES ($note_id,NOW(),$seller_id,1)";
                $result_multiple_path = mysqli_query($conn, $query_multiple_path);

                $attach_id = mysqli_insert_id($conn);

                // Upload file
                if (!is_dir("../Members/")) {
                    mkdir('../Members/');
                }
                if (!is_dir("../Members/" . $seller_id)) {
                    mkdir("../Members/" . $seller_id);
                }
                if (!is_dir("../Members/" . $seller_id . "/" . $note_id)) {
                    mkdir('../Members/' . $seller_id . '/' . $note_id);
                }
                if (!is_dir("../Members/" . $seller_id . "/" . $note_id . "/" . "Attachements")) {
                    mkdir('../Members/' . $seller_id . '/' . $note_id . '/' . 'Attachements');
                }

                $multiple_file_name = '../Members/' . $seller_id . '/' . $note_id . '/' . 'Attachements/' . $attach_id . '_' . time() . '.' . $filecheck3;
                move_uploaded_file($_FILES['upload_notes']['tmp_name'][$i], $multiple_file_name);

                $attached_name = $attach_id . "_" . time() . $filecheck3;
                $query_multiple_final = "UPDATE notesattachment SET File_Name ='$attached_name',Path ='$multiple_file_name' WHERE ID =$attach_id";
                $result_multiple_final = mysqli_query($conn, $query_multiple_final);
            } else {
                $valid_format_2 = false;
            }
        }
        header('Location:Dashboard-1.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<?php include 'head.php';?>
<body>

    <!-- Header -->
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
                            <li >
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
                                    <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <div class="logged-in-user-photo">
                                            <img src="images/user-profile/user-img.png" alt="User Photo" class="rounded-circle">
                                        </div>
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item active" href="user-profile.php">My Profile</a>
                                        <a class="dropdown-item" href="my-downloads.php">My Downloads</a>
                                        <a class="dropdown-item" href="my-sold-notes.php">My Sold Notes</a>
                                        <a class="dropdown-item" href="my-rejected-notes.php">My Rejected Notes</a>
                                        <a class="dropdown-item" href="change-password.php">Change Password</a>
                                        <a class="dropdown-item logout-btn-dropdown" href="login.php">Logout</a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a class="btn btn-general btn-purple" href="login.php" title="Download" role="button">Logout</a>
                            </li>
                        </ul>
                    </nav>
                </div>

                <!-- Mobile Menu-->
                <div id="mobile-nav">
                    <img class="logo-in-mobile-menu" src="images/logo/dark-logo.png" alt="Notes Logo">
                    <!-- Mobile Menu Close Button-->
                    <span id="mobile-nav-close-btn">&times;</span>

                    <div id="mobile-nav-content">
                        <ul class="nav">
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
                                    <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <div class="logged-in-user-photo">
                                            <img src="images/user-profile/user-img.png" alt="User Photo" class="rounded-circle">
                                        </div>
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item active" href="user-profile.php">My Profile</a>
                                        <a class="dropdown-item" href="my-downloads.php">My Downloads</a>
                                        <a class="dropdown-item" href="my-sold-notes.php">My Sold Notes</a>
                                        <a class="dropdown-item" href="my-rejected-notes.php">My Rejected Notes</a>
                                        <a class="dropdown-item" href="change-password.php">Change Password</a>
                                        <a class="dropdown-item logout-btn-dropdown" href="login.php">Logout</a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a class="btn btn-general btn-purple" href="login.php" title="Download" role="button">Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
    </div>
    <!-- Header ends -->
    <!-- background-->
    <div id="add-note">
        <!-- back img-->
        <div class="small-height-bg">
            <p class="text-center">Add Notes</p>
        </div>
        <!-- back img-->

        <!-- Heading-1-->
        <div id="form-heading-1">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        Basic Note Details
                    </div>
                </div>
            </div>
        </div>
        <!--Form-1-->
        <form action="add-notes.php" method="POST" enctype = "multipart/form-data">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Title *</label>
                                <input type="text" name="title" class="form-control input-light-color" placeholder="Enter your title" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="right-content">Category*</label>
                                <select class="form-control input-light-color options-arrow-down right-content" name="category" required>
            
                                    <?php
                                    if (isset($_GET['id'])) {
                                        echo "<option selected value='$categories_id'>$category_name</option>";

                                        $query_category = "SELECT Category_name,ID FROM category";
                                        $result_category = mysqli_query($conn, $query_category);

                                        while ($raw = mysqli_fetch_assoc($result_category)) {
                                            $categories = $raw['Category_name'];
                                            $category_id = $raw['ID'];
                                            if ($category_id == $categories_id)
                                                echo "";
                                            else
                                                echo "<option value='$category_id'>$categories</option>";
                                        }
                                    } else {
                                        $query_category = "SELECT Category_name,ID FROM category";
                                        $result_category = mysqli_query($conn, $query_category);
                                        echo "<option value='' selected disabled>Select your Category</option>";

                                        while ($raw = mysqli_fetch_assoc($result_category)) {
                                            $categories = $raw['Category_name'];
                                            $category_id = $raw['ID'];
                                            echo "<option value='$category_id'>$categories</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Display Picture</label>
                                <div class="user-profile-photo-uploader">
                                    <label for="upload-file"><img src="images/user-profile/upload.png" class="note-img-upload" title="Click here to upload your photo" alt="Upload your photo here"></label>
                                    <input id="upload-file" name="upload_profile" class="form-control" type="file">
                                    <div style="margin-top: 22px;font-weight: 600;font-size: 15px" id="file-upload-filename"></div>
                                </div>
                                <div class="alert-msg"> 
                                    <?php
                                    if (empty($profile_pic)) {
                                        echo "";
                                    } else if ($valid_format_1 == false) {
                                        echo "<p style='color:red ; font-size:13px;'>Only JPEG,JPG,PNG file formats are supported!</p>";
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="right-content">Upload notes*</label>
                                <div id="upload-note" class="user-profile-photo-uploader right-content">
                                    <label for="upload-note"><img src="images/add-note/upload-note.png" class="right-content note-img-upload" title="Click here to upload your notes" alt="Upload your notes here"></label>
                                    <input id="upload-note" name="upload_notes[]" <?php if (isset($_GET['id'])) echo "";else echo "required"; ?>class="form-control right-content" type="file" multiple>         
                                    <div class="incorrect-password-label">
                                    <?php
                                    if ($valid_format_2 == false)
                                        echo "Only Pdf Files can be uploaded";
                                    ?>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <div class="form-group">
                                    <label>Type</label>
                                    <select class="form-control options-arrow-down input-light-color" name="type" required>
                                    <?php
                                    if (isset($_GET['id'])) {
                                        echo "<option selected value='$type'>$type_name</option>";
                                        $query_type = "SELECT Type_Name,ID FROM type";
                                        $result_type = mysqli_query($conn, $query_type);

                                        while ($raw = mysqli_fetch_assoc($result_type)) {
                                            $types = $raw['Type_Name'];
                                            $type_id = $raw['ID'];
                                            if ($type_id == $type) {
                                                echo "";
                                            } else
                                                echo " <option value='$type_id'>$types</option>";
                                        }
                                    } else {
                                        echo "<option value='' selected disabled>Select your Note type</option>";
                                        $query_type = "SELECT Type_Name,ID FROM type";
                                        $result_type = mysqli_query($conn, $query_type);

                                        while ($raw = mysqli_fetch_assoc($result_type)) {
                                            $types = $raw['Type_Name'];
                                            $type_id = $raw['ID'];
                                            echo " <option value='$type_id'>$types</option>";
                                        }
                                    }
                                    ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="right-content">Number of pages</label>
                                <input type="text" name="pages" class="form-control input-light-color right-content" placeholder="Enter number of note pages" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Description</label>
                                <textarea id="add-notes-textarea" name="description" placeholder="Enter your description" class="form-control input-light-color" required><?php echo $description ?></textarea>
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
                        Institution Information
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
                                <label>Country *</label>
                                <select class="form-control input-light-color options-arrow-down" name="country" required>
                                <?php
                                    if (isset($_GET['id'])) {
                                        echo "<option selected value='$countries_id'>$country_name</option>";
                                        $query_country = "SELECT Country_Name,ID FROM country";
                                        $result_country = mysqli_query($conn, $query_country);

                                        while ($raw = mysqli_fetch_assoc($result_country)) {
                                            $countries = $raw['Country_Name'];
                                            $country_id = $raw['ID'];
                                            if ($countries_id == $country_id)
                                                echo "";
                                            else
                                                echo "<option value='$country_id'>$countries</option>";
                                        }
                                    } else {
                                        echo "<option value='' selected disabled>Select your country</option>";
                                        $query_country = "SELECT Country_Name,ID FROM country";
                                        $result_country = mysqli_query($conn, $query_country);

                                        while ($raw = mysqli_fetch_assoc($result_country)) {
                                            $countries = $raw['Country_Name'];
                                            $country_id = $raw['ID'];
                                            echo "<option value='$country_id'>$countries</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="right-content">Institution Name</label>
                                <input type="text" class="form-control input-light-color right-content" name="institute_name" value="<?php echo $institute_name ?>" placeholder="Enter your Institution Name" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!--Course infomation-->
        <div id="form-heading-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        Course Details
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
                                <label>Course Name</label>
                                <input type="text" name="course_name" class="form-control input-light-color"   value="<?php echo $course_name ?>" placeholder="Enter course your name" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="right-content">Course Code</label>
                                <input type="text" name="course_code" class="form-control input-light-color right-content"   value="<?php echo $course_code ?>" placeholder="Enter course your code" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Professor/Lecturer</label>
                                <input type="text" name="professor_name" class="form-control input-light-color"   value="<?php echo $professor_name ?>"placeholder="Enter your professor name" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!--Selling infomation-->
        <div id="form-heading-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        Selling Information
                    </div>
                </div>
            </div>
        </div>
        <!--Form-4-->
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Sell for*</label>
                                <div class="row no-gutters free-paid-radio-wrapper">
                                <label class="purple-radio-input">
                                    <?php
                                    if(isset($_GET['id'])){?> 
                                    <input type='radio' <?php if($sell_type_new==5) echo "checked";?> name='sell_type' value='5' onclick='disablePrice()'><span class='checkmark'></span>
                                    <?php  }else{
										$query_note_mode = "SELECT ID FROM referencedata WHERE value='Free'";
                                                $result_note_mode = mysqli_query($conn, $query_note_mode);
                                                while ($row = mysqli_fetch_assoc($result_note_mode)) {
                                                    $note_type = $row['ID'];
                                                    echo "<input type='radio' name='sell_type' value='$note_type' onclick=" ."disablePrice()"."><span class='checkmark'></span>";}}?>
									</label><label class="info-label-check">Free</label>                             
                                                
									            
									<label class="purple-radio-input ">
									<?php	
                                    if(isset($_GET['id'])){?>
                                    <input type='radio' <?php if($sell_type_new==4) echo "checked";?> name='sell_type' value='4' onclick='enablePrice()'><span class='checkmark'></span><?php
                                    }else{
										$query_note_mode = "SELECT ID FROM referencedata WHERE value='Paid'";
                                                $result_note_mode = mysqli_query($conn, $query_note_mode);
                                                while ($row = mysqli_fetch_assoc($result_note_mode)) {
                                                    $note_type = $row['ID'];
                                                    echo "<input type='radio' name='sell_type' checked value='$note_type' onclick=" ."enablePrice()"."><span class='checkmark'></span>";}}?>
								</label><label class="info-label-check">Paid</label>
                                </div>

                                <div class="form-group">
                                    <label>Sell Price</label>
                                    <input type="number" id="price-box" name="sell_price" value="<?php echo $sell_price ?>" class="form-control input-light-color" placeholder="Enter your price" disabled>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="right-content">Note Preview</label>
                                <div class="note-preview">
                                    <div class="user-profile-photo-uploader right-content">
                                        <label for="note-preview"><img class="note-img-upload" src="images/user-profile/upload.png" title="Click here to upload your photo" alt="Upload your photo here"></label>
                                        <input id="note-preview" name="note_preview" class="form-control" type="file" required>
                                        <div style="font-size: 15px;margin-top:70px;font-weight: 600;" id="file-upload-filename2"></div>
                                        <div class="incorrect-password-label">
                                            <?php
                                                if (empty($note_preview)) {
                                                    echo "";
                                                } else if ($valid_format_3 == false) {
                                                    echo "Only JPEG,JPG,PNG file formats are supported!";
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <?php if (isset($_GET['id'])) {
                                    $temp_id = $_GET['id']; ?>
                                <input name="id_getter" <?php echo "value='$temp_id'"; ?> type="hidden"> <?php } ?>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="row no-gutters note-buttons">
                                    <div class="form-btn">

                                    <?php
                                       if(isset($_GET['id'])){ ?>
                                         <button type="submit" name="save2" class="btn btn-general btn-purple save-note-btn">Save</button>
                                         <button type="submit" name="publish" class="btn btn-general btn-purple publish-note-btn"  onclick='javascript:Publish($(this));return false;' href='publish-notes.php id=".$noteid."'>Publish</button>
                                         <?php
                                        }else{ ?>
                                            <button type="submit" name="save" class="btn btn-general btn-purple save-note-btn">Save</button>
                                            <button disabled class="btn btn-general btn-purple publish-note-btn" name="publish">Publish</button>
                                        <?php }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>

    <!-- background-->

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
    //enable and disable price input
    function disablePrice() {
        $("#price-box").attr("disabled", true);
        $("#price-box").attr("required", false);
    }

    function enablePrice() {
        $("#price-box").attr("disabled", false);
        $("#price-box").attr("required", true);
    }

    //show file name
    var input = document.getElementById("upload-file");
    var infoArea = document.getElementById("file-upload-filename");
    input.addEventListener("change", showFileName);

    function showFileName(event) {
        var input = event.srcElement;
        var fileName = input.files[0].name;
        infoArea.textContent = "File name: " + fileName;
    }

    var input2 = document.getElementById("note-preview");
    var infoArea2 = document.getElementById("file-upload-filename2");
    input2.addEventListener("change", showFileName2);

    function showFileName2(event) {
        var input2 = event.srcElement;
        var fileName2 = input2.files[0].name;
        infoArea2.textContent = "File name: " + fileName2;
    }
    </script>

    <?php if (isset($_GET['id'])) {
        if ($sell_type_new == 4) {  ?>
    <script>
    $("#price-box").attr("disabled", false);
    $("#price-box").attr("required", true);
    </script>
    <?php  }
    }  ?>

</body>

</html>