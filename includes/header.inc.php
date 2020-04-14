<?php date_default_timezone_set('Asia/Kabul'); ?>
<?php require_once("Admin/includes/initialize.php"); ?>
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
<link rel="apple-touch-icon" sizes="57x57" href="favicon/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="favicon/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="favicon/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="favicon/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="favicon/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="favicon/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="favicon/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="favicon/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="favicon/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="favicon/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
<link rel="manifest" href="favicon/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="favicon/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="Admin/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="Admin/css/font-awesome.css" rel="stylesheet">
<link href="css/search_style.css" rel="stylesheet">

<!-- start plugins -->
<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>

<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:100,200,300,400,500,600,700,800,900' rel='stylesheet' type='text/css'>
<script src="js/responsiveslides.min.js"></script>
<!-- Magnific Popup core CSS file -->
<link rel="stylesheet" href="Admin/assets/Magnific-Popup-master/dist/magnific-popup.css"> 

<!-- Magnific Popup core JS file -->
<script src="Admin/assets/Magnific-Popup-master/dist/jquery.magnific-popup.min.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script>
    $(function () {
      $("#slider").responsiveSlides({
      	auto: true,
      	nav: true,
      	speed: 500,
        namespace: "callbacks",
        pager: true,
      });
    });
</script>
<script type="text/javascript">
	$(document).ready(function() {
        // Validate comment_form form
		$("#comment_form").validate({
		
			rules: {
				name: {
					required: true,
					minlenght: 4
				},
				email: {
					required: true,
					email: true
				},
				
				message: {
					required: true,
					minlenght: 10
				}
				
			},
			messages: {
				name: {
					required: "Name is required! Please enter valid name.",
					minlenght: "Name must be grater than 4 characters."
				},
				email: {
					required: "Email is required! Please enter valid email address.",
					email: "Please provide valid email address."
				},
				
				message: {
					required: "Message is required! Please enter valid message.",
					minlenght: "Message must be grater than 10 characters."
				}
			},
			highlight:function(element, errorClass, validClass) {
				$(element).parents('.input-group').addClass('has-error');
				$(element).parents('.form-group').addClass('has-error');
			},
			unhighlight:function(element, errorClass, validClass) {
				$(element).parents('.input-group').removeClass('has-error');
				$(element).parents('.input-group').addClass('has-success');
				$(element).parents('.form-group').removeClass('has-error');
				$(element).parents('.form-group').addClass('has-success');
			}
		});

    });
</script>
<script type="text/javascript">
	$(document).ready(function() {
        
		// Validate contact_form form
		$("#contact_form").validate({
		
			rules: {
				name: {
					required: true,
					minlenght: 4
				},
				email: {
					required: true,
					email: true
				},
				subject: "required",
				message: {
					required: true,
					minlenght: 10
				}
				
			},
			messages: {
				name: {
					required: "Name is required! Please enter valid name.",
					minlenght: "Name must be grater than 4 characters."
				},
				email: {
					required: "Email is required! Please enter valid email address.",
					email: "Please provide valid email address."
				},
				subject: "Subject is required! Please enter valid subject.",
				message: {
					required: "Message is required! Please enter valid message.",
					minlenght: "Message must be grater than 10 characters."
				}
			},
			highlight:function(element, errorClass, validClass) {
				$(element).parents('.input-group').addClass('has-error');
				$(element).parents('.form-group').addClass('has-error');
			},
			unhighlight:function(element, errorClass, validClass) {
				$(element).parents('.input-group').removeClass('has-error');
				$(element).parents('.input-group').addClass('has-success');
				$(element).parents('.form-group').removeClass('has-error');
				$(element).parents('.form-group').addClass('has-success');
			}
		});
		
		
    });
</script> 

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
    </style>

<script type="text/javascript">
	$(document).ready(function(){
		$('[data-toggle="tooltip"]').tooltip();
	});
</script>
<script type="text/javascript">
      $(document).ready(function() {
        $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
          disableOn: 700,
          type: 'iframe',
          mainClass: 'mfp-fade',
          removalDelay: 160,
          preloader: false,

          fixedContentPos: false
        });
      });
    </script>


</head>
<body>
<div class="container">
	<div class="container_wrap">
		<div class="header_top">
		    <div class="col-sm-4 logo"><a href="index.php"><img src="images/logo.png" alt=""/></a></div>
		    <div class="col-sm-5 nav">
			  <ul>
				 <li class="col-sm-1"> <span class="simptip-position-bottom simptip-movable" data-tooltip="contact"><a href="contact.php" style="background:none;"> <i class="fa fa-comments-o fa-2x fa-pull-right"></i> </a></span></li>
				 <li class="col-sm-1"><span class="simptip-position-bottom simptip-movable" data-tooltip="movie"><a href="movie.php" style="background:none;"> <i class="fa fa-film fa-2x fa-pull-right"></i> </a> </span></li>
				 <li class="col-sm-1"><span class="simptip-position-bottom simptip-movable" data-tooltip="trailers"><a href="trailers.php" style="background:none;"> <i class="fa fa-youtube-play fa-2x fa-pull-right"></i> </a></span></li>
				 <li class="col-sm-1"><span class="simptip-position-bottom simptip-movable" data-tooltip="tv"><a href="tv.php" style="background:none;"> <i class="fa fa-desktop fa-2x fa-pull-right"></i> </a></span></li>
				<li class="col-sm-1"><span class="simptip-position-bottom simptip-movable" data-tooltip="search"><a href="search.php" style="background:none;"> <i class="fa fa-search fa-2x fa-pull-right"></i> </a></span></li>			
			 </ul>
			</div>
			<div class="col-sm-3 header_right">
			   <ul class="header_right_box">
				 <li><img src="images/mnf.png" class="img-circle" alt="Mohammad Naim Faizy"/></li>
				 <li><p><a href="http://mnfprofile.com" target="_blank">M.Naim Faizy</a></p></li>
				 <div class="clearfix"> </div>
			   </ul>
			</div>
			<div class="clearfix"> </div>
	      </div>