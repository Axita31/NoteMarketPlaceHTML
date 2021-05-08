<?php

include "db.php";
session_start();

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

$login = true;
if (isset($_SESSION['email']))
    $email_buyer = $_SESSION['email'];
else
    $login = false;


//downloader id
$buyer_id_fetch = mysqli_query($conn, "SELECT ID,FirstName,LastName FROM users WHERE EmailID='$email_buyer'");
while ($row = mysqli_fetch_assoc($buyer_id_fetch)) {
    $buyer_id = $row['ID'];
    $full_name_reporter = $row['FirstName'] . " " . $row['LastName']; 
}

//for downloading
if (isset($_GET['NoteID'])) {
    $noteid = $_GET['NoteID'];
    $download_query = mysqli_query($conn, "SELECT NoteTitle, AttachmentPath FROM downloads WHERE NoteID=$noteid AND DownloaderID=$buyer_id");

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

            $attached_downloaded = mysqli_query($conn, "UPDATE downloads SET IsSellerHasAllowedDownload=1,AttachmentDownloadedDate=NOW() WHERE NoteID=$noteid AND DownloaderID=$buyer_id");
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

            $attached_downloaded = mysqli_query($conn, "UPDATE downloads SET IsAttachmentDownloaded=1,AttachmentDownloadedDate=NOW() WHERE NoteID=$noteid AND DownloaderID=$buyer_id");
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<?php include 'head.php';?>

<style>
    
.rateyo{
    text-align: center;
    font-size: 20px;
}

</style>

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
                                        <a class="dropdown-item " href="user-profile.php">My Profile</a>
                                        <a class="dropdown-item active" href="my-downloads.php">My Downloads</a>
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
                                        <a class="dropdown-item " href="user-profile.php">My Profile</a>
                                        <a class="dropdown-item active" href="my-downloads.php">My Downloads</a>
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
    <?php
    //review pop up
        if (isset($_POST['submit'])) {
            $comments = $_POST['comments'];
            $rating = $_POST['rating'];
            $noteid = $_POST['noteid_for_review'];

            $seller_id_getter = mysqli_query($conn, "SELECT ID FROM Downloads WHERE NoteID=$noteid");
          
            while ($row = mysqli_fetch_assoc($seller_id_getter))
                $sellerid = $row['ID'];

            $exist_review = mysqli_query($conn, "SELECT COUNT(ID) FROM sellernotesreviews WHERE ReviewedByID=$buyer_id
             AND NoteID=$noteid");
            while ($row = mysqli_fetch_assoc($exist_review))
            $count_review = $row['COUNT(ID)'];
            
            if ($count_review == 0)
            $ratting_getter = mysqli_query($conn, "INSERT INTO sellernotesreviews(NoteID,ReviewedByID,againstdownloadID,
            ratings,Comments,CreatedDate,CreatedBy,ModifiedDate,ModifiedBy,IsActive) 
            VALUES($noteid,$buyer_id,$sellerid,$rating,'$comments',NOW(),$buyer_id,NOW(),$buyer_id,1)");
           
        }
    
    ?>

    <!-- Download popup -->
    <!-- Modal -->
    <div id="download-popup">
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <img src="images/notes-detail/close.png" alt="">
                        </button>
                    </div>
                    <div class="modal-body">
                    <form action="#" method="post">
                        <p class="add-review-heading">Add Review</p>

                        <div class="add-reviews-stars text-center">
                            <div class="rateyo text-center" id= "rating"
                                data-rateyo-rating="1"
                                data-rateyo-num-stars="5"
                                data-rateyo-score="3">
                            </div>
                        
                            <span class='result'>0</span>
                            <input type="hidden" name="rating">
                        </div>
                        <input name="noteid_for_review" id="noteid_for_review" type="hidden">

                        <div class="form-group">
                            <label class="info-label" for="comment-questions">Comments *</label>
                            <textarea class="form-control input-box-style" id="" name="comments" placeholder="Comments..." required></textarea>
                        </div>

                        <div class="form-btn">
                            <button type="submit" class="btn btn-general btn-purple" name="submit">Submit</button>
                            <button type="submit" class="btn btn-general btn-purple" onclick="window.location.href='my-downloads.php' ">Cancel</button>
                        </div>
                        <p  style="font-size:18px;margin-top:20px;color:#6255a5;margin-top:20px;margin-bottom:10px;" class="add-review-heading">(you can remarks it only once!)</p>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- review  popup end -->

    <!-- My-downloads  part-->
    <div id="my-downloads">
        <div class="content-box-lg">
            <div class="container">
                <form action="my-downloads.php" method="post">
                    <div class="row no-gutters all-notes">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12 text-left box-heading-wrapper">
                            <p class="download-heading">My Downloads</p>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="row no-gutters text-right general-search-bar-btn-wrapper">
                                <div class="form-group has-search">
                                    <span class="fa fa-search form-control-feedback"></span>
                                    <input type="text" name="search_result" class="form-control search-bar" placeholder="Search">
                                </div>
                                <button name="search" class="btn btn-general btn-purple progress-btn">Search</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!--My-download table-->
            <div class="container">

                <div class="my-downloads-table general-table-responsive">
                    <div class="table-responsive-xl">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">sr no.</th>
                                    <th scope="col">Note title</th>
                                    <th scope="col">category</th>
                                    <th scope="col">Buyer</th>
                                    <th scope="col">Sell type</th>
                                    <th scope="col">price</th>
                                    <th scope="col">downloaded time</th>
                                    <th scope="col" width="80px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php     
                            
                            $limit = 8;

                                if (isset($_GET["page"])) {
                                    $page  = $_GET["page"];
                                } else {
                                    $page = 1;
                                };
                                $start_from = ($page - 1) * $limit;
                                //search button
                                if (isset($_POST['search'])) {
                                    $search_result = $_POST['search_result'];

                                    //main query
                                    $query = "SELECT DISTINCT downloads.NoteID,downloads.DownloaderID,downloads.NoteTitle,downloads.
                                                        NoteCategory,users.EmailID,downloads.IsPaid,downloads.IsSellerHasAllowedDownload,
                                                        downloads.PurchasedPrice,downloads.AttachmentDownloadedDate FROM downloads 
                                                        LEFT JOIN users ON downloads.DownloaderID=users.ID  LEFT JOIN referencedata 
                                                        ON downloads.IsPaid=referencedata.ID 
                                                        WHERE IsSellerHasAllowedDownload=1 AND DownloaderID=$buyer_id AND 
                                                        (NoteTitle LIKE '%$search_result%' OR NoteCategory LIKE '%$search_result%' 
                                                        OR users.EmailID LIKE '%$search_result%' OR referencedata.Value LIKE '%$search_result%' 
                                                        OR PurchasedPrice LIKE '%$search_result%')LIMIT $start_from,$limit";

                                    $result = mysqli_query($conn,$query);
                                
                                    $result_num= mysqli_query($conn,"SELECT COUNT(downloads.ID) FROM downloads 
                                                        LEFT JOIN users ON downloads.DownloaderID=users.ID  LEFT JOIN referencedata 
                                                        ON downloads.IsPaid=referencedata.ID 
                                                        WHERE IsSellerHasAllowedDownload=1 AND DownloaderID=$buyer_id AND 
                                                        (NoteTitle LIKE '%$search_result%' OR NoteCategory LIKE '%$search_result%' 
                                                        OR users.EmailID LIKE '%$search_result%' OR referencedata.Value LIKE '%$search_result%' 
                                                        OR PurchasedPrice LIKE '%$search_result%')LIMIT $start_from,$limit");

                                    $row = mysqli_fetch_row($result_num);
                                    $total_records = $row[0];
                                    //echo $total_records;
                                    $total_page = ceil($total_records / $limit);
                                // echo $total_page;
                                }else{
                                    $query = "SELECT DISTINCT downloads.NoteID,downloads.DownloaderID,downloads.NoteTitle,downloads.
                                                        NoteCategory,users.EmailID,downloads.IsPaid,downloads.IsSellerHasAllowedDownload,
                                                        downloads.PurchasedPrice,downloads.AttachmentDownloadedDate FROM downloads 
                                                        LEFT JOIN users ON downloads.DownloaderID=users.ID  LEFT JOIN referencedata 
                                                        ON downloads.IsPaid=referencedata.ID 
                                                        WHERE IsSellerHasAllowedDownload=1 AND DownloaderID=$buyer_id LIMIT $start_from,$limit";

                                    $result = mysqli_query($conn,$query);


                                    $result_num= mysqli_query($conn,"SELECT COUNT(downloads.ID) FROM downloads 
                                                LEFT JOIN users ON downloads.DownloaderID=users.ID  LEFT JOIN referencedata 
                                                ON downloads.IsPaid=referencedata.ID 
                                                WHERE IsSellerHasAllowedDownload=1 AND DownloaderID=$buyer_id");

                                    $row = mysqli_fetch_row($result_num);
                                    $total_records = $row[0];
                                    $total_page = ceil($total_records / $limit);
                                    //echo $total_page;

                                }

                            $data = mysqli_query($conn, $query);
                            $sr_no = 1;
                                
                            if($page <= 0 or $page > $total_page){
                                echo "<tr><td colspan ='8' style ='text-align:center ;'> No Records Found </td></tr>";
                            }else{
                                
                                while ($row = mysqli_fetch_assoc($data)) {
                            
                                $seller_id = $row['DownloaderID'];
                                $noteid = $row['NoteID'];
                                $notetitle = $row['NoteTitle'];
                                $notecategory = $row['NoteCategory'];
                                $emailid_seller = $row['EmailID'];
                                $ispaid = $row['IsPaid'];
                                $purchasedprice = $row['PurchasedPrice'];
                                $createddate = $row['AttachmentDownloadedDate'];
                            ?>
                                <tr>
                                    <td><?php echo $sr_no ?></td>
                                    <td><a class="purple-td" title="click to view <?php echo $notetitle ?>" href="note-details.php?id=<?php echo $noteid ?>"><?php echo $notetitle ?></a>
                                    </td>
                                    <td><?php echo $notecategory ?></td>
                                    <td><?php echo $emailid_seller ?></td>
                                    <td><?php if ($ispaid == 5) echo "Free";
                                        else if ($ispaid == 4) echo "Paid" ?></td>
                                    <td><?php if ($ispaid == 5) echo "&#36;0";
                                        else if ($ispaid == 4) echo "&#36;" . $purchasedprice ?></td>
                                    <td><?php echo date("d-m-y, H:i", strtotime($createddate)); ?></td>
                                    
                                    <td class="text-center visible-overflow-for-dropdown">
                                        <a href="note-details.php?id=<?php echo $noteid ?>">
                                            <img class="eye-img-in-table" src="images/Dashboard/eye.png" alt="view"></a>

                                        <div class="dropdown dropdown-dots-table">
                                            <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <img class="dots-in-table" src="images/Dashboard/dots.png" alt="edit">
                                            </a>

                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <li><a href="my-downloads.php?NoteID=<?php echo $noteid; ?>">
                                                <a role="button" class="dropdown-item" href="my-downloads.php?NoteID=<?php echo $noteid; ?>">Download Note</a>
                                                
                                                <a role="button" class="dropdown-item" data-id="<?php echo $noteid; ?>" id="add-review-star" href="#" data-toggle="modal" data-target="#exampleModal">Add Reviews / Feedback</a>
                                                
                                                <a role="button"  data-toggle="modal" data-note_title="<?php echo $notetitle ?>" data-id="<?php echo $noteid ?>" data-sellerid="<?php echo $seller_id ?>" data-target="#mark-as-inappropriate" id="inappropriate" class="dropdown-item" href="#">Report as Inappropriate</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                                $sr_no++;
                            }
                            }                   
                            ?>
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- pagination -->
           <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                 <?php
                
                echo "<li class='page-item'><a class='page-link' href='my-downloads.php?page=" . ($page - 1)
                    . "'> <img src='images/pagination/left-arrow.png' alt='previous'> </a></li>";
                
                
                for ($i = 1; $i <= $total_page; $i++) {
                    if ($i == $page) {
                        echo "<li class='page-item active '><a class='page-link' href='my-downloads.php?page=$i'>$i</a></li>";
                    } else echo "<li class='page-item'><a class='page-link' href='my-downloads.php?page=$i'>$i</a></li>";
                }
                echo "<li class='page-item'><a class='page-link' href='my-downloads.php?page=" . ($page + 1)
                    . "'> <img style='color: white;' src='images/pagination/right-arrow.png' alt='next'> </a></li>";
                ?>
            </ul>
        </nav>
        <!-- pagination -->
           
    <!--inappropiate popup--->
    <?php
      
        //mark as an inappropriate pop up
            if (isset($_POST['inappropriate_submit'])) {

                $noteid_inappropriate = $_POST['inappropriate_noteid'];
                $remark_inappropriate = $_POST['inappropriate_review'];

                $seller = mysqli_query($conn, "SELECT ID FROM Downloads WHERE NoteID=$noteid_inappropriate");
                
                while ($row = mysqli_fetch_assoc($seller))
                $sellerid_inappropriate = $row['ID'];
                

                $exist_inappropriate = mysqli_query($conn, "SELECT COUNT(1),ID FROM sellernotesreportedissues WHERE Reportedbyid=$buyer_id AND NoteID=$noteid_inappropriate");
               // echo $exist_inappropriate;

                while ($row = mysqli_fetch_assoc($exist_inappropriate))
                    $count_inappropriate = $row['COUNT(1)'];

                if ($count_inappropriate == 0) {
                    $report_query = mysqli_query($conn, "INSERT INTO sellernotesreportedissues(NoteID,Reportedbyid,againstDownloadID,Remarks,CreatedDate,CreatedBy,IsActive) 
                    VALUES($noteid_inappropriate,$buyer_id,$sellerid_inappropriate,'$remark_inappropriate',NOW(),$buyer_id,1)");
               
                    $title_selector = mysqli_query($conn, "SELECT Note_Title,FirstName,LastName,users.EmailID FROM 
                    notes LEFT JOIN  users ON users.ID=notes.SellerID WHERE notes.ID=$noteid_inappropriate");

                    while ($row = mysqli_fetch_assoc($title_selector)) {
                        $title_inappropriate = $row['Note_Title'];
                        $full_name_reporter_againts = $row['FirstName'] . " " . $row['LastName'];
                        $reporter_email = $row['EmailID'];
                    }
                    //mailer
                    require 'PHPMailer/Exception.php';
                    require 'PHPMailer/PHPMailer.php';
                    require 'PHPMailer/SMTP.php';

                    $mail = new PHPMailer(true);

                    try{
                        $mail->isSMTP();
                        $mail->Host = 'smtp.gmail.com';
                        $mail->SMTPAuth = true;
                        $mail->SMTPSecure = PHPMailer :: ENCRYPTION_STARTTLS;
                        $mail->Port = 587;  
                        $mail->Username = "axita31.khunt@gmail.com";
                        $mail->Password = 'axita31khunt';

                        // Sender and recipient settings
                        $mail->setFrom("axita31.khunt@gmail.com", 'NotesMarketPlace');
                        $mail->addAddress($reporter_email, "NotesMarketPlace");
                        $mail->addReplyTo("axita31.khunt@gmail.com", $full_name_reporter);
                        //$mail->addAddress("axita31.khunt@gmail.com");
                        $mail->IsHTML(true);
                        $mail->Subject = $full_name_reporter . "  Reported an issue for " . $title_inappropriate;

                        $mail->Body = "Hello Admins, We want to inform you that,<b>$full_name_reporter</b> Reported an 
                        issue for <b>$full_name_reporter_againts</b><b>’s</b> Note with
                        title <b>$title_inappropriate</b>. Please look at the notes and take required actions.<br>
                        <b>Regards,</b><br>
                        <b>Notes Marketplace</b>";
                        $mail->AltBody = '';
                        $mail->send();
                    } catch (Exception $e) {
                        echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
                    }
                }
            }
            
    ?>
    
    <div id="download-popup">
        <div class="modal fade" id="mark-as-inappropriate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <img src="images/notes-detail/close.png" alt="">
                        </button>
                    </div>
                    <div class="modal-body">
                    <form action="" method="post">
                        <p class="add-review-heading" id="title_for_inappropriate"></p>
                        
                        <div class="form-group">
                            <label class="info-label" for="comment-questions">Remarks *</label>
                            <textarea class="form-control input-box-style" id="" name="inappropriate_review" placeholder="Remarks..." required></textarea>
                        </div>
                        
                        <input id="note_id_inappropriate" name="inappropriate_noteid" type="hidden">
                        <!-- <input id="note_seller_inappropriate" name="inappropriate_seller" type="hidden"> -->
                        <div class="form-btn">
                            <button type="submit" class="btn btn-general btn-purple" name="inappropriate_submit">Submit</button>
                            <button class="btn btn-general btn-purple" onclick="window.location.href='my-downloads.php' " >cancel</button>
                        </div>
                        <p  style="font-size:18px;margin-top:20px;color:#6255a5;margin-top:20px;margin-bottom:10px;" class="add-review-heading" id="title_for_inappropriate">(you can review it only once!)</p>

                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--inappropiate popup end--->
        </div>
    </div>
    <!-- My-downloads  part end-->




    <!-- Footer-->
    <?php include 'footer.php'; ?>
    <!-- Footer End-->


    <!-- Popper Js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>

    <!-- JQuery -->
    <script src="js/jquery.min.js"></script>
    
    <script>
        $(function() {

            //note id getter via data id
            $(document).on("click", "#add-review-star", function() {
                $('#noteid_for_review').val($(this).data('id'));
                $('#exampleModal').modal('show');
            });

            //note title getter via data id
            $(document).on("click", "#inappropriate", function() {
                $("#title_for_inappropriate").text($(this).data('note_title'));
                $("#note_id_inappropriate").val($(this).data('id'));
                $("#note_seller_inappropriate").val($(this).data('sellerid'));
                $("#mark-as-inappropriate").modal('show');
            })
        });
    </script>


    <!-- Bootstrap JS -->
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <!-- retyo star JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
    <script>
    $("#rating").rateYo({
                rating: 1.5,
                spacing: "10px",
                numStars: 5,
                minValue: 0,
                maxValue: 5,
                normalFill: 'gray',
                ratedFill: 'orange',
    
            })
    $(function () {
        $(".rateyo").rateYo().on("rateyo.change", function (e, data) {
            var rating = data.rating;
            $(this).parent().find('.score').text('score :'+ $(this).attr('data-rateyo-score'));
            $(this).parent().find('.result').text('rating :'+ rating);
            $(this).parent().find('input[name=rating]').val(rating); //add rating value to input field
        });
    });
    </script>

    <!-- Custom JS -->
    <script src="js/script.js"></script>

</body>

</html>