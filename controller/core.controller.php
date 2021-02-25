<?php

    require("../config/database.php");
    require("../model/account.model.php");
    require("../view/account.view.php");
    require("../view/core.view.php");

    $action = $_REQUEST['action'];
    switch($action){
        case "uploadimgWebcam":

            /* Testing Upload */
            $target = $_POST['upimg'];
            $image = "output".date('Y-m-dH-i-s').".jpeg";
            
            imagejpeg(imagecreatefromstring(file_get_contents($target)), "../uploads/".$image);
            move_uploaded_file($target, "../uploads/".$image);
            $target_file2 = "uploads/".$image;

            //Database connection
            $obj2 = new DatabaseQuering();

            //Database connection
            $obj3 = new SanitizeSecurity();
            $username = $obj3->getSession();

            $sps = $_REQUEST['sps'];
            if ($sps == 1){
                $sp1 = $_REQUEST['sp1'];
                $returnVal = $obj2->insertOnce("imgs", "`username`, `img_url`, `superposable_1`, `superposable_2`, `superposable_3`, `superposable_nums`", "'$username', '$target_file2', '$sp1', 'NULL', 'NULL', 1");
                echo $returnVal;
            }else if ($sps == 2){
                $sp1 = $_REQUEST['sp1'];
                $sp2 = $_REQUEST['sp2'];
                $returnVal = $obj2->insertOnce("imgs", "`username`, `img_url`, `superposable_1`, `superposable_2`, `superposable_3`, `superposable_nums`", "'$username', '$target_file2', '$sp1', '$sp2', 'NULL', 2");
                echo $returnVal;
            }else if ($sps == 3){
                $sp1 = $_REQUEST['sp1'];
                $sp2 = $_REQUEST['sp2'];
                $sp3 = $_REQUEST['sp3'];
                $returnVal = $obj2->insertOnce("imgs", "`username`, `img_url`, `superposable_1`, `superposable_2`, `superposable_3`, `superposable_nums`", "'$username', '$target_file2', '$sp1', '$sp2', '$sp3', 3");
                echo $returnVal;
            }else{
                $returnVal = $obj2->insertOnce("imgs", "`username`, `img_url`, `superposable_1`, `superposable_2`, `superposable_3`, `superposable_nums`", "'$username', '$target_file2', 'NULL', 'NULL', 'NULL', 0");
                echo $returnVal;
            }


        break;
        case "postcomment":
            
            $obj = new SanitizeSecurity();
            $message = $obj->cleanString($_GET['message']);
            
            $username = $_GET['username'];
            $imgid = $_GET['img_id'];
            
            $obj1 = new DatabaseQuering();
            /* Get Username of a clint that posted an image */
            $rows = $obj1->selectReturn("imgs", "*", "id = '$imgid'");
            $un1 = $rows['username'];
            
            /* Get Email Address and Check if user allows email */
            $rows = $obj1->selectReturn("`users`", "*", "`username` = '$un1'");
            $un2 = $rows['username'];
            $em2 = $rows['email'];
            $er2 = $rows['email_receiver'];

            if ($er2 == "Yes"){
                $mailer = $obj->sendMail($em2, "New Comment from $username", "Message: ".$message);
            }

            $returnVal = $obj1->insertOnce("comments", "`img_id`, `username`, `comment`", "$imgid, '$username', '$message'");
            echo $returnVal;
        break;
        case "imglike":
            $username = $_GET['un'];
            $imgid = $_GET['imgid'];

            $obj1 = new DatabaseQuering();
            $retVal = $obj1->selectOnce("likes", "*", "img_id = '$imgid' AND username = '$username'");
            if ($retVal == "error"){
                $retVal = $obj1->insertOnce("likes", "img_id, username", "'$imgid', '$username'");
                if ($retVal == "success"){
                    echo "success";
                }else{
                    echo "An error occured please try like again.";
                }
            }else{
                echo "Image already liked.";
            }
        break;
        case "imgdelete":
            $url = $_GET['imgurl'];
            $imgid = $_GET['imgid'];

            $obj1 = new DatabaseQuering();


            $returnVal = $obj1->deleteRow("imgs", "`id` = '$imgid'");
            echo $returnVal;
        break;
        case "uploadimg":
            //Generate a random string
            $obj1 = new DevLib();
            $imgname = $obj1->stringGenerator();
            //Database connection
            $obj2 = new DatabaseQuering();
            //Database connection
            $obj3 = new SanitizeSecurity();
            $username = $obj3->getSession();
            ####File Upload
            $target_dir = "../uploads/";
            $target_file = $target_dir .$imgname. basename($_FILES["upimg"]["name"]);
            $target_file2 = "uploads/" .$imgname. basename($_FILES["upimg"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            // Check if image file is a actual image or fake image
            if(isset($_POST["submit"])) {
                $check = getimagesize($_FILES["upimg"]["tmp_name"]);
                if($check !== false) {
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    exit;
                }
            }
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                exit;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.!";
                exit;
            // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["upimg"]["tmp_name"], $target_file)) {
                    $sps = $_REQUEST['sps'];
                    if ($sps == 1){
                        $sp1 = $_REQUEST['sp1'];
                        $returnVal = $obj2->insertOnce("imgs", "`username`, `img_url`, `superposable_1`, `superposable_2`, `superposable_3`, `superposable_nums`", "'$username', '$target_file2', '$sp1', 'NULL', 'NULL', 1");
                        echo $returnVal;
                    }else if ($sps == 2){
                        $sp1 = $_REQUEST['sp1'];
                        $sp2 = $_REQUEST['sp2'];
                        $returnVal = $obj2->insertOnce("imgs", "`username`, `img_url`, `superposable_1`, `superposable_2`, `superposable_3`, `superposable_nums`", "'$username', '$target_file2', '$sp1', '$sp2', 'NULL', 2");
                        echo $returnVal;
                    }else if ($sps == 3){
                        $sp1 = $_REQUEST['sp1'];
                        $sp2 = $_REQUEST['sp2'];
                        $sp3 = $_REQUEST['sp3'];
                        $returnVal = $obj2->insertOnce("imgs", "`username`, `img_url`, `superposable_1`, `superposable_2`, `superposable_3`, `superposable_nums`", "'$username', '$target_file2', '$sp1', '$sp2', '$sp3', 3");
                        echo $returnVal;
                    }else{
                        $returnVal = $obj2->insertOnce("imgs", "`username`, `img_url`, `superposable_1`, `superposable_2`, `superposable_3`, `superposable_nums`", "'$username', '$target_file2', 'NULL', 'NULL', 'NULL', 0");
                        echo $returnVal;
                    }
                } else {
                    echo "An error occured please try again!";
                    exit;
                }
            }

        break;
        
        default:
            
    }
?>