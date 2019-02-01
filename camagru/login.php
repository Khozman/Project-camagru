<?php
// ini_set("display_errors",1);
// error_reporting(E_ALL);
session_start();
require('connection.php');
if (strlen($_POST['email']) > 0)
{
    $database = database();
    $email = $_POST['email'];
    $passwd = $_POST['passwd'];
    $query = $database->prepare("SELECT id,activate FROM camagru.users WHERE (email=:email) AND passwd=:passwd");
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $hash = hash('sha256', $passwd);
    $query->bindParam(':passwd', $hash, PDO::PARAM_STR);
    $query->execute();
    if ($query->rowCount() > 0)
    {
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if ($result['activate'] > 0)
        {
            $_SESSION['email'] = $_POST['email'];
            // echo '<script> alert("WELCOME TO AUSTIN CAMAGRU !!! CLICK OK"); </script>';
            // header('refresh:0.01; url=home.php');
            header("Location: ./home.php");
        }
        else
        {
        echo "<script>alert ('Please click on activation that was sent to your email')</script>";
        }
    }
}
else
{
    echo "Please enter password or email";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login to Camagru</title>
    <link rel="stylesheet" type="text/css" href="css/style1.css">
</head>
<body>
    <div class="loginbox">
        <img src="pictures/avatar.png" class="avatar">
            <h1>Camagru. </h1>
            <form action="login.php" method="post">
                <p>Email</p>
                <input type="email" name="email" placeholder="Enter Email adress" required>
                <p>Password</p>
                <input type="password" name="passwd" placeholder="Password" required>
                <input type="submit" name="login" value="LOGIN"><br/>
                <a href="signup.php">Don't have an account?</a>
                <a href="forgot_pass.php">Forgot password?</a>
            </form>
    </div>
</body>
</html>