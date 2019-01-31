<?php
session_start();
ini_set("display_errors",1);
error_reporting(E_ALL);
require ("home.php");

//gfrgfrgerre

$register_error_message = "";
$message = "";
$id = $_SESSION['id'];
  if (isset($_POST['save']))
  {
    if (!empty($_POST['email']))
    {
      if ($app->isEmail($_POST['email']) == false)
      {
        $app->update_email($_POST['email'], $id);
        $message = "email changed";
      }
      else {
        $register_error_message = "email exists";
      }
    }
    if (!empty($_POST['fullnames']))
    {
        if ($app->isUsername($_POST['fullnames']) == false)
        {
            $app->update_username($_POST['fullnames'], $id);
            $message = "Name changed";
        }
        else
        {
          $register_error_message = "fullnames error";
        }
    }
    if (empty($_POST['email']) && empty($_POST['fullnames']))
    {
      echo "<script>alert ('fields empty')</script>";
    }
  }
  if (isset($_POST['email_notification']) && isset($_POST['save_notification']))
  {
    $yes = 0;
    $_SESSION['notification'] = $yes;
    echo "<script>alert ('Email Notifications switched Off')</script>";
    header("refresh:0.01; url=template.php");
  }
  if (isset($_POST['email_notification_yes']) && isset($_POST['save_notification_yes']))
  {
    $yes = 1;
    $_SESSION['notification'] = $yes;
    echo "<script>alert ('Email Notifications switched On)</script>";
    header("refresh:0.5; url=template.php");
  }
 ?>
 <div>
     <h4>Edit Profile</h4>
     <?php
     if ($register_error_message != "")
     {
         echo '<div><strong>Error: </strong> ' . $register_error_message . '</div>';
     }
     else if ($message != "")
     {
         echo '<script> alert ("Hello: '.$message.'")</script>';
         header("refresh:0.01; url=logout.php");
     }
     ?>
     <form action="edit_prof.php" method="post">
     <div>
             <label for="">Fullnames</label>
             <input type="text" name="fullnames" pattern="[a-zA-Z0-9!@#$%^*_|]{1,25}" placeholder="Enter new fullnames"/>
         </div>
         <div>
             <label for="">Email</label>
             <input type="email" name="email" placeholder="Enter new email" />
         </div>
         <div>
             <input type="submit" name="save" value="Save"/>
         </div>
         <div>
           <label >Do Not Receive Email Notifications?
             <input type="checkbox" name="email_notification">
             <input type="submit" name="save_notification" value="Update"/>
           </label>
         </br>
           <label>Receive Email Notifications?
             <input type="checkbox" name="email_notification_yes">
             <input type="submit" name="save_notification_yes" value="Update"/>
           </label>
         </div>
     </form>
     <div>
       <p>

         <a href="forgot_pass.php" ><input type="submit" name="passwd" value="Change Password"/></a>
         <a href="profile/profile.php" ><input type="submit" name="btnLogin" value="Cancel"/></a>
     </p>
         </div>
 </div>