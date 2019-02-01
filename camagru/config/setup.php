<?php

// include ("../connection.php");
require("database.php");

try {
    $conn = new PDO("mysql:host=$server;", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE DATABASE IF NOT EXISTS camagru";
    // use exec() because no results are returned
    $conn->exec($sql);
    echo "Database camagru created successfully<br>";
    $createtable = true;
    
    $conn->exec("USE camagru");
     // put in the sql code to create a table in the database
    $sql = "CREATE TABLE users (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        fullnames VARCHAR(30) NOT NULL,
        email VARCHAR(30) NOT NULL,
        passwd VARCHAR(256) NOT NULL,
        code VARCHAR(255) NOT NULL,
        activate INT(1) NOT NULL DEFAULT '0'
        )";
    
        // use exec(), no results are returned
        $conn->exec($sql);
        echo "Table users successfully created";

        header("Location: ../index.php");

} catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
?>
