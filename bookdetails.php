<?php
session_start();

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

  function bookdescription($getbookTitle){
    if(!empty($getbookTitle)){
      $bookdesc = curl_get_contents('https://www.googleapis.com/books/v1/volumes?q='.urlencode($getbookTitle));
      $len = 100;
      while($len<300 || $len > 4000){
        preg_match("/\",\s*\"description\":\s*\"(.*)\",\s*\"/Us", $bookdesc, $results);
        $bookdesc = preg_replace("/\",\s*\"description\":\s*\"(.*)\",\s*\"/Us", '', $bookdesc, 1);
        $len = strlen($results[1]);
      }
      echo '<br>'.stripslashes($results[1]).'<br>';
    }else{
      echo 'Invalid URL';
    }
  }

//to display status of the book
  function b_status($bId,$ownerId){
    $query = "SELECT nStatus FROM bookShelf WHERE bId='$bId'";
    global $con,$getbookTitle;
    if($query_run = mysqli_query($con,$query)){
      $nStatus = mysqli_fetch_assoc($query_run)['nStatus'];
    if($nStatus[0]==1){
      $return_b_status='Available ';
      if($nStatus[1]==1)$return_b_status.=('<a href="permission.php?id='.$ownerId.'&bookTitle='.urlencode($getbookTitle).'&askId=100">&nbspAskForBorrowing</a> ');
      if($nStatus[2]==1)$return_b_status.=('<a href="permission.php?id='.$ownerId.'&bookTitle='.urlencode($getbookTitle).'&askId=010">&nbspGetOnRent</a> ');
      if($nStatus[3]==1)$return_b_status.=('<a href="permission.php?id='.$ownerId.'&bookTitle='.urlencode($getbookTitle).'&askId=001">WantToBuy</a> ');
      return $return_b_status;
    }else{
      return 'Not Available';
    }
    }
  }
//if(!isset($_SESSION["user_email"])){
  //echo "<script>window.location='homecss.php'</script>";
  //exit();}
#session_start();
include ('includes/connection.php');
require 'includes/fileExtractCurl.php';
$sharing="";
  $FORSALE="";
  $RENT="";
  if(isset($_SESSION["user_email"])){
  $idd=$_SESSION['user_id'];}
  if(!isset($_GET['bookTitle'])) exit('Invalid URL');
  $getbookTitle = urldecode($_GET['bookTitle']);

if (isset($_POST['ok'])){
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
$sqli = "UPDATE bookShelf SET pStatus='$stat' WHERE bookTitle='$getbookTitle' AND ownerId='$idd'";

if (mysqli_query($con, $sqli)) {
     echo "<script>alert('Record status changed successfully')</script>";
 } else {
    echo "Error updating record: " . mysqli_error($con);
}











}

  if (isset($_POST['delete'])){
    $sql = "DELETE FROM bookShelf WHERE bookTitle='$getbookTitle' AND ownerId='$idd'";

if (mysqli_query($con, $sql)) {
    echo "<script>alert('Record deleted successfully')</script>";
    echo "<script>window.location='profile.php'</script>";
    exit();
} else {
    echo "Error deleting record: " . mysqli_error($con);
}

  }
  if(!isset($_GET['bookTitle'])) exit('Invalid URL');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title>Book Details</title>

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
        <?php if(isset($_SESSION["user_email"])){ ?>
        <li> <img src="iitroparlogo.png" id="front-page-logo" style="margin-left:40px;margin-top:30px;" class="responsive-img"></li>
          <li><a href="index.php">Home</a></li>
          <li><a href="profile.php">My Profile</a></li>
          <li><a href="memberscss.php">Members Directory</a></li>
          <li><a href="bookinsertcss.php">Insert New Book</a></li>
          <li><a href="notifications.php">Pings and Notifications</a></li>
          <li><a href="discussions.php">Discussions</a></li>
         <li><a href="logout.php">LogOut</a></li>
          <?php 
              }else{
          ?>
          <li> <img src="iitroparlogo.png" id="front-page-logo" style="margin-left:40px;margin-top:30px;" class="responsive-img"></li>
          <li><a href="index.php">Home</a></li>
          <li><a href="logincss.php">Login</a></li>
          <?php
            } ?>
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
  <h3  class="center-align"><?php  echo $getbookTitle = urldecode($_GET['bookTitle']);?></h3></div>
    <div class="row">
    <p class="flow-text"><?php bookdescription($getbookTitle);?></p>
    <?php require 'includes/connection.php';
  $query = 'SELECT bookTitle,ownerId,bId FROM bookShelf';
  if(isset($_SESSION["user_email"])){
    if($query_run = mysqli_query($con,$query)){?>
<div class="collection">
     <?php while ($query_row = mysqli_fetch_assoc($query_run)){
        $bookTitle = $query_row['bookTitle'];
        if($getbookTitle===$bookTitle){
          $ownerId = $query_row['ownerId'];
          $bId = $query_row['bId'];
          //checking if the id matches the owner id of the book (if yes then don't show his/her name otherwise show)
          if($ownerId!=$_SESSION['user_id']){?>
            
           <?php echo '<a  class="collection-item" href = "profile.php?id='.$ownerId.'">'.searchOwner($query_row['ownerId']).'<span class="badge">Status :'.b_status($bId,$ownerId).'</span></a><br>';
         } 
         echo '</div>';
        

    if($ownerId == $_SESSION['user_id'])
      { ?><br><form method="post" ><button class="waves-effect waves-light btn-large" name="delete">Delete Book</button><br><br>
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
    <br><br><button class="btn waves-effect waves-light" name="ok">Update</button>
     </div> </div>
    </form>

      <?php };}}
    }

  }else{
    if($query_run = mysqli_query($con,$query)){
      while ($query_row = mysqli_fetch_assoc($query_run)){
        $bookTitle = $query_row['bookTitle'];
        if($getbookTitle===$bookTitle){
          $ownerId = $query_row['ownerId'];
          $bId = $query_row['bId'];
          echo '<a href = "profile.php?id='.$ownerId.'">'.searchOwner($query_row['ownerId']).'</a> has the book<br> <strong>Status : </strong>'.b_status($bId,$ownerId).'<br>';
          echo '<a href="index.php">Login</a><br>';
        }
      }
    }
  }



?>

 </div>
  </div>
</div>
  <!-- Sumthing Was Here====Alot -->
  <footer class="page-footer teal">
    <div class="container">
      <div class="row">
        <div class="col l6 s12">
          <h5 class="white-text">IIT Ropar Presents</h5>
          <p class="grey-text text-lighten-4">We are a team of IIT-Ropar students working on this project for the exclusive use by students. Any amount would help support and continue development on this project and is greatly appreciated.</p>


        </div>
        <div class="col l3 s12">
          <h5 class="white-text">Developers</h5>
          <ul>
            <li><a class="white-text" >Danish Saleem</a></li>
            <li><a class="white-text" >Jainendra Mandavi</a></li>
            <li><a class="white-text" >T.Vamsi </a></li>
            <li><a class="white-text" >Priyanshu Ranjan</a></li>
          </ul>
        </div>
        <div class="col l3 s12">
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
