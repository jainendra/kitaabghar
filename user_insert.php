<?php
include('includes/connection.php');
global $con;
if (isset($_POST['SignUp'])){
	$name = mysqli_real_escape_string($con,$_POST['u_name']);
	$pass = md5(mysqli_real_escape_string($con,$_POST['u_pass']));
	$email = mysqli_real_escape_string($con,$_POST['u_email']);
	$phone=mysqli_real_escape_string($con,$_POST['u_phone']);
	$activation = md5(uniqid(rand(), true));

	//$status ="unverified";
	//$posts ="No";	

	$get_mail="select * from allowed_emails where a_emails='$email'";
	$run_mail=mysqli_query($con,$get_mail);
	$checking =mysqli_num_rows($run_mail);
	if ($checking==0){
		echo "<script>alert('Email is not registered with IIT-Ropar,Get a IIT Ropar domain Email')</script>";
		echo "<script>window.location='logincss.php'</script>";
		exit();
	}
	
	$get_email="select * from user_login_details where user_email='$email'";
	$run_email=mysqli_query($con,$get_email);
	$check =mysqli_num_rows($run_email);


	if ($check!=0){
		echo "<script>alert('Email already registered!Try another one')</script>";
		echo "<script>window.location='logincss.php'</script>";
		exit();
	}
	if (strlen($pass)<8){
		echo "<script>alert('Password should be minimum 8 characters')</script>";
		echo "<script>window.location='logincss.php'</script>";
		//exit();
	}
	else{
		$insert="insert into user_login_details(user_name,user_pass,user_email,user_phone,user_image,register_date_time,last_login,Activation) values('$name','$pass','$email','$phone','default.jpg',NOW(),NOW(),'$activation')";
	$run_insert=mysqli_query($con,$insert);
	if ($run_insert){
		if (mysqli_affected_rows($con) == 1) { 
                $message = " To activate your account, please click on this link:\n\n";
                $message .= 'localhost/overall/activate.php?email=' . urlencode($email) . "&key=$activation";
                mail($email, 'Registration Confirmation', $message, 'From: danishslm1@gmail.com');
               echo 'Thank you for registering! A confirmation email
has been sent to ' . $email .
                    ' Please click on the Activation Link to Activate your account ';}
                    else { 

                echo 'You could not be registered due to a system

error. We apologize for any inconvenience.</div>';

            }


		echo "<script>alert('Congratulations! Registration Sucessful.An email has been sent')</script>";
		echo "<script>window.location='logincss.php'</script>";
	}
	}
}
?>