<?php
include('includes/connection.php');
//include('home.php');

if (isset($_POST['sub'])){
	$email = mysqli_real_escape_string($con,$_POST['email']);
	$pass = md5(mysqli_real_escape_string($con,$_POST['pass']));
	$get_user="select * from user_login_details where user_email='$email' AND user_pass='$pass' AND Activation='0'";
	$run_user=mysqli_query($con,$get_user);
	$_SESSION['user_id'] = mysqli_fetch_assoc(mysqli_query($con,"select user_id from user_login_details where user_email='$email'"))['user_id']; 
	$check =mysqli_num_rows($run_user);
	if ($check==1){
		$_SESSION["user_email"]=$email;
		$_SESSION["user_name"] = searchOwner($_SESSION["user_id"]);
		echo "<script>window.location='homecss.php'</script>";

	}
	else{
		echo "<script>alert('Email or Password incorrect!Try agin')</script>";
	}
}
	//to search the owner of if owner id is mentioned
	function searchOwner($ownerId){
		global $con;
		$userQuery = "SELECT user_id,user_name FROM user_login_details";
		if(!($userQuery_run = mysqli_query($con,$userQuery))) die("Could load book owners data");
		while ($userQuery_row = mysqli_fetch_assoc($userQuery_run)){
			$id = $userQuery_row['user_id'];
			$username = $userQuery_row['user_name'];
			if($id==$ownerId) return $username;
		}
	}
?>
