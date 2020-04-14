<?php
	require_once("includes/initialize.php");
	
	if($session->is_logged_in()) {
		redirect_to("index.php");	
	}
	
	$message = "";
	// Remember to give your form's submit tag a name="submit" attribute!
	if(isset($_POST['submit'])) { // Form has been submitted.
		
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
		
		// Check database to see if username/password exist
		$found_user = User::authenticate($username, $password);
		
		if($found_user) {
			$session->login($found_user);
			//log_action('Login', "{$found_user->username} logeed in.");
			redirect_to("index.php");
				
			/*echo "<script> alert('Login Successfull'); </script>";*/
		} else {
			// username/password combo was not found in the database
			$message = true;
			/*echo "<script> alert('Login was not successful'); </script>";*/	
		}
	} else { // Form has not been submitted
		$username = "";
		$password = "";	
	}
?>
<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>MNF Movies List | Admin Panel</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Movies, Hollywood Movies, Action Movies, Adventure Movies" />
<link rel="apple-touch-icon" sizes="57x57" href="../favicon/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="../favicon/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="../favicon/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="../favicon/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="../favicon/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="../favicon/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="../favicon/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="../favicon/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="../favicon/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="../favicon/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="../favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="../favicon/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="../favicon/favicon-16x16.png">
<link rel="manifest" href="../favicon/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="../favicon/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
 <!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- jQuery -->
<script src="js/jquery.min.js"></script>
<!----webfonts--->
<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900' rel='stylesheet' type='text/css'>
<!---//webfonts--->  
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
</head>
<body id="login">
  <div class="login-logo">
    <a href="index.php"><img src="images/logo.png" alt=""/></a>
    
  </div>
  <?php if(isset($message) && $message == true) { ?>
  	<div class="col-md-4"></div>
    <div class="col-md-4">
    	<div class="alert alert-error red1">
            <button class="close" data-dismiss="alert"></button>
            <strong>Error!</strong> The username OR password is incorret.
        </div>
    </div>
    <div class="col-md-4"></div>
    <?php } ?>
  <h2 class="form-heading">login</h2>
  <div class="app-cam">
	  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="login_form" name="login_form">
		<input type="text" class="text" value="Username" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Username';}" name="username" id="username">
		<input type="password" value="Password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}" name="password" id="password">
		<div class="submit"><input type="submit" name="submit" id="submit" value="Login"></div>
		<ul class="new">
			<li class="new_left"><p><a href="#">Forgot Password ?</a></p></li>
			<div class="clearfix"></div>
		</ul>
	</form>
  </div>
   <div class="copy_layout login">
      <p>Copyright &copy; 2015 Modern. All Rights Reserved | Design by <a href="http://w3layouts.com/" target="_blank">W3layouts</a> </p>
   </div>
</body>
</html>
