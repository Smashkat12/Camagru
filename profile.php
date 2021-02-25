<?php
    session_start();
    //Models for getting data from database
    include("config/database.php");
    include("model/account.model.php");
    include("view/account.view.php");
    //Getting session value for username
    $usernameSession = $_SESSION['unique_username'];
    //Object creation from model DatabaseQuering()
    $obj = new DatabaseQuering();
    //Object creation from view SanitizeSecurity()
    $obj2 = new SanitizeSecurity();
    //Methods from DatabaseQuering()
    $row = $obj->selectReturn("`users`", "*", "`username` = '$usernameSession'");
    //Methods from sanitizeSecurity()
    $username = $row['username'];
    $email = $row['email'];
    $email_receiver = $row['email_receiver'];
    if ($email_receiver == "Yes"){
        $email_receiver = '
        <option value="Yes">Yes</option>
        <option value="No">No</option>
        ';
    }else{
        $email_receiver = '
        <option value="No">No</option>
        <option value="Yes">Yes</option>
        ';
    }
?>
<!DOCTYPE html>
<html>

<head>
    <title>Profile : Camagru</title>
    <!-- Header -->
    <?php require("includes/header.php");?>
    <!-- End Header -->
</head>

<body>
    <!-- Navigation -->
    <?php include("includes/navigation.php");?>
    <!-- End Navigation -->
    <!-- Section -->
    <div class="container profile">
        <h2>Profile</h2>
        <p>User preference</p>
        <div class="index-account-form-content margin-10" id="index-account-form-edit">
            <label>Username:</label><br />
            <input id="e-username" type="text" value="<?php echo $username;?>" require /><br />
            <label>Email:</label><br />
            <input id="e-email" type="email" value="<?php echo $email;?>" require /><br />
            <label>Password (Enter new password or old password when you save):</label><br />
            <input id="e-pass" type="text" value="" require /><br />
            <label>Receive Email when users like and comment:</label><br />
            <select id="e-ems">
                <?php echo $email_receiver;?>
            </select><br/>
            <button class="index-account-btn-lr" onclick="userSaveEditProfile('<?php echo $usernameSession;?>');">Save</button>
        </div>
    </div>
    <!-- End Section -->
    <!-- Footer -->
    <?php #include("includes/footer.php");?>
    <!-- End Footer -->
</body>

</html>