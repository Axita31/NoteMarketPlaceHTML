<?php 
include 'db.php';
session_start();

//isallowed
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

$login = true;
if (isset($_SESSION['email']))
    $s_email = $_SESSION['email'];
else
    $login = false;

//get seller id
$get_seller = mysqli_query($conn, "SELECT ID,FirstName,LastName FROM users WHERE EmailID='$s_email'");

while ($row = mysqli_fetch_assoc($get_seller)){
    $seller_id = $row['ID'];
    $fname = $row['FirstName'] ;
}

// alloweddownload
if (isset($_GET['ID'])) {
    $note_allow = $_GET['ID'];
    $download_allow = $_GET['DownloaderID'];
    $allow_download = mysqli_query($conn, "UPDATE downloads SET IsSellerHasAllowedDownload=1,AttachmentDownloadedDate=NOW() 
                             WHERE NoteID=$note_allow AND DownloaderID=$download_allow");

    //get buyer
    $get_buyer = mysqli_query($conn, "SELECT FirstName,LastName,EmailID FROM users WHERE ID=$download_allow");
    while ($row = mysqli_fetch_assoc($get_buyer)) {
        $buyer_fname = $row['FirstName'] ;
        $email_buyer = $row['EmailID'];
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
        $mail->addAddress($email_buyer);
        $mail->addReplyTo($email_buyer, $fname);
        $mail->IsHTML(true);
        $mail->Subject = $fname . " Allows you to download a note";

        $mail->Body = "Hello <b>$buyer_fname</b>,<br>
        We would like to inform you that,<b>$fname</b> Allows you to download a note.
        Please login and see My Download tabs to download particular note.<br>
        <b>Regards,<br>
        Notes Marketplace</b>";
        $mail->AltBody = '';
        $mail->send();
    } catch (Exception $e) {
        echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
    }
    header("Location:buyer-request.php");

}

?>


<!DOCTYPE html>
<html lang="en">

<?php include 'head.php';?>

<!--pagination css -->
<style>
    .page-item.active .page-link {
    z-index: 3;
    color: #fff;
    background-color: #6255a5;
    border-color: #6255a5;
}

</style>
<body>

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
                                <a href="Dashboard-1.php">Sell Your Notes</a>
                            </li>
                            <li class="active">
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
                    <img src="images/logo/dark-logo.png" alt="Logo" style="margin-top: 30px;margin-left: 30px">
                    <!-- Mobile Menu Close Button -->
                    <span id="mobile-nav-close-btn">&times;</span>

                    <div id="mobile-nav-content">
                        <ul class="nav">
                            <li>
                                <a href="search-notes.php">Search Notes</a>
                            </li>
                            <li>
                                <a href="Dashboard-1.php">Sell Your Notes</a>
                            </li>
                            <li class="active">
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

    <!-- buyer request  part-->
    <div id="buyer-requests">
        <div class="content-box-lg">
            <form action="buyer-request.php" method="POST">
                <div class="container">
                    <div class="row no-gutters">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12 text-left box-heading-wrapper">
                            <p class="download-heading">Buyer Request</p>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12 buyer-part">
                            <div class="row no-gutters text-right general-search-bar-btn-wrapper">
                                <div class="form-group has-search">
                                    <span class="fa fa-search form-control-feedback"></span>
                                    <input type="text" name="search-result" class="form-control search-bar" placeholder="Search">
                                </div>
                                <button name="search" class="btn btn-general btn-purple progress-btn">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <!--My-sold-note table-->
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
                                    <th scope="col">Phone no.</th>
                                    <th scope="col">Sell type</th>
                                    <th scope="col">price</th>
                                    <th scope="col">downloaded date/time</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php

                                $limit = 5;

                                if (isset($_GET["page"])) {
                                $page  = $_GET["page"];
                                } else {
                                $page = 1;
                                };

                                $start_from = ($page - 1) * $limit;
                                if (isset($_POST['search'])) {

                                $search_result = $_POST['search-result'];

                                $query = "SELECT DISTINCT downloads.NoteID,downloads.DownloaderID,downloads.NoteTitle,downloads.NoteCategory,users.EmailID,users_details.Phone_No,downloads.IsPaid,downloads.PurchasedPrice,downloads.AttachmentDownloadedDate,country.Country_Code FROM downloads 
                                LEFT JOIN referencedata ON downloads.IsPaid=referencedata.ID 
                                LEFT JOIN users ON downloads.DownloaderID=users.ID 
                                LEFT JOIN users_details ON users_details.UserID=downloads.DownloaderID
                                LEFT JOIN country ON users_details.Country=country.ID 
                                WHERE downloads.NoteTitle LIKE '%$search_result%' OR downloads.NoteCategory LIKE '%$search_result%' OR users.EmailID LIKE 
                                '%$search_result%'  OR users_details.Phone_No LIKE '%$search_result%' OR referencedata.Value LIKE '%$search_result%' OR downloads.PurchasedPrice LIKE '%$search_result%' 
                                AND downloads.IsPaid=4 AND SellerID= $seller_id  AND IsSellerHasAllowedDownload=0 LIMIT $start_from,$limit";	
                                $result = mysqli_query($conn, $query);

                                $result_num = mysqli_query($conn, "SELECT COUNT(downloads.ID) FROM downloads 
                                                LEFT JOIN referencedata ON downloads.IsPaid=referencedata.ID 
                                                LEFT JOIN users ON downloads.DownloaderID=users.ID 
                                                LEFT JOIN users_details ON users_details.UserID=downloads.DownloaderID
                                                LEFT JOIN country ON users_details.Country=country.ID 
                                                WHERE downloads.NoteTitle LIKE '%$search_result%' OR downloads.NoteCategory LIKE '%$search_result%' OR users.EmailID LIKE 
                                                '%$search_result%'  OR users_details.Phone_No LIKE '%$search_result%' OR referencedata.Value LIKE '%$search_result%' OR downloads.PurchasedPrice LIKE '%$search_result%' 
                                                AND downloads.IsPaid=4 AND SellerID= $seller_id  AND IsSellerHasAllowedDownload=0 LIMIT $start_from,$limit");	

                                $row = mysqli_fetch_row($result_num);
                                $total_records = $row[0];
                                $total_pages = ceil($total_records / $limit);
                                    

                                } else {

                                    $query = "SELECT DISTINCT downloads.NoteID,downloads.DownloaderID,downloads.NoteTitle,downloads.NoteCategory,users.EmailID,users_details.Phone_No,downloads.IsPaid,downloads.PurchasedPrice,downloads.AttachmentDownloadedDate,country.Country_Code FROM downloads 
                                    LEFT JOIN referencedata ON downloads.IsPaid=referencedata.ID 
                                    LEFT JOIN users ON downloads.DownloaderID=users.ID 
                                    LEFT JOIN users_details ON users_details.UserID=downloads.DownloaderID
                                    LEFT JOIN country ON users_details.Country=country.ID 
                                    WHERE downloads.IsPaid=4 AND SellerID= $seller_id  AND IsSellerHasAllowedDownload=0  LIMIT $start_from,$limit";	
                                    
                                    $result = mysqli_query($conn, $query);

                                    $result_num = mysqli_query($conn, "SELECT COUNT(downloads.ID) FROM downloads 
                                                    LEFT JOIN referencedata ON downloads.IsPaid=referencedata.ID 
                                                    LEFT JOIN users ON downloads.DownloaderID=users.ID 
                                                    LEFT JOIN users_details ON users_details.UserID=downloads.DownloaderID
                                                    LEFT JOIN country ON users_details.Country=country.ID 
                                                    WHERE  downloads.IsPaid=4 AND SellerID= $seller_id  AND IsSellerHasAllowedDownload=0");	

                                    $row = mysqli_fetch_row($result_num);
                                    $total_records = $row[0];
                                    $total_pages = ceil($total_records / $limit);
                                        

                                }

                            $i = 1;
                            if($page <= 0 or $page > $total_pages){
                                echo "<tr><td colspan ='9' style ='text-align:center ;'> No Records Found </td></tr>";
                            }else{
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $noteid = $row['NoteID'];
                                    $downloader = $row['DownloaderID'];
                                    $title = $row['NoteTitle'];
                                    $category = $row['NoteCategory'];
                                    $email = $row['EmailID'];
                                    $phone = $row['Phone_No'];
                                    $type = $row['IsPaid'];
                                    $type == 4 ? $type = "Paid" : $type = "Free";
                                    $price = $row['PurchasedPrice'];
                                    $time = $row['AttachmentDownloadedDate'];
                                    echo " 
                                        <tr>
                                            <td>" . $i++ . "</td>
                                            <td class='purple-td'>$title</td>
                                            <td>$category</td>
                                            <td>$email</td>
                                            <td>$phone</td>
                                            <td>$type</td>
                                            <td>&#36;$price</td>
                                            <td>$time</td>
                                            <td class='text-center visible-overflow-for-dropdown'>
                                            <a href='note-details.php?id=$noteid'>
                                            <img class='eye-img-in-table' src='images/Dashboard/eye.png' alt='view'></a>

                                            <div class='dropdown dropdown-dots-table'>
                                                <a href='allowdownload.php' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                    <img class='dots-in-table' src='images/Dashboard/dots.png' alt='edit'>
                                                </a>

                                                <div class='dropdown-menu' aria-labelledby='dropdownMenuLink'>
                                                    <a class='dropdown-item' href='buyer-request.php?ID=$noteid&DownloaderID= $downloader'>Allow Download</a>
                                                </div>
                                            </div>
                                        </td>
                                        </tr>";
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
                echo "<li class='page-item'><a class='page-link' href='buyer-request.php?page=" . ($page - 1)
                    . "'> <img src='images/pagination/left-arrow.png' alt='previous'> </a></li>";
                for ($i = 1; $i <= $total_pages; $i++) {
                    if ($i == $page) {
                        echo "<li class='page-item active '><a class='page-link' href='buyer-request.php?page=$i'>$i</a></li>";
                    } else echo "<li class='page-item'><a class='page-link' href='buyer-request.php?page=$i'>$i</a></li>";
                }
                echo "<li class='page-item'><a class='page-link' href='buyer-request.php?page=" . ($page + 1)
                    . "'> <img style='color: white;' src='images/pagination/right-arrow.png' alt='next'> </a></li>";
                ?>
            </ul>
        </nav>
        <!-- pagination -->
        </div>
    </div>
    <!-- buyer-request  part end-->

    <!-- Footer-->
        <?php include 'footer.php'; ?>
    <!-- Footer End-->

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