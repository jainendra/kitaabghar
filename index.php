<?php
	#if logged in redirect
	session_start();
	if(isset($_SESSION["user_email"])){
		echo "<script>window.location='homecss.php'</script>";
		exit();}

	include ('includes/connection.php');
	include('login.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title>KitabGhar</title>

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
      <a id="logo-container" href="index.php" class="brand-logo center"><img id="logobc" src="kitaabghar2.png"></a>
        <ul id="slide-out" class="side-nav">
       <li> <img src="iitroparlogo.png" id="front-page-logo" style="margin-left:40px;margin-top:30px;" class="responsive-img"></li>
          <li><a href="index.php">Home</a></li>
          <li><a href="logincss.php">Login</a></li>
          <li><a href="logincss.php">Signup</a></li>
        </ul>
        <a href="#" data-activates="slide-out" class="button-collapse show-on-large"><i class="mdi-navigation-menu"></i></a>        
    </div>
  </nav>

  <div id="index-banner" class="parallax-container z-depth-4">
    <div class="section no-pad-bot">
      <div class="container">
        <br><br>
        <h1 id="sliderbc" class="header center teal-text text-lighten-2">Share</h1>
        <div class="row center">
          <h5 class="header col s12 light">'Tis the good reader that makes the good book; in every book he finds passages which seem confidences or asides hidden from all else and unmistakenly meant for his ear</h5>
        </div>
        <div class="row center">
          <a href="booklistcss.php" id="download-button" class="btn-large waves-effect waves-light teal lighten-1">Go to Book-List</a>
        </div>
        <br><br>

      </div>
    </div>
    <div class="parallax"><img src="books.jpg" alt="Unsplashed background img 2"></div>
  </div>
  <style type="text/css">
  		#recents {
  			margin: 0 2%%;
  		}
  </style>
  <div id="recents" class="center">
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
        #bookslistmargin{
          margin-top: 6%;
        }
  			</style>
  		<div class="col s12" id="cols12">
  			<div class="card-panel z-depth-3">
  				<i class="large mdi-maps-local-library"></i>
  				<br><div id="newarrivals"class="bold">new arrivals</div>
          <div id="bookslistmargin">
          <p class="flow-text" id="ft">
  					<?php require 'booklist.php';?>
  				</p>
          </div>
  			</div>
  		</div>
  	</div>
  </div>

   <div class="parallax-container valign-wrapper">
    <div class="section no-pad-bot">
      <div class="container">
        <div class="row center">
          <h5 class="header col s12 light">We are here to share</h5>
        </div>
      </div>
    </div>
    <div class="parallax"><img src="books.jpg" alt="Unsplashed background img 2"></div>
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
