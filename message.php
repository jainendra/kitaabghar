<?php 
	require 'includes/connection.php';
	//session continue
	//session_start();
	//session check
	if(!isset($_SESSION["user_email"])){
		echo "you're not logged in<br>Click <a href=\"index.php\">here</a> to log in.";
		exit();
	}
	$user_email=$_SESSION['user_email'];
	$user_id=searchOwnerId($user_email);
	$recipient_id = $_GET['id'];
	$user_name = searchOwner($user_id);
	//function to return $ownerId
	function searchOwnerId($user_email){
			global $con;
			$userQuery = "SELECT user_id FROM user_login_details WHERE user_email='$user_email'";
			if(!($userQuery_run = mysqli_query($con,$userQuery))) die("Could load book owners data");
			 return mysqli_fetch_assoc($userQuery_run)['user_id'];
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
<style type="text/css">
	#message_content{
		width: 35%;
		height: 10%;
	}
</style>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title>LibraryIITRPR - Materialize</title>

  <!-- CSS  -->
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<br><br><br>
<h1 class="card-panel teal lighten-2">POST A MESSAGE</h1>
<form action="" method="post">
	<h5>Subject : </h5>
	<input type="text" name="message_subject" placeholder="Enter the Subject" autocomplete="off"><br>
	<h5>Message : </h5>
	<textarea id="message_content" class="materialize-textarea" length="120" name="message_content"></textarea>
	<label for="message_content">Textarea</label>
	<br>
	
	<button class="btn waves-effect waves-light" name="send_content">Send
		<i class="mdi-content-send right"></i>
	</button>

</form>

<?php
	if(isset($_POST['send_content'])){
		$message_content = trim($_POST['message_content']);
		$message_subject = trim($_POST['message_subject']);
		if(!empty($message_content)){
			if(empty($message_subject))echo 'Sending without subject<br>';
			$query = "INSERT INTO messages
				(m_tag,message_time,message_sender_id,message_recipient_id,message_subject,message_content)
				VALUES ('00',NOW(),'$user_id','$recipient_id','$message_subject','$message_content')";
			if($query_run = mysqli_query($con, $query)){
				echo 'Message sent successfully.....';
				$_POST['message_content']='';
				$_POST['message_subject']='';
			}else{
				echo "Something went wrong!!";
			}
		}else{
			echo('Please enter any message!!!');
		}
	}
?>