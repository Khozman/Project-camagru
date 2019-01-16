<?php

// include ("../connection.php");
$server = "localhost";
$username = "root";
$password = "2435465674";
$db = "camagru";
$createtable = false;

try {
    $conn = new PDO("mysql:host=$server;", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE DATABASE IF NOT EXISTS camagru";
    // use exec() because no results are returned
    $conn->exec($sql);
    echo "Database camagru created successfully<br>";
    $createtable = true;
} catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
?>
