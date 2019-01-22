<?php
ini_set("display_errors",1);
error_reporting(E_ALL);
session_start();
require ('connection.php');
if (isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['code']) && !empty($_GET['code']))
{
    $database = database();
    $email = $_GET['email'];
    $code = $_GET['code'];
    $select = $database->prepare("SELECT email, code, activate FROM camagru.users WHERE email=:email AND code=:code AND activate='0'");
    $select->bindValue(":email", $email);
    $select->bindValue(":code", $code);
    $select->execute();
    $row = $select->fetchColumn();
    $row_no = count($row);
    if ($row_no > 0)
    {
        $update = $database->prepare("UPDATE camagru.users SET activate='1' WHERE email='".$email."' AND code='".$code."' AND activate='0'");
        $update->bindValue(":email", $email);
        $update->bindValue(":code", $code);
        $update->execute();
        echo '<script> alert ("Your account has been activated, you can now login")</script>';
        header("refresh:0.01; url=login.php");
    }
    else
    {
        echo '<script> alert ("Your account has not been activated")</script>';
    }
    }
    else {
    echo '<script> alert ("Please use link sent to email")</script>';
}
// $username = $_GET['user'];

// echo $username;

?>