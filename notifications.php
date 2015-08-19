<?php
session_start();
if(!isset($_SESSION["user_email"])){
  echo "<script>window.location='homecss.php'</script>";
  exit();}
#session_start();
include ('includes/connection.php');
$user_email=$_SESSION['user_email'];
  $user_id=searchOwnerId($user_email);
  //for reply check box
  if(isset($_POST['accept'])){
    $mid = $_POST['accept'];
    $query = "SELECT message_subject,message_content,message_sender_id FROM messages WHERE m_id=$mid";
    $message_sender_id = mysqli_fetch_assoc(mysqli_query($con, $query))['message_sender_id'];
    $message_content = mysqli_fetch_assoc(mysqli_query($con, $query))['message_content'];
    $message_subject = mysqli_fetch_assoc(mysqli_query($con, $query))['message_subject'];
    $requestofapproval = requestofapproval($message_subject);
    $query_accept = "INSERT INTO messages
            (m_tag,message_time,message_sender_id,message_recipient_id,message_subject,message_content)
            VALUES ('01',NOW(),'$user_id','$message_sender_id','$requestofapproval','$message_content')";
    if(!(mysqli_query($con,$query_accept))){
      echo 'Something Went wrong';
    }
    $query_accept = "UPDATE messages
            SET m_tag='11' WHERE m_id='$mid'";
    if(!(mysqli_query($con,$query_accept))){
      echo 'Something Went wrong';
    }
    if(isset($_POST['leave_message']))echo "<script>window.location='reply.php?recipientId=$message_sender_id'</script>";
  }elseif(isset($_POST['reject'])){
    $mid = $_POST['reject'];
    $query = "SELECT message_subject,message_content,message_sender_id FROM messages WHERE m_id=$mid";
    $message_sender_id = mysqli_fetch_assoc(mysqli_query($con, $query))['message_sender_id'];
    $message_content = mysqli_fetch_assoc(mysqli_query($con, $query))['message_content'];
    $message_subject = mysqli_fetch_assoc(mysqli_query($con, $query))['message_subject'];
    $requestofrejection = requestofrejection($message_subject);
    $query_accept = "INSERT INTO messages
            (m_tag,message_time,message_sender_id,message_recipient_id,message_subject,message_content)
            VALUES ('01',NOW(),'$user_id','$message_sender_id','$requestofrejection','$message_content')";
    if(!(mysqli_query($con,$query_accept))){
      echo 'Something Went wrong';
    }
    $query_accept = "UPDATE messages
            SET m_tag='11' WHERE m_id='$mid'";
    if(!(mysqli_query($con,$query_accept))){
      echo 'Something Went wrong';
    }
    if(isset($_POST['leave_message']))echo "<script>window.location='reply.php?recipientId=$message_sender_id'</script>";
  }



  //function to return $ownerId
  function searchOwnerId($user_email){
      global $con;
      $userQuery = "SELECT user_id FROM user_login_details WHERE user_email='$user_email'";
      if(!($userQuery_run = mysqli_query($con,$userQuery))) die("Could load book owners data");
       return mysqli_fetch_assoc($userQuery_run)['user_id'];
    }
  //checking if reply or request
  function rorr($request){
    if($request==='__ASKFORBORROWING__APPROVED__')return 'APPROVED';
    if($request==='__GETONRENT__APPROVED__')return 'APPROVED';
    if($request==='__WANTTOBUY__APPROVED__')return 'APPROVED';
    if($request==='__ASKFORBORROWING__REJECTED__')return 'REJECTED';
    if($request==='__GETONRENT__REJECTED__')return 'REJECTED';
    if($request==='__WANTTOBUY__REJECTED__')return 'REJECTED';
  }


  //function to print ask/share/rent
  function stringreturn($request){
    if($request==='__ASKFORBORROWING__')return 'WantToBorrow';
    if($request==='__GETONRENT__')return 'WantOnRent';
    if($request==='__WANTTOBUY__')return 'WantToBorrow';
    if($request==='__ASKFORBORROWING__APPROVED__')return 'IsReadyToShareTheBook';
    if($request==='__GETONRENT__APPROVED__')return 'IsReadyToRentTheBook';
    if($request==='__WANTTOBUY__APPROVED__')return 'IsReadyToSellTheBook';
    if($request==='__ASKFORBORROWING__REJECTED__')return 'IsNotReadyToShareTheBook';
    if($request==='__GETONRENT__REJECTED__')return 'IsNotReadyToRentTheBook';
    if($request==='__WANTTOBUY__REJECTED__')return 'IsNotReadyToSellTheBook';
  }

  //function to return request approval
  function requestofapproval($request){
    if($request==='__ASKFORBORROWING__')return '__ASKFORBORROWING__APPROVED__';
    if($request==='__GETONRENT__')return '__GETONRENT__APPROVED__';
    if($request==='__WANTTOBUY__')return '__WANTTOBUY__APPROVED__';
  }

  //function to return request rejection
  function requestofrejection($request){
    if($request==='__ASKFORBORROWING__')return '__ASKFORBORROWING__REJECTED__';
    if($request==='__GETONRENT__')return '__GETONRENT__REJECTED__';
    if($request==='__WANTTOBUY__')return '__WANTTOBUY__REJECTED__';
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

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title>Pings</title>

  <!-- CSS  -->
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
<?php
//requests
  $query = "SELECT m_id,message_sender_id,message_subject,message_content,message_time FROM messages WHERE message_recipient_id='$user_id' AND m_tag='01' ORDER BY message_time DESC";
  if($query_run = mysqli_query($con,$query)){
    $num_rows = mysqli_num_rows($query_run);
    $notify_array = array();
    while($query_row = mysqli_fetch_assoc($query_run)){ $notify_array[]=$query_row;}
?>
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
    #loginmargin{
      margin-top: 6%;
      margin-bottom: 10%;
    }
  </style>
  <div id="loginmargin" class="container">
  <div class="card-panel">
  <h3  class="center-align">Messages/Notifications</h3></div>
    <div class="row">
    <div><h4 class="card-panel teal lighten-2">Requests/Approvals</h4>
    <table class="striped responsive-table centered">
    <?php
          if($num_rows===0){
            echo 'No requests';
          }else{
    ?>
      <thead>
        <tr>
          <th>Sender</th>
          <th>Request</th>
          <th>Book Title</th>
          <th>Time</th>
          <th>Reply</th>
          <th>Leave a message?</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          
            foreach ($notify_array as $n) {
        ?>
        <tr>
          <td><?php echo searchOwner($n['message_sender_id']); ?></td>
          <td><?php echo stringreturn($n['message_subject']); ?></td>
          <td><?php echo ($n['message_content']); ?></td>
          <td><?php echo ($n['message_time']); ?></td>
          <?php
            if(rorr($n['message_subject'])==='REJECTED' || rorr($n['message_subject'])==='APPROVED'){
              echo '<i>'.rorr($n['message_subject']).'</i>';
            }else{
          ?>
          <form method="post" action="">
            <td>
              <button class="waves-effect waves-light btn-large" name="accept" value="<?php echo $n['m_id']?>">Accept</button>
              <button class="waves-effect waves-light btn-large" name="reject" value="<?php echo $n['m_id']?>">Reject</button>
            </td>
            </form>
            <form method="post" action="">
            <td>
              <input type="checkbox" name="leave_message" class="filled-in" checked="checked" />
              <label for="filled-in-box"></label>
            </td>
            </form>
            <?php
              }
            ?>
          </td>
        </tr>
        <?php
          }
        ?>
      </tbody>
<?php 
    }
   }
?>
    </table>  
    <br><br>
<?php
//new message recieved
  $query = "SELECT message_sender_id,message_subject,message_content,message_time FROM messages WHERE message_recipient_id='$user_id' AND (m_tag='00' OR m_tag='10') ORDER BY message_time DESC";
  if($query_run = mysqli_query($con,$query)){
    $num_rows = mysqli_num_rows($query_run);
    $notify_array = array();
    while($query_row = mysqli_fetch_assoc($query_run)){ $notify_array[]=$query_row;}
?>
  <h4 class="card-panel teal lighten-2">Recieved Messages</h4>
    <table class="striped">
      <?php
          if($num_rows===0){
            echo 'No messages';
          }else{
            
        ?>
      <thead>
        <tr>
          <th>Sender</th>
          <th>Subject</th>
          <th>Message</th>
          <th>Time</th>
        </tr>
      </thead>
      <tbody>
        <?php
          foreach ($notify_array as $n) {
        ?>
        <tr>
          <td><?php echo searchOwner($n['message_sender_id']); ?></td>
          <td><?php echo $n['message_subject']; ?></td>
          <td><?php echo ($n['message_content']); ?></td>
          <td><?php echo ($n['message_time']); ?></td>
        </tr>
        <?php
            }
          }
        ?>
      </tbody>
    </table>
    <br><br>
<?php
  }
//new message sent
  $query = "SELECT message_recipient_id,message_sender_id,message_subject,message_content,message_time FROM messages WHERE message_sender_id='$user_id' AND (m_tag='00' OR m_tag='10') ORDER BY message_time DESC";
  if($query_run = mysqli_query($con,$query)){
    $num_rows = mysqli_num_rows($query_run);
    $notify_array = array();
    while($query_row = mysqli_fetch_assoc($query_run)){ $notify_array[]=$query_row;}
?>
  <h4 class="card-panel teal lighten-2">Sent Messages</h4>
    <table classs="striped">
      <?php
          if($num_rows===0){
            echo 'No messages';
          }else{
            
        ?>
      <thead>
        <tr>
          <th>Reciever</th>
          <th>Subject</th>
          <th>Message</th>
          <th>Time</th>
        </tr>
      </thead>
      <tbody>
        <?php
          foreach ($notify_array as $n) {
        ?>
        <tr>
          <td><?php echo searchOwner($n['message_recipient_id']); ?></td>
          <td><?php echo $n['message_subject']; ?></td>
          <td><?php echo ($n['message_content']); ?></td>
          <td><?php echo ($n['message_time']); ?></td>
        </tr>
        <?php
            }
          }
        ?>
      </tbody>
    </table>
    <br><br>
<?php
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
