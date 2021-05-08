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

if (isset($_GET["page"])) {
    $page  = $_GET["page"];
} else {
    $page = 1;
};
$start_from = ($page - 1) * $limit;

/* $sr_no = 1;
$page = (isset($_GET['page'])  && ($_GET['page'] > 0) && !empty($_GET['page'])) ? $_GET['page'] : 1;
$start_from = ($page - 1) * $limit;
 */
$merge_query = $query_fetch . $whereQuery . "  ORDER BY notes.CreatedDate DESC LIMIT " . $start_from . "," . $limit;
$get_data = mysqli_query($conn, $merge_query);

$page_count_query = mysqli_query($conn, $query_fetch . $whereQuery);
$total_rows = mysqli_num_rows($page_count_query);
$total_pages = ceil($total_rows / $limit);


?>

<style>
    
#search-result ul {
	list-style: none;
}

.search-img-border {
	border: 1px solid #d1d1d1;
	border-bottom: none;
	padding: 0;
	margin: 0;
	max-width: 450px;
	margin-bottom: 0;
	width: 100%;
}

.search-result-below-img {
	border: #d1d1d1 1px solid;
	-webkit-box-shadow: 0 0 60px 15px rgba(0, 0, 0, 0.08);
	box-shadow: 0 0 60px 15px rgba(0, 0, 0, 0.08);
	border-top: none;
	padding-top: 0px;
	max-height: 400px !important;
	height: 100%;
	max-width: 452px !important;
	margin-bottom: 50px
}

.search-result-data {
	display: -webkit-box;
	display: -ms-flexbox;
	display: flex;
}

.search-result-data-body {
	margin-left: 15px;
}

#search-result h3 {
	font-size: 20px;
	font-weight: 600;
	line-height: 26px;
	color: #6255a5;
	text-align: left;
	padding: 30px 0 0 0;
	-webkit-transform: translateX(-20px);
	transform: translateX(-20px);
	text-transform: capitalize;
	min-height: 100px;
}

.search-icon-resizer {
	height: 25px;
	width: 25px;
	-webkit-transform: translateX(15px);
	transform: translateX(15px);
}

#search-result h6 {
	text-align: left;
	font-size: 16px;
	margin-top: 3px;
	font-weight: 400;
	line-height: 20px;
	color: #333333;
	padding-left: 20px;
	margin-bottom: 20px;
}

.single-book-selecter {
	margin-bottom: 50px;

}

#responsive-pagination {
	margin-top: -20px;
}

#search-result .col-md-4 {
	margin-bottom: 50px;
}

.search-result-red {
	color: red !important;
	-webkit-transform: translateY(-5px);
	transform: translateY(-5px);

}

.search-result-rating {
	margin: 0 0 15px 15px;
}
.notes-rating img{
    height: 30px;
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
        <div class="container">
            <div class="row">
            <?php

            //to get all books data
            while ($row = mysqli_fetch_assoc($get_data)) {
               
                $note_id = $row['ID'];
                $note_pic = $row['Note_Display_Picture'];
                $note_title = $row['Note_Title'];
                $university_name = $row['University'];
                $note_page = $row['Note_Pages'];
                $note_pub_date = $row['PublishedDate']; 
                ?>
   
            <div class="col-lg-4 col-md-6 col-sm-6  single-book-selecter">
                <?php echo "<a href='note-details.php?id=$note_id'>"; ?>

                <!-- display img -->
                <img src='<?php echo $note_pic ?>' class="img-fluid search-img-border" 
                    title='Click to View <?php echo $note_title ?>' alt='Book Cover photo of <?php echo $note_title ?>'>
                <?php echo "</a>
                        <a href='note-details.php?id=$note_id' title='Click to view $note_title'>";
                    ?>
                <div class="search-result-below-img">
                    <ul>
                        <li>
                            <!-- display title     -->
                            <h3> <?php echo $note_title; ?> </h3>
                        </li>
                    </ul>
                    <div class="search-result-data">

                        <!-- university name -->
                        <img class="search-icon-resizer" src="images/Search/university.png" alt="university">
                        <h6 class="search-result-data-body">
                            <?php echo (!empty($university_name) && $university_name != '') ? $university_name : 'Not specified' ?>
                        </h6>
                    </div>

                    <!-- notes pages -->
                    <div class="search-result-data">
                        <img class="search-icon-resizer" src="images/Search/pages.png" alt="book">
                        <h6 class="search-result-data-body"><?php echo $note_page; ?> Pages</h6>
                    </div>

                    <!-- note publish date -->
                    <div class="search-result-data">
                        <img class="search-icon-resizer" src="images/Search/date.png" alt="calender">
                        <h6 class="search-result-data-body">
                            <?php echo date('D, F d Y', strtotime($note_pub_date)); ?></h6>
                    </div>

                    <!-- imappropriate count -->
                    <div class="search-result-data">
                        <?php $appropriate_query = mysqli_query($conn, "SELECT 1 FROM sellernotesreportedissues WHERE NoteID=$note_id");
                            $appropriate_count = mysqli_num_rows($appropriate_query);
                            if ($appropriate_count > 0) { ?>
                        <img class="search-icon-resizer" src="images/Search/flag.png" alt="flag">
                        <h6 class="search-result-data-body search-result-red">
                            <?php echo $appropriate_count ?>&nbspUser(s) have marked this note as
                            inappropriate</h6>
                        <?php } else
                            echo "<img class='search-icon-resizer' src='images/Search/flag.png' alt='flag'>
                                <h6 class='search-result-data-body search-result-red''>
                                   No user(s) have marked this note as
                                        inappropriate</h6>";
                        ?>
                    </div>

                    <?php

                        // display rating
                        $ratiing_getter = mysqli_query($conn, "SELECT AVG(ratings),COUNT(ratings) FROM sellernotesreviews WHERE NoteID=$note_id AND isactive=1");
                        while ($row = mysqli_fetch_assoc($ratiing_getter)) {
                            $ratiing_val = $row['AVG(ratings)'];
                            $total_rating = $row['COUNT(ratings)']; ?>

                    <!-- rating display -->
                   

                    <div style="display:flex;margin-left:20px; " class="notes-star">
										<?php for($i=0;$i<$ratiing_val;$i++){
											echo "<img style='height:20px;width:auto;' src='images/notes-detail/star.png'>";
										}
                                        for($i=0;$i<(5-$ratiing_val);$i++){
											echo "<img style='height:20px;width:auto;' src='images/notes-detail/star-white.png'>";
										}
									?>
				         <div style="margin-left:20px;" class="note-page-star-setter">
                            <div id="<?php echo $note_id ?>"></div>
                            <?php echo $total_rating > 0 ? "<h6>" . $total_rating . " Reviews</h6>" : "<h6>No reviews yet!</h6>"; ?>
                            </div>
                            <?php } ?>

				    </div><?php ?>
                   
				</div>
	 
		   
            
            <?php echo "</a>"; ?></div>
			<?php } ?>
         </div>
    </div>
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
