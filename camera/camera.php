<?php
//require("header.php");
//require("includes/upload.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
  <!-- <link rel="stylesheet" href="css/filters.css" /> -->
  <link rel="stylesheet" href="css/main.css" />
  
</head>
<body>
    <div class="top-container">
    <form method = "post" action = "camera.php">
    <video id="video" autoplay>Something went wrong while streaming</video>

    <button id="capture" name = "sub">
    Take Picture
    </button>

    <input type = "hidden" id = "url" name = "url">
  </form>
    <button id="clear">Clear</button>
    <canvas id="canvas"></canvas>
    </div>
    <div class="bottom-container">
    <div id="thumbnail"></div>
    </div>

    <?php
    
    session_start();
    if (isset($_POST["sub"]))
    {

      $_SESSION['url'] = $_POST["url"];

      echo $_SESSION['url'];
      echo '<script>window.location= "discam.php"</script>';
    }
    ?>
    <script src="capture.js"></script>
</body>

</html>