<?php
session_start();
if(isset($_SESSION["user_email"])){
	echo "<script>window.location='homecss.php'</script>";
	exit();}
#session_start();
include ('includes/connection.php');
include('login.php');
include('user_insert.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title>Login-LibraryIITRPR</title>

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
          <li><a href="index.php">Home</a></li>
          <li><a href="logincss.php">Login</a></li>
          <li><a href="logincss.php">Signup</a></li>
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
  	<div class="row">
  			<form method="post" id="form1">
			<strong>Email:</strong>
			<input type="email" name="email" placeholder="Enter@iitrpr.ac.in" required="required"/>
			<strong>Password:</strong>
			<input type="password" name="pass" placeholder="*********" required="required"/>
			<button class="btn waves-effect waves-light" name="sub">Login</button>
			</form>
  		<div id="form2">
  			<form method="post">
				<h2 class="center">Not Yet Registered? SignUp Below</h1>
				<table>
					<tr>
						<td>Full Name:</td>
						<td><input type="text" name="u_name" placeholder="Enter Username" required="required"/></td>
					</tr>
					<tr>
						<td>Email:</td>
						<td><input type="email" name="u_email" placeholder="Enter@iitrpr.ac.in" required="required"/></td>
					</tr>
					<tr>
						<td>Password:</td>
						<td><input type="password" name="u_pass" placeholder="Enter Your Password" required="required"/></td>
					</tr>
					<tr>
						<td>Phone no.<br>(optional)</td></td>
						<td><input type="number" name="u_phone" placeholder="+91" /></td>
					</tr>
					<tr>
						<td colspan="6" id="rt">
							<button class="btn waves-effect waves-light" name="SignUp" >SignUp<i class="mdi-content-send right"></i></button>
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
