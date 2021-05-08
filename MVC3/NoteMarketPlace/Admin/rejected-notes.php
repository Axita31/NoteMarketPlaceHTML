<?php
include "../front/db.php";
session_start();

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    //echo $email;
    $query = mysqli_query($conn , "SELECT ID FROM users WHERE EmailID = '$email' ");
    while($row = mysqli_fetch_assoc($query)){
        $userid = $row['ID'];
    }

if(isset($_POST['active_yes'])){

      $get_note_id=$_POST['get_note_id'];
      $active_query=mysqli_query($conn,"UPDATE notes SET Status=9,Actioned_By=$userid WHERE ID=$get_note_id");
    /*   if($active_query){
          echo "select";
      }else{
          echo "not".mysqli_error($conn);
      } */
} 

//download notes
if (isset($_GET['dnote_id'])) {
    $dnote_id = $_GET['dnote_id'];
    $download_query = mysqli_query($conn, "SELECT NoteTitle, AttachmentPath FROM downloads WHERE NoteID=$dnote_id");

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
}
?>

<!DOCTYPE html>
<html lang="en">

<?php include 'head.php' ; ?>

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
                                        <a class="dropdown-item active" href="rejected-notes.php">Rejected Notes</a>
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
                                        <a class="dropdown-item active" href="rejected-notes.php">Rejected Notes</a>
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

<!-- Header ends -->
   
 <!-- rejected content-->   

    <div id="rejected-note"> 
        <div class="content-box-md">
            <div class="container">
                <div class="row no-gutters all-notes">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12 text-left">
                        <p class="note-heading">Rejected Notes</p>
                    </div>
                </div>
            </div>
        </div>
            
     <!-- publish Notes Box-->
          
        <div class="content-box-lg">
            <div class="container">
                <div class="row no-gutters">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-4 text-left box-heading-wrapper">
                       <label for="" class="info-label">Seller</label>
                        <select id="seller" onchange="filterData();" class="form-control options-arrow-down input-light-color seller-box">
                            <option selected disabled>Seller</option>
                            <?php
                                $seller_query=mysqli_query($conn,"SELECT DISTINCT notes.SellerID,users.FirstName,users.LastName FROM notes  LEFT JOIN users ON notes.SellerID=users.ID");
                                while($row = mysqli_fetch_assoc($seller_query))
                                { ?>
                                    <option value="<?php echo $row['SellerID']; ?>"><?php echo $row['FirstName']." ".$row['LastName']; ?></option>
                                <?php  echo $userid; }
                            ?>
                        </select>
                        
    
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-12 ">
                        
                            <div class="row no-gutters text-right general-search-bar-btn-wrapper search-bar-btn-box">
                                <div class="form-group has-search">
                                    <span class="fa fa-search form-control-feedback"></span>
                                    <input type="text"  id="search_txt" class="form-control search-bar" placeholder="Search">
                                </div> 
                                <button  onclick="filterData();" class="btn btn-general btn-purple progress-btn">Search</button>                              
                            </div>
                       
                    </div>
                </div>
            </div>   
            <div id="rejected_table"></div>       
        </div>
        <!-- Progress Notes Box End-->  
         <!-- Footer-->
         <?php include 'footer.php' ; ?>
        <!-- Footer End-->
    </div>
   
 <!-- rejected-notes content End-->

    
    <!-- Popper Js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>

    <!-- JQuery -->
    <script src="js/jquery.min.js"></script>
    
    <!-- Bootstrap JS -->
    <script src="js/bootstrap/bootstrap.min.js"></script>

   <!--  datatable js -->
   <script src="js/datatables.js"></script>
      
    <!-- Custom JS -->
    <script src="js/script.js"></script>
    <script>
     $(document).on("click", "#active-user", function () {
               var note_id = $(this).data('userid');
               $("#get_note_id").val( note_id );
        });
    </script>

    <script type="text/javascript">
          $(function(){
              filterData();
          });
          function filterData(){
            var search_txt=$("#search_txt").val();
            var select_seller=$("#seller").val();

            $.ajax({
              url:"rejected-notes-ajax.php",
              type:"GET",
              data:{
                  search:search_txt,
                  seller:select_seller,
              },
              success:function(data){
                $("#rejected_table").html(data);
              }
            });
          }
    </script>
    
</body>

</html>