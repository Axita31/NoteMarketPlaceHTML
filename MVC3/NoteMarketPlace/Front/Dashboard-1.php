<?php
include "db.php";
session_start();

$login = true;
if (isset($_SESSION['email']))
    $email = $_SESSION['email'];
else
    $login = false;

$seller_id = mysqli_query($conn, "SELECT ID FROM users WHERE EmailID='$email'");
while ($row = mysqli_fetch_assoc($seller_id))
    $userid = $row['ID'];
?>


<!DOCTYPE html>
<html lang="en">
<style>
/* a.disabled {
  pointer-events: none;
  cursor: default; */
}
</style>
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
                            <li class="active">
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
                    <!-- Mobile Menu Close Button -->
                    <span id="mobile-nav-close-btn">&times;</span>

                    <div id="mobile-nav-content">
                        <ul class="menu-navigation">
                            <li>
                                <a href="search-notes.php">Search Notes</a>
                            </li>
                            <li class="active">
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

    <!-- Dashboard content-->

    <div id="dashboard">
        <!-- Dashboard box-->
        <div class="content-box-lg">
            <div class="container">
                <div class="row no-gutters all-notes">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6 text-left">
                        <p class="dashboard-heading">Dashboard</p>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6 text-right">
                        <button class="btn btn-general btn-purple add-note-btn" onclick="window.location.href='add-notes.php'">Add Note</button>
                    </div>
                </div>
            </div>

            <?php
               
            ?>
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="row no-gutters dashboard-left">

                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
                                <div class="my-earning-heading dashboard-box">
                                    <img src="images/Dashboard/earning-icon.svg" alt="">
                                    <p class="box-heading text-center">My Earning</p>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
                                <div class="numbers-of-notes dashboard-box">
                                <?php
                                    $note_sold = mysqli_query($conn, "SELECT DISTINCT NoteID FROM downloads WHERE SellerID=$userid AND IsSellerHasAllowedDownload=1");
                                    $note_sold_count = mysqli_num_rows($note_sold);
                                 ?>
                                    <p class="dashboard-single-details text-center"><?php echo $note_sold_count; ?></p>
                                    <p class="dashboard-detail-heading text-center">Numbers of Notes Sold</p>
                                </div>
                            </div>

                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
                                <div class="money-earned dashboard-box">
                                <?php

                                    $note_id_getter = mysqli_query($conn, "SELECT NoteID,PurchasedPrice FROM downloads WHERE IsPaid=4 AND IsSellerHasAllowedDownload=1 AND SellerID=$userid");
                                    $final_price = 0;
                                    while ($row = mysqli_fetch_assoc($note_id_getter)) {
                                        $all_note_id = $row['NoteID'];
                                        $price_all_note = $row['PurchasedPrice'];

                                        //select notes with first attachment
                                        $select_attach = mysqli_query($conn, "SELECT AttachmentPath FROM downloads WHERE NoteID=$all_note_id");
                                        $count_attach = mysqli_num_rows($select_attach);
                                        $final_price = $final_price + ($price_all_note / $count_attach);
                                        $final_price = round($final_price, 2);
                                    }
                                ?>
                                    <p class="dashboard-single-details text-center">$<?php echo $final_price ;?></p>
                                    <p class="dashboard-detail-heading text-center">Money Earned</p>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 dashboard-right">
                        <div class="row no-gutters ">

                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
                                <div class="my-download dashboard-box">
                                <?php
                                $mydownload = mysqli_query($conn, "SELECT DISTINCT NoteID FROM downloads WHERE DownloaderID=$userid AND IsSellerHasAllowedDownload=1");
                                $mydownload_count = mysqli_num_rows($mydownload);
                                ?>
                                    <p class="dashboard-single-details text-center"><?php echo $mydownload_count ;?></p>
                                    <p class="dashboard-detail-heading text-center">My Downloads</p>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
                                <div class="rejected-notes dashboard-box">
                                <?php
                                    $rejected_note = mysqli_query($conn, "SELECT ID FROM notes WHERE Status=10 AND SellerID=$userid");
                                    $rejected_note_count = mysqli_num_rows($rejected_note);
                                    ?>
                                    <p class="dashboard-single-details text-center"><?php echo $rejected_note_count ;?></p>
                                    <p class="dashboard-detail-heading text-center">My Rejected Notes</p>
                                </div>
                            </div>

                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
                                <div class="buyer-request dashboard-box">
                                <?php
                                $buyer_req = mysqli_query($conn, "SELECT DISTINCT NoteID FROM downloads WHERE IsPaid=4 AND IsSellerHasAllowedDownload=0 AND SellerID=$userid");
                                $buyer_req_count = mysqli_num_rows($buyer_req);
                                ?>
                                    <p class="dashboard-single-details text-center"><?php echo $buyer_req_count ;?></p>
                                    <p class="dashboard-detail-heading text-center">Buyer Request</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dashboard box End -->

        <!-- Progress Notes Box-->

        <div class="content-box-lg">
            <div class="container">
                <form action="Dashboard-1.php" method="POST">
                    <div class="row no-gutters">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12 text-left box-heading-wrapper">
                            <p class="progress-heading">In Progress Notes</p>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="row no-gutters text-right general-search-bar-btn-wrapper">
                                <div class="form-group has-search">
                                    <span class="fa fa-search form-control-feedback"></span>
                                    <input type="text" class="form-control search-bar" name="search_result" placeholder="Search">
                                </div>
                                <button name="search" class="btn btn-general btn-purple progress-btn">Search</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <?php

                if (isset($_GET["page"])) {
                    $page  = $_GET["page"];
                } else {
                    $page = 1;
                }
                $limit=5;
                $start=($page *$limit) - $limit;
                
                if (isset($_POST['search'])) {
                
                    $search_result = $_POST['search_result'];
                
                    $query = "SELECT notes.ID,notes.CreatedDate,notes.Note_Title, category.Category_name,referencedata.Value FROM notes 
                    LEFT JOIN  category ON notes.Category=category.ID LEFT JOIN referencedata ON notes.Status=referencedata.ID WHERE notes.Note_Title 
                    LIKE '%$search_result%' OR category.Category_Name LIKE '%$search_result%' OR referencedata.Value LIKE '%$search_result%' AND notes.IsActive=1 AND 
                    referencedata.ID IN (6,7,8) ORDER BY notes.CreatedDate DESC LIMIT $start, $limit";
                    $result = mysqli_query($conn, $query);
                    
                    $result_num = mysqli_query($conn, "SELECT COUNT(notes.ID) FROM notes LEFT JOIN  category ON notes.Category=category.ID 
                    LEFT JOIN referencedata ON notes.Status=referencedata.ID WHERE notes.Note_Title LIKE '%$search_result%' OR category.Category_Name LIKE 
                    '%$search_result%' OR referencedata.Value LIKE '%$search_result%' AND notes.IsActive=1 AND Status IN (6,7,8) ORDER BY notes.CreatedDate DESC
                    LIMIT $start, $limit");
                    
                    $row = mysqli_fetch_row($result_num);    
                    $total_rows = $row[0];
                    $total_page = ceil($total_rows / $limit);
                    //echo $total_rows;
                    
                }
                else{
                    $query = "SELECT notes.ID,notes.CreatedDate,notes.Note_Title, category.Category_name,referencedata.Value FROM notes 
                    LEFT JOIN  category ON notes.Category=category.ID LEFT JOIN referencedata ON notes.Status=referencedata.ID WHERE notes.IsActive=1 AND 
                    referencedata.ID IN (6,7,8) ORDER BY notes.CreatedDate DESC LIMIT $start, $limit";
                    $result = mysqli_query($conn, $query); 
                    
                    $result_num = mysqli_query($conn, "SELECT COUNT(notes.ID) FROM notes LEFT JOIN  category ON notes.Category=category.ID 
                    LEFT JOIN referencedata ON notes.Status=referencedata.ID WHERE notes.IsActive=1 AND Status IN (6,7,8) ORDER BY notes.CreatedDate DESC ");
                
                    $row = mysqli_fetch_row($result_num);
                    $total_rows = $row[0];
                    $total_page = ceil($total_rows / $limit);
                   // echo $total_rows;
                }
                ?>

            <div class="container">
                <div class="in-progress-notes-table general-table-responsive">
                    <div class="table-responsive-xl">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Added Date</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                           </thead>
                            <tbody>
                            <?php
                                if($page <= 0 or $page > $total_page){
                                    echo "<tr><td colspan ='6' style ='text-align:center ;'> No Records Found </td></tr>";
                                }else{
                                
                                while ($row = mysqli_fetch_assoc($result)) {
                                        $date = $row['CreatedDate'];
                                        $title = $row['Note_Title'];
                                        $category_name = $row['Category_name'];
                                        $refe_data = $row['Value'];
                                        $noteid = $row['ID'];
                                        echo "<tr>
                                        <td>$date</td>
                                        <td>$title</td>
                                        <td>$category_name</td>
                                        <td>$refe_data</td>";
                                        if ($refe_data == 'Draft') {
                                            echo " <td> 
                                            <a href='delete_draft.php?id=$noteid'>
                                            <img src='images/Dashboard/delete.png' onclick='javascript:Delete($(this));return false;'>   
                                            <a href='add-notes.php?id=$noteid'>
                                            <img src='images/Dashboard/edit.png' title='Click to Edit' alt='edit'></a>
                                        </td>
                                        </tr>";
                                        } else {
                                            echo " <td>
                                            <a href='note-details.php?id=$noteid'>
                                            <img class='eye-img-in-table' src='images/Dashboard/eye.png' alt='view'></a>
                                            </td>";
                        
                                        }
                                    }
                                }
                                ?>                   
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Progress Notes Box End-->

        <!-- pagination -->
        <nav aria-label="Page navigation example" id="page">
        <ul class="pagination justify-content-center">
                <?php
                echo "<li class='page-item'><a class='page-link' href='Dashboard-1.php?page=" . ($page - 1)
                    . "'> <img src='images/pagination/left-arrow.png' alt='previous'> </a></li>";
                for ($i = 1; $i <= $total_page; $i++) {
                    if ($i == $page) {
                        echo "<li class='page-item active'><a class='page-link' href='Dashboard-1.php?page=$i'>$i</a></li>";
                    } else echo "<li class='page-item'><a class='page-link' href='Dashboard-1.php?page=$i'>$i</a></li>";
                }
                echo "<li class='page-item'><a class='page-link' href='Dashboard-1.php?page=" . ($page + 1)
                    . "'> <img style='color: white;' src='images/pagination/right-arrow.png' alt='next'> </a></li>";
                ?>
            </ul>
        </nav>
        <!-- pagination -->

        <!-- published note table -->
<?php

include "db.php";

if (isset($_GET["page2"])) {
    $page2  = $_GET["page2"];
} else {
    $page2 = 1;
}

$limit=5;
$start2 = ($page2 *$limit) - $limit;

if (isset($_POST['published-search'])) {

    $search_publish = $_POST['search-publish'];

    $query = "SELECT notes.ID,notes.PublishedDate,notes.Note_Title, category.Category_name,referencedata.Value,notes.Price FROM notes LEFT JOIN 
    category ON notes.Category=category.ID LEFT JOIN referencedata ON notes.Is_Paid=referencedata.ID WHERE(notes.Note_Title LIKE '%$search_publish%' 
    OR category.Category_Name LIKE '%$search_publish%' OR referencedata.Value LIKE '%$search_publish%' )AND notes.IsActive=1 AND notes.Status=9 ORDER BY
    notes.PublishedDate DESC LIMIT $start2, $limit";
	$result2 = mysqli_query($conn, $query);
    
	$result_num2 = mysqli_query($conn, "SELECT COUNT(notes.ID) FROM notes WHERE Note_Title LIKE '%$search_publish%'  AND notes.IsActive=1 AND notes.Status=9");
    
    /*if($result_num2){
        echo "connect";
    }else{
        echo "not".mysqli_error($conn);
    }*/
    
    $row2 = mysqli_fetch_row($result_num2);

    $total_records2 = $row2[0];
    $total_page2 = ceil($total_records2 / $limit);
    
	
}
else{
	$query = "SELECT notes.ID,notes.PublishedDate,notes.Note_Title, category.Category_name,referencedata.Value,notes.Price FROM notes LEFT JOIN  category ON notes.Category=category.ID LEFT JOIN referencedata ON notes.Is_Paid=referencedata.ID WHERE  notes.IsActive=1 AND notes.Status=9 ORDER BY notes.PublishedDate DESC LIMIT $start2, $limit";
	$result2 = mysqli_query($conn, $query);
    
	$result_num2 = mysqli_query($conn, "SELECT COUNT(notes.ID) FROM notes WHERE notes.IsActive=1 AND notes.Status=9");
    
    $row2 = mysqli_fetch_row($result_num2); 
    $total_records2 = $row2[0];
    $total_page2 = ceil($total_records2 / $limit);
   
}
?>


        <div class="content-box-lg">
            <div class="container">
                <form action="Dashboard-1.php" method="POST">
                    <div class="row no-gutters">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12 text-left box-heading-wrapper">
                            <p class="progress-heading">Published Notes</p>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="row no-gutters text-right general-search-bar-btn-wrapper">
                                <div class="form-group has-search">
                                    <span class="fa fa-search form-control-feedback"></span>
                                    <input type="text" class="form-control search-bar" name="search-publish" placeholder="Search">
                                </div>
                                <button name="published-search" class="btn btn-general btn-purple progress-btn">Search</button>
                            </div>
                        </div>
                    </div>  
                </form>   
            </div>
            <div class="container">
                <div class="in-progress-notes-table general-table-responsive">
                    <div class="table-responsive-xl">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Added date</th>
                                    <th scope="col">title</th>
                                    <th scope="col">category</th>
                                    <th scope="col">sell type</th>
                                    <th scope="col">price</th>
                                    <th scope="col">action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            
                                if($page2 <= 0 or $page2 > $total_page2){
                                    echo "<tr><td colspan ='6' style ='text-align:center ;'> No Records Found </td></tr>";
                                }else{
                                
                                while ($row = mysqli_fetch_assoc($result2)) {
                                    $date2 = $row['PublishedDate'];
                                    $title2 = $row['Note_Title'];
                                    $category_name2 = $row['Category_name'];
                                    $refe_data2 = $row['Value'];
                                    $sell_price = $row['Price'];
                                    $noteid = $row['ID'];
                                    echo "<tr>
                                            <td>$date2</td>
                                            <td>$title2</td>
                                            <td>$category_name2</td>
                                            <td>$refe_data2</td> 
                                            <td>$sell_price</td>
                                            <td>
                                            <a href='note-details.php?id=$noteid'>
                                            <img class='eye-img-in-table' src='images/Dashboard/eye.png' alt='view'></a>
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
        </div>
        <!-- published note table -->

        <!-- pagination -->
        <nav aria-label="Page navigation example" id="page2">
        <ul class="pagination justify-content-center">
                <?php
                echo "<li class='page-item'><a class='page-link' href='Dashboard-1.php?page2=" . ($page2 - 1)
                    . "'> <img src='images/pagination/left-arrow.png' alt='previous'> </a></li>";
                for ($i = 1; $i <= $total_page2; $i++) {
                    if ($i == $page2) {
                        echo "<li class='page-item active'><a class='page-link' href='Dashboard-1.php?page2=$i'>$i</a></li>";
                    } else echo "<li class='page-item'><a class='page-link' href='Dashboard-1.php?page2=$i'>$i</a></li>";
                }
                echo "<li class='page-item'><a class='page-link' href='Dashboard-1.php?page2=" . ($page2 + 1)
                    . "'> <img style='color: white;' src='images/pagination/right-arrow.png' alt='next'> </a></li>";
                ?>
            </ul>
        </nav>
            <!-- pagination -->

        <!-- Footer-->
            <?php include 'footer.php'; ?>
        <!-- Footer End-->
    </div>

    <!-- Dashboard content End-->
    
    <!-- Popper Js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>

    <!-- JQuery -->
    <script src="js/jquery.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="js/bootstrap/bootstrap.min.js"></script>
    
    <script>
        function Delete() {
            if (confirm("are you sure, you want to delete this notes")) {
                window.location=anchor.attr("href");
            } else {
                txt = "You pressed Cancel!";
            }
        }
    </script>

    <!-- Custom JS -->
    <script src="js/script.js"></script>

</body>

</html>