/* Comment */
function userComment($id, $username) {
    var $message = document.getElementById("comment-message" + $id).value;

    function functionResults(xmlhttp) {
        if (xmlhttp == "success") {
            alert("Comment successfully posted!.");
            window.location.assign("dashboard.php");
        } else {
            alert("An error occured Please try again.");
        }
    }
    globalPhpAjax("GET", "controller/core.controller.php?action=postcomment&username=" + $username + "&img_id=" + $id + "&message=" + $message, functionResults);
}
/* End Comment */
/* Change Password */
function userChangePassword($username) {
    //Receive input
    var $pass = document.getElementById("f-pass").value;
    var $confirmpass = document.getElementById("f-pass-confirm").value;

    if ($pass == "" || $confirmpass == "") {
        alert("Please fill in all text fields!");
        return;
    }
    if ($pass.length <= 6 || $confirmpass.length <= 6) {
        alert("Password length should be morethan 6 charecters!");
        return;
    }
    if ($pass != $confirmpass) {
        alert("Password must be the same as confirm password.");
        return;
    }
    if (isLowerCase($pass) == true) {
        alert("Password must be combination of Lower Case and Upper Case and Numbers.");
        return;
    }

    function functionResults(xmlhttp) {
        if (xmlhttp == "success") {
            alert("Password successfully changed login with a new password now!.");
            window.location.assign("index.php");
        } else {
            alert("An error occured Please try again.");
        }
    }
    globalPhpAjax("GET", "controller/account.controller.php?action=changepass&username=" + $username + "&pass=" + $pass, functionResults);
}
/* End Change Password */

/* Post Image Cam and Upload Containers */
function indexWebCam() {
    document.getElementById("cmi-cam").style.display = "";
    document.getElementById("cmi-upload").style.display = "none";
}

function indexUpload() {
    document.getElementById("cmi-cam").style.display = "none";
    document.getElementById("cmi-upload").style.display = "";
}
/* End Post Image Cam and Upload Containers */
/* it User Profile */
function userSaveEditProfile(log) {
    var $username = document.getElementById("e-username").value;
    var $email = document.getElementById("e-email").value;
    var $pass = document.getElementById("e-pass").value;
    var $ems = document.getElementById("e-ems").value;

    if ($username == "" || $email == "" || $pass == "") {
        alert("Please fill in all text fields!");
        return;
    }
    if ($pass.length <= 6) {
        alert("Password length should be morethan 6 charecters long!");
        return;
    }
    if (isLowerCase($pass) == true) {
        alert("Profile already edited if you did not edit any values please do so before saving the profile.");
        return;
    }

    function functionResults(xmlhttp) {
        if (xmlhttp == "success") {
            alert("Profile successfully edited.");
            window.location.assign("profile.php");
        } else {
            alert("An error occured please try again first logout and login then edit your information.");
        }
    }
    globalPhpAjax("GET", "controller/account.controller.php?action=edit&username=" + $username + "&email=" + $email + "&pass=" + $pass + "&ems=" + $ems + '&log=' + log, functionResults);
}
/* End it User Profile */
/* Index Page Functions */
//Hides Other sections
function indexHideLoginRegister() {
    document.getElementById("index-account-gallery").style.display = "";
    document.getElementById("index-account-form-register").style.display = "none";
    document.getElementById("index-account-form-login").style.display = "none";
    document.getElementById("index-account-form-forgot-password").style.display = "none";
}
//Show Accounts
function indexHideForgotPass() {
    document.getElementById("index-account-gallery").style.display = "none";
    document.getElementById("index-account-form-forgot-password").style.display = "none";
    document.getElementById("index-account-form-login").style.display = "";
    document.getElementById("index-account-form-register").style.display = "none";
}
//Hide Accounts
function indexShowForgotPass() {
    document.getElementById("index-account-gallery").style.display = "none";
    document.getElementById("index-account-form-forgot-password").style.display = "";
    document.getElementById("index-account-form-login").style.display = "none";
    document.getElementById("index-account-form-register").style.display = "none";
}
//Hides login section
function indexHideLogin() {
    document.getElementById("index-account-gallery").style.display = "none";
    document.getElementById("index-account-form-register").style.display = "";
    document.getElementById("index-account-form-login").style.display = "none";
    document.getElementById("index-account-form-forgot-password").style.display = "none";
}
//Hides register section
function indexHideRegister() {
    document.getElementById("index-account-gallery").style.display = "none";
    document.getElementById("index-account-form-register").style.display = "none";
    document.getElementById("index-account-form-forgot-password").style.display = "none";
    document.getElementById("index-account-form-login").style.display = "";
}
/* End Index Page Functions */
/* Forgot Password for existing users */
function userForgetPassword() {
    //Receive input
    var $email = document.getElementById("f-email").value;
    if ($email == "") {
        alert("Please fill in your email address!");
        return;
    }

    function functionResults(xmlhttp) {
        if (xmlhttp == "success") {
            alert("An email has been sent to your account with your password and instructions to change it.");
            window.location.assign("index.php");
        } else {
            alert("An error occured please type in a correct password or email address\nIf you are a new user register for a new account.");
        }
    }
    globalPhpAjax("GET", "controller/account.controller.php?action=forgot&email=" + $email, functionResults);
}
/* End Forgot Password for existing users */
/* Login for existing users */
function userLogin() {
    //Receive input
    var $username = document.getElementById("l-username").value;
    var $pass = document.getElementById("l-password").value;
    if ($username == "" || $pass == "") {
        alert("Please fill in all text fields!");
        return;
    }

    function functionResults(xmlhttp) {
        if (xmlhttp == "success") {
            alert("Login in success.");
            window.location.assign("dashboard.php");
        } else {
            alert("An error occured and it might be because your email/username or password is incorrect or you haven't confirmed your email address or you don't have an account.");
        }
    }
    globalPhpAjax("GET", "controller/account.controller.php?action=login&username=" + $username + "&pass=" + $pass, functionResults);
}
/* End Login for existing users*/
/* Registration Function for new users */
function userRegistration() {
    //Receive input
    var $username = document.getElementById("r-username").value;
    var $email = document.getElementById("r-email").value;
    var $pass = document.getElementById("r-pass").value;
    var $confirmpass = document.getElementById("r-confirmpass").value;

    if ($username == "" || $email == "" || $confirmpass == "" || $pass == "") {
        alert("Please fill in all text fields!");
        return;
    }
    if ($pass.length <= 6 || $confirmpass.length <= 6) {
        alert("Password length should be morethan 6 charecters!");
        return;
    }
    if ($pass != $confirmpass) {
        alert("Password must be the same as confirm password.");
        return;
    }
    if (isLowerCase($pass) == true) {
        alert("Password must be combination of Lower Case and Upper Case and Numbers.");
        return;
    }

    function functionResults(xmlhttp) {
        if (xmlhttp == "success") {
            indexHideRegister();
            alert("Account created successfully and an email is sent to your email address.\n To login validate your email address first using a unique url that is sent to you and login.");
        } else {
            alert("An error occured while creating your account, the problem might be a duplicate of email addresses/username please try again using different email address.");
        }
    }
    globalPhpAjax("GET", "controller/account.controller.php?action=registration&username=" + $username + "&email=" + $email + "&pass=" + $pass, functionResults);
}
/* End Registration Function for new users */
/* Upload Image */
function userUploadImage() {
    //Receive input
    var $img = document.getElementById("upload-image").files[0];
    var fd = new FormData();
    var $count = 1;
    var $count_fd = 0;

    if (document.getElementById('s-glasses').checked) {
        $count_fd = $count_fd + 1;
        if ($count_fd == 1) {
            fd.append("sp1", "glasses");
        }
    }
    if (document.getElementById('s-hat').checked) {
        $count_fd = $count_fd + 1;
        if ($count_fd == 1) {
            fd.append("sp1", "hat");
        } else if ($count_fd == 2) {
            fd.append("sp2", "hat");
        }
    }
    if (document.getElementById('s-thumbs').checked) {
        $count_fd = $count_fd + 1;
        if ($count_fd == 1) {
            fd.append("sp1", "thumb");
        } else if ($count_fd == 2) {
            fd.append("sp2", "thumb");
        } else if ($count_fd == 3) {
            fd.append("sp3", "thumb");
        }
    }

    if ($count_fd == 0) {
        alert("You did not select a sticker.");
    }

    if ($img == undefined) {
        alert("Upload an image.");
        return;
    }

    fd.append("sps", $count_fd);
    fd.append("action", "uploadimg");
    fd.append("upimg", $img);
    var xmlhttp = new XMLHttpRequest();
    //To be called when we server response is ready
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            alert(this.responseText);
            window.location.assign("post_image.php");
        }
    };
    //Sending request to a php file
    xmlhttp.open("POST", "controller/core.controller.php", true);
    xmlhttp.send(fd);
}
/* End Upload Image */

/* Delete Image */
function userDeleteImage($id, $url) {

    if ($id == "" || $url == "") {
        alert("An error occured! Please refresh the page and try again!");
        return;
    }

    function functionResults(xmlhttp) {
        if (xmlhttp == "success") {
            alert("Image successfully deleted.");
            window.location.assign("post_image.php");
        } else {
            alert("An error occured! Please refresh the page and try again!");
        }
    }
    globalPhpAjax("GET", "controller/core.controller.php?action=imgdelete&imgid=" + $id + "&imgurl=" + $url, functionResults);
}
/* End Delete Image */