<?php
	#if not logged in redirect to index.php
	session_start();
	if(!isset($_SESSION["user_email"])){
		echo "<script>window.location='index.php'</script>";
		exit();}

	include ('includes/connection.php');
	include('login.php');
$d_id=$_SESSION['user_id'];
if(!empty($_POST)){
$query= "INSERT INTO discussions(status_user_id,status_time,status_content) VALUES('$d_id',NOW(),'$_POST[status_content]')";
if (mysqli_query($con, $query)) {
    //echo "<script>alert('Status Upadated')</script>";
    //unset($_POST);
    header("Location:discussions.php");
} else {
    echo "Error: <br>" . mysqli_error($con);
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title>Discuusions - LibraryIITRPR</title>

  <!-- CSS  -->
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
  <nav class="white z-depth-4" role="navigation">
    <div class="nav-wrapper container">
      <!-- styling the logo to be at proper center and spacing -->
      <style type="text/css">
       #logobc{
          padding: 1.3%;
            height: 20%;
            width: 20%;
        }
      </style>
        <a id="logo-container" href="index.php" class="brand-logo right brown-text text-lighten-3 hide-on-med-and-down">IIT-Ropar</a>
      <a id="logo-container" href="#" class="brand-logo center"><img id="logobc" src="kitaabghar2.png"></a>
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
  #discontainer{
    margin-top: 3%;
  }
  #postby {
    font-size: 0.8em;
  }
  </style>
	<div id="discontainer" class="container">
    <div class="row">
		 <form method="post" class="col s12 m12 l12">
		 <input name="status_time" type="hidden" />
		 <div class="input-field col s12 m12 l12">
		 <textarea class="materialize-textarea col s12 m12 l12" name="status_content"></textarea>
		 <label for="textarea1">What is On ur mind?</label>
		 </div>
		 <p>
		 <button type="submit" class="btn waves-effect waves-light" name="SignUp" >Post<i class="mdi-content-send right"></i></button>
		 </p>
		</form>
  </div>
  <div class="row">
    <ul class="collection">
<?php
$query_feed = "SELECT  * FROM discussions ORDER BY status_time DESC" ;
if($query_run = mysqli_query($con,$query_feed)){
			while ($query_row = mysqli_fetch_assoc($query_run)){
				$user =$query_row['status_user_id'];
				$stat = $query_row['status_content'];
				$tim =$query_row['status_time'];
				$namely  = searchOwner($user);
        echo '<li class="collection-item"><span class="title"> '.$stat.'- </span><p id="postby" class="small light right-align"><i>'.$namely.'<br>'.$tim.'</i></p></li>';
      }
	}
?>
</ul>
</div>
</div>


<<footer class="page-footer teal">
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