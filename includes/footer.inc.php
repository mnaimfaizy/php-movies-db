<!-- Modern Footer -->
<footer id="footer">
    <div class="container">
        <div class="row g-4">
            <!-- Brand Column -->
            <div class="col-lg-4 col-md-6">
                <div class="footer-brand">
                    <img src="assets/images/logo.png" alt="MNF Movies" class="footer-logo mb-3" style="height: 50px;">
                    <p class="footer-description">
                        A modern movie database to catalog and discover your favorite films. 
                        Browse 600+ movies, watch trailers, and find your next favorite.
                    </p>
                    <div class="social-links mt-4">
                        <a href="https://www.facebook.com/mnaimfaizy" target="_blank" title="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://twitter.com/Naim_Soft" target="_blank" title="Twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="https://www.linkedin.com/in/mohammad-naim-faizy-17600250" target="_blank" title="LinkedIn">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="https://github.com/mnaimfaizy" target="_blank" title="GitHub">
                            <i class="fab fa-github"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Quick Links -->
            <div class="col-lg-2 col-md-6">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
                    <li><a href="movie.php"><i class="fas fa-film"></i> Movies</a></li>
                    <li><a href="trailers.php"><i class="fas fa-play-circle"></i> Trailers</a></li>
                    <li><a href="search.php"><i class="fas fa-search"></i> Search</a></li>
                    <li><a href="contact.php"><i class="fas fa-envelope"></i> Contact</a></li>
                </ul>
            </div>
            
            <!-- Top Genres -->
            <div class="col-lg-2 col-md-6">
                <h3>Top Genres</h3>
                <ul>
                    <li><a href="movie.php?genre=Action">Action</a></li>
                    <li><a href="movie.php?genre=Adventure">Adventure</a></li>
                    <li><a href="movie.php?genre=Comedy">Comedy</a></li>
                    <li><a href="movie.php?genre=Drama">Drama</a></li>
                    <li><a href="movie.php?genre=Thriller">Thriller</a></li>
                </ul>
            </div>
            
            <!-- Browse by Year -->
            <div class="col-lg-2 col-md-6">
                <h3>Browse Years</h3>
                <ul>
                    <li><a href="movie.php?year=2015">2015</a></li>
                    <li><a href="movie.php?year=2014">2014</a></li>
                    <li><a href="movie.php?year=2013">2013</a></li>
                    <li><a href="movie.php?year=2012">2012</a></li>
                    <li><a href="movie.php?year=2011">2011</a></li>
                </ul>
            </div>
            
            <!-- Newsletter -->
            <div class="col-lg-2 col-md-6">
                <h3>Stay Updated</h3>
                <p class="text-secondary mb-3" style="font-size: 0.9rem;">
                    Get notified about new movies and features.
                </p>
                <form class="newsletter-form">
                    <div class="input-group">
                        <input type="email" class="form-control" placeholder="Your email" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: white;">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0">&copy; <?php echo date('Y'); ?> MNF Movies. Original template by <a href="http://w3layouts.com" target="_blank">w3layouts</a>.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="mb-0">Developed with <i class="fas fa-heart text-danger"></i> by <a href="https://mnfprofile.com" target="_blank">Mohammad Naim Faizy</a></p>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Scroll to Top Button -->
<button class="scroll-to-top" id="scrollToTop" title="Back to Top">
    <i class="fas fa-chevron-up"></i>
</button>

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
	<?php } elseif($page_name === 'search.php' && ($_GET['search_query'] || $_GET['genre'] || $_GET['year'] || $_GET['rating'])) { ?>
		// Build query string for advanced search
		var searchParams = {
			rowcount: $("#rowcount").val(),
			pagination_setting: $("#pagination-setting").val(),
			search_query: "<?php echo isset($_GET['search_query']) ? addslashes($_GET['search_query']) : ''; ?>",
			genre: "<?php echo isset($_GET['genre']) ? addslashes($_GET['genre']) : ''; ?>",
			year: "<?php echo isset($_GET['year']) ? addslashes($_GET['year']) : ''; ?>",
			rating: "<?php echo isset($_GET['rating']) ? addslashes($_GET['rating']) : ''; ?>",
			sort: "<?php echo isset($_GET['sort']) ? addslashes($_GET['sort']) : 'newest'; ?>"
		};
		
		function getresult(url) {
			$.ajax({
				url: url,
				type: "GET",
				data: searchParams,
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
				searchParams.pagination_setting = option;
				getresult("ajax/loadAdvancedSearch.php");
			}
		}
		getresult("ajax/loadAdvancedSearch.php");
		
		// View toggle functionality
		$(document).ready(function() {
			$('#gridViewBtn').on('click', function() {
				$('.movies-grid').removeClass('list-view');
				$('#gridViewBtn').addClass('active');
				$('#listViewBtn').removeClass('active');
			});
			
			$('#listViewBtn').on('click', function() {
				$('.movies-grid').addClass('list-view');
				$('#listViewBtn').addClass('active');
				$('#gridViewBtn').removeClass('active');
			});
		});
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

<!-- Bootstrap 5.3 JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<!-- Modern UI JavaScript -->
<script src="assets/js/modern-ui.js"></script>

<?php include_once('includes/loading_toast.inc.php'); ?>
</body>
</html>