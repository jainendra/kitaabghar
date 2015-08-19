<?php
	//session start
	session_start();
	//session check
	if(!isset($_SESSION["user_email"])){
	echo "you're not logged in,log in<br>Click <a href=\"http:\/\/localhost/overall/index.php\">here</a> to log in.";
	exit();
	}
	if(empty($_GET)){
		echo 'Invalid URL<br>';
		echo '<a href="index.php">Go Home</a>';
		exit();
	}elseif (empty($recipientId = trim($_GET['recipientId']))) {
		echo 'Invalid URL<br>';
		echo '<a href="index.php">Go Home</a>';
		exit();
	}
	$senderId = $_SESSION['user_id'];
	$_GET['id'] = $recipientId;
	require 'message.php';
?>
<br><br>
<a href="home.php">Go Home</a>