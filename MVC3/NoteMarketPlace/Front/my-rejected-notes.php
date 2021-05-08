<?php 
include "db.php";
session_start();

$login = true;
if (isset($_SESSION['email']))
    $s_email = $_SESSION['email'];
else
    $login = false;

//get seller
$seller = mysqli_query($conn, "SELECT ID FROM users WHERE EmailID='$s_email'");
while ($row = mysqli_fetch_assoc($seller))
    $seller_id = $row['ID'];

//for download notes
if (isset($_GET['NoteID'])) {
    $noteid = $_GET['NoteID'];
    $note_title = $_GET['NoteTitle'];

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

?>


<!DOCTYPE html>
<html lang="en">

<?php include 'head.php';?>

<style>
    .my-downloads-table.general-table-responsive .dropdown.dropdown-dots-table .dropdown-menu{
        -webkit-transform: translate3d(-170px, 25px, 0px) !important;
         transform: translate3d(-170px, 25px, 0px) !important;
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
                                        <a class="dropdown-item active" href="my-rejected-notes.php">My Rejected Notes</a>
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
                                        <a class="dropdown-item active" href="my-rejected-notes.php">My Rejected Notes</a>
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



    <!-- My-rejected-note  part-->
    <div id="my-rejected-notes">
        <div class="content-box-lg">
            <div class="container">
               <form action="my-rejected-notes.php" method="post">
                   <div class="row no-gutters all-notes">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12 text-left box-heading-wrapper">
                        <p class="download-heading">My Rejected Notes</p>
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
                                    <th scope="col">Remarks</th>
                                    <th scope="col">Clone</th>
                                    <th scope="col" width="80px"></th>
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
                            
                                $rejected_query = "SELECT notes.Note_Title,category.Category_name,notes.Admin_Remarks,
                                                notes.ID FROM notes
                                                LEFT JOIN category ON category.ID=notes.Category 
                                                WHERE (notes.Note_Title LIKE '%$search_result%' OR category.Category_Name LIKE '%$search_result%' OR notes.Admin_Remarks 
                                                LIKE '%$search_result%') AND notes.Status=10 AND SellerID=$seller_id  LIMIT $start_from, $limit ";         
                            
                                $result = mysqli_query($conn,$rejected_query);
                            
                            
                                $result_num = mysqli_query($conn,"SELECT COUNT(notes.ID) FROM notes LEFT JOIN category ON category.ID=notes.Category 
                                WHERE (notes.Note_Title LIKE '%$search_result%' OR category.Category_Name LIKE '%$search_result%' OR notes.Admin_Remarks 
                                LIKE '%$search_result%') AND notes.Status=10 AND SellerID=$seller_id  LIMIT $start_from, $limit ");
                            
                                $row = mysqli_fetch_row($result_num);
                                $total_records = $row[0];
                                //echo $total_records;
                                $total_page = ceil($total_records / $limit);
                                //echo $total_page;
                            
                            }else{
                                $rejected_query = "SELECT notes.Note_Title,notes.Category,notes.Admin_Remarks,
                                notes.ID,notes.SellerID, category.Category_name FROM notes LEFT JOIN users ON notes.SellerID =users.ID
                                LEFT JOIN category ON category.ID=notes.Category 
                                WHERE notes.Status=10 AND SellerID=$seller_id  LIMIT $start_from, $limit ";
                            
                                $result = mysqli_query($conn,$rejected_query);
                            
                            
                                $result_num = mysqli_query($conn,"SELECT COUNT(notes.ID) FROM notes  LEFT JOIN users ON notes.SellerID =users.ID LEFT JOIN category ON
                                            category.ID=notes.Category  WHERE notes.Status=10 AND SellerID=$seller_id");
                            
                                $row = mysqli_fetch_row($result_num);
                                $total_records = $row[0];
                                //echo $total_records;
                                $total_page = ceil($total_records / $limit);
                                //echo $total_page;
                            
                            
                            }
                            
                            if($page <= 0 or $page > $total_page){
                                echo "<tr><td colspan ='6' style ='text-align:center ;'> No Records Found </td></tr>";
                            }
                               else{
                              
                                   $sr_no = 1;

                                while ($row = mysqli_fetch_assoc($result)) {
                                    $noteid = $row['ID'];
                                    $title = $row['Note_Title'];
                                    $category = $row['Category_name'];
                                    $remark_admin = (!empty($remark_admin)) ? $row['Admin_Remarks'] : "not specified";
                                ?>
                                <tr>
                                    <td><?php echo $sr_no ?></td>
                                    <td><a title="click to view <?php echo $title ?>" class="purple-td"
                                            href="note-details.php?id=<?php echo $noteid; ?>"><?php echo $title ?></a>
                                    </td>
                                    <td><?php echo $category ?></td>
                                    <td><?php echo $remark_admin ?></td>
                                    <td>
                                        <a href="add-notes.php?id=<?php echo $noteid; ?>&clone=1"
                                            title="click to view <?php echo $title ?>" class="purple-td"
                                            title="click here to clone <?php echo $title ?>">clone
                                        </a>
                                    </td>
                                    <td class= "text-center visible-overflow-for-dropdown">
                                        <div class="dropdown dropdown-dots-table">
                                            <div class='dropdown dropdown-dots-table'>
                                                <a href='#' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                    <img class='dots-in-table' src='images/Dashboard/dots.png' alt='edit'>
                                                </a>

                                                <div class='dropdown-menu' aria-labelledby='dropdownMenuLink'>
                                                     <a role='button' class='dropdown-item' href='my-rejected-notes.php?NoteID=<?php echo $noteid; ?>&NoteTitle=<?php echo $title ?>'>  Download Note</a>                                                
                                                </div>
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
                echo "<li class='page-item'><a class='page-link' href='my-rejected-notes.php?page=" . ($page - 1)
                    . "'> <img src='images/pagination/left-arrow.png' alt='previous'> </a></li>";
                for ($i = 1; $i <= $total_page; $i++) {
                    if ($i == $page) {
                        echo "<li class='page-item active '><a class='page-link' href='my-rejected-notes.php?page=$i'>$i</a></li>";
                    } else echo "<li class='page-item'><a class='page-link' href='my-rejected-notes.php?page=$i'>$i</a></li>";
                }
                echo "<li class='page-item'><a class='page-link' href='my-rejected-notes.php?page=" . ($page + 1)
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