<?php
include "db.php";
session_start();

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
 

if(isset($_GET['id']))
    $noteid = $_GET['id'];
else 
    $noteid = 11;


$mail_sent = false;
$login = true;

//fetch data  

if(isset($_SESSION['email'])){
    $email = $_SESSION['email'];

    //get buyer
    $buyer = mysqli_query($conn, "SELECT ID,FirstName,LastName FROM users WHERE EmailID = '$email' ");
    
    while ($row = mysqli_fetch_assoc($buyer)){     
        $buyerid = $row ['ID'];
        $buyer_fullname = $row ['FirstName'] ." ".$row['LastName'];

        //get seller
        $seller = mysqli_query($conn,"SELECT SellerID,Price,Note_Title,Category,Is_Paid FROM notes WHERE ID=$noteid");
        while ($row = mysqli_fetch_assoc($seller)){  

            $sellerid = $row['SellerID'];
            $note_price = $row['Price'];
            $note_title = $row['Note_Title'];
            $category_id = $row['Category'];
            $sell_type = $row['Is_Paid'];

        //get category 
        $category = mysqli_query($conn ,"SELECT Category_name FROM category WHERE ID=$category_id");
        while ($row = mysqli_fetch_assoc($category)){
        $categoryname = $row['Category_name'];
        }

        $check_download = mysqli_query($conn, "SELECT ID FROM downloads WHERE NoteID=$noteid AND DownloaderID=$buyerid");

        }
     }
   }
//single attachment
if (isset($_POST['single_download'])) {

    $attactments_getter = mysqli_query($conn, "SELECT Note_ID,File_Name,Path FROM notesattachment WHERE Note_ID=$noteid");
    while ($row = mysqli_fetch_array($attactments_getter)) {
        $filepath = $row['File_Name'];
    }
    $file_getter = mysqli_query($conn, "SELECT Note_Title FROM notes WHERE ID=$noteid");
    while ($row = mysqli_fetch_array($file_getter)) {
        $title = $row['Note_Title'];
    }

    header('Cache-control: public');
    header('Content-Description: File Transfer');
    header('Content-Disposition: attachment; filename=' . $title . '.pdf');
    header('Content-Type: application/pdf');
    header('Content-Transfer-Encoding:binary');
    readfile($filepath);

    $download_entry_number = mysqli_num_rows($check_download);
    if ($download_entry_number == 0 && $buyerid != $sellerid) {

        //insert query
        $attact_path_getter = mysqli_query($conn, "SELECT Path FROM notesattachment WHERE Note_ID=$noteid");

        while ($row = mysqli_fetch_assoc($attact_path_getter)) {
            $path = $row['Path'];

        $download_insert = mysqli_query($conn , "INSERT INTO downloads (NoteID,SellerID,DownloaderID,
                                        IsSellerHasAllowedDownload,AttachmentPath,IsAttachmentDownloaded,
                                        AttachmentDownloadedDate,IsPaid,PurchasedPrice,NoteTitle,NoteCategory,
                                        CreatedDate,CreatedBy,ModifiedDate,ModifiedBy) VALUES($noteid,$sellerid,$buyerid,1,'$path',1,NOW(),5,
                                        '$note_price','$note_title','$categoryname',NOW(),$buyerid,NOW(),$buyerid)");

        }
    }
}

//multiple attachement
if (isset($_POST['download_all'])) {
    $file_getter = mysqli_query($conn, "SELECT DISTINCT Note_Title FROM notes WHERE ID=$noteid");
    while ($row = mysqli_fetch_array($file_getter)) {
        $title = $row['title'];
    }
    $zipname = $title . '.zip';
    $zip = new ZipArchive;
    $zip->open($zipname, ZipArchive::CREATE);
    $query = mysqli_query($conn, "SELECT Path FROM notesattachment WHERE Note_ID=$noteid");
    while ($row = mysqli_fetch_assoc($query)) {
        $attact_id = $row['Path'];
        $zip->addFile($attact_id);
    }
    $zip->close();
    header('Content-Type: application/zip');
    header('Content-disposition: attachment; filename=' . $zipname);
    header('Content-Length: ' . filesize($zipname));
    readfile($zipname);

    $download_entry_number = mysqli_num_rows($check_download);
    if ($download_entry_number == 0 && $buyerid != $sellerid) {

        //insert query
        $attact_path_getter = mysqli_query($conn, "SELECT Path FROM notesattachment WHERE Note_ID=$noteid");

        while ($row = mysqli_fetch_assoc($attact_path_getter)) {
            $path = $row['Path'];

        $download_insert = mysqli_query($conn , "INSERT INTO downloads (NoteID,SellerID,DownloaderID,
                                        IsSellerHasAllowedDownload,AttachmentPath,IsAttachmentDownloaded,
                                        AttachmentDownloadedDate,IsPaid,PurchasedPrice,NoteTitle,NoteCategory,
                                        CreatedDate,CreatedBy,ModifiedDate,ModifiedBy) VALUES($noteid,$sellerid,$buyerid,1,'$path',1,NOW(),5,
                                        '$note_price','$note_title','$category_name',NOW(),$buyerid,NOW(),$buyerid)");

        }
    }
}

//if note is paid
if (isset($_POST['purchase_yes_box'])) {
    $download_entry_number = mysqli_num_rows($check_download);
    if ($download_entry_number == 0 && $buyerid != $sellerid) {
        //insert query
        // sleep(2);
        $attact_path_getter = mysqli_query($conn, "SELECT Path FROM notesattachment WHERE Note_ID=$noteid");

        while ($row = mysqli_fetch_assoc($attact_path_getter)) {
            $path = $row['Path'];
            $download_insert = mysqli_query($conn , "INSERT INTO downloads (NoteID,SellerID,DownloaderID,
                                            IsSellerHasAllowedDownload,AttachmentPath,IsAttachmentDownloaded,
                                            AttachmentDownloadedDate,IsPaid,PurchasedPrice,NoteTitle,NoteCategory,
                                            CreatedDate,CreatedBy,ModifiedDate,ModifiedBy) VALUES($noteid,$sellerid,$buyerid,0,'$path',0,NOW(),4,
                                            '$note_price','$note_title','$categoryname',NOW(),$buyerid,NOW(),$buyerid)");

        }

        //seller nane getter
        $seller_id_getter = mysqli_query($conn, "SELECT SellerID FROM notes WHERE ID=$noteid");
        while ($row = mysqli_fetch_assoc($seller_id_getter))
            $seller_id = $row['SellerID'];
        $seller_name_getter = mysqli_query($conn, "SELECT FirstName,LastName,EmailID FROM users WHERE ID=$seller_id");
        while ($row = mysqli_fetch_assoc($seller_name_getter)) {
            $full_name_seller = $row['FirstName'] . " " . $row['LastName'];
            $email_seller = $row['EmailID'];
        }

        //mailer
        require 'PHPMailer/Exception.php';
        require 'PHPMailer/PHPMailer.php';
        require 'PHPMailer/SMTP.php';

        $mail = new PHPMailer(true);

        try {

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = PHPMailer :: ENCRYPTION_STARTTLS;
            $mail->Port = 587;  
            $mail->Username = "axita31.khunt@gmail.com";
            $mail->Password = 'axita31khunt';

            // Sender and recipient settings
            $mail->setFrom("axita31.khunt@gmail.com", 'NotesMarketPlace');
            $mail->addAddress($email_seller, $full_name_seller);
            $mail->addReplyTo($email,  $buyer_fullname);
            $mail->IsHTML(true);
            $mail->Subject = $buyer_fullname. " wants to purchase your notes";

            $mail->Body = "Hello <br>$full_name_seller</b>,<br>
            We would like to inform you that,<b> $buyer_fullname</b> wants to purchase your notes. Please see
            Buyer Requests tab and allow download access to Buyer if you have received the payment from
            him.<br>
            Regards,<br>
            Notes Marketplace<br>";
            $mail->AltBody = '';
            $mail->send();
            $mail_sent = true;
        } catch (Exception $e) {
            echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
if (isset($_POST['no-login']))
    $login = false;

//contact_us_phone_ getter
//if systemconfiguration table has null entry
$contact_no = "91 7048600717";
$contact_us_phone_getter = mysqli_query($conn, "SELECT Value FROM system_configuration WHERE Key_info ='support_phone_no'");
while ($row = mysqli_fetch_assoc($contact_us_phone_getter))
    $contact_no = $row['Value'];
?>


<!DOCTYPE html>
<html lang="en">

<?php include 'head.php';?>

<body>
<style>
.note-details-right-part .note-single-detail-tag img{
    height: 30px;
    width: 30px;
}

</style>
    <!-- Header -->
    <div class="only-white-nav  extra-style-nav">
        <header class="site-header">
            <div class="header-wrapper">

                <!-- Mobile Menu Open Button -->
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
                                <a href="add-notes.php">Sell Your Notes</a>
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
                                    $dp_path_getter = mysqli_query($conn, "SELECT Profile_Pic FROM users_details WHERE UserID=$userid");
                                    while ($row = mysqli_fetch_assoc($dp_path_getter)) {
                                        $dp_path = $row['Profile_Pic'];
                                    }
                                    echo "
                                    <a href='#' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                        <div class='logged-in-user-photo'>
                                        <img style='height:50px;width,50px;' src='$dp_path' alt='PIC-$full_name' class='rounded-circle img-fluid'>
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

                <!-- Mobile Menu -->
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
                                <a href="add-notes.php">Sell Your Notes</a>
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
                                    $dp_path_getter = mysqli_query($conn, "SELECT Profile_Pic FROM users_details WHERE UserID=$userid");
                                    while ($row = mysqli_fetch_assoc($dp_path_getter)) {
                                        $dp_path = $row['Profile_Pic'];
                                    }
                                    echo "
                                    <a href='#' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                        <div class='logged-in-user-photo'>
                                        <img style='height:50px;width,50px;' src='$dp_path' alt='PIC-$full_name' class='rounded-circle img-fluid'>
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

    <!--- popup boxes --->
    <form action="" method="POST">
            <!-- Thanks Pop up -->
            <div id="popup">
                <div class="modal fade" id="thanks-popup-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <img src="images/notes-detail/close.png" alt="">
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="thank-img text-center">
                                    <img src="images/notes-detail/SUCCESS.png" alt="">
                                </div>
                                <p class="thank-heading">Thank you for purchasing!</p>
                                <p class="dear-buyer-name"><?php echo  $buyer_fullname; ?>,</p>
                                <p>As this is paid notes - you need to pay to seller <?php echo $full_name_seller; ?> offline. We will send him an emial that you want to download this note. He may contact you further for payment process completion.</p>
                                <p>In case, you have urgency,<br>Please contact us on <?php echo '+' . $contact_no ?>.</p>
                                <p>Once he receives the payment and acknowledgde us - selected notes you can see over my downloads tab for download.</p>
                                <p>Have a good day.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- confirm Pop up -->
            <div class="popup">
                <div style="margin-top: 200px;" class="modal fade" id="confirm-purchase-popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <img src="images/notes-detail/close.png" alt="">
                                </button>
                            </div>
                            <div style="margin-top: 20px;" class="modal-body">
                                <p class="thank-heading">Are you sure you want to download this Paid note? </p>
                                <p style="margin-top: 20px;" class="dark-font-22"> Please confirm. </p>
                                <div style="margin-top:15px;">
                                    <button type="submit" data-toggle='modal' style="margin-right: 30px;"
                                        name="purchase_yes_box"
                                        class="btn btn-purple">yes</button>
                                    <button id="purchase_no_box"
                                        class="btn btn-purple">no</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
<!---popup box end --->
   

    <div id="note-detail">

    <?php
        //to get all required infomation
        $data_fetch = mysqli_query($conn, "SELECT * FROM notes WHERE ID=$noteid");
/* 
        if($data_fetch){
            echo "select";
        }else{
            echo "not".mysqli_error($conn);
        } */
        while($row = mysqli_fetch_array($data_fetch)){
        
            $note_title = $row['Note_Title'];
            $category = $row['Category'];
            $note_dis_pic = $row['Note_Display_Picture'];
            $note_pages = $row['Note_Pages'];
            $description = $row['Description'];
            $university = $row['University'];
            $country = $row['Country'];
            $course = $row['Course'];
            $code  = $row['Course_Code'];
            $professor_name = $row['Professor_Name'];
            $sell_type = $row['Is_Paid'];
            $sell_price = $row['Price'];
            $publisheddate = $row['PublishedDate'];
            
        }

        $country_getter = mysqli_query($conn, "SELECT Country_Name FROM country WHERE ID=$country");
    
            while ($row = mysqli_fetch_assoc($country_getter)) {
                $country_name = $row['Country_Name'];
            }
    
            $category_getter = mysqli_query($conn, "SELECT Category_name FROM category WHERE ID=$category");

            while ($row = mysqli_fetch_assoc($category_getter)) {
                $category_name = $row['Category_name']; 
            }
        ?>
        <!-- note details Upper Part -->
        <div class="container">
            <div class="note-upr content-box-md">
                <!-- note details Upper left Part -->
                <p class="note-heading-1" style="margin-top:50px;">Note Details</p>
                <div class="row no-gutters">
                    <div class="note-detail-left col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="row no-gutters">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            <?php  echo "<img src='$note_dis_pic' alt='note-img' class='note-img img-fluid' > "; ?>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="note-box-details">
                                    <p class="note-name"><?php  echo $note_title; ?></p>
                                    <p class="note-type"><?php  echo $category_name; ?></p>
                                    <p class="note-desc"><?php  echo $description; ?> </p>

                                    <?php

                                    //chcker wheather user log in or not
                                    if(isset($_SESSION['email'])){

                                        //if note is paid
                                        if ($sell_type == 4) {
                                            echo " <button class='btn btn-general btn-purple' href='#' role='button' data-toggle='modal'
                                             data-target='#confirm-purchase-popup'>Download / $ $sell_price</button>";

                                        }

                                        //if note is free
                                        if ($sell_type == 5) {
                                            $attactments_getter = mysqli_query($conn, "SELECT Note_ID FROM notesattachment WHERE Note_ID=$noteid");
                                            $attact_count = mysqli_num_rows($attactments_getter);

                                            //if note has single attachement
                                            if ($attact_count <= 1) {
                                                echo "<form action='' method='POST'>";
                                                echo " <button type='submit' name='single_download' class='btn btn-general btn-purple'>download</button>";
                                                echo "</form>";
                                               
                                                //if note has multiple attachements
                                                    } else if ($attact_count > 1) {
                                        ?>
                                            <form action="" method="post">
                                                <button name='download_all' class='btn btn-general btn-purple'>download</button>
                                            </form>
                                            <?php
                                                    }
                                                }
                                            }

                                    //if user has not log-in
                                    else {
                                        echo "<form method='POST'>";
                                        echo " <button class='btn btn-general btn-purple' name='no-login'>download</button>";
                                        echo "</form>";
                                    } 
                                ?>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- note details Upper right Part -->
                    <div class="note-details-right col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="row no-gutters">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                <div class="note-details-left-part">
                                    <p class="note-single-detail-tag">Institution:</p>
                                    <p class="note-single-detail-tag">Country:</p>
                                    <p class="note-single-detail-tag">Course Name:</p>
                                    <p class="note-single-detail-tag">Course Code</p>
                                    <p class="note-single-detail-tag">Professor:</p>
                                    <p class="note-single-detail-tag">Number Of Pages:</p>
                                    <p class="note-single-detail-tag">Approved Date:</p>
                                    <p class="note-single-detail-tag">Rating:</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                <div class="note-details-right-part">
                                <p class="note-single-detail-tag"><?php echo (!empty($university) && $university != '') ? $university : '-' ?></p>
                                    <p class="note-single-detail-tag"><?php echo (!empty($country_name) && $country_name != '') ? $country_name : '-' ?></p>
                                    <p class="note-single-detail-tag"><?php echo (!empty($course) && $course) ? $course : '-' ?></p>
                                    <p class="note-single-detail-tag"><?php echo (!empty($code) && $code != '') ? $code : '-' ?></p>
                                    <p class="note-single-detail-tag"><?php echo (!empty($professor_name) && $professor_name != '') ? $professor_name : '-' ?></p>
                                    <p class="note-single-detail-tag"><?php echo $note_pages ?></p>
                                    <p class="note-single-detail-tag"><?php echo date('D,d F Y', strtotime($publisheddate)); ?></p>
                                   
                                    <span>
                                            <?php
                                                $star_rating = mysqli_query($conn, "SELECT AVG(ratings),COUNT(ratings) FROM sellernotesreviews WHERE NoteID=$noteid");
                                                while ($row = mysqli_fetch_assoc($star_rating)) {
                                                    $star_rating_val = $row['AVG(ratings)'];
                                                    $star_rating_count = $row['COUNT(ratings)'];
                                                }
                                                if ($star_rating_count > 0) { ?>
                                              
                                                <p class="note-single-detail-tag">
                                                    <span>
                                                        <?php
                                                        for ($i = 0; $i < $star_rating_val; $i++) {
                                                            echo "<img src='images/notes-detail/star.png'>";
                                                        }
                                                        for ($j = 0; $j < (5 - $star_rating_val); $j++) {
                                                            echo "<img src='images/notes-detail/star-white.png'>";
                                                        }
                                                        ?>
                                                    </span><?php echo $star_rating_count ?> Reviews
                                                 </p>
                                                <?php  } else { ?>
                                                <div>
                                                    <p>No ratings Yet!</p>
                                                    <p class="first-reviewer">(be the first to review it!)</p>
                                                </div>
                                                <?php   }  ?>
                                        </span>
                                </div>
                            </div>
                            <div>
                                <?php
                                $inappropriate = mysqli_query($conn, "SELECT COUNT(1) FROM sellernotesreportedissues WHERE NoteID=$noteid");
                                while ($row = mysqli_fetch_assoc($inappropriate))
                                    $inappropriate_count = $row['COUNT(1)'];
                                if ($inappropriate_count > 0) { ?>
                                    <p class="note-red-text"><?php echo $inappropriate_count ?> User(s) marked this note as inappropriate</p>
                                <?php }  ?>                      
                           </div>
                    </div>
                    <!-- note details Upper right Part End -->
                </div>
            </div>
        </div>
        <!-- note details Upper Part End -->

        <div class="notes-detail-border-bottom"></div>

        <!-- note details lower Part  -->
        <div class="container">
            <div class="content-box-lg">
                <div class="row no-gutters">
                    <div class="col-lg-5 col-md-5 col-sm-12 col-12">
                        <div class="note-preview-box">
                            <p class="note-heading">Note Preview</p>
                            <?php $notes_preview_getter = mysqli_query($conn, "SELECT AttachmentPath FROM downloads WHERE NoteID=$noteid");
                                while ($row = mysqli_fetch_assoc($notes_preview_getter))
                                    $preview_path = $row['AttachmentPath'];
                            ?>
                            <?php
                            if ($preview_path != null) {
                                echo "<iframe src='{$preview_path}'></iframe>";
                            } else {
                                echo "<p>No preview available</p>";
                            }
                            ?>
                        </div>
                    </div>
        
                    <div class="col-lg-7 col-md-7 col-sm-12 col-12">
                        <div class="customer-review-box">
                            <p class="note-heading">Customer Review</p>

                            <?php

                            //count decider
                            $review_decide = mysqli_query($conn, "SELECT * FROM sellernotesreviews WHERE NoteID=$noteid");
                           
                            if (mysqli_num_rows($review_decide) > 0) {

                                //if has review it will execute this block
                                $rate_counter = 1;
                                $review_getter = mysqli_query($conn, "SELECT users.FirstName,users.Lastname,sellernotesreviews.ratings,sellernotesreviews.Comments,users_details.Profile_Pic 
                                FROM users LEFT JOIN sellernotesreviews ON users.ID=sellernotesreviews.ReviewedByID LEFT JOIN users_details ON users_details.ID=sellernotesreviews.ReviewedByID 
                                WHERE NoteID=$noteid");

                                while ($row = mysqli_fetch_assoc($review_getter)) {
                                    $rate_counter++;
                                    $full_name = $row['FirstName'] . " " . $row['Lastname'];
                                    $rate_val = $row['ratings'];
                                    $rate_cmnt = $row['Comments'];
                                    $member_pic = $row['Profile_Pic'];
                                    $review_count = mysqli_num_rows($review_getter);
                            ?>
                            
                            <div class="customer-review-detail-box">
                                <div class="customer-review-detail">
                                        <div class="row no-gutters">
                                        <?php if ($review_count > 0) { ?>
                                            <div class="col-lg-2 col-md-3 col-sm-2 col-12">
                                                <!-- Profile-pic -->
                                                <?php if (empty($member_pic)) { ?>
                                                <img src="../Members/default/PP_default.jpg"
                                                    title="The honest review by our customers <?php echo $full_name ?>"
                                                    class="reviewer-img" alt="Customer Photo <?php echo $full_name ?>">
                                                <?php } ?>
                                                <?php if ($member_pic != "") { ?>
                                                <img src="<?php echo $member_pic ?>" title="The honest review by our customers <?php echo $full_name ?>"
                                                class="reviewer-img" alt="Customer Photo <?php echo $full_name ?>">
                                                <?php } ?>                                        
                                            </div>
                                            <div class="col-lg-10 col-md-9 col-sm-10 col-12">
                                                <p class="reviewer-name"><?php echo $full_name ?></p>
                                                <p class="reviewer-rating">
                                                    <span>
                                                    <?php
                                                            for ($i = 0; $i < $rate_val; $i++) {
                                                                echo "<img src='images/notes-detail/star.png'>";
                                                            }
                                                            for ($j = 0; $j < (5 - $rate_val); $j++) {
                                                                echo "<img src='images/notes-detail/star-white.png'>";
                                                            }
                                                        ?>
                                                    </span>                                                 
                                                </p>
                                                <p class="reviewer-text"><?php echo $rate_cmnt ;?> </p>
                                            </div>
                                         </div>

                                <div class="customer-review-detail-border-bottom"></div>
                                <?php  } ?>
                            </div>
                            <?php
                                    }
                                } else {
                                    echo "<p>No reviews.</p>";
                                ?>
                                
                                <?php } ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- note details lower Part End -->
        
       


    <!-- Footer-->
        <?php include 'footer.php'; ?>
    <!-- Footer End-->


    <!-- Popper Js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>

    <!-- JQuery -->
    <script src="js/jquery.min.js"></script>
      <!-- log-in failed -->
    <?php if (!$login) { ?>
    <script>
        alert(
            "Please sign in/register to download '<?php echo $note_title ?>' note\npressing OK you will be redirect to login page"
        );
        window.location.replace("login.php");
    </script>
    <?php } ?>

    <!-- Bootstrap JS -->
    <script src="js/bootstrap/bootstrap.min.js"></script>

      <!-- retyo star JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
    <script>
    $("#rating").rateYo({
        length: 5,
        spacing: "0px",
        starHeight: 3,
        colorFront: 'yellow',
        enabled: false,
        value: '<?php echo $star_rating_val ?>',
    })    
    </script>

    <script>
    <?php
        if ($mail_sent) { ?>
    $("#confirm-purchase-popup").modal('hide');
    $("#thanks-popup-model").modal('show');
    <?php } ?>
    </script>

    <!-- Custom JS -->
    <script src="js/script.js"></script>

</body>

</html>