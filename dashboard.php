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
    $q = $obj1->selectReturnRows("imgs", "*", " id != 0 ORDER BY uploaded_date DESC");
    $q->setFetchMode(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html>

<head>

    <title>Dashboard : Camagru</title>
    <!-- Header -->
    <?php require("includes/header.php");?>
    <!-- End Header -->
</head>

<body>
    <!-- Navigation -->
    <?php include("includes/navigation.php");?>
    <!-- End Navigation -->
    <!-- Section -->
    <div class="container margin-10">
        <div class="left col-25">
            
        </div>
        <div class="left col-50">
            <center><h1>Gallery</h1></center>
            <?php while ($r = $q->fetch()){

                $numComments = $obj1->selectReturnNumRows("comments", "*", " img_id = '".$r['id']."'");
                $query = $obj1->selectReturnRows("comments", "*", " img_id = '".$r['id']."'");
                $query->setFetchMode(PDO::FETCH_ASSOC);

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

                    
                    echo "<div class='thumbnails' style=\"background-image: url('".$r['img_url']."');height: 350px !important;\">
                    </div>
                ";  

                }

                
                $likesid = $r['id'];
                $likerows = $obj1->selectReturnNumRows("likes", "*", "img_id = '$likesid'");

                if($numComments > 0){

                    $commentsDisplayRow = "<h3>Comments:</h3>";


                    while ($commentsrows = $query->fetch()){

                        $commentsDisplay = "
                            <p><strong>".$commentsrows['username'].":</strong></p>
                            <p> ".$commentsrows['comment']."</p>";

                        $commentsDisplayRow .= "
                            
                                $commentsDisplay
                                
                            
                        ";
                    }
                    
                }else{
                    $commentsDisplayRow = "<p><strong>No comments</strong></p>";
                }

                echo "
                <br>
                    <div class='likesandcomments'>
                        <center>
                            <button class='index-account-btn' onclick='userLike(".$r['id'].", \"".$uname."\");'>Like ($likerows)</button>
                        </center>
                    </div>

                    <div class='comments-layout'>

                    $commentsDisplayRow

                    <hr/>

                        <textarea id='comment-message".$r['id']."' rows='4'>Comment</textarea>
                        <center>
                            <button class='index-account-btn' onclick='userComment(".$r['id'].", \"".$uname."\");'>Post Comment</button>
                        </center>

                    </div>

                    
                    
                <br>
                ";
                
            }
            
            echo "<br>";

            ?>

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
        <div class="left col-25">
            
        </div>
        
    </div>

    <script>

    function loadPreviousElements(){
        hideAllThumbnails();

        var $pageElements = document.getElementsByClassName("thumbnails");
        var $pageLC = document.getElementsByClassName("likesandcomments");
        var $pageCM = document.getElementsByClassName("comments-layout");
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
            $pageLC[$start].style.display = "";
            $pageCM[$start].style.display = "";
            $start++;
        }
        localStorage.setItem("lastdisplayPage", $end);
    }

    function hideAllThumbnails(){
        var $pageElements = document.getElementsByClassName("thumbnails");
        var $pageLC = document.getElementsByClassName("likesandcomments");
        var $pageCM = document.getElementsByClassName("comments-layout");
        var $len = $pageElements.length;
        var $index = 0;

        while($index < $len){
            $pageElements[$index].style.display = "none";
            $pageLC[$index].style.display = "none";
            $pageCM[$index].style.display = "none";
            $index++;
        }
        document.getElementById("thumbnailsPagination").style.display = "none";
        document.getElementById("thumbnailsPaginationPrevious").style.display = "none";
        document.getElementById("thumbnailsPaginationNext").style.display = "none";
    }
    
    function loadNextElements(){
        hideAllThumbnails();

        var $pageElements = document.getElementsByClassName("thumbnails");
        var $pageLC = document.getElementsByClassName("likesandcomments");
        var $pageCM = document.getElementsByClassName("comments-layout");
        var $len = $pageElements.length;
        var $lastElement =  localStorage.getItem("lastdisplayPage");

        var $start = Number($lastElement) + 1;
        localStorage.setItem("firstdisplayPage", $start);
        var $end = $start + 5; 
        while ($start < $end){
            if ($start < $len){
                $pageElements[$start].style.display = "";
                $pageLC[$start].style.display = "";
                $pageCM[$start].style.display = "";
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
        var $pageLC = document.getElementsByClassName("likesandcomments");
        var $pageCM = document.getElementsByClassName("comments-layout");
        var $len = $pageElements.length;
        var $index = 0;
        
        if ($len <= 5 ){
            while ($index < $len){
                $pageElements[$index].style.display = "";
                $pageLC[$index].style.display = "";
                $pageCM[$index].style.display = "";
                $index++;
            }
            document.getElementById("thumbnailsPagination").style.display = "";
        }else{
            while($index < $len){
                if($index <= 4){
                    $pageElements[$index].style.display = "";
                    $pageLC[$index].style.display = "";
                    $pageCM[$index].style.display = "";
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
    <!-- End Section -->
    <!-- Footer -->
    <?php #include("includes/footer.php");?>
    <!-- End Footer -->
</body>

</html>