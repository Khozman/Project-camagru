<?php
require ("home.php");
if(isset($_POST['submit']) && !empty($_POST['email']))
{
  $database = camagru();
	$email =  strip_tags(trim($_POST['email']));
	$query = $database->prepare("SELECT * FROM camagru.users WHERE email =:email");
	$query->bindParam(":email", $email, PDO::PARAM_STR);
  $query->execute();
  while ($row = $query->fetch(PDO::FETCH_ASSOC))
  {
    if($row > 1)
    {
        $toEmail = $_POST['email'];
        $subject = "Your Recovered Password";
        $folder = basename(__DIR__);
        $message = "Please click on this link for resetting password ". "http://$_SERVER[HTTP_HOST]/$folder"."/reset_password.php?email=$email";
        $headers = "From: Camagru\r\n";
        if($row)
        {
          if(mail($toEmail, $subject, $message, $headers))
          {
          	// echo "<div><p> ".$toEmail." ".$subject." ".$message." ".$headers."</p></div>";
            echo "<script> alert ('Please check your email')</script>";
          }
          else
          {
          	echo "Failed to Recover your password, try again";
          }
        }
  	}
    else
    {
  		echo "Name does not exist in database";
  	}
  }
}
?>

<form  action="forgot.php" method="POST">
  <h2>Forgot Password</h2>
  <div>
      <input type="text" name="email"  placeholder="Your email" required>
      <br />
      <input type="submit" name="submit"/>
      <a href="login.php">Login</a>
    </form>