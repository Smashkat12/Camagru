<?php
    require("config/database.php");
    include("model/account.model.php");

    switch($_GET['action']){
        case "activation":
            $username = $_GET['action_name'];
            $pass = $_GET['action_sender'];
            //Check if user exist
            $obj = new DatabaseQuering();
            $returnValue = $obj->selectOnce("`users`","*","`username` = '$username' AND pass = '$pass'");
            if ($returnValue == "success"){
                $obj = new DatabaseQuering();
                $results = $obj->updateOnce('users', "account_status = 'Activated'", "pass = '$pass' AND username = '$username'");
                if ($results == 1){
                    echo "Your email address has been validated you may login here <a href='index.php'>GO HOME</a>";
                }else{
                    echo "Your account is already varified click here <a href='index.php'>GO HOME</a> and login.";
                }
            }else{
                echo "An error occured the reason might be that you are not a user please click here to redirect <a href='index.php'>GO HOME</a>";
            }
        break;
        default:
            header("Location: index.php");
    }
    //http://localhost/Piscine/camagru/account_status.php?action=activation&action_name=1ks10oD6JntvFnObFGf7tAptXKdDgv/6CJfueXuQpcw=&action_sender=5Q18qctqDG9aoHRPQ8xWruA5fdeKXE66uy4t97L2Tdk
?>