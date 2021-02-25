<?php
    class DatabaseQuering{

        function selectReturnNumRows($table_name, $table_headers, $positions){
            try{
                $conn = new PDO($GLOBALS['DB_DSN'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWORD']);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $statement = $conn->prepare("SELECT count($table_headers) FROM $table_name WHERE $positions;");
                $statement->execute();
                $row = $statement->fetchColumn();
                $results = $row;
            }catch(PDOException $e){ 
                $results = $e->getMessage();
            }
            return $results;
        }


        function deleteRow($table_name, $positions){
            try {
                $conn = new PDO($GLOBALS['DB_DSN'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWORD']);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "DELETE FROM `$table_name` WHERE $positions;";
                $conn->exec($sql);
                return "success";
            } catch (PDOException $e) {
                return $e->getMessage();
            }
        }

        function selectReturnRows($table_name, $table_headers, $positions){
            try {
                $conn = new PDO($GLOBALS['DB_DSN'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWORD']);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT $table_headers FROM $table_name WHERE $positions;";
                $res = $conn->query($sql);
                return $res;
            } catch (PDOException $e) {
                return $e->getMessage();
            }
        }

        function selectReturn($table_name, $table_headers, $positions){
            try{
                $conn = new PDO($GLOBALS['DB_DSN'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWORD']);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $statement = $conn->prepare("SELECT $table_headers FROM $table_name WHERE $positions;");
                $statement->execute();
                $row = $statement->fetch(PDO::FETCH_ASSOC);
                if ($row === false)
                    $results = "error";
                else
                    $results = $row;
            }catch(PDOException $e){
                $results = $e->getMessage();
            }
            return $results;
        }

        function updateOnce($table_name, $table_updates, $table_place){
            try{
                $conn = new PDO($GLOBALS['DB_DSN'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWORD']);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "UPDATE $table_name SET $table_updates WHERE $table_place;";
                $exe = $conn->prepare($sql);
                $exe->execute();
                return $exe->rowCount();
            }catch (PDOException $e){
                return $e->getMessage();
            }
        }
        function insertOnce($table_name, $table_headers, $values){
            try{
                $conn = new PDO($GLOBALS['DB_DSN'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWORD']);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "INSERT INTO `$table_name`($table_headers) VALUES($values);";
                $conn->exec($sql);
                $results = "success";
            }catch(PDOException $e){
                $results = $e->getMessage();
            }
            return $results;
        }

        function selectOnce($table_name, $table_headers, $positions){
            try{
                $conn = new PDO($GLOBALS['DB_DSN'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWORD']);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $statement = $conn->prepare("SELECT $table_headers FROM $table_name WHERE $positions;");
                $statement->execute();
                $row = $statement->fetch(PDO::FETCH_ASSOC);
                if ($row === false)
                    $results = "error";
                else
                    $results = "success";
            }catch(PDOException $e){
                $results = $e->getMessage();
            }
            return $results;
        }
    }
?>