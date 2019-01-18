 <?php
//session_start();
$server = "localhost";
$username = "root";
$password = "2435465674";
$db = "camagru";

try {
	$conn = new PDO("mysql:host=$server;dbname=$db", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
echo "hello";

	if(isset($_POST['signup'])){
		
		$fullnames = $_POST['fullnames'];
		$email = $_POST['email'];
		$passwd = $_POST['passwd'];
		$confirm_passwd = $_POST['confirm_passwd'];
		
		// Checking whether the new password created is == to the confirmation
		if($passwd === $confirm_passwd) { 

			$insert = $conn->prepare("INSERT INTO users (fullnames,email,passwd)
			values(:fullnames,:email,:passwd)  ");

			$insert->bindParam(':fullnames',$fullnames);
			$insert->bindParam(':email',$email);
			$insert->bindParam(':passwd',$passwd);

			$insert->execute();
				
		}
	}
		// elseif(isset($_POST['signin'])){

	// 	$email = $_POST['email'];
	// 	$passwd = $_POST['passwd'];

	// 	$select = $conn->prepare("SELECT * FROM users WHERE email='$email' and passwd='$passwd");
	// 	$select->setFetchMode(PDO::FETCH_ASSOC);
	// 	$select->execute();
	// 	$data=$select->fetch();

	// 	if($data['email']!=$email and $data['passwd']!=$passwd) {

	// 		echo "You have entered an invalid email or password!";

	// 	} elseif($data['email']==$email and $data['passwd']==$passwd) {

	// 		$_SESSION['email']=$data['email'];
	// 		$_SESSION['fullnames']=$data['fullnames'];
	// 	}
	// }

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PODException $e) {
	echo $sql . "<br>" . $e->getMessage();
}

?>

<html>
	<head>
		<title>Login Form Design</title>
		<link rel="stylesheet" type="text/css" href="css/style1.css">
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
						<a href="">Already have an account?</a>
					</form>
			</div>

		</body>
	</head>
</html>








