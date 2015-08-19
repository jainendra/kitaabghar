<?php
session_start();
if(!isset($_SESSION["user_email"])){
  echo "<script>window.location='homecss.php'</script>";
  exit();}
#session_start();
include ('includes/connection.php');
$email = $_SESSION['user_email'];


if(isset($_POST['submit'])){
	if(!isset($_POST['user_pass'])){
echo "<script>alert('Please enter the same or new password to continue')</script>";
echo "<script>window.location='editprofile.php'</script>";
exit();

}
	$name = mysqli_real_escape_string($con,$_POST['user_name']);
	$pass = md5(mysqli_real_escape_string($con,$_POST['user_pass']));
	$phone=mysqli_real_escape_string($con,$_POST['user_phone']);

	$query_edit= "UPDATE user_login_details 
			SET user_name='$name', user_pass='$pass',user_phone='$phone' 
			WHERE user_email='$email'";
	$query_edit_run =mysqli_query($con,$query_edit);
	echo "<script>alert('Profile edited Sucessfully')</script>";
	echo "<script>window.location='profile.php'</script>";



}
$query_for_details = "select * from user_login_details where user_email='$email'";
if($query_run_details = mysqli_query($con,$query_for_details)){
			$query_whole = mysqli_fetch_assoc($query_run_details);}
//$user=load_user_object($logged_user_id);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title>Edit Your Profile</title>

  <!-- CSS  -->
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
  <nav class="white z-depth-4" role="navigation">
    <div class="nav-wrapper container">
      <style type="text/css">
       #logobc{
          padding: 1.3%;
            height: 20%;
            width: 20%;
        }
      </style>
        <a id="logo-container" href="index.php" class="brand-logo right brown-text text-lighten-3 hide-on-med-and-down">IIT-Ropar</a>
      <a id="logo-container" href="#" class="brand-logo center"><img id="logobc" src="kitaabghar2.png" width="20%" height="20%"></a>
        <ul id="slide-out" class="side-nav">
        <li> <img src="iitroparlogo.png" id="front-page-logo" style="margin-left:40px;margin-top:30px;" class="responsive-img"></li>
          <li><a href="homecss.php">Home</a></li>
          <li><a href="profile.php">My Profile</a></li>
          <li><a href="memberscss.php">Members Directory</a></li>
          <li><a href="bookinsertcss.php">Insert New Book</a></li>
          <li><a href="notifications.php">Pings and Notifications</a></li>
          <li><a href="discussions.php">Discussions</a></li>
         <li><a href="logout.php">LogOut</a></li>
        </ul>
        <a href="#" data-activates="slide-out" class="button-collapse show-on-large"><i class="mdi-navigation-menu"></i></a>        
    </div>
  </nav>
  <style type="text/css">
    #loginmargin{
      margin-top: 6%;
      margin-bottom: 10%;
    }
  </style>
  <div id="loginmargin" class="container">
    <div class="card-panel">
  <h3  class="center-align">Dear <?php echo $query_whole['user_name']; ?> <br><h5 class="center-align">Edit Your profile Here</h5></h3></div><br>
  <div class="row">

  		<div id="form2">
  			<form method="post">
				<table>
					<tr>
						<td>Full Name:</td>
						<td><input type="text" name="user_name" value="<?php echo $query_whole['user_name']; ?>" required="required"/></td>
					</tr>
					<tr>
					<td>Contact:</td>
						<td><input type="number" name="user_phone" value="<?php echo $query_whole['user_phone']; ?>" /></td>
					</tr>
					
					<tr>
						<td>Password:</td>
						<td><input type="password" name="user_pass" required="required"/></td>
					</tr>
				
					<tr>
						<td colspan="6" id="rt">
							<button class="btn waves-effect waves-light" name="submit" >Save Profile<i class="mdi-content-send right"></i></button>
						</td>
						
					</tr>
				</table>
			</form>
    

        
  </div>
  </div>
  </div>


  <!-- Sumthing Was Here====Alot -->
  <footer class="page-footer teal">
    <div class="container">
      <div class="row">
        <div class="col l6 s12">
          <img src="iitroparlogo.png" class="small responsive-img">
          <h5 class="white-text">IIT Ropar Presents</h5>
          <p class="grey-text text-lighten-4">We are a team of IIT-Ropar students working on this project for the exclusive use by students. Any amount would help support and continue development on this project and is greatly appreciated.</p>
        </div>
        <div class="col l6 s12">
          <div class="row">
          <h5 class="white-text">Faculty In-Charge</h5>
          <ul>
            <li><a class="white-text" href="http://www.iitrpr.ac.in/cse/nitin" >Dr. Nitin Auluck</a></li>
          </ul>
        </div>
        <div class="row">
          <h5 class="white-text">Mentor</h5>
            <ul>
              <li><a class="white-text" href="https://in.linkedin.com/pub/ashu-kaushik/51/528/866" >Ashu Kaushik</a></li>
            </ul>
        </div>
          <div class="row">
            <div class="col l6 s12">
            <h5 class="white-text">Developers</h5>
            <ul>
              <li><a class="white-text" >Danish Saleem</a></li>
              <li><a class="white-text" >Jainendra Mandavi</a></li>
              <li><a class="white-text" >T.Vamsi </a></li>
              <li><a class="white-text" >Priyanshu Ranjan</a></li>
            </ul>
            </div>
            <div class="col l6 s12">
          <h5 class="white-text">Connect  Us</h5>
          <ul>
            <li><a class="white-text" href="https://www.facebook.com/danishslm"><i class="mdi-social-group-add"></i></a></li>
            <li><a class="white-text" href="https://www.facebook.com/jainendra.mandavi"><i class="mdi-social-group-add"></i></a></li>
            <li><a class="white-text" href="https://www.facebook.com/vamsi.bobby.7"><i class="mdi-social-group-add"></i></a></li>
            <li><a class="white-text" href="https://www.facebook.com/prince.m.emperor"><i class="mdi-social-group-add"></i></a></li>
          </ul>
        </div>
        </div>
        </div>
      </div>
    </div>
    <div class="footer-copyright">
      <div class="container">
      Crafted By <a class="brown-text text-lighten-3" href="http://www.iitrpr.ac.in">IIT-Ropar Students</a>
      </div>
    </div>
  </footer>


  <!--  Scripts-->
  <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
  <script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>
  
  </body>
</html>
