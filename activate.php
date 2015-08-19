<?php
include('includes/connection.php');

$email = urldecode($_GET['email']);
 $key = $_GET['key'];
 $query_activate_account = "UPDATE user_login_details SET Activation='0' WHERE  user_email='$email' AND Activation='$key'";
 $result_activate_account = mysqli_query($con, $query_activate_account);
 if (mysqli_affected_rows($con) == 1) 

 {

 echo '<div>Your account is now active. You may now <a href="index.php">Log in</a></div>';


 } else {

 echo '<div>Oops !Your account could not be activated. Please recheck the link or contact the system administrator.</div>';

 }

 ?>