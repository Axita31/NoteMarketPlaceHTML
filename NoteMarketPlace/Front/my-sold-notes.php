<?php
include "db.php";
session_start();

$login = true;
if (isset($_SESSION['email']))
    $seller_email = $_SESSION['email'];
else
    $login = false;

//seller id getter
$seller_getter = mysqli_query($conn, "SELECT ID FROM users WHERE EmailID='$seller_email'");

while ($row = mysqli_fetch_assoc($seller_getter))
    $seller_id = $row['ID'];

//downloading mechanisum
if (isset($_GET['Note_ID'])) {
    $noteid = $_GET['Note_ID'];
   // $note_title = $_GET['NoteTitle'];

    $download_query = mysqli_query($conn, "SELECT Path FROM notesattachment WHERE Note_ID=$noteid");
    while ($row = mysqli_fetch_assoc($download_query)) {

        $note_path = $row['Path'];
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

//search button
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

    $query_sold_note = "SELECT DISTINCT downloads.NoteID,downloads.NoteTitle,downloads.NoteCategory,users.EmailID,downloads.IsPaid,
    downloads.PurchasedPrice,downloads.ModifiedDate,downloads.DownloaderID FROM downloads LEFT JOIN users ON downloads.DownloaderID=users.ID LEFT JOIN 
    referencedata ON downloads.IsPaid=referencedata.ID WHERE (downloads.NoteTitle like '%$search_result%' OR downloads.NoteCategory LIKE '%$search_result%' 
    OR users.EmailID LIKE '%$search_result%' OR referencedata.Value LIKE '%$search_result%' OR downloads.PurchasedPrice LIKE '%$search_result%' OR 
    downloads.ModifiedDate LIKE '%$search_result%') AND SellerID=$seller_id AND IsSellerHasAllowedDownload=1 LIMIT $start_from,$limit";
    
    $result = mysqli_query($conn,$query_sold_note);

  /*   if($query_sold_note){
            echo "select";
        }else{
            echo "not".mysqli_error($conn);
    } */
   
    $result_num = mysqli_query($conn,"SELECT COUNT(downloads.ID) FROM downloads LEFT JOIN users ON 
                downloads.DownloaderID=users.ID LEFT JOIN referencedata ON downloads.IsPaid=referencedata.ID WHERE (downloads.NoteTitle like '%$search_result%' OR downloads.NoteCategory LIKE '%$search_result%' 
                 OR users.EmailID LIKE '%$search_result%' OR referencedata.Value LIKE '%$search_result%' OR downloads.PurchasedPrice LIKE 
                 '%$search_result%' OR downloads.ModifiedDate LIKE '%$search_result%') AND
                SellerID=$seller_id AND IsSellerHasAllowedDownload=1 LIMIT $start_from,$limit");


    $row = mysqli_fetch_row($result_num);
    $total_records = $row[0];
   // echo $total_records;
    $total_page = ceil($total_records / $limit);


}else{
    
    $query_sold_note = "SELECT DISTINCT downloads.NoteID,downloads.NoteTitle,downloads.NoteCategory,users.EmailID,
    downloads.IsPaid,
    downloads.PurchasedPrice,downloads.ModifiedDate,downloads.DownloaderID FROM downloads LEFT JOIN users ON 
    downloads.DownloaderID=users.ID LEFT JOIN referencedata ON downloads.IsPaid=referencedata.ID WHERE 
    SellerID=$seller_id AND IsSellerHasAllowedDownload=1 LIMIT $start_from,$limit";
    
    $result = mysqli_query($conn,$query_sold_note);

    $result_num = mysqli_query($conn,"SELECT COUNT(downloads.ID) FROM downloads LEFT JOIN users ON 
                downloads.DownloaderID=users.ID LEFT JOIN referencedata ON downloads.IsPaid=referencedata.ID WHERE 
                SellerID=$seller_id AND IsSellerHasAllowedDownload=1");

    $row = mysqli_fetch_row($result_num);
    $total_records = $row[0];
    //echo $total_records;
    $total_page = ceil($total_records / $limit);
    //echo $total_page;
}

//log-in failed
if (!$login) { ?>
    <script>
        alert("Please sign in/register to gain access to this page\npressing OK you will be redirect to login page");
        window.location.replace("login.php");
    </script>
<?php }
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
                    <a href="index.php" title="Site Logo">
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
                                        <a class="dropdown-item active" href="my-sold-notes.php">My Sold Notes</a>
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
                                        <a class="dropdown-item active" href="my-sold-notes.php">My Sold Notes</a>
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



    <!-- My-sold-note  part-->
    <div id="my-sold-notes">
        <div class="content-box-lg">
        <form action="my-sold-notes.php" method="POST">
            <div class="container">
                <div class="row no-gutters all-notes">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12 text-left box-heading-wrapper">
                        <p class="download-heading">My Sold Notes</p>
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
                                    <th scope="col">Sell type</th>
                                    <th scope="col">price</th>
                                    <th scope="col">downloaded time</th>
                                    <th scope="col" width="80px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php
                                //echo $total_records;
                                $sr_no = 1;                         
                                if($total_records == 0){
                                    echo "<tr><td colspan ='8' style ='text-align:center ;'> No Records Found </td></tr>";                               
                                }else{
                                while ($row = mysqli_fetch_assoc($result)) {
                                $noteid = $row['NoteID'];
                                $downloader = $row['DownloaderID'];
                                $title = $row['NoteTitle'];
                                $category = $row['NoteCategory'];
                                $buyer_email = $row['EmailID'];
                                $sell_type = $row['IsPaid'];
                                $sell_type == 4 ? $sell_type = "Paid" : $sell_type = "Free";
                                $price = $row['PurchasedPrice'];
                                $time = $row['ModifiedDate'];
                                    
                                echo "<tr>
                                    <td>  $sr_no </td>
                                    <td><a class='purple-td' href='note-details.php?id= .$noteid; '>$title</a>
                                    </td>
                                    <td> $category </td>
                                    <td> $buyer_email </td>
                                    <td> $sell_type </td>
                                    <td> $$price </td>
                                    <td>$time </td>
                                    <td class='text-center visible-overflow-for-dropdown'>
                                    <a href='note-details.php?id=$noteid;'>
                                        <img class='eye-img-in-table' src='images/Dashboard/eye.png' title='Click to view <?php echo $title ?>' alt='view'>
                                    </a>
                                        <div class='dropdown dropdown-dots-table'>
                                            <a href='#' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                <img class='dots-in-table' src='images/Dashboard/dots.png' alt='edit'>
                                            </a>

                                            <div class='dropdown-menu' aria-labelledby='dropdownMenuLink'>
                                            <a role='button' class='dropdown-item' href='my-sold-notes.php?NoteID=<?php echo $noteid; ?>&DownloaderID=<?php echo $downloader; ?>'>  Download Note</a>                                                
                                            </div>
                                        </div>
                                    </td>
                                </tr>";
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
                echo "<li class='page-item'><a class='page-link' href='my-sold-notes.php?page=" . ($page - 1)
                    . "'> <img src='images/pagination/left-arrow.png' alt='previous'> </a></li>";
                for ($i = 1; $i <= $total_page; $i++) {
                    if ($i == $page) {
                        echo "<li class='page-item active '><a class='page-link' href='my-sold-notes.php?page=$i'>$i</a></li>";
                    } else echo "<li class='page-item'><a class='page-link' href='my-sold-notes.php?page=$i'>$i</a></li>";
                }
                echo "<li class='page-item'><a class='page-link' href='my-sold-notes.php?page=" . ($page + 1)
                    . "'> <img style='color: white;' src='images/pagination/right-arrow.png' alt='next'> </a></li>";
                ?>
            </ul>
            </nav>
            <!-- pagination -->
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

    <!-- Bootstrap JS -->
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <!-- Custom JS -->
    <script src="js/script.js"></script>

</body>

</html>