<?php
//session_start();
$server = "localhost";
$username = "root";
$password = "2435465674";
$db = "camagru";

try {
   
    $conn = new PDO("mysql:host=$server;dbname=$db", $username, $password);
    
    // setting the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // put in the sql code to create a table in the database
    $sql = "CREATE TABLE users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    fullnames VARCHAR(30) NOT NULL,
    email VARCHAR(30) NOT NULL,
    passwd VARCHAR(256) NOT NULL
    )";

    // use exec(), no results are returned
    $conn->exec($sql);
    echo "Table users successfully created";

} catch(PDOException $e) {

    echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
?>