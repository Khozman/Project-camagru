<?php

    //workiing on my reset page...
    require("connection.php");
    
    $email = $_GET['email'];
    if(isset($_POST['reset'])){
        $new_passwd = $_POST['new_pass'];
        $con_passwd = $_POST['con_pass'];

        if (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $new_passwd))
		{
			echo "password must contain at least one number, at least one letter, at least one special character and  there have to be 8-12 characters";
		}
        else if ($new_passwd === $con_passwd) {
            $hased_passwd = hash('sha256', $new_passwd);
            echo $email;
    
            $update = $conn->prepare("UPDATE users SET passwd=? WHERE email=?");
            // $update->execute([$hashed_passwd, $email]);
            // header("Location: login.php");
        }
        else {
            echo "Passwords do not match!!!!!!!!!!!!!!!!!!!!!!!!!";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style1.css">
    <title>Reset Password</title>
</head>
<body>
    <form action=<?php echo "reset_pass.php?email=$email"; ?> method="POST">
        <p>New Password</p>
        <input type="password" name="new_pass" placeholder="New password" required>
        <p>Confirm Password</p>
        <input type="password" name="con_pass" placeholder="Confirm password" required><br/><br/>
        <input type="submit" name="reset" value="RESET"><br/>
    </form>
</body>
</html>