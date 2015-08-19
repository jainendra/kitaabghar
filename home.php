<?php
include('includes/connection.php');
session_start();
if(!isset($_SESSION["user_email"])){
	

	echo "you're not logged in<br>Click <a href=\"index.php\">here</a> to log in.";
	//exit();
	require 'booklist.php';
	exit();
}
$user_email = $_SESSION['user_email'];


$query_for_name = "select user_name from user_login_details where user_email='$user_email'";

		if($query_run_name = mysqli_query($con,$query_for_name)){
			$query_row_name = mysqli_fetch_assoc($query_run_name);
			$my_name = $_SESSION['user_name'] = $query_row_name['user_name'];	
		}
?>
<!DOCTYPE html>
<html>
<head>
<title>Welcome <?php echo $my_name;?></title>
</head>
<body>
<h1>Welcome <?php echo $_SESSION["user_name"];?></h1>

<a href="logout.php">LogOut</a><br><br>
<a href="profile.php">MyProfile</a><br>
<a href="discussions.php">Discussions</a><br>
<a href="bookinsert.php">Insert Book into library</a><br>

<form method="post">
<li>
	<input type="text" name="BookTitle">
	<button name="Submit">Search with Bookname</button></li>
<li>
	<input type="text" name="Bookauthor">
	<button name="Submita">Search with Bookauthor</button></li>
</form>
<?php require 'booklist.php';?>



</body>
</html>