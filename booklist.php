<?php
	require 'includes/connection.php';
	if(isset($_POST['Submit'])){
		$nam = mysqli_real_escape_string($con,$_POST['BookTitle']);
		$query = "SELECT * FROM bookShelf WHERE bookTitle LIKE '%$nam%'";}

	elseif(isset($_POST['Submita'])){
		$name = mysqli_real_escape_string($con,$_POST['Bookauthor']);
		$query = "SELECT * FROM bookShelf WHERE bookAuthor LIKE '%$name%'";}

	else{//$connect = mysqli_connect('localhost','kitaabGhar','12344321','kitaabGhar');
	$query = "SELECT * FROM bookShelf ORDER By bookTitle";}
	if($query_run = mysqli_query($con,$query)) {
		$temp = '_';
		$tempString = '134234235346';
		?>
		<div class="collection">
	<?php	while ($query_row = mysqli_fetch_assoc($query_run)) {
			$bookTitle = $query_row['bookTitle'];
			$bookAuthor = $query_row['bookAuthor'];
			$ownerId = $query_row['ownerId'];
			if($temp[0]!=$bookTitle[0]){
				echo '<br><br><strong>'.$bookTitle[0].':</strong><br>';
				$temp = $bookTitle[0];
			}
			if($tempString != $bookTitle){
				echo '<a  class="collection-item" href = "bookdetails.php?bookTitle='.htmlentities(urlencode($bookTitle)).'">'.$bookTitle.'<span class="badge hide-on-med-and-down"> by '.$bookAuthor.' is available.</span></a>';
				$tempString = $bookTitle;
			}
		}
		/*echo '<br><br><a href="home.php">Go back to list Of all Books</a>';*/
		echo '<br><br><a class="waves-effect waves-light btn" href="booklistcss.php">Go back to list Of all Books</a>';
	}
	else echo mysqli_error($connect);
?>
