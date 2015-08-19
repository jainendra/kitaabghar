<?php
	#if not logged in redirect to index.php
	session_start();
	if(!isset($_SESSION["user_email"])){
		echo "<script>window.location='index.php'</script>";
		exit();}

	include ('includes/connection.php');
	include('login.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title>LibraryIITRPR -Home</title>

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
  
  <div class="container hide-on-med-and-down">
  	<div class="row">
	    <div class="col m12 l12">
	    	<div class="card-panel row center teal white-text">
		    	<a class="white-text" href="discussions.php">
		    		<div class="col m4 l4">
		    			<i class="large mdi-action-dashboard"></i>Join Discussions
		    		</div>
		    	</a>
		    	<a class="white-text" href="booklistcss.php">
		    		<div class="col m4 l4">
		    			<i class="large mdi-communication-dialpad"></i>Books
		    		</div>
		    	</a>
		    	<a class="white-text" href="profile.php">
		    		<div class="col m4 l4">
		    			<i class="large mdi-communication-contacts"></i>Your Profile
		    		</div>
		    	</a>
	    	</div>
	    </div>
      </div>
  </div>
  <style type="text/css">
  		#recents {
  			margin: 0 2%%;
  		}
  		#cols12{
  			margin-top: 2%;
  		}
  		#ft{
  			margin-top: -4%;
  		}
  		#newarrivals{
  			margin-top: -30px;
  		}
  		.tabs .tab a{
  			color: #e0f2f1;
  		}

  		.tabs .tab a:hover{
  			color: #80cbc4;
  		}
  		.tabs .tab a.active{
  			color: #009688;
  		}
  		.tabs .indicator {
  			background-color: #009688;
  		}
      #bookslistmargin{
          margin-top: 6%;
        }

  	</style>
	<div id="recents" class="center">
  	<div class="row">
  		<div class="col s12" id="cols12">
  			<div class="card-panel z-depth-3">
		  				
				<div class="row">
				    <div class="col s12">
				      <ul class="tabs teal-text">
				        <li id="#newarrival" class="tab col s4 l4 m4 teal-text"><a class="active" onclick="changetm(); return false;" href=""><i class="small mdi-maps-local-library"></i></a></li>
				        <li id="#newsfeed" class="tab col s4 l4 m4 teal-text"><a href=""><i class="small mdi-social-poll"></i></a></li>
				        <li id="#notification" class="tab col s4 m4 l4 teal-text"><a href=""><i class="small mdi-maps-local-library"></i></a></li>
				      </ul>
				    </div>
				</div>
				<div class="row">
					<div id="tm" class="col s12 m12 l12">
					<i class="large mdi-maps-local-library"></i>
                    <br><div id="newarrivals"class="bold">new arrivals</div>
						
            <div id="bookslistmargin"><p class="flow-text" id="ft">
                     		<?php require 'booklist.php';?>
                    	</p>	</div>
					</div>
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
      		changetm();
    		});

  		function changetm () {
  			$('#test1')
  		}
  </script>
  </body>
</html>