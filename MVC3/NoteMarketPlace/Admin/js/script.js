/* show/hide password*/
function Toggle() {
	var temp = document.getElementById("exampleInputPassword1");
	if (temp.type === "password") {
		temp.type = "text";
	} else {
		temp.type = "password";
	}
}

function Toggle1() {
	var temp = document.getElementById("oldpassword");
	if (temp.type === "password") {
		temp.type = "text";
	} else {
		temp.type = "password";
	}
}

function Toggle2() {
	var temp = document.getElementById("newpassword");
	if (temp.type === "password") {
		temp.type = "text";
	} else {
		temp.type = "password";
	}
}

function Toggle3() {
	var temp = document.getElementById("confirmpassword");
	if (temp.type === "password") {
		temp.type = "text";
	} else {
		temp.type = "password";
	}
}

function Toggle4() {
	var temp = document.getElementById("spassword");
	if (temp.type === "password") {
		temp.type = "text";
	} else {
		temp.type = "password";
	}
}

function Toggle5() {
	var temp = document.getElementById("cpassword");
	if (temp.type === "password") {
		temp.type = "text";
	} else {
		temp.type = "password";
	}
}

// show and hide navbAR

function sticky_header() {
    var header_height = jQuery('.site-header').innerHeight() / 2;
    var scrollTop = jQuery(window).scrollTop();
    if (scrollTop > header_height) {
        jQuery('body').addClass('sticky-header');
        $("#home .logo-wrapper img").attr("src", "images/logo/dark-logo.png");
    } else {
        jQuery('body').removeClass('sticky-header');
        $("#home .logo-wrapper img").attr("src", "images/logo/white-logo.png");
    }
}

jQuery(document).ready(function () {
  sticky_header();
});

jQuery(window).scroll(function () {
  sticky_header();  
});
jQuery(window).resize(function () {
  sticky_header();
});


/* =========================================
              Mobile Menu
============================================ */
$(function () {

    // Show mobile nav
    $("#mobile-nav-open-btn").click(function () {
        $("#mobile-nav").css("height", "100%");
    });

    // Hide mobile nav
    $("#mobile-nav-close-btn").click(function () {
        $("#mobile-nav").css("height", "0%");
    });
    $("#mobile-nav a").click(function () {
        $("#mobile-nav").css("height", "100%");
    });

});


/* =========================================================================
                                faq.html
============================================================================ */

// 1
$("#faq .faq1 .faq-plus")[0].addEventListener("click", function() {
  $("#faq .faq1 .faq-plus")[0].style.display = "none";
  $("#faq .faq1 .faq-minus")[0].style.display = "block";
});

$("#faq .faq1 .faq-minus")[0].addEventListener("click", function() {
  $("#faq .faq1 .faq-minus")[0].style.display = "none";
  $("#faq .faq1 .faq-plus")[0].style.display = "block";
});

// 2

$("#faq .faq2 .faq-plus")[0].addEventListener("click", function() {
  $("#faq .faq2 .faq-plus")[0].style.display = "none";
  $("#faq .faq2 .faq-minus")[0].style.display = "block";
});

$("#faq .faq2 .faq-minus")[0].addEventListener("click", function() {
  $("#faq .faq2 .faq-minus")[0].style.display = "none";
  $("#faq .faq2 .faq-plus")[0].style.display = "block";
});

// 3

$("#faq .faq3 .faq-plus")[0].addEventListener("click", function() {
  $("#faq .faq3 .faq-plus")[0].style.display = "none";
  $("#faq .faq3 .faq-minus")[0].style.display = "block";
});

$("#faq .faq3 .faq-minus")[0].addEventListener("click", function() {
  $("#faq .faq3 .faq-minus")[0].style.display = "none";
  $("#faq .faq3 .faq-plus")[0].style.display = "block";
});

// 4

$("#faq .faq4 .faq-plus")[0].addEventListener("click", function() {
  $("#faq .faq4 .faq-plus")[0].style.display = "none";
  $("#faq .faq4 .faq-minus")[0].style.display = "block";
});

$("#faq .faq4 .faq-minus")[0].addEventListener("click", function() {
  $("#faq .faq4 .faq-minus")[0].style.display = "none";
  $("#faq .faq4 .faq-plus")[0].style.display = "block";
});

// 5

$("#faq .faq5 .faq-plus")[0].addEventListener("click", function() {
  $("#faq .faq5 .faq-plus")[0].style.display = "none";
  $("#faq .faq5 .faq-minus")[0].style.display = "block";
});

$("#faq .faq5 .faq-minus")[0].addEventListener("click", function() {
  $("#faq .faq5 .faq-minus")[0].style.display = "none";
  $("#faq .faq5 .faq-plus")[0].style.display = "block";
});

// 6

$("#faq .faq6 .faq-plus")[0].addEventListener("click", function() {
  $("#faq .faq6 .faq-plus")[0].style.display = "none";
  $("#faq .faq6 .faq-minus")[0].style.display = "block";
});

$("#faq .faq6 .faq-minus")[0].addEventListener("click", function() {
  $("#faq .faq6 .faq-minus")[0].style.display = "none";
  $("#faq .faq6 .faq-plus")[0].style.display = "block";
});

// 7

$("#faq .faq7 .faq-plus")[0].addEventListener("click", function() {
  $("#faq .faq7 .faq-plus")[0].style.display = "none";
  $("#faq .faq7 .faq-minus")[0].style.display = "block";
});

$("#faq .faq7 .faq-minus")[0].addEventListener("click", function() {
  $("#faq .faq7 .faq-minus")[0].style.display = "none";
  $("#faq .faq7 .faq-plus")[0].style.display = "block";
});

