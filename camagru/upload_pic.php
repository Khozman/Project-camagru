<?php
    // ini_set('mysql.connect_timeout', 300);
    // ini_set('default_socket_timeout', 300);
    // // Work in progress  
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Upload Picture</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
    <form method="post" enctype="multipart/form-data">
    <br/><br/>
        <input type="file" name="image" />
        <br/><br/>
        <input type="submit" name="submit" value="upload" />
    </form>
    <?php 
        if(isset($_POST['submit']))
        {
            if(getimagessize($_FILES['image']['tmp_name'])== FALSE)
            {
                echo "Please select image.";
            }
            else
            {
                $image= addlashes($_FILES['image']['tmp_name']);
                $name= addlashes($_FILES['image']['name']);
                $image= file_get_contents($image);
                $image= base64_encode($image);
                saveimage($name,$image);
            }
        }
        function saveimage()
        {
            $con=mysql_connect("localhost", "root", "2435465674");
            mysql_select_db("camagru", $con);
            $query="insert into images (name,image) values ('$name', '$image')";
            $result=mysql_query($query,$con);

            if($result)
            {
                echo "<br/> Image uploaded.";
            }
            else
            {
                echo "<br/> Image NOT uploaded.";
            }
        }
    ?>
</body>
</html>