<?php
include "db.php";
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<?php include 'head.php';?>

<body data-spy="scroll" data-target=".navbar" data-offset="65">
   
    <!-- Header -->
        <div class="only-white-nav extra-style-nav">
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
                                <li class="active">
                                    <a href="search-notes.php">Search Notes</a>
                                </li>
                                <li>
                                    <a href="dashboard-1.php">Sell Your Notes</a>
                                </li>
                                <li>
                                    <a href="faq.php">FAQ</a>
                                </li>
                                <li >
                                    <a href="contact-us.php">Contact Us</a>
                                </li>
                                <li>
                                    <a class="btn btn-general btn-purple" href="login.php" title="Download"
                                        role="button">Login</a>
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
                                <li class="active">
                                    <a href="search-notes.php">Search Notes</a>
                                </li>
                                <li>
                                    <a href="dashboard-1.php">Sell Your Notes</a>
                                </li>
                                <li>
                                    <a href="faq.php">FAQ</a>
                                </li>
                                <li >
                                    <a href="contact-us.php">Contact Us</a>
                                </li>
                                <li>
                                    <a class="btn btn-general btn-purple" href="login.php" title="Download"
                                        role="button">Login</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </header>
        </div>
    <!-- Header ends -->


    <!-- background-->
    <div id="search-notes">
        <!-- back img-->
        <div class="small-height-bg">
            <p class="text-center">Search Notes</p>
        </div>
        <!-- back img-->
        <div id="search-filter-heading">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-12">
                        <h4>Search and Filter notes</h4>
                    </div>
                </div>
            </div>
        </div>
        <div id="search-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-md-12 col-sm-12 col-12">
                        <div id="search-icon">
                            <i class="fa fa-search"></i>
                            <input id="search-note-main" onkeyup="searchclick()" type="text" class="form-control input-light-color" placeholder="Search your notes here...">
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-12">
                        <div id="search-filters">
                            <div class="row">
                                <div class="col-lg-2 col-md-4 col-sm-6 col-12 search-type-gap">
                                    <select id="search_type" onchange="searchclick()"class="text-hidden form-control options-arrow-down">
                                        <option value="0" selected>Select type</option>
                                        <?php
                                        $result = mysqli_query($conn, "SELECT ID,Type_Name FROM type WHERE IsActive=1");
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $type_id = $row['ID'];
                                            $type_name = $row['Type_Name'];
                                            echo "<option value='$type_id'>$type_name</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-lg-2 col-md-4 col-sm-6 col-12 search-type-gap">
                                    <select id="search_category" onchange="searchclick()" class="text-hidden form-control options-arrow-down">
                                        <option value="0" selected>Select Category</option>
                                        <?php
                                        $result = mysqli_query($conn, "SELECT ID,Category_name FROM category WHERE IsActive=1");
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $cat_id = $row['ID'];
                                            $cat_name = $row['Category_name'];
                                            echo "<option value='$cat_id'>$cat_name</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-lg-2 col-md-4 col-sm-6 col-12 search-type-gap">
                                    <select id="search_university" onchange="searchclick()" class="text-hidden form-control options-arrow-down">
                                        <option value="0" selected>Select University</option>
                                        <?php
                                        $result = mysqli_query($conn, "SELECT DISTINCT University FROM notes WHERE IsActive=1");
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $university_name = $row['University'];
                                            echo (!empty($university_name) && $university_name != "")
                                                ? "<option value='$university_name'>$university_name</option>" : "";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-lg-2 col-md-4 col-sm-6 col-12 search-type-gap">
                                    <select id="search_course" onchange="searchclick()" class="text-hidden form-control options-arrow-down">
                                        <option value="0" selected>Select Course</option>
                                        <?php
                                        $result = mysqli_query($conn, "SELECT DISTINCT Course FROM notes WHERE IsActive=1");
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $course_name = $row['Course'];
                                            echo (!empty($course_name) && $course_name != "")
                                                ? "<option value='$course_name'>$course_name</option>" : "";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-lg-2 col-md-4 col-sm-6 col-12 search-type-gap">
                                    <select id="search_country" onchange="searchclick()" class="text-hidden form-control options-arrow-down">
                                        <option value="0" selected>Select Country</option>
                                        <?php
                                        $result = mysqli_query($conn, "SELECT ID,Country_Name FROM country WHERE IsActive=1");
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $country_id = $row['ID'];
                                            $country_name = $row['Country_Name'];
                                            echo "<option value='$country_id'>$country_name</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-lg-2 col-md-4 col-sm-6 col-12 search-type-gap">
                                <select id="search_rating" onchange="searchclick()" class="text-hidden form-control options-arrow-down">
                                        <option value="0" selected>Select rating</option>
                                        <option value="5">5</option>
                                        <option value="4">4</option>
                                        <option value="3">3</option>
                                        <option value="2">2</option>
                                        <option value="1">1</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- data from ajax will display in this  -->   
        <div id="search_data_display"></div>
        
      
    <!-- Form Content End-->

    </div>  
  
    <!-- Footer-->
        <?php include 'footer.php'; ?>
    <!-- Footer End-->


    <!-- JQuery -->
    <script src="js/jquery.min.js"></script>
    
    <!-- Popper Js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>

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

    <script type="text/javascript">
        function searchclick(page){
            var search_text = $("#search-note-main").val();
            var search_type = $("#search_type").val();
            var search_category = $("#search_category").val();
            var search_university = $("#search_university").val();
            var search_course = $("#search_course").val();
            var search_country = $("#search_country").val();
            var search_rating = $("#search_rating").val();

        $.ajax({
                type : "GET", 
                url : "AJAX/search-notes-ajax.php",
                data :
                {
                    search : search_text,
                    type : search_type,
                    category : search_category,
                    university : search_university,
                    course : search_course,
                    country : search_country,
                    rating : search_rating,
                    page: page      
                },
                success: function (data) {
                    $("#search_data_display").html(data);
                }
              
          });
       }       
        $(document).ready(function(){
         searchclick(1);  
    });  
     </script>     
      
    <!-- Custom JS -->
    <script src="js/script.js"></script>
    
    </body>
</html>