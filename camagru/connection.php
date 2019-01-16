<?php
// database config...
$server = "localhost";
$username = "root";
$password = "2435465674";
$db = "camagru";

// checking if my connection was successful...
try {
    $handle = new PDO("mysql:host=$server;dbname=$db", "$username", "$password");
    $handle->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    echo "connected";
} catch(PDOException $e) {
    die("Oops. Something went wrong in the database.");
}
?>