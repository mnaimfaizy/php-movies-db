<div class="container"> 
 <footer id="footer">
 	<div id="footer-3d">
		<div class="gp-container">
			<span class="first-widget-bend"></span>
		</div>		
	</div>
    <div id="footer-widgets" class="gp-footer-larger-first-col">
		<div class="gp-container">
            <div class="footer-widget footer-1">
            	<div class="wpb_wrapper">
					<img src="images/logo.png" alt=""/>
				</div> 
	          <br>
	          <p>A simple yet useful database to catalog your favorite movies and know what was the faviroute one.</p>
			  <p class="text">It can also be used as a website for your shop or online store with just adding some modifications.</p>
			  <p>&nbsp;</p>
			 </div>
			 <div class="footer_box">
			  <div class="col_1_of_3 span_1_of_3">
					<h3>Categories</h3>
					<ul class="first">
						<li><a href="http://localhost/php-movies-db/movie.php?genre_id=2">Adventure</a></li>
						<li><a href="http://localhost/php-movies-db/movie.php?genre_id=4">Biography</a></li>
						<li><a href="http://localhost/php-movies-db/movie.php?genre_id=15">Musical</a></li>
						<li><a href="http://localhost/php-movies-db/movie.php?genre_id=6">Comedy</a></li>
					</ul>
		     </div>
		     <div class="col_1_of_3 span_1_of_3">
					<h3>Information</h3>
					<ul class="first">
						<li><a href="movie.php">New Movies</a></li>
						<li><a href="trailers.php">Trailers</a></li>
						<li><a href="search.php">Search Movie</a></li>
						<li><a href="contact.php">Contact Us</a></li>
					</ul>
		     </div>
		     <div class="col_1_of_3 span_1_of_3">
					<h3>Follow Us</h3>
					<ul class="first">
						<li><a href="https://www.facebook.com/mnaimfaizy" target="_blank">Facebook</a></li>
						<li><a href="https://twitter.com/Naim_Soft" target="_blank">Twitter</a></li>
						<li><a href="https://www.linkedin.com/in/mohammad-naim-faizy-17600250" target="_blank">LinkedIn</a></li>
						<li><a href="https://github.com/mnaimfaizy" target="_blank">GitHub</a></li>
					</ul>
					<div class="copy">
				      <p>&copy; 2015 Template by <a href="http://w3layouts.com" target="_blank"> w3layouts</a>.</p>
			        </div>
					<div class="copy">
				      <p> Developed by <a href="https://mnfprofile.com" target="_blank">Mohammad Naim Faizy</a>.</p>
			        </div>
		     </div>
		    <div class="clearfix"> </div>
	        </div>
	        <div class="clearfix"> </div>
		</div>
	</div>
  </footer>
</div>	

</div>
<!-- start plugins -->
<script src="assets/js/jquery-1.11.1.min.js"></script>
<script src="assets/js/responsiveslides.min.js"></script>
<!-- Magnific Popup core JS file -->
<script src="assets/js/jquery.magnific-popup.min.js"></script>

<script src="assets/js/search_script.js" ></script>	
<script src="assets/js/jquery.validate.min.js"></script>
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

        $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
          disableOn: 700,
          type: 'iframe',
          mainClass: 'mfp-fade',
          removalDelay: 160,
          preloader: false,
          fixedContentPos: false
		});
		
	  });
	  
	  /* This section is for the pagination of the website 
	   * Here we are taking the data from the page and passing it to the pagination processor page
	   * It will generate the data according to the limit specifid and populate the screen with it.
	   */
	<?php if($page_name === 'index.php') { ?>
		function getresult(url) {
			$.ajax({
				url: url,
				type: "GET",
				data:  {rowcount:$("#rowcount").val(),"pagination_setting":$("#pagination-setting").val()},
				beforeSend: function(){$("#overlay").show();},
				success: function(data){
					$("#pagination-result").html(data);
					setInterval(function() {$("#overlay").hide(); },2000);
				},
				error: function() 
				{} 	        
			});

		}
		function changePagination(option) {
			if(option!= "") {
				getresult("ajax/loadMovies.php");
			}
		}
		getresult("ajax/loadMovies.php");
	<?php } elseif($page_name === 'movie.php' && empty($_GET)) { ?>
		function getresult(url) {
			$.ajax({
				url: url,
				type: "GET",
				data:  {rowcount:$("#rowcount").val(),"pagination_setting":$("#pagination-setting").val()},
				beforeSend: function(){$("#overlay").show();},
				success: function(data){
					$("#pagination-result").html(data);
					setInterval(function() {$("#overlay").hide(); },2000);
				},
				error: function() 
				{} 	        
			});

		}
		function changePagination(option) {
			if(option!= "") {
				getresult("ajax/loadAllMovies.php");
			}
		}
		getresult("ajax/loadAllMovies.php");
	<?php } elseif($page_name === 'movie.php' && isset($_GET['year'])) { ?>
		function getresult(url) {
			$.ajax({
				url: url,
				type: "GET",
				data:  {rowcount:$("#rowcount").val(),"pagination_setting":$("#pagination-setting").val(),year:<?php echo $_GET['year']; ?>},
				beforeSend: function(){$("#overlay").show();},
				success: function(data){
					$("#pagination-result").html(data);
					setInterval(function() {$("#overlay").hide(); },2000);
				},
				error: function() 
				{} 	        
			});

		}
		function changePagination(option) {
			if(option!= "") {
				getresult("ajax/loadMoviesByYear.php");
			}
		}
		getresult("ajax/loadMoviesByYear.php");
	<?php } elseif($page_name === 'movie.php' && isset($_GET['genre'])) { ?>
		function getresult(url) {
			$.ajax({
				url: url,
				type: "GET",
				data:  {rowcount:$("#rowcount").val(),"pagination_setting":$("#pagination-setting").val(),genre:'<?php echo $_GET['genre']; ?>'},
				beforeSend: function(){$("#overlay").show();},
				success: function(data){
					$("#pagination-result").html(data);
					setInterval(function() {$("#overlay").hide(); },2000);
				},
				error: function() 
				{} 	        
			});

		}
		function changePagination(option) {
			if(option!= "") {
				getresult("ajax/loadMoviesByGenre.php");
			}
		}
		getresult("ajax/loadMoviesByGenre.php");
	<?php } elseif($page_name === 'trailers.php') { ?>
		function getresult(url) {
			$.ajax({
				url: url,
				type: "GET",
				data:  {rowcount:$("#rowcount").val(),"pagination_setting":$("#pagination-setting").val()},
				beforeSend: function(){$("#overlay").show();},
				success: function(data){
					$("#pagination-result").html(data);
					setInterval(function() {$("#overlay").hide(); },2000);
				},
				error: function() 
				{} 	        
			});

		}
		function changePagination(option) {
			if(option!= "") {
				getresult("ajax/loadMoviesByTrailer.php");
			}
		}
		getresult("ajax/loadMoviesByTrailer.php");
	<?php } elseif($page_name === 'search.php' && $_GET['search_query']) { ?>
		function getresult(url) {
			$.ajax({
				url: url,
				type: "GET",
				data:  {rowcount:$("#rowcount").val(),"pagination_setting":$("#pagination-setting").val(),search_query:"<?php echo @$_GET['search_query']; ?>"},
				beforeSend: function(){$("#overlay").show();},
				success: function(data){
					$("#pagination-result").html(data);
					setInterval(function() {$("#overlay").hide(); },2000);
				},
				error: function() 
				{} 	        
			});

		}
		function changePagination(option) {
			if(option!= "") {
				getresult("ajax/loadSearchedMovies.php");
			}
		}
		getresult("ajax/loadSearchedMovies.php");
	<?php } ?>
</script>

<script type="text/javascript">
	$(window).load(function() {
	$("#flexiselDemo3").flexisel({
		visibleItems: 4,
		animationSpeed: 1000,
		autoPlay: true,
		autoPlaySpeed: 3000,    		
		pauseOnHover: true,
		enableResponsiveBreakpoints: true,
		responsiveBreakpoints: { 
			portrait: { 
				changePoint:480,
				visibleItems: 1
			}, 
			landscape: { 
				changePoint:640,
				visibleItems: 2
			},
			tablet: { 
				changePoint:768,
				visibleItems: 3
			}
		}
	});
	
});
</script>
<script type="text/javascript" src="assets/js/jquery.flexisel.js"></script>
</body>
</html>