 <?php
session_start();
$server = "localhost";
$username = "root";
$password = "2435465674";
$db = "camagru";

try {
	$conn = new PDO("mysql:host=$server;dbname=$db", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
// echo "hy";

	if(isset($_POST['signup'])){
		
		$fullnames = $_POST['fullnames'];
		$email = $_POST['email'];
		$passwd = $_POST['passwd'];
		$confirm_passwd = $_POST['confirm_passwd'];

		
		
		// Checking whether the new password created is == to the confirmation
		if (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $passwd))
		{
			echo "<script> alert ('password must contain at least one number, at least one letter, at least one special character and  there have to be 8-12 characters'); </script>";
		}
		else if($passwd === $confirm_passwd)
		{
			

			// Search whether the email entered exists in the data base.
			$query = "SELECT * From users";
			$result = $conn->query($query);
			$exists = 0;
			while($stmt = $result->fetch())
			{
				if ($stmt['email'] == $email)
				{
					echo 'The email you have entered alreay exists!';
					$exists = 1;
					break ;
				}
			}
			if ($exists == 0) {

				// Hashing of password..
				// $passwd = hash('whirlpool', test_input($_POST['passwd']));
        		// $confirm_passwd = hash('whirlpool', test_input($_POST['confirm_passwd']));

				
				echo 'At Successfully created!<br>';
				$hashed_pass = hash('sha256', $passwd);
				$code = md5(rand(0,1000));
				$insert = $conn->prepare("INSERT INTO camagru.users (fullnames,email,passwd,code)
				VALUES (:fullnames,:email,:hashed_pass,:code) ");

				$insert->bindParam(':fullnames',$fullnames);
				$insert->bindParam(':email',$email);
				$insert->bindParam(':hashed_pass',$hashed_pass);
				$insert->bindParam(':code',$code);

				if ($insert->execute())
				{
					// verification on email..
					$folder = basename(__DIR__);
					$link = "http://$_SERVER[HTTP_HOST]/$folder/" . "verification.php?email=".$email."&code=".$code;
					$body = "Hello $fullnames!
					 
Here is your verification link to Camagru, hope you enjoy the journey of taking pictures with us:".$link;
					$subject = "Camagry Account Confimation mail";
					$mailHeaders = "From: Camagru\r\n";
					if (mail($email,$subject, $body, $mailHeaders))
					{
						echo "Confimation link has been sent to ".htmlspecialchars($email);
					}
					else
					{
						echo "email not sent";
					}
				}

				unset($_POST);
			}

		}	else {

			echo "Passwords do not match.<br/>You will be redirected...";
        	header('refresh:3; url="index.php"');
		}
	}

} catch(PODException $e) {
	echo $sql . "<br>" . $e->getMessage();
}

?>

<html>
	<head>
		<title>Sigup with Camagru</title>
		<link rel="stylesheet" type="text/css" href="css/style1.css">
	</head>
		<body>
			<div class="loginbox">
				<img src="pictures/avatar.png" class="avatar">
					<h1>Camagru. </h1>
					<form name="signup" action="signup.php" method="POST">
						<p>Full Names</p>
						<input type="text" name="fullnames" placeholder="Full Name" required>
						<p>Email</p>
						<input type="email" name="email" placeholder="Enter Email adress" required>
						<p>Create Password</p>
						<input type="password" name="passwd" placeholder="New Password" required>
						<input type="password" name="confirm_passwd" placeholder="Confirm Password" required>
						<input type="submit" name="signup" value="SIGN UP"><br/>
						<a href="login.php">Already have an account?</a>
					</form>
			</div>
			<footer>Akhosa Camagru 2018 &copy;</footer>
		</body>
</html>








