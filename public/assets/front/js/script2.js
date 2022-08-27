$("#form_email").keyup(function () {
  var pattern = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  var email = $("#form_email").val();

  if (pattern.test(email) && email !== "") {
    $("#form_email").css("border", "1px solid #ff027c");
    $(".disnon-email").css("display", "block");
    $(".emailmsg").fadeOut("fast");
  } else {
    $(".colorred").css("color", "red");
    $("#form_email").css("border", "1px solid red");
    $(".emailmsg").fadeIn("fast");
    error_email = true;
  }
});

$("#mypass").keyup(function () {
  var patternpass = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
  var mypass = $("#mypass").val();
  if (patternpass.test(mypass) && mypass !== "") {
    $("#mypass").css("border", "1px solid #d2ddec");
    $(".passmsg").fadeOut("fast");
  } else {
    $(".colorred").css("color", "red");
    $("#mypass").css("border", "1px solid red");
    $(".passmsg").fadeIn("fast");
    error_pass = true;
  }
});

$("#firstname").keyup(function () {
  var firstname = $("#firstname").val();
  if (firstname !== "") {
    $("#firstname").css("border", "1px solid #d2ddec");
    $(".fnamemsg").fadeOut("fast");
  } else {
    $(".colorred").css("color", "red");
    $("#firstname").css("border", "1px solid red");
    $(".fnamemsg").fadeIn("fast");
    error_fname = true;
  }
});

$("#lastname").keyup(function () {
  var lastname = $("#lastname").val();
  if (lastname !== "") {
    $("#lastname").css("border", "1px solid #d2ddec");
    $(".lnamemsg").fadeOut("fast");
  } else {
    $(".colorred").css("color", "red");
    $("#lastname").css("border", "1px solid red");
    $(".lnamemsg").fadeIn("fast");
    error_lname = true;
  }
});

$("#phonenum").keyup(function () {
  var phonenum = $("#phonenum").val();
  if (phonenum !== "") {
    $("#phonenum").css("border", "1px solid #d2ddec");
    $(".phonemsg").fadeOut("fast");
  } else {
    $(".colorred").css("color", "red");
    $("#phonenum").css("border", "1px solid red");
    $(".phonemsg").fadeIn("fast");
    error_phone = true;
  }
});

$("#signupp1").click(function (e) {
  e.preventDefault();
  var error_email = false;
  var pattern = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  var email = $("#form_email").val();
  if (pattern.test(email) && email !== "") {
    $("#form_email").css("border", "1px solid #ff027c");
    $(".disnon-email").css("display", "block");
    $(".emailmsg").fadeOut("fast");
  } else {
    $(".colorred").css("color", "red");
    $("#form_email").css("border", "1px solid red");
    $(".emailmsg").fadeIn("fast");
    error_email = true;
  }

  if (error_email === false) {
    const submitButton = document.querySelector(".loadingsubmitbtn");
    const timeOut = 1500;

    /**
     * Add Loading Animation
     */
    const addLoading = (button) => {
      const addLoader = document.createElement("div");

      addLoader.classList.add("btn-loader");
      button.appendChild(addLoader);
      button.classList.add("is-loading");
      button.setAttribute("disabled", "disabled");

      // Demo Remove Loader
      setTimeout(() => {
        removeLoading(button);
        //  window.location.href = "./sign-in.html";
        $(".signuppart1").css("display", "none");
        $(".signuppart2").css("display", "block");
      }, timeOut);
    };

    /**
     * Remove Loading Animation
     */
    const removeLoading = (button) => {
      const loader = button.querySelector(".btn-loader");

      if (loader) {
        button.classList.remove("is-loading");
        loader.remove();
        button.removeAttribute("disabled");
      }
    };

    /**
     * Demo
     */

    removeLoading(submitButton);
    addLoading(submitButton);

    return true;
  } else {
    return false;
  }
});

$("#signupp2").click(function (e) {
  e.preventDefault();
  var error_pass = false;
  var error_lname = false;
  var error_fname = false;
  var error_phone = false;

  var patternpass = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
  var mypass = $("#mypass").val();
  if (patternpass.test(mypass) && mypass !== "") {
    $("#mypass").css("border", "1px solid #d2ddec");
    $(".passmsg").fadeOut("fast");
  } else {
    $(".colorred").css("color", "red");
    $("#mypass").css("border", "1px solid red");
    $(".passmsg").fadeIn("fast");
    error_pass = true;
  }

  var firstname = $("#firstname").val();
  if (firstname !== "") {
    $("#firstname").css("border", "1px solid #d2ddec");
    $(".fnamemsg").fadeOut("fast");
  } else {
    $(".colorred").css("color", "red");
    $("#firstname").css("border", "1px solid red");
    $(".fnamemsg").fadeIn("fast");
    error_fname = true;
  }

  var lastname = $("#lastname").val();
  if (lastname !== "") {
    $("#lastname").css("border", "1px solid #d2ddec");
    $(".lnamemsg").fadeOut("fast");
  } else {
    $(".colorred").css("color", "red");
    $("#lastname").css("border", "1px solid red");
    $(".lnamemsg").fadeIn("fast");
    error_lname = true;
  }

  var phonenum = $("#phonenum").val();
  if (phonenum !== "") {
    $("#phonenum").css("border", "1px solid #d2ddec");
    $(".phonemsg").fadeOut("fast");
  } else {
    $(".colorred").css("color", "red");
    $("#phonenum").css("border", "1px solid red");
    $(".phonemsg").fadeIn("fast");
    error_phone = true;
  }

  if (
    error_pass === false &&
    error_fname === false &&
    error_lname === false &&
    error_phone === false
  ) {
    window.location.href = "./index.html";
    return true;
  } else {
    return false;
  }
});

// $("#resetpasswrd").on("hidden.bs.modal", function () {
//   $(".header").css("display", "block");
// });

// $("#signupmodal").on("hidden.bs.modal", function () {
//   $(".header").css("display", "block");
// });

// $("#signinmodal").on("hidden.bs.modal", function () {
//   $(".header").css("display", "block");
// });

$(".resetbtnjs").click(function () {
  $("#signinmodal").modal("hide");
  $("#signupmodal").modal("hide");
  $("#resetpasswrd").modal("show");
  //   $(".header").css("display","none");
});

$(".signinbtnjs").click(function () {
  $("#resetpasswrd").modal("hide");
  $("#signupmodal").modal("hide");
  $("#signinmodal").modal("show");
  //   $(".header").css("display", "none");
});

$(".signupbtnjs").click(function () {
  $("#resetpasswrd").modal("hide");
  $("#signinmodal").modal("hide");
  $("#signupmodal").modal("show");
  //   $(".header").css("display", "none");
});

// $(".signinmodal").click(function () {
//   $(".header").css("display", "none");
// });
// $(".signupmodal").click(function () {
//   $(".header").css("display", "none");
// });

// $(".resetpasswrd").click(function () {
//   $(".header").css("display", "none");
// });

$(".benefitsshowmore").click(function () {
  if ($(".benefitstext").hasClass("benefitsshow-more-height")) {
    $(this).html(
      "<span>Hide Package Details</span> <img src='./img/arrow-square-down.svg' />"
    );
  } else {
    $(this).html(
      "<span>Show Package Details</span> <img src='./img/arrow-square-down.svg' />"
    );
  }

  $(".benefitstext").toggleClass("benefitsshow-more-height");
});

// $(".benefitsshowmore2").click(function () {
//   $("#dura1").css("display", "none");
// });

$("#dura1").css("display", "none");
$("#dura2").css("display", "none");
$(".benefitsshowmore2").click(function () {
  if ($(".benefitstext2").hasClass("benefitsshow-more-height")) {
    $(this).html("Hide <i class='fa fa-angle-up'></i>");
    $("#dura1").css("display", "block");
  } else {
    $(this).html("Show more <i class='fa fa-angle-down'></i>");
    $("#dura1").css("display", "none");
    
  }

  $(".benefitstext2").toggleClass("benefitsshow-more-height");
});
$(".benefitsshowmore3").click(function () {
  if ($(".benefitstext3").hasClass("benefitsshow-more-height")) {
    $(this).html("Hide <i class='fa fa-angle-up'></i>");
    $("#dura2").css("display", "block");
  } else {
    $(this).html("Show more <i class='fa fa-angle-down'></i>");
    $("#dura2").css("display", "none");
  }

  $(".benefitstext3").toggleClass("benefitsshow-more-height");
});

$(".enternamedid").click(function () {
  $(".enternamedid").css("display", "none");
  $("#enternamediv").css("display", "flex");
});

$(".creditcardactive").click(function () {
  $(".maindivcreditcard").css("display", "block");
});

$(".plusadults").click(function () {
  $("#inputadults1").val(parseInt($("#inputadults1").val()) + 1);

  if ($("#inputadults1").val() >= 14) {
    $(".plusadults").attr("disabled", true);
  }
  if ($("#inputadults1").val() >= 1) {
    $(".minusadults").removeAttr("disabled");
  }
});

$(".minusadults").click(function () {
  $("#inputadults1").val(parseInt($("#inputadults1").val()) - 1);

  if ($("#inputadults1").val() < 1) {
    $(".minusadults").attr("disabled", true);
  }

  if ($("#inputadults1").val() <= 13) {
    $(".plusadults").removeAttr("disabled");
  }
});

$(".pluschild").click(function () {
  $("#inputchild").val(parseInt($("#inputchild").val()) + 1);

  if ($("#inputchild").val() >= 6) {
    $(".pluschild").attr("disabled", true);
  }
  if ($("#inputchild").val() >= 1) {
    $(".minuschild").removeAttr("disabled");
  }
});

$(".minuschild").click(function () {
  $("#inputchild").val(parseInt($("#inputchild").val()) - 1);

  if ($("#inputchild").val() <= 0) {
    $(".minuschild").attr("disabled", true);
  }

  if ($("#inputchild").val() <= 5) {
    $(".pluschild").removeAttr("disabled");
  }
});



$(".plusJs").click(function () {
  $("#inputJs").val(parseInt($("#inputJs").val()) + 1);

  if ($("#inputJs").val() >= 3) {
    $(".plusJs").attr("disabled", true);
  }
  if ($("#inputJs").val() >= 1) {
    $(".minusJs").removeAttr("disabled");
  }
});

$(".minusJs").click(function () {
  $("#inputJs").val(parseInt($("#inputJs").val()) - 1);

  if ($("#inputJs").val() <= 1) {
    $(".minusJs").attr("disabled", true);
  }

  if ($("#inputJs").val() <= 3) {
    $(".plusJs").removeAttr("disabled");
  }
});

$(".plusbed").click(function () {
  $("#inputbed").val(parseInt($("#inputbed").val()) + 1);

  if ($("#inputbed").val() >= 4) {
    $(".plusbed").attr("disabled", true);
  }
  if ($("#inputbed").val() >= 3) {
    $(".minusbed").removeAttr("disabled");
  }
});

$(".minusbed").click(function () {
  $("#inputbed").val(parseInt($("#inputbed").val()) - 1);

  if ($("#inputbed").val() <= 3) {
    $(".minusbed").attr("disabled", true);
  }

  if ($("#inputbed").val() <= 4) {
    $(".plusbed").removeAttr("disabled");
  }
});







$(".entercoupendid").click(function () {
  $(".entercoupendid").css("display", "none");
  $("#entercoupendiv").css("display", "flex");
});
$(".cancelcoupen").click(function () {
  $("#entercoupendiv").css("display", "none");
   $(".entercoupendid").css("display", "block");
});

function addslash(element) {
  let ele = document.getElementById(element.id);
  ele = ele.value.split("/").join(""); // Remove slash (/) if mistakenly entered.

  let finalVal = ele.match(/.{1,2}/g).join("/");
  document.getElementById(element.id).value = finalVal;
}

function addspace(element) {
  let ele = document.getElementById(element.id);
  ele = ele.value.split(" ").join(""); // Remove space ( ) if mistakenly entered.

  let finalVal = ele.match(/.{1,4}/g).join(" ");
  document.getElementById(element.id).value = finalVal;
}



// Click to Copy
var tooltip = document.getElementById('myTooltip');
var copyText = document.getElementById('couponCode');
function myFunction() {
	copyText.select();
	copyText.setSelectionRange(0, 99999);
	document.execCommand('copy');
	tooltip.innerHTML = 'Copied: ' + copyText.value;
}
function outFunc() {
	tooltip.innerHTML = 'Copy to clipboard';
}


// checkout new

// $("#chseroom").children().off("click");
$("#chseroom input[type=radio]").attr("disabled", true);
$("#chseroom").css("opacity", ".32");


$(".minusJs").attr("disabled", true);
$(".plusJs").attr("disabled", true);
$("#chseocp").css("opacity", ".32");

$("#chsestay input[type=radio]").attr("disabled", true);
$("#chsestay").css("opacity", ".32");

$("#chsegender input[type=radio]").attr("disabled", true);
$("#chsegender").css("opacity", ".32");

$("#chsecostume select").attr("disabled", "disabled");
$("#chsecostume").css("opacity", ".32");

$("#chseevent input[type=checkbox]").attr("disabled", true);
$("#chseevent").css("opacity", ".32");

$("#chseaddservice input[type=checkbox]").attr("disabled", true);
$("#chseaddservice").css("opacity", ".32");

$("#chsepayoption input[type=radio]").attr("disabled", true);
$("#chsepayoption").css("opacity", ".32");



$("#chsehotel input[type=radio]").click(function () {
  $("#chseroom input[type=radio]").attr("disabled", false);
  $("#chseroom").css("opacity", "1");

});

$("#chseroom input[type=radio]").click(function () {
   $(".minusJs").attr("disabled", false);
   $(".plusJs").attr("disabled", false);
  $("#chseocp").css("opacity", "1");
});

$("#chseocp .minusJs, .plusJs, .minusbed, .plusbed").click(function () {
   $("#chsestay input[type=radio]").attr("disabled", false);
  $("#chsestay").css("opacity", "1");
});

$("#chsestay input[type=radio]").click(function () {
   $("#chsegender input[type=radio]").attr("disabled", false);
  $("#chsegender").css("opacity", "1");
});

$("#chsegender input[type=radio]").click(function () {
  $("#chsecostume select").removeAttr("disabled");
  $("#chsecostume").css("opacity", "1");
});

$("#chsecostume ").click(function () {
    $("#chseevent input[type=checkbox]").attr("disabled", false);
  $("#chseevent").css("opacity", "1");
});

$("#chseevent input[type=checkbox]").click(function () {
  $("#chseaddservice input[type=checkbox]").attr("disabled", false);
  $("#chseaddservice").css("opacity", "1");
});

$("#chseaddservice input[type=checkbox]").click(function () {
   $("#chsepayoption input[type=radio]").attr("disabled", false);
  $("#chsepayoption").css("opacity", "1");
});

$("#chsepayoption input[type=radio]").click(function () {
  $("#traveldet").css("display", "block");
});

$("#conttopay").click(function () {
   $("#chsepaymet").css("display", "block");
}); 

