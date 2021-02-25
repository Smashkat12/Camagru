<?php

    include("database.php");

    $db_name = "camagru";

    $count = 0;

    try{
        $db = new PDO($GLOBALS['DB_SERVER'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWORD']);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE DATABASE $db_name";
        $stm = $db->prepare($sql);
        $stm->execute();

        $count = 1;
    }catch(PDOException $e){
        $error = $e->getMessage();
    }

    if($count == 1){
        $myfile = fopen("../camagru.sql", "r") or die("Unable to open file!");
        $sql2 = fread($myfile,filesize("../camagru.sql"));
        fclose($myfile);

        $DB_DSN2 = "mysql:host=localhost;dbname=$db_name";

        try{
            $conn = new PDO($DB_DSN2, $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWORD']);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->exec($sql2);
            echo "success";
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }else{
        echo "Database exists, error message: ".$error;
    }


?>