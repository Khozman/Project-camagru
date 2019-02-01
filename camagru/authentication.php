<?php
    session_start();
    
    if(!isset($_SESSION['email'])) {
        // echo "hello";
        header("Location: login.php");
    }
?>