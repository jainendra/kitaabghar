<?php
	require 'includes/connection.php';
	//session continue
	session_start();
	//session check
	if(!isset($_SESSION["user_email"])){
		echo "you're not logged in<br>Click <a href=\"index.php\">here</a> to log in.";
		exit();
	}
	$user_id = $_SESSION['user_id'];
	if(empty($_GET)){
		echo 'Invalid URL<br>';
		echo '<a href="index.php">Go Home</a>';
		exit();
	}elseif ((empty($request = trim($_GET['request']))) && (empty($mid = trim($_GET['mid'])))) {
		echo 'Invalid URL<br>';
		echo '<a href="index.php">Go Home</a>';
		exit();
	}

	if($request==='a'){
		if(checkmid($mid)){
			
		}
	}elseif ($request==='r') {
		# code...
	}else{
		echo 'Invalid URL<br>';
		echo '<a href="index.php">Go Home</a>';
		exit();
	}

	function checkmid($mid)
	{
		global $con;
		$query = "SELECT * FROM messages WHERE m_id='$mid' AND message_recipient_id='$user_id'";
		if(mysqli_query($con,$query)) return 1;
		else return 0;
	}
?>