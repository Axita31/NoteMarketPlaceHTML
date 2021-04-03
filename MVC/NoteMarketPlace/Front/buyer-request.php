<?php 
include "db.php";
$limit = 8;

if (isset($_GET["page"])) {
    $page  = $_GET["page"];
} else {
    $page = 1;
};
$start_from = ($page - 1) * $limit;
if (isset($_POST['search'])) {

    $search_result = $_POST['search_result'];

    $query = "SELECT downloads.NoteTitle,downloads.NoteCategory,referencedata.Value,downloads.PurchasedPrice,
            downloads.AttachmentDownloadedDate FROM downloads LEFT JOIN referencedata ON downloads.IsPaid = referencedata.ID
            WHERE NoteTitle LIKE '%search_result%' LIMIT $start_from,$limit" ;

    $result = mysqli_query($conn, $query);

    $result_num = mysqli_query($conn, "SELECT COUNT(downloads.ID) FROM downloads LEFT JOIN referencedata 
    ON downloads.IsPaid=referencedata.ID WHERE NoteTitle LIKE '%$search_result%'");

    $row = mysqli_fetch_row($result_num);
    $total_records = $row[0];
    $total_pages = ceil($total_records / $limit);
} else {

    $query = "SELECT downloads.NoteTitle,downloads.NoteCategory,referencedata.Value,downloads.PurchasedPrice,
            downloads.AttachmentDownloadedDate FROM downloads LEFT JOIN referencedata ON downloads.IsPaid = referencedata.ID
            LIMIT $start_from,$limit" ;

    $result = mysqli_query($conn, $query);

    $result_num = mysqli_query($conn, "SELECT COUNT(downloads.ID) FROM downloads LEFT JOIN referencedata 
    ON downloads.IsPaid=referencedata.ID");

    $row = mysqli_fetch_row($result_num);
    $total_records = $row[0];
    $total_pages = ceil($total_records / $limit);
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
                                    <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <div class="logged-in-user-photo">
                                            <img src="images/user-profile/user-img.png" alt="User Photo" class="rounded-circle">
                                        </div>
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item " href="user-profile.php">My Profile</a>
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
                                    <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <div class="logged-in-user-photo">
                                            <img src="images/user-profile/user-img.png" alt="User Photo" class="rounded-circle">
                                        </div>
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item " href="user-profile.php">My Profile</a>
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
                                    <th scope="col" width="80px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                                $title = $row['NoteTitle'];
                                $category = $row['NoteCategory'];
                                $type = $row['Value'];
                                $price = $row['PurchasedPrice'];
                                $time = $row['AttachmentDownloadedDate'];
                                echo " 
                                    <tr>
                                        <td>" . $i++ . "</td>
                                        <td>$title</td>
                                        <td>$category</td>
                                        <td>Testing" . $i . $i * 2 . ($i * 7) . "@gmail.com</td>
                                        <td>+91 98" . $i . "5" . $i . "9" . $i . $i . "7</td>
                                        <td>$type</td>
                                        <td>&#36;$price</td>
                                        <td>$time</td>
                                        <td class='text-center visible-overflow-for-dropdown'>
                                        <a href='note-details.php'>
                                        <img class='eye-img-in-table' src='images/Dashboard/eye.png' alt='edit'>

                                        <div class='dropdown dropdown-dots-table'>
                                            <a href='#' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                <img class='dots-in-table' src='images/Dashboard/dots.png' alt='edit'>
                                            </a>

                                            <div class='dropdown-menu' aria-labelledby='dropdownMenuLink'>
                                                <a class='dropdown-item' href='#'>Allow Download</a>
                                            </div>
                                        </div>
                                    </td>
                                    </tr>";
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
                        echo "<li class='page-item '><a class='page-link' href='buyer-request.php?page=$i'>$i</a></li>";
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