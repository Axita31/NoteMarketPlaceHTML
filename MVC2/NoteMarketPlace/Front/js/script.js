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

/*function validatePassword() {
	var validator = $("#signup-form").validate({
		rules: {
			spassword: "required",
			scpassword: {
				equalTo: "#spassword"
			}
		},
		messages: {
			spassword: " Enter Password",
			scpassword: " Enter Confirm Password Same as Password"
		}
	});
	if (validator.form()) {
		alert('Sucess');
	}
}
*/

function Delete() {
	if (confirm("are you sure, you want to delete this notes")) {
		window.location=anchor.attr("href");
	} else {
		txt = "You pressed Cancel!";
	}
}

function Publish() {
	if (confirm("Publishing this note will send note to administrator for review, once administrator review and approve then this note will be published to portal. Press yes to continue.” ")) {
		window.location=anchor.attr("href");
	} else {
		txt = "You pressed Cancel!";
	}
}

function Report() {
	if (confirm("Are you sure you want to mark this report as spam, you cannot update it later?")) {
		txt = "You pressed OK!";
	} else {
		txt = "You pressed Cancel!";
	}
}


function reject() {
	if (confirm("for reject popup")) {
		txt = "You pressed OK!";
	} else {
		txt = "You pressed Cancel!";
	}
}

function deactivate() {
	if (confirm("Are you sure you want to make this member inactive?")) {
		txt = "You pressed OK!";
	} else {
		txt = "You pressed Cancel!";
	}
}

function inreview() {
	if (confirm("Via marking the note In Review – System will let user know that review process has been initiated. Please press yes to continue.")) {
		txt = "You pressed OK!";
	} else {
		txt = "You pressed Cancel!";
	}
}

function approve() {
	if (confirm("If you approve the notes – System will publish the notes over portal. Please press yes to continue.")) {
		txt = "You pressed OK!";
	} else {
		txt = "You pressed Cancel!";
	}
}

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


//enable and disable price input
function disablePrice() {
    $("#price-box").attr("disabled", true);
    $("#price-box").attr("required", false);
  }
function enablePrice() {
    $("#price-box").attr("disabled", false);
    $("#price-box").attr("required", true);
  }
  
  //show file name
  var input = document.getElementById("upload-file");
  var infoArea = document.getElementById("file-upload-filename");
  input.addEventListener("change", showFileName);
  function showFileName(event) {
    var input = event.srcElement;
    var fileName = input.files[0].name;
    infoArea.textContent = "File name: " + fileName;
}
  
  //show file name
  var input2 = document.getElementById("note-preview");
  var infoArea2 = document.getElementById("file-upload-filename2");
  input2.addEventListener("change", showFileName2);
  function showFileName2(event) {
    var input2 = event.srcElement;
    var fileName2 = input2.files[0].name;
    infoArea2.textContent = "File name: " + fileName2;
  }

/*========================================================
            Star
=================================================*/

$(document).ready(function(){
  
  /* 1. Visualizing things on Hover - See next part for action on click */
  $('#stars li').on('mouseover', function(){
    var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on
   
    // Now highlight all the stars that's not after the current hovered star
    $(this).parent().children('li.star').each(function(e){
      if (e < onStar) {
        $(this).addClass('hover');
      }
      else {
        $(this).removeClass('hover');
      }
    });
    
  }).on('mouseout', function(){
    $(this).parent().children('li.star').each(function(e){
      $(this).removeClass('hover');
    });
  });
  
  
  /* 2. Action to perform on click */
  $('#stars li').on('click', function(){
    var onStar = parseInt($(this).data('value'), 10); // The star currently selected
    var stars = $(this).parent().children('li.star');
    
    for (i = 0; i < stars.length; i++) {
      $(stars[i]).removeClass('selected');
    }
    
    for (i = 0; i < onStar; i++) {
      $(stars[i]).addClass('selected');
    }
    
    // JUST RESPONSE (Not needed)
    var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
    var msg = "";
    if (ratingValue > 1) {
        msg = "Thanks! You rated this " + ratingValue + " stars.";
    }
    else {
        msg = "We will improve ourselves. You rated this " + ratingValue + " stars.";
    }
    responseMessage(msg);
    
  });
  
  
});