<?php
    class SanitizeSecurity{
        function hashData($input){
            $encoded = password_hash($input, PASSWORD_BCRYPT);
            return $encoded;
        }

        function hashCmp($input1, $input2){
            if (password_verify($input1, $input2))
                $val = "success";
            else
                $val = "error";
            return $val;
        }

        function cleanString($input){
            $input = trim($input);
            $input = htmlspecialchars($input);
            return $input;
        }

        function setSession($username){
            session_start();
            $_SESSION['unique_username'] = $username;
        }

        function getSession(){
            session_start();
            return $_SESSION['unique_username'];
        }

        function removeSession(){
            session_start();
            $_SESSION = array();
            if(isset($_SESSION['unique_username'])){
                return false;
            }else{
                return true;
            }
        }

        function sendMail($to, $subject, $message){
            return mail($to, $subject, $message, "From: <nzilanegiven@gmail.com> \r\nContent-type: text/html; charset=iso-8859-1");
        }
    }
?>