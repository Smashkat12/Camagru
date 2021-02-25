<?php
    error_reporting(E_ALL);
    ini_set("display_errors", "on");
    //Models for getting data from database
    include("config/database.php");
    include("model/account.model.php");
    include("view/account.view.php");

    $obj2 = new SanitizeSecurity();
    
    $obj1 = new DatabaseQuering();
    $q = $obj1->selectReturnRows("imgs", "*", " id != 0 ORDER BY uploaded_date DESC");
    $q->setFetchMode(PDO::FETCH_ASSOC)
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
    <h1 class="text-center big-text marin-0">Camagru</h1>
    <div class="index-account">
        <center>
            <button class="index-account-btn" onclick="indexHideLoginRegister();">Public Gallery</button>
            <button class="index-account-btn" onclick="indexHideRegister();">Login</button>
            <button class="index-account-btn" onclick="indexHideLogin();">Register</button>
        </center>
    </div>
    <div class="index-account-form-content-main">
        <div class="index-account-form-content force-height"></div>
        <div class="index-account-form-content margin-10" id="index-account-gallery">
            <?php while ($r = $q->fetch()){
                if ($r['superposable_nums'] == 1){
                    echo "<div class='thumbnails' style=\"background-image: url('".$r['img_url']."');height: 350px !important;\">
                    <center>
                        <img src='rsc/img/".$r['superposable_1'].".svg'/>
                        <br>
                    </center>
                </div>
                ";    
                }else if ($r['superposable_nums'] == 2){
                    echo "<div class='thumbnails' style=\"background-image: url('".$r['img_url']."');\">
                    <center>
                        <img src='rsc/img/".$r['superposable_1'].".svg'/>
                        <br>
                        <img src='rsc/img/".$r['superposable_2'].".svg'/>
                        <br>
                    </center>
                </div>
                ";    
                }else if ($r['superposable_nums'] == 3){
                    echo "<div class='thumbnails' style=\"background-image: url('".$r['img_url']."');\">
                    <center>
                        <img src='rsc/img/".$r['superposable_1'].".svg'/>
                        <br>
                        <img src='rsc/img/".$r['superposable_2'].".svg'/>
                        <br>
                        <img src='rsc/img/".$r['superposable_3'].".svg'/>
                        <br>
                    </center>
                </div>
                ";    
                }else{
                    echo "<div class='thumbnails' style=\"background-image: url('".$r['img_url']."');height: 350px !important;\"></div>
                ";  
                }
            } ?>
            <center>
            <br>
                <button class="index-account-btn" id="thumbnailsPagination">Only Less Than 6 Images Uploaded</button>
                <button class="index-account-btn" id="thumbnailsPaginationPrevious" onclick="loadPreviousElements()">Previous 5</button>
                <button class="index-account-btn" id="thumbnailsPaginationNext" onclick="loadNextElements()">Next 5</button>
            <br>
            </center>
            <br>
            <br>
        </div>
        <div class="index-account-form-content margin-10" id="index-account-form-login">
            <label>Username:</label><br />
            <input id="l-username" type="text" /><br />
            <label>Password:</label><br />
            <input id="l-password" type="password" /><br />
            <center>
                <a href="#" onclick="indexShowForgotPass();">Forgot Password</a><br>
                <button class="index-account-btn-lr" onclick="userLogin();">Login</button>
            </center>
        </div>
        <div class="index-account-form-content margin-10" id="index-account-form-register">
            <label>Username:</label><br />
            <input id="r-username" type="text" require /><br />
            <label>Email:</label><br />
            <input id="r-email" type="email" require /><br />
            <label>Password:</label><br />
            <input id="r-pass" type="password" require /><br />
            <label>Confirm Password:</label><br />
            <input id="r-confirmpass" type="password" require /><br />
            <center>
                <button class="index-account-btn-lr" onclick="userRegistration();">Register</button>
            </center>
        </div>
        <div class="index-account-form-content margin-10" id="index-account-form-forgot-password">
            <label>Email:</label><br />
            <input id="f-email" type="email" require /><br />
            <center>
                <a href="#" onclick="indexHideForgotPass();">Login/Register</a><br>
                <button class="index-account-btn-lr" onclick="userForgetPassword();">Send Me Password</button>
            </center>
        </div>
        <div class="index-account-form-content force-height"></div>
    </div>
    <!-- End Content -->
    <!-- Script -->
    <script>
    indexHideLoginRegister();

    function loadPreviousElements(){
        hideAllThumbnails();

        var $pageElements = document.getElementsByClassName("thumbnails");
        var $len = $pageElements.length;

        var $firstElement =  localStorage.getItem("firstdisplayPage");
        var $lastElement =  localStorage.getItem("lastdisplayPage");

        $start = Number($firstElement) - 5;
        $end = Number($firstElement) - 1;
        localStorage.setItem("firstdisplayPage", $start);

        if ($start != 0){
            document.getElementById("thumbnailsPaginationPrevious").style.display = "";
            document.getElementById("thumbnailsPaginationNext").style.display = "";
        }else{
            document.getElementById("thumbnailsPaginationNext").style.display = "";
        }

        while ($start <= $end){
            $pageElements[$start].style.display = "";
            $start++;
        }
        localStorage.setItem("lastdisplayPage", $end);
    }

    function hideAllThumbnails(){
        var $pageElements = document.getElementsByClassName("thumbnails");
        var $len = $pageElements.length;
        var $index = 0;

        while($index < $len){
            $pageElements[$index].style.display = "none";
            $index++;
        }
        document.getElementById("thumbnailsPagination").style.display = "none";
        document.getElementById("thumbnailsPaginationPrevious").style.display = "none";
        document.getElementById("thumbnailsPaginationNext").style.display = "none";
    }
    
    function loadNextElements(){
        hideAllThumbnails();

        var $pageElements = document.getElementsByClassName("thumbnails");
        var $len = $pageElements.length;
        var $lastElement =  localStorage.getItem("lastdisplayPage");

        var $start = Number($lastElement) + 1;
        localStorage.setItem("firstdisplayPage", $start);
        var $end = $start + 5; 
        while ($start < $end){
            if ($start < $len){
                $pageElements[$start].style.display = "";
            }
            localStorage.setItem("lastdisplayPage", $start);
            $start++;
        }
        if ($end > $len){
            document.getElementById("thumbnailsPaginationPrevious").style.display = "";
            document.getElementById("thumbnailsPaginationNext").style.display = "none";
        }else{
            document.getElementById("thumbnailsPaginationPrevious").style.display = "";
            document.getElementById("thumbnailsPaginationNext").style.display = "";
        }
    }

    function loadFirstLements(){
        hideAllThumbnails();
        var $pageElements = document.getElementsByClassName("thumbnails");
        var $len = $pageElements.length;
        var $index = 0;
        
        if ($len <= 5 ){
            while ($index < $len){
                $pageElements[$index].style.display = "";
                $index++;
            }
            document.getElementById("thumbnailsPagination").style.display = "";
        }else{
            while($index < $len){
                if($index <= 4){
                    $pageElements[$index].style.display = "";
                    localStorage.setItem("lastdisplayPage", $index);
                }  
                $index++;
            }
            document.getElementById("thumbnailsPaginationNext").style.display = "";
        }

    }

    loadFirstLements();

    </script>
    <!-- End Script -->
</body>

</html>