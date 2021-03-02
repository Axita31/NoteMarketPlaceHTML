/* =========================================================================
                                login.html
============================================================================ */

// Change type text to obscure text by clicking eye-image

// $(".eye-img").click(function() {
//     var input1 = $("#exampleInputPassword1").attr("type");
//     var input2 = $("#exampleInputPassword2").attr("type");
//     var input3 = $("#exampleInputPassword3").attr("type");
//     var input4 = $("#exampleInputPassword4").attr("type");
//     var input5 = $("#exampleInputPassword5").attr("type");
//     var input6 = $("#exampleInputPassword6").attr("type");

//     if (input1 == "password" || input2 == "password" || input3 == "password" || input4 == "password" || input5 == "password" || input6 == "password") {
//         $("#exampleInputPassword1").attr("type", "text");
//         $("#exampleInputPassword2").attr("type", "text");
//         $("#exampleInputPassword3").attr("type", "text");
//         $("#exampleInputPassword4").attr("type", "text");
//         $("#exampleInputPassword5").attr("type", "text");
//         $("#exampleInputPassword6").attr("type", "text");
//     } else {
//         $("#exampleInputPassword1").attr("type", "password");
//         $("#exampleInputPassword2").attr("type", "password");
//         $("#exampleInputPassword3").attr("type", "password"); 
//         $("#exampleInputPassword4").attr("type", "password");
//         $("#exampleInputPassword5").attr("type", "password");    
//         $("#exampleInputPassword6").attr("type", "password");   
//     }

// });

$("#login div.eye .eye-img").click(function () {
    var input1 = $("#exampleInputPassword1").attr("type");

    if (input1 == "password") {
        $("#exampleInputPassword1").attr("type", "text");
    } else {
        $("#exampleInputPassword1").attr("type", "password");
    }
});

$("#sign-up form .form-group:nth-child(4) div.eye .eye-img").click(function () {
    var input1 = $("#exampleInputPassword1").attr("type");

    if (input1 == "password") {
        $("#exampleInputPassword1").attr("type", "text");
    } else {
        $("#exampleInputPassword1").attr("type", "password");
    }
});

$("#sign-up form .form-group:nth-child(5) div.eye .eye-img").click(function () {
    var input1 = $("#exampleInputPassword1").attr("type");

    if (input1 == "password") {
        $("#exampleInputPassword1").attr("type", "text");
    } else {
        $("#exampleInputPassword1").attr("type", "password");
    }
});

$("#change-pwd form .form-group:nth-child(1) div.eye .eye-img").click(function () {
    var input4 = $("#exampleInputPassword1").attr("type");

    if (input4 == "password") {
        $("#exampleInputPassword1").attr("type", "text");
    } else {
        $("#exampleInputPassword1").attr("type", "password");
    }
});

$("#change-pwd form .form-group:nth-child(2) div.eye .eye-img").click(function () {
    var input5 = $("#exampleInputPassword1").attr("type");

    if (input5 == "password") {
        $("#exampleInputPassword1").attr("type", "text");
    } else {
        $("#exampleInputPassword1").attr("type", "password");
    }
});

$("#change-pwd form .form-group:nth-child(3) div.eye .eye-img").click(function () {
    var input6 = $("#exampleInputPassword1").attr("type");

    if (input6 == "password") {
        $("#exampleInputPassword1").attr("type", "text");
    } else {
        $("#exampleInputPassword1").attr("type", "password");
    }
});




// when password is incorrect then it will add div under password input that will show "you've entered incorrect password"
// document.getElementsByClassName("form-btn").onclick = function() {
//     document.getElementsByClassName("incorrect-password-label").style.display = "block";
// }


// your account has benn successfully created
// $("#signup-btn")[0].addEventListener("click", function() {
//     document.getElementsByClassName("success-msg")[0].style.display = "block";
// });




// navbar

function sticky_header() {
    var header_height = jQuery('.site-header').innerHeight();
    var scrollTop = jQuery(window).scrollTop();
    if (scrollTop > header_height) {
        jQuery('body').addClass('sticky-header');
        $("#home-header .logo-wrapper img").attr("src", "images/logo/dark-logo.png");
    } else {
        jQuery('body').removeClass('sticky-header');
        $("#home-header .logo-wrapper img").attr("src", "images/logo/white-logo.png");
    }
    if (scrollTop > header_height) {
        jQuery('body').addClass('sticky-header');
        $("#home-header .only-white-nav .site-header .header-wrapper .navigation-wrapper .main-nav .menu-navigation > li a ").css("color", "#333333");
    } else {
        jQuery('body').addClass('sticky-header');
        $("#home-header .only-white-nav .site-header .header-wrapper .navigation-wrapper .main-nav .menu-navigation > li a ").css("color", "#fff");
    }
    if (scrollTop > header_height) {
        jQuery('body').addClass('sticky-header');
        $("#home-header .only-white-nav .site-header .header-wrapper .navigation-wrapper .main-nav .menu-navigation > li a.btn-general ").css("color", "#fff");
    } else {
        jQuery('body').addClass('sticky-header');
        $("#home-header .only-white-nav .site-header .header-wrapper .navigation-wrapper .main-nav .menu-navigation > li a.btn-general ").css("color", "#fff");
    }
    if (scrollTop > header_height) {
        // Show white nav
        $("#home-header").addClass("white-nav-top");
        $(".site-header").css("background-color", "#fff");
    } else {
        // Hide white nav
        $("#home-header").removeClass("white-nav-top");
        $(".site-header").css("background-color", "transparent");
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
    $("#mobile-nav-close-btn, #mobile-nav a").click(function () {
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
$("#faq .faq1 .faq-plus")[0].addEventListener("click", function () {
    $("#faq .faq1 .faq-plus")[0].style.display = "none";
    $("#faq .faq1 .faq-minus")[0].style.display = "block";
});

$("#faq .faq1 .faq-minus")[0].addEventListener("click", function () {
    $("#faq .faq1 .faq-minus")[0].style.display = "none";
    $("#faq .faq1 .faq-plus")[0].style.display = "block";
});

// 2

$("#faq .faq2 .faq-plus")[0].addEventListener("click", function () {
    $("#faq .faq2 .faq-plus")[0].style.display = "none";
    $("#faq .faq2 .faq-minus")[0].style.display = "block";
});

$("#faq .faq2 .faq-minus")[0].addEventListener("click", function () {
    $("#faq .faq2 .faq-minus")[0].style.display = "none";
    $("#faq .faq2 .faq-plus")[0].style.display = "block";
});

// 3

$("#faq .faq3 .faq-plus")[0].addEventListener("click", function () {
    $("#faq .faq3 .faq-plus")[0].style.display = "none";
    $("#faq .faq3 .faq-minus")[0].style.display = "block";
});

$("#faq .faq3 .faq-minus")[0].addEventListener("click", function () {
    $("#faq .faq3 .faq-minus")[0].style.display = "none";
    $("#faq .faq3 .faq-plus")[0].style.display = "block";
});

// 4

$("#faq .faq4 .faq-plus")[0].addEventListener("click", function () {
    $("#faq .faq4 .faq-plus")[0].style.display = "none";
    $("#faq .faq4 .faq-minus")[0].style.display = "block";
});

$("#faq .faq4 .faq-minus")[0].addEventListener("click", function () {
    $("#faq .faq4 .faq-minus")[0].style.display = "none";
    $("#faq .faq4 .faq-plus")[0].style.display = "block";
});

// 5

$("#faq .faq5 .faq-plus")[0].addEventListener("click", function () {
    $("#faq .faq5 .faq-plus")[0].style.display = "none";
    $("#faq .faq5 .faq-minus")[0].style.display = "block";
});

$("#faq .faq5 .faq-minus")[0].addEventListener("click", function () {
    $("#faq .faq5 .faq-minus")[0].style.display = "none";
    $("#faq .faq5 .faq-plus")[0].style.display = "block";
});

// 6

$("#faq .faq6 .faq-plus")[0].addEventListener("click", function () {
    $("#faq .faq6 .faq-plus")[0].style.display = "none";
    $("#faq .faq6 .faq-minus")[0].style.display = "block";
});

$("#faq .faq6 .faq-minus")[0].addEventListener("click", function () {
    $("#faq .faq6 .faq-minus")[0].style.display = "none";
    $("#faq .faq6 .faq-plus")[0].style.display = "block";
});

// 7

$("#faq .faq7 .faq-plus")[0].addEventListener("click", function () {
    $("#faq .faq7 .faq-plus")[0].style.display = "none";
    $("#faq .faq7 .faq-minus")[0].style.display = "block";
});

$("#faq .faq7 .faq-minus")[0].addEventListener("click", function () {
    $("#faq .faq7 .faq-minus")[0].style.display = "none";
    $("#faq .faq7 .faq-plus")[0].style.display = "block";
});