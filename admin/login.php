<?php
	require_once("includes/initialize.php");
	
	// Handle logout
	if(isset($_GET['logout'])) {
		$session->logout();
		redirect_to("login.php");
	}
	
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

  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Google Fonts - Inter -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/css/adminlte.min.css">
  <!-- Custom Modern Styles -->
  <link rel="stylesheet" href="assets/css/admin-modern.css">

</head>
<body class="hold-transition login-page">

<div class="login-box animate-fadeInUp">

	<?php if(isset($message) && $message == true) { ?>

		<div class="alert alert-danger" style="margin-bottom: 1rem; border-radius: 10px;">
			<button class="close" data-dismiss="alert">&times;</button>
			<i class="fas fa-exclamation-circle mr-2"></i>
			<strong>Error!</strong> The username or password is incorrect.
		</div>

    <?php } ?>

  <div class="login-logo">
    <a href="/" style="color: #fff; text-decoration: none;">
      <i class="fas fa-film" style="font-size: 2.5rem; margin-bottom: 0.5rem; display: block;"></i>
      <span style="font-weight: 700; font-size: 1.5rem;">MNF Movies</span>
      <small style="display: block; font-size: 0.9rem; opacity: 0.9; font-weight: 400;">Admin Panel</small>
    </a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">
        <i class="fas fa-lock-open mr-1" style="color: #667eea;"></i>
        Sign in to start your session
      </p>

      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="login_form" name="login_form">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="username" id="username" placeholder="Username" autocomplete="username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-4">
          <input type="password" class="form-control" name="password" id="password" placeholder="Password" autocomplete="current-password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" name="submit" id="submit" class="btn btn-primary btn-block btn-lg">
              <i class="fas fa-sign-in-alt mr-2"></i> Sign In
            </button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="text-center mt-4">
        <a href="/" style="color: #667eea; text-decoration: none; font-weight: 500;">
          <i class="fas fa-arrow-left mr-1"></i> Back to Website
        </a>
      </div>

    </div>
    <!-- /.login-card-body -->
  </div>
  
  <p class="text-center mt-3" style="color: rgba(255,255,255,0.7); font-size: 0.85rem;">
    &copy; <?php echo date('Y'); ?> MNF Movies Database
  </p>
</div>
<!-- /.login-box -->

   	<!-- jQuery -->
	<script src="assets//plugins/jquery/jquery.min.js"></script>
	<!-- Bootstrap 4 -->
	<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- AdminLTE App -->
	<script src="assets/js/adminlte.min.js"></script>

</body>
</html>
