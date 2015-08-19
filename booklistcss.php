<?php //to check for what to show in navigation pannel login or myprofile
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title>LibraryIITRPR - booklist</title>

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
      <a id="logo-container" href="#" class="brand-logo center"><img id="logobc" height="20%" src="kitaabghar2.png"></a>
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
            }
          ?>
        </ul>
        <a href="#" data-activates="slide-out" class="button-collapse show-on-large"><i class="mdi-navigation-menu"></i></a>        
    </div>
  </nav>

  <div class="center">
    <div class="row">
      <style type="text/css">
        #cols12{
          margin-top: 2%;
        }
        #ft{
          margin-top: -4%;
        }
        #newarrivals{
          margin-top: -30px;
        }
        #cardbookpanel{
          margin: 0 2%;
        }
      </style>
      <div id="cols12">
        <div id="cardbookpanel"class="card-panel z-depth-3">
          <div class="row">
            <form method="post">
              <div class="col s12 m12 l6">
                <ul>
                  <input type="text" name="BookTitle" required="required" >
                  <button class="waves-effect waves-light btn" name="Submit">Search with Bookname</button></ul>
              </div>
              </form>
              <div class="col s12 m12 l6">
              <form method="post">
                <ul>

                <input type="text" name="Bookauthor" required="required" >
                <button class="waves-effect waves-light btn" name="Submita">Search with Bookauthor</button></ul>
              </div>
            </form>
          </div>
          <p class="flow-text" id="ft">
            <?php require 'booklist.php';?>
          </p>
        </div>
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
  
  <script type="text/javascript">
    $(document).ready(function() {
      refreshbc();
    });

    function refreshbc () {
      setTimeout(function(){
        $('#sliderbc').fadeOut(1000, function() {
            $(this).text('Rent').fadeIn(1000);
          });
        setTimeout(function(){
          $('#sliderbc').fadeOut(1000, function() {
              $(this).text('Sell').fadeIn(1000);
            });
          setTimeout(function(){
            $('#sliderbc').fadeOut(1000, function() {
                $(this).text('Share').fadeIn(1000);
              });
            setTimeout(refreshbc,5000);
            },5000);
        },5000);
      },3000); 
    }
  </script>
  </body>
</html>
