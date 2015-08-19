<?php
session_start();
if(!isset($_SESSION["user_email"])){
  echo "<script>window.location='index.php'</script>";
  exit();}
#session_start();
include ('includes/connection.php');
if(!empty($_GET['id'])){
  $getuid = $_GET['id'];}
  if(empty($_GET['id'])){
      $getuid = $_SESSION['user_id'];
    }
  if(isset($_SESSION["user_email"])){
    $user_email = $_SESSION['user_email'];
    $query_for_uid = "select user_id from user_login_details where user_email='$user_email'";
    $query_for_phone = "select user_phone from user_login_details where user_id='$getuid'";

    if($query_run = mysqli_query($con,$query_for_uid)){
      $query_row = mysqli_fetch_assoc($query_run);
      $my_id = $_SESSION['user_id'] = $query_row['user_id'];  
    }

    if($query_run_phone = mysqli_query($con,$query_for_phone)){
      $query_row_phone = mysqli_fetch_assoc($query_run_phone);
      
  }


  }
  if($getuid==$_SESSION['user_id']){
    //$getuid = $_SESSION['user_id'];
    $mine=true;
  }
$query_for_details = "select * from user_login_details where user_id='$getuid'";
if($query_run_details = mysqli_query($con,$query_for_details)){
      $query_whole = mysqli_fetch_assoc($query_run_details);}



  $query_for_uid="SELECT user_name FROM user_login_details WHERE user_id='$getuid'";
  $query_run = mysqli_query($con,$query_for_uid);
  $query_row = mysqli_fetch_assoc($query_run);
  
  $query_for_uid = "SELECT bookTitle,bookAuthor FROM bookShelf WHERE ownerId='$getuid'";
  $query_run = mysqli_query($con,$query_for_uid);
  $temp = '_';
  $tempString = '134234235346';
  $bookCount = 1;
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title>View Profile</title>

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
          <li><a href="editprofilecss.php">Edit Profile</a></li>
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
  <div class="row center">
    <a class="waves-effect waves-light btn" href="index.php">Home</a>
    <?php 
      if(isset($_POST['id'])){
        if(trim($_POST['id'])==$_SESSION['user_id']){
    ?>
    <a class="waves-effect waves-light btn" href="memberscss.php">Edit Profile</a>
    <?php }} ?>
    <a class="waves-effect waves-light btn" href="memberscss.php">Members Registered</a>
    <a class="waves-effect waves-light btn" href="notifications.php">Notifications</a>
    <a class="waves-effect waves-light btn" href="logout.php">LogOut</a>
  </div>

    <div class="row">
    <h3  class="center-align">Profile</h3></div>
    <div class="row card-panel teal lighten-2">
      <div class="col s3 m3 l3 center-align"><h3>About:</h3></div>
      <div class="col s9 m9 l9">
        <p>Name: <?php echo $query_whole['user_name'];?></p>
        <p>
    <?php
    if($query_row_phone['user_phone']){
    echo "PHONE :" . $query_row_phone['user_phone'] ;}?></p>
    <p>Email : <?php echo $query_whole['user_email'];?></p>
      </div>
    </div>


    <h1 class="center-align card-panel teal lighten-2">List Of Books Owned </h1>
    <div class="collection">
    <?php while($query_row = mysqli_fetch_assoc($query_run)){
    $bookTitle = $query_row['bookTitle'];
    $bookAuthor = $query_row['bookAuthor'];
    if($temp[0]!=$bookTitle[0]){
        echo '<br><strong>'.$bookTitle[0].':</strong>';
        $temp = $bookTitle[0];
    }
    if($tempString != $bookTitle){
        echo '<a class="collection-item" href = "bookdetails.php?bookTitle='.htmlentities(urlencode($bookTitle)).'">'.$bookTitle.'<span class="badge"> by '.$bookAuthor.' - '.$bookCount.' Copy/ies</span></a>';
        $bookCount = 1;
        $tempString = $bookTitle;
    }else{
      $bookCount+=1;
    }
  }
if(!empty($_GET['id'])){
  if($_SESSION['user_id']!=$_GET['id'])require 'message.php';
}
?>

    
    </div></body>


  </div>
  </div>

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
