<?php 
	require 'includes/connection.php';
	//session continue
	session_start();
	//session check
	if(!isset($_SESSION["user_email"])){
		echo "you're not logged in<br>Click <a href=\"index.php\">here</a> to log in.";
		exit();
	}

	//checking the url for proper format
	if(!empty($_GET)){

		if(isset($_GET['id'],$_GET['bookTitle'],$_GET['askId'])){
			//some variables
			$askerId   = $_SESSION['user_id'];
			$toWhomId  = urldecode(trim($_GET['id']));
			$bookTitle = urldecode(trim($_GET['bookTitle']));
			$askId     = urldecode(trim($_GET['askId']));
			//checking for spaces ie. valid urls		
			if(!empty($toWhomId) && !empty($bookTitle) && !empty($askId)){
				//connection - query
				$query = "SELECT bookTitle,nStatus FROM bookShelf WHERE bookTitle='$bookTitle' AND ownerId='$toWhomId'";
				//checking if found or not; ie query successful or not
				if($query_run = mysqli_query($con, $query)){
					//fetching the data
					$query_row = mysqli_fetch_assoc($query_run);
					//checking for availibility of books
					if($query_row['nStatus'][0]==1){
						//checking the status matching for the book
						if($askId=='100'){
							//verifying the permission with the owners status of the book
							//askforborrow
							if($query_row['nStatus'][1]==$askId[0]){
								?>
								<html>
								<head>
									<title>Permissions</title>
								</head>
								<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title>View Profile</title>

  <!-- CSS  -->
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
								<body>
									<h3>Ask <?php echo searchOwner($toWhomId)?> for borrowing</h3>
									<form method="post" action="">
										<button class="waves-effect waves-light btn-large" name="confirm">Yes</button>
										<button class="waves-effect waves-light btn-large" name="cancel">No</button>
										<h5>Leave a message</h5>
										<strong>Subject : </strong>
										<input type="text" name="message_subject"><br>
										<strong>Message : </strong>
										<input type="text" name="message_content"><br>
									</form>
								</body>
								</html>
								<?php
								if(isset($_POST['confirm'])){
									$query = "SELECT * FROM messages WHERE (m_tag='01' OR m_tag='11') AND message_sender_id='$askerId' AND message_subject='__ASKFORBORROWING__' AND message_recipient_id='$toWhomId' AND message_content='$bookTitle'";
									$query_run = mysqli_query($con,$query);
									$check_query = mysqli_num_rows($query_run);
									if($check_query!=0){
										echo 'You already have asked him/her';
										echo '<br><a href="bookdetails.php?bookTitle='.urlencode($bookTitle).'">Go Back.</a>';
									}else{
										$query = "INSERT INTO messages
										(m_tag,message_time,message_sender_id,message_recipient_id,message_subject,message_content)
										VALUES ('01',NOW(),'$askerId','$toWhomId','__ASKFORBORROWING__','$bookTitle')";
										$user_email=$_SESSION['user_email'];
										$user_id=searchOwnerId($user_email);
										$recipient_id = $_GET['id'];
										$user_name = searchOwner($user_id);
										$message_content = trim($_POST['message_content']);
										$message_subject = trim($_POST['message_subject']);
										//$message_query = "INSERT INTO messages
										//				(m_tag,message_time,message_sender_id,message_recipient_id,message_subject,message_content)
										//				VALUES ('00',NOW(),'$user_id','$recipient_id','$message_subject','$message_content')";
										if(mysqli_query($con,$query)){// && mysqli_query($con, $message_query)){
											echo "We will notify him/her shortly.<br>Please Wait while we redirect.";
											echo '<script>
													setTimeout(function(){
  														window.location = "bookdetails.php?bookTitle='.urlencode($bookTitle).'";
													}, 2000);
												</script>';
										}else{
											echo "Something went wrong";
										}
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
										}
									}
								}
								if(isset($_POST['cancel'])){
									echo '<script>
													setTimeout(function(){
  														window.location = "bookdetails.php?bookTitle='.urlencode($bookTitle).'";
													}, 2000);
												</script>';
								}
							}
						}else{
							if($askId=='010'){
								//askforrent
								//verifying the permission with the owners status of the book
								if($query_row['nStatus'][2]==$askId[1]){
									?>
									<html>
									<head>
										<title>Permissions</title>
									</head>
																	<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title>View Profile</title>

  <!-- CSS  -->
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
									<body>
										<h3>Request <?php echo searchOwner($toWhomId)?> for renting</h3>
										<form method="post" action="">
											<button class="waves-effect waves-light btn-large" name="confirm">Yes</button>
											<button class="waves-effect waves-light btn-large" name="cancel">No</button>
										</form>
									</body>
									</html>
									<?php
									if(isset($_POST['confirm'])){
										$query = "SELECT * FROM messages WHERE (m_tag='01' OR m_tag='11') AND message_sender_id='$askerId' AND message_subject='__GETONRENT__' AND message_recipient_id='$toWhomId' AND message_content='$bookTitle'";
										$query_run = mysqli_query($con,$query);
										$check_query = mysqli_num_rows($query_run);
										if($check_query!=0){
											echo 'You already have requested him/her';
											echo '<br><a href="bookdetails.php?bookTitle='.urlencode($bookTitle).'">Go Back.</a>';
										}else{
											$query = "INSERT INTO messages
											(m_tag,message_time,message_sender_id,message_recipient_id,message_subject,message_content)
											VALUES ('01',NOW(),'$askerId','$toWhomId','__GETONRENT__','$bookTitle')";
											if(mysqli_query($con,$query)){
												echo "We will notify him/her shortly.<br>Please Wait while we redirect.";
												echo '<script>
														setTimeout(function(){
	  														window.location = "bookdetails.php?bookTitle='.urlencode($bookTitle).'";
														}, 0000);
													</script>';
											}else{
												echo "Something went wrong";
												//window.open(\'bookdetails.php?bookTitle='.urlencode($bookTitle).'\',\'_self\')
											}
										}
									}
									if(isset($_POST['cancel'])){
										echo '<script>
														setTimeout(function(){
	  														window.location = "bookdetails.php?bookTitle='.urlencode($bookTitle).'";
														}, 0000);
													</script>';
									}
								}
							}else{
								if($askId=='001'){
									//askforbuying
									//echo "WorksTillHere";
									//verifying the permission with the owners status of the book
									if($query_row['nStatus'][2]==$askId[2]){
										?>
										<html>
										<head>
											<title>Permissions</title>
										</head>
																		<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title>View Profile</title>

  <!-- CSS  -->
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
										<body>
											<h3>Request <?php echo searchOwner($toWhomId)?> to buy</h3>
											<form method="post" action="">
												<button class="waves-effect waves-light btn-large" name="confirm">Yes</button>
												<button class="waves-effect waves-light btn-large" name="cancel">No</button>
											</form>
										</body>
										</html>
										<?php
										if(isset($_POST['confirm'])){
											$query = "SELECT * FROM messages WHERE (m_tag='01' OR m_tag='11') AND message_sender_id='$askerId' AND message_subject='__WANTTOBUY__' AND message_recipient_id='$toWhomId' AND message_content='$bookTitle'";
											$query_run = mysqli_query($con,$query);
											$check_query = mysqli_num_rows($query_run);
											if($check_query!=0){
												echo 'You already have requested him/her';
												echo '<br><a href="bookdetails.php?bookTitle='.urlencode($bookTitle).'">Go Back.</a>';
											}else{
												$query = "INSERT INTO messages
												(m_tag,message_time,message_sender_id,message_recipient_id,message_subject,message_content)
												VALUES ('01',NOW(),'$askerId','$toWhomId','__WANTTOBUY__','$bookTitle')";
												if(mysqli_query($con,$query)){
													echo "We will notify him/her shortly.<br>Please Wait while we redirect.";
													echo '<script>
															setTimeout(function(){
		  														window.location = "bookdetails.php?bookTitle='.urlencode($bookTitle).'";
															}, 0000);
														</script>';
												}else{
													echo "Something went wrong";
													//window.open(\'bookdetails.php?bookTitle='.urlencode($bookTitle).'\',\'_self\')
												}
											}
										}
										if(isset($_POST['cancel'])){
											echo '<script>
															setTimeout(function(){
		  														window.location = "bookdetails.php?bookTitle='.urlencode($bookTitle).'";
															}, 0000);
														</script>';
										}
									}
								}else{
									echo "Invalid URL";
								}
							}
						}

					}else{
						echo "Invalid URL";
					}
				}else{
					echo "Invalid URL";
				}
			}else{
				echo "Invalid URL";
			}	
		}else{
			echo "Invalid URL";
		}
	}else{
		echo "Invalid URL";
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
//function to return $ownerId
	function searchOwnerId($user_email){
			global $con;
			$userQuery = "SELECT user_id FROM user_login_details WHERE user_email='$user_email'";
			if(!($userQuery_run = mysqli_query($con,$userQuery))) die("Could load book owners data");
			 return mysqli_fetch_assoc($userQuery_run)['user_id'];
		}

?>