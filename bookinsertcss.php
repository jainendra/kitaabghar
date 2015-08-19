<?php
session_start();
if(!isset($_SESSION["user_email"])){
  echo "<script>window.location='homecss.php'</script>";
  exit();}
#session_start();
include ('includes/connection.php');
$idd=$_SESSION['user_id'];
//session_start();
if (isset($_POST['ok'])){
$bookname=mysqli_real_escape_string($con,$_POST['bookname']);
$author=mysqli_real_escape_string($con,$_POST['author']);

	$sharing=$_POST["sharing"];
	$FORSALE=$_POST["FORSALE"];
	$RENT=$_POST["RENT"];

	$stat="1";
    

    if($sharing=="YES"){
    $stat.="1";	
    }
    else{
    	$stat.="0";

    }
    if($FORSALE=="YES"){
    $stat.="1";	
    }
    else{
    	$stat.="0";

    }
    if($RENT=="YES"){
    $stat.="1";	
    }
    else{
    	$stat.="0";

    } 

$sqll = "INSERT INTO bookShelf (bookTitle,bookAuthor,ownerid,pStatus)
VALUES ('$bookname', '$author','$idd','$stat')";

if (mysqli_query($con, $sqll)) {
    echo "<script>alert('New record created successfully')</script>";
    unset($_POST);
} else {
    echo "Error: " . $sqll . "<br>" . mysqli_error($con);
}
}

//mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title>Insert Book IIT Ropar</title>

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
    #water{
    	background: url("waterlib.jpg");
    	background-color: red;
    }

  </style>
  <div id="loginmargin" class="container">
    <div id-"water" class="row" >
    <div class="card-panel">
  <h3  class="center-align">Add Your Own Book Below</h3></div><br>
    <form class="col s12" method="post">
      <div class="row">
        <div class="input-field col s12">
          <textarea id="textarea1"  name="bookname"  required="required" class="materialize-textarea"></textarea>
          <label for="textarea1">Enter Book Name</label>
        </div>
         <div class="input-field col s12">
          <textarea id="textarea1"  name="author"  required="required" class="materialize-textarea"></textarea>
          <label for="textarea1">Enter Book Author</label>
        </div>

        <div class="input-field col s4">
        <h5>Want To Share?</h5>
      <p>
      <input class="with-gap" type="radio" name="sharing" value="YES" id="test7" checked />
      <label for="test7">Yes</label>
    </p>
    <p>
      <input class="with-gap" type="radio" name="sharing" value="NO" id="test5" />
      <label for="test5">No</label>
    </p></div>
    <div class="input-field col s4">
        <h5>Want To Sell?</h5>
      <p>
      <input class="with-gap" type="radio" name="FORSALE" value="YES" id="test6" checked />
      <label for="test6">Yes</label>
    </p>
    <p>
      <input class="with-gap" type="radio" name="FORSALE" value="NO" id="test8" />
      <label for="test8">No</label>
    </p></div>
    <div class="input-field col s4">
        <h5>Want To Rent?</h5>
      <p>
      <input class="with-gap" type="radio" name="RENT" value="YES" id="test9" checked />
      <label for="test9">Yes</label>
    </p>
    <p>
      <input class="with-gap" type="radio" name="RENT" value="NO" id="test1" />
      <label for="test1">No</label>
    </p></div>
    <div class="input-field col s12">
    <br><br><button class="btn waves-effect waves-light" name="ok">Insert This Book</button>
     </div> </div>
    </form>

       
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
