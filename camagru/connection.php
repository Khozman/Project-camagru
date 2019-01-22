<?php

function database()
{ 
    $server = "localhost";
    $username = "root";
    $password = "2435465674";
    $db = "camagru";
    try
    {
        $handle = new PDO("mysql:host=$server;dbname=$db", "$username", "$password");
        $handle->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $handle;
        // echo "connected";
    }
    catch(PDOException $e)
    {
        return ("Error:" . $e->getMessage());
        die("Oops. Something went wrong in the database.");
    }
}
?>