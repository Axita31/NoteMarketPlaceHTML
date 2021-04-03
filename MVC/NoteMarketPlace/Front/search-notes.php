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
                            <input id="search-note-main" type="text" class="form-control input-light-color" placeholder="Search your notes here...">
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-12">
                        <div id="search-filters">
                            <div class="row">
                                <div class="col-lg-2 col-md-4 col-sm-6 col-12 search-type-gap">
                                    <select class="text-hidden form-control options-arrow-down">
                                        <option selected disabled>Select type</option>
                                        <option>Free</option>
                                        <option>Paid</option>
                                    </select>
                                </div>
                                <div class="col-lg-2 col-md-4 col-sm-6 col-12 search-type-gap">
                                    <select class="text-hidden form-control options-arrow-down">
                                        <option selected disabled>Select category</option>
                                        <option>PDF(Digital)</option>
                                        <option>Scanned</option>
                                        <option>Hard-Copy</option>
                                        <option>Hand-writing</option>
                                    </select>
                                </div>
                                <div class="col-lg-2 col-md-4 col-sm-6 col-12 search-type-gap">
                                    <select class="text-hidden form-control options-arrow-down">
                                        <option selected disabled>Select college university</option>
                                        <option>GTU</option>
                                        <option>STU</option>
                                        <option>Nirma</option>
                                        <option>Marwadi</option>
                                        <option>Delhi University</option>
                                        <option>MS University</option>
                                    </select>
                                </div>
                                <div class="col-lg-2 col-md-4 col-sm-6 col-12 search-type-gap">
                                    <select class="text-hidden form-control options-arrow-down">
                                        <option selected disabled>Select course</option>
                                        <option>Computer-science</option>
                                        <option>Mechanical Engineering</option>
                                        <option>Civil Engineering</option>
                                        <option>Electrical Engineering</option>
                                        <option>Automobile Engineering</option>
                                        <option>Drwing</option>
                                        <option>Bio-logy</option>
                                        <option>Arts-study</option>
                                    </select>
                                </div>
                                <div class="col-lg-2 col-md-4 col-sm-6 col-12 search-type-gap">
                                    <select class="text-hidden form-control options-arrow-down">
                                        <option selected disabled>Select country</option>
                                        <option>India</option>
                                        <option>Japan</option>
                                        <option>USA</option>
                                        <option>China</option>
                                        <option>Canada</option>
                                        <option>Australia</option>
                                        <option>Pakistan</option>
                                        <option>Tajikistan</option>
                                        <option>Taiwan</option>
                                    </select>
                                </div>
                                <div class="col-lg-2 col-md-4 col-sm-6 col-12 search-type-gap">
                                    <select class="text-hidden form-control options-arrow-down">
                                        <option selected disabled>Select rating</option>
                                        <option>5</option>
                                        <option>4</option>
                                        <option>3</option>
                                        <option>2</option>
                                        <option>1</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="search-result">
            <div class="container">
                <div class="row">
                    <div id="search-result-heading">
                        <div class="col-md-12 col-md-12 col-sm-12 col-12">
                            <h2>Total 18 notes</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="note-details-box">
                            <img src="images/Search/1.jpg" alt="">
                            <div class="note-details">
                                <p class="note-name-title">Computer Operating System - Final Exam Book With Paper Solution</p>
                                <p class="note-info-with-icon"><span><img src="images/Search/university.png" alt=""></span>University of California, US</p>
                                <p class="note-info-with-icon"><span><img src="images/Search/pages.png" alt=""></span>204 Pages</p>
                                <p class="note-info-with-icon"><span><img src="images/Search/date.png" alt=""></span>Thu, Nov 26 2020</p>    
                                <p class="note-info-with-icon red-text"><span><img src="images/Search/flag.png" alt=""></span>5 Users marked this note as  inappropriate</p>

                                <div class="notes-rating">
                                    <div class="col-md-7 col-sm-8 col-8">
                                        <div class="rate">
                                            <input type="radio" id="star5" name="rate" value="5" />
                                            <label for="star5" title="text">5 stars</label>
                                            <input type="radio" id="star4" name="rate" value="4" />
                                            <label for="star4" title="text">4 stars</label>
                                            <input type="radio" id="star3" name="rate" value="3" />
                                            <label for="star3" title="text">3 stars</label>
                                            <input type="radio" id="star2" name="rate" value="2" />
                                            <label for="star2" title="text">2 stars</label>
                                            <input type="radio" id="star1" name="rate" value="1" />
                                            <label for="star1" title="text">1 star</label>
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-sm-4 col-4">
                                        <p class="review-count">150 reviews</p>
                                    </div>                                        
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="note-details-box">
                            <img src="images/Search/2.jpg" alt="">
                            <div class="note-details">
                                <p class="note-name-title">Computer Science - The complete reference</p>
                                <p class="note-info-with-icon"><span><img src="images/Search/university.png" alt=""></span>University of California, US</p>
                                <p class="note-info-with-icon"><span><img src="images/Search/pages.png" alt=""></span>204 Pages</p>
                                <p class="note-info-with-icon"><span><img src="images/Search/date.png" alt=""></span>Thu, Nov 26 2020</p>    
                                <p class="note-info-with-icon red-text"><span><img src="images/Search/flag.png" alt=""></span>5 Users marked this note as  inappropriate</p>
                                <div class="notes-rating">
                                    <div class="col-md-7 col-sm-8 col-8">
                                        <div class="rate">
                                            <input type="radio" id="star5" name="rate" value="5" />
                                            <label for="star5" title="text">5 stars</label>
                                            <input type="radio" id="star4" name="rate" value="4" />
                                            <label for="star4" title="text">4 stars</label>
                                            <input type="radio" id="star3" name="rate" value="3" />
                                            <label for="star3" title="text">3 stars</label>
                                            <input type="radio" id="star2" name="rate" value="2" />
                                            <label for="star2" title="text">2 stars</label>
                                            <input type="radio" id="star1" name="rate" value="1" />
                                            <label for="star1" title="text">1 star</label>
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-sm-4 col-4">
                                        <p class="review-count">150 reviews</p>
                                    </div>                                        
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="note-details-box">
                            <img src="images/Search/3.jpg" alt="">
                            <div class="note-details">
                                <p class="note-name-title">Basic Computer Engineering Tech India Publication Series</p>
                                <p class="note-info-with-icon"><span><img src="images/Search/university.png" alt=""></span>University of California, US</p>
                                <p class="note-info-with-icon"><span><img src="images/Search/pages.png" alt=""></span>204 Pages</p>
                                <p class="note-info-with-icon"><span><img src="images/Search/date.png" alt=""></span>Thu, Nov 26 2020</p>    
                                <p class="note-info-with-icon red-text"><span><img src="images/Search/flag.png" alt=""></span>5 Users marked this note as  inappropriate</p>
                                <div class="notes-rating">
                                    <div class="col-md-7 col-sm-8 col-8">
                                        <div class="rate">
                                            <input type="radio" id="star5" name="rate" value="5" />
                                            <label for="star5" title="text">5 stars</label>
                                            <input type="radio" id="star4" name="rate" value="4" />
                                            <label for="star4" title="text">4 stars</label>
                                            <input type="radio" id="star3" name="rate" value="3" />
                                            <label for="star3" title="text">3 stars</label>
                                            <input type="radio" id="star2" name="rate" value="2" />
                                            <label for="star2" title="text">2 stars</label>
                                            <input type="radio" id="star1" name="rate" value="1" />
                                            <label for="star1" title="text">1 star</label>
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-sm-4 col-4">
                                        <p class="review-count">150 reviews</p>
                                    </div>                                        
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="note-details-box">
                            <img src="images/Search/4.jpg" alt="">
                            <div class="note-details">
                                <p class="note-name-title">Computer Science - The complete reference - Seventh Edition</p>
                                <p class="note-info-with-icon"><span><img src="images/Search/university.png" alt=""></span>University of California, US</p>
                                <p class="note-info-with-icon"><span><img src="images/Search/pages.png" alt=""></span>204 Pages</p>
                                <p class="note-info-with-icon"><span><img src="images/Search/date.png" alt=""></span>Thu, Nov 26 2020</p>    
                                <p class="note-info-with-icon red-text"><span><img src="images/Search/flag.png" alt=""></span>5 Users marked this note as  inappropriate</p>
                                <div class="notes-rating">
                                    <div class="col-md-7 col-sm-8 col-8">
                                        <div class="rate">
                                            <input type="radio" id="star5" name="rate" value="5" />
                                            <label for="star5" title="text">5 stars</label>
                                            <input type="radio" id="star4" name="rate" value="4" />
                                            <label for="star4" title="text">4 stars</label>
                                            <input type="radio" id="star3" name="rate" value="3" />
                                            <label for="star3" title="text">3 stars</label>
                                            <input type="radio" id="star2" name="rate" value="2" />
                                            <label for="star2" title="text">2 stars</label>
                                            <input type="radio" id="star1" name="rate" value="1" />
                                            <label for="star1" title="text">1 star</label>
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-sm-4 col-4">
                                        <p class="review-count">150 reviews</p>
                                    </div>                                        
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="note-details-box">
                            <img src="images/Search/5.jpg" alt="">
                            <div class="note-details">
                                <p class="note-name-title">Computer Operating System - Final Exam Book With Paper Solution</p>
                                <p class="note-info-with-icon"><span><img src="images/Search/university.png" alt=""></span>University of California, US</p>
                                <p class="note-info-with-icon"><span><img src="images/Search/pages.png" alt=""></span>204 Pages</p>
                                <p class="note-info-with-icon"><span><img src="images/Search/date.png" alt=""></span>Thu, Nov 26 2020</p>    
                                <p class="note-info-with-icon red-text"><span><img src="images/Search/flag.png" alt=""></span>5 Users marked this note as  inappropriate</p>
                                <div class="notes-rating">
                                    <div class="col-md-7 col-sm-8 col-8">
                                        <div class="rate">
                                            <input type="radio" id="star5" name="rate" value="5" />
                                            <label for="star5" title="text">5 stars</label>
                                            <input type="radio" id="star4" name="rate" value="4" />
                                            <label for="star4" title="text">4 stars</label>
                                            <input type="radio" id="star3" name="rate" value="3" />
                                            <label for="star3" title="text">3 stars</label>
                                            <input type="radio" id="star2" name="rate" value="2" />
                                            <label for="star2" title="text">2 stars</label>
                                            <input type="radio" id="star1" name="rate" value="1" />
                                            <label for="star1" title="text">1 star</label>
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-sm-4 col-4">
                                        <p class="review-count">150 reviews</p>
                                    </div>                                        
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="note-details-box">
                            <img src="images/Search/6.jpg" alt="">
                            <div class="note-details">
                                <p class="note-name-title">Computer Science - The complete reference</p>
                                <p class="note-info-with-icon"><span><img src="images/Search/university.png" alt=""></span>University of California, US</p>
                                <p class="note-info-with-icon"><span><img src="images/Search/pages.png" alt=""></span>204 Pages</p>
                                <p class="note-info-with-icon"><span><img src="images/Search/date.png" alt=""></span>Thu, Nov 26 2020</p>    
                                <p class="note-info-with-icon red-text"><span><img src="images/Search/flag.png" alt=""></span>5 Users marked this note as  inappropriate</p>
                                <div class="notes-rating">
                                    <div class="col-md-7 col-sm-8 col-8">
                                        <div class="rate">
                                            <input type="radio" id="star5" name="rate" value="5" />
                                            <label for="star5" title="text">5 stars</label>
                                            <input type="radio" id="star4" name="rate" value="4" />
                                            <label for="star4" title="text">4 stars</label>
                                            <input type="radio" id="star3" name="rate" value="3" />
                                            <label for="star3" title="text">3 stars</label>
                                            <input type="radio" id="star2" name="rate" value="2" />
                                            <label for="star2" title="text">2 stars</label>
                                            <input type="radio" id="star1" name="rate" value="1" />
                                            <label for="star1" title="text">1 star</label>
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-sm-4 col-4">
                                        <p class="review-count">150 reviews</p>
                                    </div>                                        
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="note-details-box">
                            <img src="images/Search/1.jpg" alt="">
                            <div class="note-details">
                                <p class="note-name-title">Basic Computer Engineering Tech India Publication Series</p>
                                <p class="note-info-with-icon"><span><img src="images/Search/university.png" alt=""></span>University of California, US</p>
                                <p class="note-info-with-icon"><span><img src="images/Search/pages.png" alt=""></span>204 Pages</p>
                                <p class="note-info-with-icon"><span><img src="images/Search/date.png" alt=""></span>Thu, Nov 26 2020</p>    
                                <p class="note-info-with-icon red-text"><span><img src="images/Search/flag.png" alt=""></span>5 Users marked this note as  inappropriate</p>
                                <div class="notes-rating">
                                    <div class="col-md-7 col-sm-8 col-8">
                                        <div class="rate">
                                            <input type="radio" id="star5" name="rate" value="5" />
                                            <label for="star5" title="text">5 stars</label>
                                            <input type="radio" id="star4" name="rate" value="4" />
                                            <label for="star4" title="text">4 stars</label>
                                            <input type="radio" id="star3" name="rate" value="3" />
                                            <label for="star3" title="text">3 stars</label>
                                            <input type="radio" id="star2" name="rate" value="2" />
                                            <label for="star2" title="text">2 stars</label>
                                            <input type="radio" id="star1" name="rate" value="1" />
                                            <label for="star1" title="text">1 star</label>
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-sm-4 col-4">
                                        <p class="review-count">150 reviews</p>
                                    </div>                                        
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="note-details-box">
                            <img src="images/Search/2.jpg" alt="">
                            <div class="note-details">
                                <p class="note-name-title">Computer Operating System - Final Exam Book With Paper Solution</p>
                                <p class="note-info-with-icon"><span><img src="images/Search/university.png" alt=""></span>University of California, US</p>
                                <p class="note-info-with-icon"><span><img src="images/Search/pages.png" alt=""></span>204 Pages</p>
                                <p class="note-info-with-icon"><span><img src="images/Search/date.png" alt=""></span>Thu, Nov 26 2020</p>    
                                <p class="note-info-with-icon red-text"><span><img src="images/Search/flag.png" alt=""></span>5 Users marked this note as  inappropriate</p>
                                <div class="notes-rating">
                                    <div class="col-md-7 col-sm-8 col-8">
                                        <div class="rate">
                                            <input type="radio" id="star5" name="rate" value="5" />
                                            <label for="star5" title="text">5 stars</label>
                                            <input type="radio" id="star4" name="rate" value="4" />
                                            <label for="star4" title="text">4 stars</label>
                                            <input type="radio" id="star3" name="rate" value="3" />
                                            <label for="star3" title="text">3 stars</label>
                                            <input type="radio" id="star2" name="rate" value="2" />
                                            <label for="star2" title="text">2 stars</label>
                                            <input type="radio" id="star1" name="rate" value="1" />
                                            <label for="star1" title="text">1 star</label>
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-sm-4 col-4">
                                        <p class="review-count">150 reviews</p>
                                    </div>                                        
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="note-details-box">
                            <img src="images/Search/3.jpg" alt="">
                            <div class="note-details">
                                <p class="note-name-title">Computer Operating System - Final Exam Book With Paper Solution</p>
                                <p class="note-info-with-icon"><span><img src="images/Search/university.png" alt=""></span>University of California, US</p>
                                <p class="note-info-with-icon"><span><img src="images/Search/pages.png" alt=""></span>204 Pages</p>
                                <p class="note-info-with-icon"><span><img src="images/Search/date.png" alt=""></span>Thu, Nov 26 2020</p>    
                                <p class="note-info-with-icon red-text"><span><img src="images/Search/flag.png" alt=""></span>5 Users marked this note as  inappropriate</p>
                                <div class="notes-rating">
                                    <div class="col-md-7 col-sm-8 col-8">
                                        <div class="rate">
                                            <input type="radio" id="star5" name="rate" value="5" />
                                            <label for="star5" title="text">5 stars</label>
                                            <input type="radio" id="star4" name="rate" value="4" />
                                            <label for="star4" title="text">4 stars</label>
                                            <input type="radio" id="star3" name="rate" value="3" />
                                            <label for="star3" title="text">3 stars</label>
                                            <input type="radio" id="star2" name="rate" value="2" />
                                            <label for="star2" title="text">2 stars</label>
                                            <input type="radio" id="star1" name="rate" value="1" />
                                            <label for="star1" title="text">1 star</label>
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-sm-4 col-4">
                                        <p class="review-count">150 reviews</p>
                                    </div>                                        
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    <!-- Form Content End-->
    <!-- pagination -->
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item">
                    <a class="page-link" href="" aria-label="Previous">
                        <img src="images/pagination/left-arrow.png" alt="">
                    </a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">4</a></li>
                <li class="page-item"><a class="page-link" href="#">5</a></li>
                <li class="page-item">
                    <a class="page-link" href="" aria-label="Next">
                        <img style="color: white;" src="images/pagination/right-arrow.png" alt="">
                    </a>
                </li>
            </ul>
        </nav>
    <!-- pagination -->
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
      
    <!-- Custom JS -->
    <script src="js/script.js"></script>
    
    </body>
</html>