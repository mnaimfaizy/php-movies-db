<?php 
// Load environment variables
function loadEnvIfNeeded() {
    if (getenv('APP_ENV') === false) {
        $envPath = __DIR__ . '/../.env';
        if (file_exists($envPath)) {
            $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                if (strpos(trim($line), '#') === 0) continue;
                if (strpos($line, '=') !== false) {
                    list($name, $value) = explode('=', $line, 2);
                    putenv(trim($name) . '=' . trim($value));
                }
            }
        }
    }
}
loadEnvIfNeeded();

// Error reporting configuration
$appEnv = getenv('APP_ENV') ?: 'production';
$appDebug = filter_var(getenv('APP_DEBUG'), FILTER_VALIDATE_BOOLEAN);

if ($appEnv === 'production' && !$appDebug) {
    error_reporting(0);
    ini_set('display_errors', '0');
    ini_set('display_startup_errors', '0');
} else {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
}

date_default_timezone_set('Asia/Kabul'); 
?>
<?php require_once("admin/includes/initialize.php"); ?>
<?php $page_name = get_page_name(); ?>
<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title> MNF Movies Website </title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Movie_store Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<link rel="apple-touch-icon" sizes="57x57" href="assets/favicon/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="assets/favicon/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="assets/favicon/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="assets/favicon/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="assets/favicon/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="assets/favicon/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="assets/favicon/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="assets/favicon/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="assets/favicon/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="assets/favicon/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="assets/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="assets/favicon/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="assets/favicon/favicon-16x16.png">
<link rel="manifest" href="assets/favicon/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="assets/favicon/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
<!-- Bootstrap 5.3 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<!-- Font Awesome 6 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- Google Fonts - Inter (Modern) -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<!-- Magnific Popup core CSS file -->
<link rel="stylesheet" href="assets/css/magnific-popup.css">

<!-- Custom CSS (legacy for backward compatibility) -->
<link href="assets/css/search_style.css" rel="stylesheet">
<link href="assets/css/style.css" rel="stylesheet" type="text/css" media="all">

<!-- Modern UI Styles (Bootstrap 5 Compatible) -->
<link href="assets/css/modern-ui.css" rel="stylesheet" type="text/css"> 

<style type="text/css">
      /**
       * Simple fade transition,
       */
      .mfp-fade.mfp-bg {
        opacity: 0;
        -webkit-transition: all 0.15s ease-out; 
        -moz-transition: all 0.15s ease-out; 
        transition: all 0.15s ease-out;
      }
      .mfp-fade.mfp-bg.mfp-ready {
        opacity: 0.8;
      }
      .mfp-fade.mfp-bg.mfp-removing {
        opacity: 0;
      }

      .mfp-fade.mfp-wrap .mfp-content {
        opacity: 0;
        -webkit-transition: all 0.15s ease-out; 
        -moz-transition: all 0.15s ease-out; 
        transition: all 0.15s ease-out;
      }
      .mfp-fade.mfp-wrap.mfp-ready .mfp-content {
        opacity: 1;
      }
      .mfp-fade.mfp-wrap.mfp-removing .mfp-content {
        opacity: 0;
      }
	  .btn-circle {
		  width: 30px;
		  height: 30px;
		  text-align: center;
		  padding: 6px 0;
		  font-size: 12px;
		  line-height: 1.42;
		  border-radius: 15px;
		}
		.error {
			color: red;
		}

		.link {padding: 10px 15px;background: transparent;border:#bccfd8 1px solid;border-left:0px;cursor:pointer;color:#607d8b}
		.disabled {cursor:not-allowed;color: #bccfd8;}
		.current {background: #bccfd8;}
		.first{border-left:#bccfd8 1px solid;}
		.question {font-weight:bold;}
		.answer{padding-top: 10px;}
		#pagination{margin-top: 20px;padding-top: 30px;border-top: #F0F0F0 1px solid;}
		.dot {padding: 10px 15px;background: transparent;border-right: #bccfd8 1px solid;}
		#overlay {background-color: rgba(0, 0, 0, 0.6);z-index: 999;position: absolute;left: 0;top: 0;width: 100%;height: 100%;display: none;}
		#overlay div {position:absolute;left:50%;top:50%;margin-top:-32px;margin-left:-32px;}
		.page-content {padding: 20px;margin: 0 auto;}
		.pagination-setting {padding:10px; margin:5px 0px 10px;border:#bccfd8  1px solid;color:#607d8b;}

		.background-image {
			width: 100%;
			height: 100%;
			display: block;
			position: relative;
		}
		.background-image::after {
			content: "";
			<?php if(isset($_GET['movie_id'])) {
					$poster = $database->getMoviePoster($_GET['movie_id']); ?>
				background: url(assets/images/movie_poster/<?php echo $poster; ?>) #3f444e no-repeat;
			<?php } else { ?>
				background: #3f444e; 
			<?php } ?>
			background-size: 100% 100%;
			opacity: 0.5;
			top: 0;
			left: 0;
			bottom: 0;
			right: 0;
			position: absolute;
			z-index: -1;   
		}
    </style>

</head>
<body style="position: relative;">
	<div id="overlay"><div><img src="assets/images/loading.gif" width="64px" height="64px"/></div></div>
	
	<!-- Modern Bootstrap 5 Navigation -->
	<nav class="modern-navbar navbar navbar-expand-lg navbar-dark">
		<div class="container">
			<a class="navbar-brand" href="index.php">
				<img src="assets/images/logo.png" alt="MNF Movies" class="logo">
			</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav mx-auto">
					<li class="nav-item">
						<a class="nav-link <?php echo ($page_name == 'index.php') ? 'active' : ''; ?>" href="index.php">
							<i class="fas fa-home me-1"></i> Home
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link <?php echo ($page_name == 'movie.php') ? 'active' : ''; ?>" href="movie.php">
							<i class="fas fa-film me-1"></i> Movies
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link <?php echo ($page_name == 'trailers.php') ? 'active' : ''; ?>" href="trailers.php">
							<i class="fas fa-youtube me-1"></i> Trailers
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link <?php echo ($page_name == 'search.php') ? 'active' : ''; ?>" href="search.php">
							<i class="fas fa-search me-1"></i> Search
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link <?php echo ($page_name == 'contact.php') ? 'active' : ''; ?>" href="contact.php">
							<i class="fas fa-envelope me-1"></i> Contact
						</a>
					</li>
				</ul>
				<div class="d-flex align-items-center">
					<a href="http://mnfprofile.com" target="_blank" class="text-decoration-none text-white d-flex align-items-center">
						<img src="assets/images/mnf.png" class="rounded-circle me-2" alt="Mohammad Naim Faizy" width="35" height="35"/>
						<span class="d-none d-lg-inline">M.Naim Faizy</span>
					</a>
				</div>
			</div>
		</div>
	</nav>

	<!-- Legacy background and header (hidden for modern design) -->
	<div class="background-image" style="display: none;">
		<div class="container">
			<div class="container_wrap">
				<div class="header_top">
				    <div class="col-sm-4 logo"><a href="index.php"><img src="assets/images/logo.png" alt=""/></a></div>
				    <div class="col-sm-5 nav">
					  <ul>
						 <li class="col-sm-1"> <span class="simptip-position-bottom simptip-movable" data-tooltip="contact"><a href="contact.php" style="background:none;"> <i class="fa fa-comments-o fa-2x fa-pull-right"></i> </a></span></li>
						 <li class="col-sm-1"><span class="simptip-position-bottom simptip-movable" data-tooltip="movie"><a href="movie.php" style="background:none;"> <i class="fa fa-film fa-2x fa-pull-right"></i> </a> </span></li>
						 <li class="col-sm-1"><span class="simptip-position-bottom simptip-movable" data-tooltip="trailers"><a href="trailers.php" style="background:none;"> <i class="fa fa-youtube-play fa-2x fa-pull-right"></i> </a></span></li>
						<li class="col-sm-1"><span class="simptip-position-bottom simptip-movable" data-tooltip="search"><a href="search.php" style="background:none;"> <i class="fa fa-search fa-2x fa-pull-right"></i> </a></span></li>			
					 </ul>
					</div>
					<div class="col-sm-3 header_right">
					   <ul class="header_right_box">
						 <li><img src="assets/images/mnf.png" class="img-circle" alt="Mohammad Naim Faizy"/></li>
						 <li><p><a href="http://mnfprofile.com" target="_blank">M.Naim Faizy</a></p></li>
						 <div class="clearfix"> </div>
					   </ul>
					</div>
					<div class="clearfix"> </div>
			      </div><!-- /header_top -->
			</div><!-- /container_wrap -->
		</div><!-- /container -->
	</div><!-- /background-image -->
	
	<!-- Main content starts here (outside hidden legacy wrapper) -->