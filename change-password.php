<?php
    error_reporting(E_ALL);
    ini_set("display_errors", "on");

    require("config/database.php");
    include("model/account.model.php");
    include("view/account.view.php");

    if ($_GET['action'] == "changepass"){
        $obj = new SanitizeSecurity();
        $pass = $obj->cleanString($_GET['action_sender']);
        $username = $obj->cleanString($_GET['action_name']);
        
        $obj2 = new DatabaseQuering();
        $returnVal = $obj2->selectReturn("`users`", "*", "`pass` = '$pass' AND `username` = '$username'");
        if ($returnVal != "error"){
            
        }else{
            header("Location: index.php");
        }
    }
?>
<!DOCTYPE html>
<html>

<head>
    <title>Camagru</title>
    <!-- Header -->
    <?php require("includes/header.php");?>
    <!-- End Header -->
</head>

<body>
    <!-- Contnent -->
    <div class="container index-container">
        <center><img class="index-img" src="rsc/img/gallery.svg" /></center>
    </div>
    <h1 class="text-center big-text marin-0">Change Password</h1>
    <div class="index-account-form-content-main">
        <div class="index-account-form-content force-height"></div>
        <div class="index-account-form-content margin-10" id="index-account-form-forgot-password">
            <label>Password:</label><br />
            <input id="f-pass" type="email" require /><br />
            <label>Confirm Password:</label><br />
            <input id="f-pass-confirm" type="email" require /><br />
            <center>
                <button class="index-account-btn-lr" onclick='userChangePassword("<?php echo $username;?>");'>Change Password</button>
            </center>
        </div>
        <div class="index-account-form-content force-height"></div>
    </div>
    <!-- End Content -->
</body>

</html>