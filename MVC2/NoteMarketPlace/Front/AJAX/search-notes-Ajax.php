<?php
include "../db.php";

if (!empty(isset($_GET['search']))) {
    $search = $_GET['search'];
} else {
    $search = "";
}
if (!empty(isset($_GET['type']))) {
    $type = $_GET['type'];
} else {
    $type = "";
}

if (!empty(isset($_GET['category']))) {
    $category = $_GET['category'];
} else {
    $category = "";
}

if (!empty(isset($_GET['university']))) {
    $university = $_GET['university'];
} else {
    $university = "";
}

if (!empty(isset($_GET['course']))) {
    $course = $_GET['course'];
} else {
    $course = "";
}

if (!empty(isset($_GET['country']))) {
    $country = $_GET['country'];
} else {
    $country = "";
}
if (!empty(isset($_GET['rating']))) {
    $rating = $_GET['rating'];
} else {
    $rating = "";
}

//to get notes
$query_fetch  ="SELECT DISTINCT notes.ID,notes.Note_Title,notes.Category,notes.Note_Types,notes.University,notes.
                Course,notes.Country,notes.Note_Pages,notes.Note_Display_Picture,notes.PublishedDate FROM notes 
                LEFT JOIN sellernotesreviews ON notes.ID=sellernotesreviews.NoteID 
                WHERE notes.IsActive=1 AND notes.Note_Title LIKE '%$search%' AND notes.Status=9";

$whereQuery = "";

if(!empty($type)) {
$whereQuery .= " AND Note_Types='$type'";
}

if(!empty($category)) {
$whereQuery .= " AND Category='$category'";
}

if(!empty($university)) {
$whereQuery .= " AND University='$university'";
}                
if(!empty($course)){
$whereQuery .= " AND Course='$course'";
}
if(!empty($country)) {
$whereQuery .= " AND Country='$country'";
}
if(!empty($rating)){
 $whereQuery .= " AND Ratings>'$rating'";   
}


$limit = 6;
$sr_no = 1;
$page = (isset($_GET['page'])  && ($_GET['page'] > 0) && !empty($_GET['page'])) ? $_GET['page'] : 1;
$start_from = ($page - 1) * $limit;

$merge_query = $query_fetch . $whereQuery . "  ORDER BY notes.CreatedDate DESC LIMIT " . $start_from . "," . $limit;
$get_data = mysqli_query($conn, $merge_query);

$page_count_query = mysqli_query($conn, $query_fetch . $whereQuery);
$total_rows = mysqli_num_rows($page_count_query);
$total_pages = ceil($total_rows / $limit);


?>

<style>
    .rate img{
        height: 20px;
        width: auto;
    }
</style>
<div id="search-result">
        <div class="container">
            <div class="row">
                <div id="search-result-heading">
                    <div class="col-md-12 col-md-12 col-sm-12 col-12">
                        <?php
                            if ($total_pages == 0)
                               echo " <h2>No Record Found!</h2>";                              
                            else
                                echo " <h2>Total " . $total_rows . " notes</h2>";
                        ?>                       
                    </div>
                </div>
            </div>
        </div>
        <div id="search-notes">
            <div class="container">
                <div class="row">
                  <?php
                    while($row=mysqli_fetch_assoc($get_data)){
                        $title = $row['Note_Title'];
                        $pages = $row['Note_Pages'];
                        $university = $row['University'];
                        $publisheddate = $row['PublishedDate'];
                        $book_image = $row['Note_Display_Picture'];
                       // $rating = $row['ratings'];
                        $noteid = $row['ID'];
                    ?>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="note-details-box">
                            <?php 
                                echo "<a href='note-details.php?id=$noteid'>"; 
                               echo "<img src='$book_image' alt='book'>" ;
                            ?>
                            
                            <div class="note-details">
                                <p class="note-name-title"><?php echo $title; ?> </p>
                                <p class="note-info-with-icon"><span><img src="images/Search/university.png" alt=""></span>
                                  <?php echo (!empty($university) && $university != '') ? $university : '-' ?>
                                </p>
                                <p class="note-info-with-icon"><span><img src="images/Search/pages.png" alt=""></span><?php echo $pages; ?> </p>
                                <p class="note-info-with-icon"><span><img src="images/Search/date.png" alt=""></span><?php echo date('D, F d Y', strtotime($publisheddate)); ?></p>    
                                <p class="note-info-with-icon red-text"><span><img src="images/Search/flag.png" alt=""></span>
                                <?php
                                    $inappropriate = mysqli_query($conn, "SELECT COUNT(1) FROM sellernotesreportedissues WHERE NoteID=$noteid");
                                    while ($row = mysqli_fetch_assoc($inappropriate))
                                        $inappropriate_count = $row['COUNT(1)'];
                                    if ($inappropriate_count > 0) { ?>
                                        <?php echo $inappropriate_count ?> User(s) marked this note as inappropriate
                                    <?php } else{
                                       echo  "No User(s) marked this note as inappropriate" ;
                                        
                                    } ?>    
                                </p>
                               
                                <div class="notes-rating">
                                    <div class="col-md-7 col-sm-8 col-8">
                                        <div class="rate">
                                         <?php
                                                $star_rating = mysqli_query($conn, "SELECT AVG(ratings),COUNT(ratings) FROM sellernotesreviews WHERE NoteID=$noteid AND IsActive=1");
                                                while ($row = mysqli_fetch_assoc($star_rating)) {
                                                    $star_rating_val = $row['AVG(ratings)'];
                                                    $star_rating_count = $row['COUNT(ratings)'];
                                                }
                                                if ($star_rating_count > 0) { ?>
                                              
                                                <p class="note-single-detail-tag">
                                                    
                                                        <?php
                                                        for ($i = 0; $i < $star_rating_val; $i++) {
                                                            echo "<img src='images/notes-detail/star.png'>";
                                                        }
                                                        for ($j = 0; $j < (5 - $star_rating_val); $j++) {
                                                            echo "<img src='images/notes-detail/star-white.png'>";
                                                        }
                                                        ?>
                                         </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-5 col-sm-4 col-4">
                                    <p class="review-count"> <?php echo $star_rating_count ?> Reviews
                                    </p>
                                            <?php  } else { ?>
                                            <div>
                                                <p review-count>No ratings Yet!</p>

                                            </div>
                                            <?php   }  ?></p>
                                </div>   
                                                                     
                            </div>
                        </div>
                    </div>           
                </div>
               
            </div>
            <?php  } 
                ?>
        </div>
        
    <!-- pagination -->
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
            <?php
                echo "<li class='page-item'><a onclick=" . "searchclick($page-1)" . " class='page-link' >
                <img style='color: white;' src='images/pagination/left-arrow.png' alt='previous'> </a></li>";
                for ($i = 1; $i <= $total_pages; $i++) {
                    if ($i == $page) {
                        echo "<li class='page-item active'><a class='page-link' onclick=" . "searchclick($i)" . ">$i</a></li>";
                    } else echo "<li class='page-item'><a class='page-link' onclick=" . "searchclick($i)" . ">$i</a></li>";
                }
                echo "<li class='page-item'><a onclick=" . "searchclick($page+1)" . " class='page-link'> 
                <img style='color: white;' src='images/pagination/right-arrow.png' alt='next'> </a></li>";
             ?>
            </ul>
        </nav>
    <!-- pagination -->

</div>