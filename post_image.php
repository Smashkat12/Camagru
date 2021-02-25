<?php
    error_reporting(E_ALL);
    ini_set("display_errors", "on");
    //Models for getting data from database
    include("config/database.php");
    include("model/account.model.php");
    include("view/account.view.php");

    $obj2 = new SanitizeSecurity();
    $uname = $obj2->getSession();

    $obj1 = new DatabaseQuering();
    $q = $obj1->selectReturnRows("imgs", "*", "username = '$uname' ORDER BY uploaded_date DESC");
    $q->setFetchMode(PDO::FETCH_ASSOC)
?>
<!DOCTYPE html>
<html>

<head>
    <title>Post Image : Camagru</title>
    <!-- Header -->
    <?php require("includes/header.php");?>
    <!-- End Header -->
</head>

<body>
    <!-- Navigation -->
    <?php include("includes/navigation.php");?>
    <!-- End Navigation -->
    <!-- Section -->
    <div class="container post-image">
        <div class="post-image-left">
            <center>
                <button class="index-account-btn" onclick="indexWebCam();">Webcam</button>
                <button class="index-account-btn" onclick="indexUpload();">Uploade</button>
            </center>
            <br>
            <div class="container-post-image">
                <div id="cmi-cam">

                    <div class="top-container">

                        <center>
                            <video id="video" autoplay>Something went wrong while streaming</video>
                            <br />
                            <label>Superposable:</label><br>

                            <input type="checkbox" name="cs-none" value="glasses" id="cs-none">
                            <label for="cs-none">No Sticker</label>

                            <input type="checkbox" name="cs-glasses" value="glasses" id="cs-glasses">
                            <label for="cs-glasses"><img src="rsc/img/glasses.svg" width="40"></label>

                            <input type="checkbox" name="cs-hat" value="hat" id="cs-hat">
                            <label for="cs-hat"><img src="rsc/img/hat.svg" width="40"></label>

                            <input type="checkbox" name="cs-thumbs" value="thumbs" id="cs-thumbs">
                            <label for="cs-thumbs"><img src="rsc/img/thumb.svg" width="40"></label>

                            <br />
                            <button class="index-account-btn" id="capture" name="sub">
                                Take Picture
                            </button>

                            <button class="index-account-btn" id="before-capture" onclick="userUploadCamera();">
                                Take Picture
                            </button>
                        </center>

                        <input type="hidden" id="url" name="url">

                        <button id="clear">Clear</button>

                        <canvas id="canvas"></canvas>
                    </div>
                    <div class="bottom-container">
                        <div id="thumbnail"></div>
                    </div>

                </div>
                <div id="cmi-upload">
                    <!-- Webcam video snapshot -->
                    <label>Upload Image:</label><br>
                    <input type="file" id="upload-image" accept="image/jpg,image/png,img/gif" /><br>
                    <label>Superposable:</label><br>

                    <input type="checkbox" name="s-image" value="glasses" id="s-glasses">
                    <label for="s-glasses"><img src="rsc/img/glasses.svg" width="40"></label>

                    <input type="checkbox" name="s-image" value="hat" id="s-hat">
                    <label for="s-hat"><img src="rsc/img/hat.svg" width="40"></label>

                    <input type="checkbox" name="s-image" value="thumbs" id="s-thumbs">
                    <label for="s-thumbs.svg"><img src="rsc/img/thumb.svg" width="40"></label>

                    <br>
                    <button class="index-account-btn" onclick="userUploadImage();">Upload</button>
                </div>
            </div>
        </div>
        <div class="post-image-right">
            <center>
                <h2>Thumbnail</h2>
            </center>
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
                echo "
                <center>
                <a href='#' onclick='userDeleteImage(".$r['id'].", \"".$r['img_url']."\")'>Delete Image</a>
                </center>
                <hr>
                <br>
                ";
                
            } ?>
        </div>
    </div>

    <script src="camera/capture.js"></script>

    <script>

    indexWebCam();

    document.getElementById("capture").style.display = "None";
    document.getElementById("before-capture").style.display = "";

    /* Upload Image */
    function userUploadCamera() {
        //Receive input
        var fd = new FormData();
        var $count = 1;
        var $count_fd = 0;

        if (document.getElementById('cs-none').checked) {
            alert("You opted not to include stickers in your post.");
            fd.append("sp0", "none");
            $count_fd = -1;
        } else {

            if (document.getElementById('cs-glasses').checked) {
                $count_fd = $count_fd + 1;
                if ($count_fd == 1) {
                    fd.append("sp1", "glasses");
                }
            }
            if (document.getElementById('cs-hat').checked) {
                $count_fd = $count_fd + 1;
                if ($count_fd == 1) {
                    fd.append("sp1", "hat");
                } else if ($count_fd == 2) {
                    fd.append("sp2", "hat");
                }
            }
            if (document.getElementById('cs-thumbs').checked) {
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
                alert("You did not select any sticker please tick No Stcker if you wish to add no sticker.");
                return;
            }

        }

        captureImage();

            

            setTimeout(function(){ 

                captureImage();

                $img_url = sessionStorage.getItem("imgurl");
            $img_url2 = document.getElementById("url").value;

             if ($img_url == $img_url2){
                fd.append("sps", $count_fd);
                fd.append("action", "uploadimgWebcam");
                fd.append("upimg", $img_url);
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
                }else{
                    alert("An error occured");
                }

             }, 5000);

    }
        /*End Upload Image */
    </script>


    <!-- End Section -->
    <!-- Footer -->
    <?php #include("includes/footer.php");?>
    <!-- End Footer -->
</body>

</html>