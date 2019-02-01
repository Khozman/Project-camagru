<?php
    require("connection.php");
    require("authentication.php");

    if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        $database = database();

        $query = $database->prepare("SELECT * FROM users WHERE email=?");
        $query->execute([$email]);
        
        if ($query->rowCount() > 0)
        {
            $result = $query->fetch(PDO::FETCH_ASSOC);
            $fullnames = $result['fullnames'];
            $code = $result['code'];

            $folder = basename(__DIR__);
            $link = " http://$_SERVER[HTTP_HOST]/$folder/" . "veri_forg.php?email=".$email."&code=".$code;
            $body = "Hey $fullnames!
            Here is link to RESET your PASSWORD to your Camagru".$link;
            $subject = "Camagry Account Confimation mail";
            $mailHeaders = "From: Camagru\r\n";
            if (mail($email,$subject, $body, $mailHeaders))
            {
                echo "Confimation link has been sent to ".htmlspecialchars($email);
            }
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
    <title>Forgot Password</title>
</head>
<body>
    <form action="forgot_pass.php" method="post">
        <input type="email" name="email" placeholder="Enter your email" required>
        <input type="submit" name="submit" value="Change Password">
    </form>
</body>
</html>