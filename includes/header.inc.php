<?php date_default_timezone_set('Asia/Kabul'); ?>
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
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="assets/css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="assets/css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="assets/css/search_style.css" rel="stylesheet">
<link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" />

<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:100,200,300,400,500,600,700,800,900' rel='stylesheet' type='text/css'>

<!-- Magnific Popup core CSS file -->
<link rel="stylesheet" href="assets/css/magnific-popup.css"> 

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
	<div class="background-image">
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
	      </div>