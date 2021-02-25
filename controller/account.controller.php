<?php

    require("../config/database.php");
    require("../model/account.model.php");
    require("../view/account.view.php");

    $action = $_GET['action'];
    switch($action){
        case "changepass":

            $obj = new SanitizeSecurity();
            $username = $obj->cleanString($_GET['username']);
            $password = $obj->cleanString($_GET['pass']);
            
            $password = md5($password);

            $obj = new DatabaseQuering();
            $results = $obj->updateOnce('users', "pass = '$password'", "username = '$username'");
            if ($results == 1){
                $returnValue = "success";
            }else{
                $returnValue = "error";
            }
            echo $returnValue;

        break;
        case "edit":

            $obj = new SanitizeSecurity();
            $username = $obj->cleanString($_GET['username']);
            $email = $obj->cleanString($_GET['email']);
            $password = $obj->cleanString($_GET['pass']);
            $ems= $obj->cleanString($_GET['ems']);
            $log = $_GET['log'];
            
            $password = $obj->hashData($password);

            $obj = new DatabaseQuering();
            $results = $obj->updateOnce('users', "username = '$username', email = '$email', pass = '$password', email_receiver = '$ems'", "username = '$log'");
            if ($results == 1){
                $returnValue = "success";
            }else{
                $returnValue = "error";
            }
            echo $returnValue;

        break;
        case "forgot":
            $obj = new SanitizeSecurity();
            $email = $obj->cleanString($_GET['email']);
            
            $obj2 = new DatabaseQuering();
            $returnValue = $obj2->selectReturn("`users`", "*", "`email` = '$email'");
            if ($returnValue != "error"){
                $message = "Welcome to Camagru in order to change your use this unique link\n <a href=\"http://localhost:8080/camagru/change-password.php?action=changepass&action_name=".$returnValue['username']."&action_sender=".$returnValue['pass']."\">Link</a> only once.";
                $mailVal = $obj->sendMail($_GET['email'], "Change Password", $message);
                echo "success";
                return;
            }else{
                echo "error";
            }
            
        break;
        case "logout":
            $obj = new SanitizeSecurity();
            $returnValue = $obj->removeSession();
            echo $returnValue;
        break;
        case "registration":
            $obj = new SanitizeSecurity();
            $username = $obj->cleanString($_GET['username']);
            $email = $obj->cleanString($_GET['email']);
            $password = $obj->cleanString($_GET['pass']);
            
            $password = md5($password);

            $obj2 = new DatabaseQuering();
            $returnValue = $obj2->insertOnce("users", "username, email, pass, account_status", "'$username', '$email', '$password', 'Deactivated'");
            $message = "Welcome to Camagru in order to login use this unique link\n <a href=\"http://localhost:8080/camagru/account_status.php?action=activation&action_name=$username&action_sender=$password\">Link</a> only once.";
            $mailVal = $obj->sendMail($_GET['email'], "Verify Email Address", $message);
            echo $returnValue;
        break;
        case "login":
            $obj = new SanitizeSecurity();
            $username = $obj->cleanString($_GET['username']);
            $password = $obj->cleanString($_GET['pass']);

            $password = md5($password);

            $obj2 = new DatabaseQuering();
            $returnValue = $obj2->selectOnce("`users`","*","`username` = '$username' AND `pass` = '$password' AND account_status = 'Activated'");
            if ($returnValue == "success")
                $obj->setSession($username);
            echo $returnValue;
        break;
        default:
            echo $GLOBALS['DB_DSN'];
    }
?>