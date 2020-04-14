<?php include 'includes/header.inc.php'; 
	// 1. the current page number ($current_page)
	$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
	
	// 2. records per page ($per_page)
	$per_page = 20;
	
	// 3. total record count ($total_count)
	$sql = "SELECT COUNT(*) AS total FROM movie_table";
	$tot_count = $database->query($sql);
	$total = $database->fetch_array($tot_count);
	$total_count = $total['total'];
	
	@$pagination = new Pagination($page, $per_page, $total_count);
?>

		<?php if(isset($_GET['genre_id'])) { ?>
	      <div class="content">
	   	   <h2 class="m_3">Movies List sorted according to Genre</h1>
      	       <div class="movie_top">
      	         <div class="col-md-9 movie_box">
                        <?php 
							// Retrive data from the movie table.
							if(isset($_GET['genre_id'])) {
								$genre_id = $_GET['genre_id'];
								$sql = "SELECT movie_id FROM movie_genre_table WHERE genre_id=$genre_id";
								$sql_result = $database->query($sql);
								if($database->num_rows($sql_result) > 0) {
								while($row = $database->fetch_array($sql_result)) {
									$movie_id = $row['movie_id'];
								$sql1 = "SELECT * FROM movie_table WHERE movie_id=$movie_id ORDER BY movie_id DESC";
								$sql1_result = $database->query($sql1);
								while($movie_info = $database->fetch_array($sql1_result)) {
									$movie_id = $movie_info['movie_id']; 
									// The Regular Express filter
									$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-z]{2,3}(\/\S*)?/";
									// The text you want to filter goes here. 
									$text = $movie_info['poster'];
									// Check if there is a url in the text
									if(preg_match($reg_exUrl, $text, $url)) {
										$poster = $url[0];
									} else {
										$poster = 'images/movie_poster/'.$movie_info['poster'];
									} 
								?>
									
                                <!-- Movie variant with time -->
                                <div class="movie movie-test movie-test-dark movie-test-left">
                                    <div class="movie__images">
                                        <a href="single.php?movie_id=<?php echo $movie_id; ?>" class="movie-beta__link">
                                            <img alt="" src="<?php echo $poster; ?>" class="img-responsive" alt="<?php echo $movie_info['movie_title']; ?>" width="250" height="240" style="width:250px; height:240px;"/>
                                        </a>
                                    </div>
                                    <div class="movie__info">
                                        <a href="single.php?movie_id=<?php echo $movie_id; ?>" class="movie__title">
										<?php echo $movie_info['movie_title']; ?> 
                                  <?php if(!empty($movie_info['year'])) { echo '('.$movie_info['year'].')'; } ?>  </a>
                                        <p class="movie__time"><?php echo $movie_info['duration']; ?></p>
                                        <p class="movie__option">
                                        <?php $sql1 = "SELECT genre.genre_id, genre.genre 
											FROM `movie_genre_table`
											LEFT JOIN genre ON
											genre.genre_id=movie_genre_table.genre_id
											WHERE movie_genre_table.movie_id=$movie_id";
									$sql1_result = $database->query($sql1);
									while($genre = $database->fetch_array($sql1_result)) { ?>
									<a href="movie.php?genre_id=<?php echo $genre['genre_id']; ?>">
									<?php if($genre['genre_id'] == $_GET['genre_id']) { echo '<strong>'.$genre['genre'].'</strong>'; } else { echo $genre['genre']; } ?></a> |  
									<?php } ?></p>
                                        <ul class="list_6">
                                        	<li><p><?php echo $movie_info['country']; ?></p></li>
						    				<li><i class="icon3"> </i><p><?php echo $release_date = $movie_info['release_date']; ?></p></li>
                                            <li>Rating : &nbsp;&nbsp;<p class="btn btn-danger btn-sm btn-circle"><?php echo $movie_info['rating']; ?></p></li>
                                            <div class="clearfix"> </div>
                                        </ul>
                                     </div>
                                    <div class="clearfix"> </div>
                                </div>
                             <!-- Movie variant with time -->
                                
								<?php	
									$release_date = $movie_info['release_date'];
									$directors = $movie_info['director'];
									$movie_description = $movie_info['movie_desc'];
									$trailer = $movie_info['trailer'];
								}
								}
								} else {
								echo '<div class="alert alert-danger">';
								echo '<h1 style="text-align: center"> Sorry no movie for this genre, please select another genre! </h1>';
								echo '</div>';	
							}
							}
						?>
                          
                              <div class="clearfix"> </div>                         
                         <!-- Movie variant with time -->
                      </div>
                 
                     <div class="col-md-3">
                      	
                        <h2> By Genre </h2>
                        <?php $query = "SELECT * FROM genre";
							$query_result = $database->query($query);
							while($genre = $database->fetch_array($query_result)) { ?>
                        	<p style="padding-left: 20px; padding-bottom: 10px;"> <strong> -> </strong> <a href="movie.php?genre_id=<?php echo $genre['genre_id']; ?>"> 
								<?php echo $genre['genre']; ?> </a> </p>
                        <?php } ?>
                        <br /> <br />
                        <h2> By Year </h2>
                        <?php $query = "SELECT * FROM year ORDER BY year DESC";
							$query_result = $database->query($query);
							while($year = $database->fetch_array($query_result)) { ?>
                        	<p style="padding-left: 20px; padding-bottom: 10px;"> <strong> -> </strong> <a href="movie.php?year=<?php echo $year['year']; ?>"> 
								<?php echo $year['year']; ?> </a> </p>
                        <?php } ?>
                        
						   
		               </div>                       <div class="clearfix"> </div>
                  </div>
                  <h1 class="recent">Latest Uploaded Movies</h3>
                   <ul id="flexiselDemo3">
                   		<?php $sql = "SELECT * FROM movie_table WHERE status='Active' ORDER BY movie_id DESC LIMIT 10";
						//$sql = "SELECT * FROM movie_table ORDER BY movie_id DESC LIMIT 12";
						$result = $database->query($sql);
						while($movie = $database->fetch_array($result)) { 
						// The Regular Express filter
						$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-z]{2,3}(\/\S*)?/";
						// The text you want to filter goes here. 
						$text = $movie['poster'];
						// Check if there is a url in the text
						if(preg_match($reg_exUrl, $text, $url)) {
							$poster = $url[0];
						} else {
							$poster = 'images/movie_poster/'.$movie['poster'];
						} ?>
						<li><a href="single.php?movie_id=<?php echo $movie['movie_id']; ?>"><img src="<?php echo $poster; ?>" class="img-responsive" style="width:269px; height:300px;"/><div class="grid-flex"><?php echo $movie['movie_title']; ?></a><p><?php echo $movie['release_date']; ?> | <?php echo '('.$movie['year'].')'; ?></p></div></li>
                        <?php } ?>
				    </ul>
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
				   <script type="text/javascript" src="js/jquery.flexisel.js"></script>		  
              </div>
      <?php } else if(isset($_GET['year'])) { ?>
	      <div class="content">
	   	   <h2 class="m_3">Movies List sorted according to Year</h1>
      	       <div class="movie_top">
      	         <div class="col-md-9 movie_box">
                        <?php 
							// Retrive data from the movie table.
							if(isset($_GET['year'])) {
								$year = $_GET['year'];
								$sql1 = "SELECT * FROM movie_table WHERE year=$year ORDER BY movie_id DESC";
								$sql1_result = $database->query($sql1);
								if($database->num_rows($sql1_result) > 0) {
								while($movie_info = $database->fetch_array($sql1_result)) {
									$movie_id = $movie_info['movie_id']; 
									// The Regular Express filter
									$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-z]{2,3}(\/\S*)?/";
									// The text you want to filter goes here. 
									$text = $movie_info['poster'];
									// Check if there is a url in the text
									if(preg_match($reg_exUrl, $text, $url)) {
										$poster = $url[0];
									} else {
										$poster = 'images/movie_poster/'.$movie_info['poster'];
									} 
								?>
									
                                <!-- Movie variant with time -->
                                <div class="movie movie-test movie-test-dark movie-test-left">
                                    <div class="movie__images">
                                        <a href="single.php?movie_id=<?php echo $movie_id; ?>" class="movie-beta__link">
                                            <img alt="" src="<?php echo $poster; ?>" class="img-responsive" alt="<?php echo $movie_info['movie_title']; ?>" width="250" height="240" style="width:250px; height:240px;"/>
                                        </a>
                                    </div>
                                    <div class="movie__info">
                                        <a href="single.php?movie_id=<?php echo $movie_id; ?>" class="movie__title">
										<?php echo $movie_info['movie_title']; ?> 
                                  <?php if(!empty($movie_info['year'])) { echo '('.$movie_info['year'].')'; } ?>  </a>
                                        <p class="movie__time"><?php echo $movie_info['duration']; ?></p>
                                        <p class="movie__option">
                                        <?php $sql2 = "SELECT genre.genre_id, genre.genre 
											FROM `movie_genre_table`
											LEFT JOIN genre ON
											genre.genre_id=movie_genre_table.genre_id
											WHERE movie_genre_table.movie_id=$movie_id";
									$sql2_result = $database->query($sql2);
									while($genre = $database->fetch_array($sql2_result)) { ?>
									<a href="movie.php?genre_id=<?php echo $genre['genre_id']; ?>">
									<?php echo $genre['genre']; ?></a> |  
									<?php } ?></p>
                                        <ul class="list_6">
                                        	<li><p><?php echo $movie_info['country']; ?></p></li>
						    				<li><i class="icon3"> </i><p><?php echo $release_date = $movie_info['release_date']; ?></p></li>
                                            <li>Rating : &nbsp;&nbsp;<p class="btn btn-danger btn-sm btn-circle"><?php echo $movie_info['rating']; ?></p></li>
                                            <div class="clearfix"> </div>
                                        </ul>
                                     </div>
                                    <div class="clearfix"> </div>
                                </div>
                             <!-- Movie variant with time -->
                                
								<?php	
									$release_date = $movie_info['release_date'];
									$directors = $movie_info['director'];

									$movie_description = $movie_info['movie_desc'];
									$trailer = $movie_info['trailer'];
								}
							} else {
								echo '<div class="alert alert-danger">';
								echo '<h1 style="text-align: center"> Sorry no movie for this year, please select another year! </h1>';
								echo '</div>';	
							}
						}
						?>
                          
                              <div class="clearfix"> </div>                         
                         <!-- Movie variant with time -->
                      </div>
                 
                     <div class="col-md-3">
                      	
                        <h2> By Genre </h2>
                        <?php $query = "SELECT * FROM genre";
							$query_result = $database->query($query);
							while($genre = $database->fetch_array($query_result)) { ?>
                        	<p style="padding-left: 20px; padding-bottom: 10px;"> <strong> -> </strong> <a href="movie.php?genre_id=<?php echo $genre['genre_id']; ?>"> 
								<?php echo $genre['genre']; ?> </a> </p>
                        <?php } ?>
                        <br /> <br />
                        <h2> By Year </h2>
                        <?php $query = "SELECT * FROM year ORDER BY year DESC";
							$query_result = $database->query($query);
							while($year = $database->fetch_array($query_result)) { ?>
                        	<p style="padding-left: 20px; padding-bottom: 10px;"> <strong> -> </strong> <a href="movie.php?year=<?php echo $year['year']; ?>"> 
								<?php echo $year['year']; ?> </a> </p>
                        <?php } ?>
                        
						   
		               </div>                       <div class="clearfix"> </div>
                  </div>
                  <h1 class="recent">Latest Uploaded Movies</h3>
                   <ul id="flexiselDemo3">
                   		<?php $sql = "SELECT * FROM movie_table WHERE status='Active' ORDER BY movie_id DESC LIMIT 10";
						//$sql = "SELECT * FROM movie_table ORDER BY movie_id DESC LIMIT 12";
						$result = $database->query($sql);
						while($movie = $database->fetch_array($result)) { 
						// The Regular Express filter
						$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-z]{2,3}(\/\S*)?/";
						// The text you want to filter goes here. 
						$text = $movie['poster'];
						// Check if there is a url in the text
						if(preg_match($reg_exUrl, $text, $url)) {
							$poster = $url[0];
						} else {
							$poster = 'images/movie_poster/'.$movie['poster'];
						} ?>
						<li><a href="single.php?movie_id=<?php echo $movie['movie_id']; ?>"><img src="<?php echo $poster; ?>" class="img-responsive" style="width:269px; height:300px;"/><div class="grid-flex"><?php echo $movie['movie_title']; ?></a><p><?php echo $movie['release_date']; ?> | <?php echo '('.$movie['year'].')'; ?></p></div></li>
                        <?php } ?>
				    </ul>
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
				   <script type="text/javascript" src="js/jquery.flexisel.js"></script>		  
              </div>
      <?php } else if(!isset($_GET['year']) && !isset($_GET['genre_id'])) { ?>
      	<div class="content">
	   	   <h2 class="m_3">All Movies list</h1>
      	       <div class="movie_top">
      	         <div class="col-md-9 movie_box">
                        <?php 
								$sql1 = "SELECT * FROM movie_table WHERE status='Active' ORDER BY movie_id DESC LIMIT {$per_page} OFFSET {$pagination->offset()}";
								$sql_result = $database->query($sql1);
								while($movie_info = $database->fetch_array($sql_result)) {
									$movie_id = $movie_info['movie_id']; 
									// The Regular Express filter
									$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-z]{2,3}(\/\S*)?/";
									// The text you want to filter goes here. 
									$text = $movie_info['poster'];
									// Check if there is a url in the text
									if(preg_match($reg_exUrl, $text, $url)) {
										$poster = $url[0];
									} else {
										$poster = 'images/movie_poster/'.$movie_info['poster'];
									} 
								?>
									
                                <!-- Movie variant with time -->
                                <div class="movie movie-test movie-test-dark movie-test-left">
                                    <div class="movie__images">
                                        <a href="single.php?movie_id=<?php echo $movie_id; ?>" class="movie-beta__link">
                                            <img alt="" src="<?php echo $poster; ?>" class="img-responsive" alt="<?php echo $movie_info['movie_title']; ?>" width="250" height="240" style="width:250px; height:240px;"/>
                                        </a>
                                    </div>
                                    <div class="movie__info">
                                        <a href="single.php?movie_id=<?php echo $movie_id; ?>" class="movie__title">
										<?php echo $movie_info['movie_title']; ?> 
                                  <?php if(!empty($movie_info['year'])) { echo '('.$movie_info['year'].')'; } ?>  </a>
                                        <p class="movie__time"><?php echo $movie_info['duration']; ?></p>
                                        <p class="movie__option">
                                        <?php $sql1 = "SELECT genre.genre_id, genre.genre 
											FROM `movie_genre_table`
											LEFT JOIN genre ON
											genre.genre_id=movie_genre_table.genre_id
											WHERE movie_genre_table.movie_id=$movie_id";
									$sql1_result = $database->query($sql1);
									while($genre = $database->fetch_array($sql1_result)) { ?>
									<a href="movie.php?genre_id=<?php echo $genre['genre_id']; ?>">
									<?php echo $genre['genre'];  ?></a> |  
									<?php } ?></p>
                                        <ul class="list_6">
                                        	<li><p><?php echo $movie_info['country']; ?></p></li>
						    				<li><i class="icon3"> </i><p><?php echo $release_date = $movie_info['release_date']; ?></p></li>
                                            <li>Rating : &nbsp;&nbsp;<p class="btn btn-danger btn-sm btn-circle"><?php echo $movie_info['rating']; ?></p></li>
                                            <div class="clearfix"> </div>
                                        </ul>
                                     </div>
                                    <div class="clearfix"> </div>
                                </div>
                             <!-- Movie variant with time -->
                                
								<?php	
									$release_date = $movie_info['release_date'];
									$directors = $movie_info['director'];
									$movie_description = $movie_info['movie_desc'];
									$trailer = $movie_info['trailer'];
								}
							
						?>
                          
                          <div class="row">
            	<div class="col-md-12">
                	<?php
						if($pagination->total_pages() > 1) {
								
                    	//echo '<div class="row">';
                		echo '<div class="col-sm-6">';
                        	echo '<ul class="pagination">';
							// To show the Previous Page button if it exists
							if($pagination->has_previous_page()) {
								echo " <li><a href=\"movie.php?page=";
								echo $pagination->previous_page();
								echo "\">&laquo; Previous</a></li> ";
							} else {
								echo "<li class=\"active\"><a href=\"\">Previous</a></li> ";
							}
							
							for($i=1; $i <= $pagination->total_pages(); $i++) {
								if($i == $page) {
									echo "<li class=\"active\"><a href=\"\">{$i}</a></li>";
								} else {
									echo " <li><a href=\"movie.php?page={$i}\">{$i}</a></li> ";
								}
							}
							
							// To show the Next Page button if it exists
							if($pagination->has_next_page()) {
								echo " <li><a href=\"movie.php?page=";
								echo $pagination->next_page();
								echo "\">Next &raquo;</a></li> ";	
							} else {
								echo "<li class=\"active\"><a href=\"\">Next</a></li> ";
							}
                        	echo '</ul>';
                    	echo '</div>';
                    	//echo '</div>';
					}
					?>
                </div>
            </div>
                              <div class="clearfix"> </div>                         
                         <!-- Movie variant with time -->
                      </div>
                           
                      <div class="col-md-3">
                      	
                        <h2> By Genre </h2>
                        <?php $query = "SELECT * FROM genre";
							$query_result = $database->query($query);
							while($genre = $database->fetch_array($query_result)) { ?>
                        	<p style="padding-left: 20px; padding-bottom: 10px;"> <strong> -> </strong> <a href="movie.php?genre_id=<?php echo $genre['genre_id']; ?>"> 
								<?php echo $genre['genre']; ?> </a> </p>
                        <?php } ?>
                        <br /> <br />
                        <h2> By Year </h2>
                        <?php $query = "SELECT * FROM year ORDER BY year DESC";
							$query_result = $database->query($query);
							while($year = $database->fetch_array($query_result)) { ?>
                        	<p style="padding-left: 20px; padding-bottom: 10px;"> <strong> -> </strong> <a href="movie.php?year=<?php echo $year['year']; ?>"> 
								<?php echo $year['year']; ?> </a> </p>
                        <?php } ?>
                        
						   
		               </div>                       <div class="clearfix"> </div>
                  </div>
                  <h1 class="recent">Latest Uploaded Movies</h3>
                   <ul id="flexiselDemo3">
                   		<?php $sql = "SELECT * FROM movie_table WHERE status='Active' ORDER BY movie_id DESC LIMIT 10";
						//$sql = "SELECT * FROM movie_table ORDER BY movie_id DESC LIMIT 12";
						$result = $database->query($sql);
						while($movie = $database->fetch_array($result)) { 
						// The Regular Express filter
						$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-z]{2,3}(\/\S*)?/";
						// The text you want to filter goes here. 
						$text = $movie['poster'];
						// Check if there is a url in the text
						if(preg_match($reg_exUrl, $text, $url)) {
							$poster = $url[0];
						} else {
							$poster = 'images/movie_poster/'.$movie['poster'];
						} ?>
						<li><a href="single.php?movie_id=<?php echo $movie['movie_id']; ?>"><img src="<?php echo $poster; ?>" class="img-responsive" style="width:269px; height:300px;"/><div class="grid-flex"><?php echo $movie['movie_title']; ?></a><p><?php echo $movie['release_date']; ?> | <?php echo '('.$movie['year'].')'; ?></p></div></li>
                        <?php } ?>
				    </ul>
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
				   <script type="text/javascript" src="js/jquery.flexisel.js"></script>		  
              </div>
      <?php } else { ?>
      		<div class="content">
	   	   <h2 class="m_3">Sorry we couldn't find any movie for this year or genre.</h1>
      	       <div class="movie_top">
      	         <div class="col-md-9 movie_box">
                  
									
                         <div class="clearfix"> </div>                         
                         <!-- Movie variant with time -->
                      </div>
                           
                      <div class="col-md-3">
                      	
                        <h2> By Genre </h2>
                        <?php $query = "SELECT * FROM genre";
							$query_result = $database->query($query);
							while($genre = $database->fetch_array($query_result)) { ?>
                        	<p style="padding-left: 20px; padding-bottom: 10px;"> <strong> -> </strong> <a href="movie.php?genre_id=<?php echo $genre['genre_id']; ?>"> 
								<?php echo $genre['genre']; ?> </a> </p>
                        <?php } ?>
                        <br /> <br />
                        <h2> By Year </h2>
                        <?php $query = "SELECT * FROM year ORDER BY year DESC";
							$query_result = $database->query($query);
							while($year = $database->fetch_array($query_result)) { ?>
                        	<p style="padding-left: 20px; padding-bottom: 10px;"> <strong> -> </strong> <a href="movie.php?year=<?php echo $year['year']; ?>"> 
								<?php echo $year['year']; ?> </a> </p>
                        <?php } ?>
                        
						   
		               </div>                       <div class="clearfix"> </div>
                  </div>
                  <h1 class="recent">Latest Uploaded Movies</h3>
                   <ul id="flexiselDemo3">
                   		<?php $sql = "SELECT * FROM movie_table WHERE status='Active' ORDER BY movie_id DESC LIMIT 10";
						//$sql = "SELECT * FROM movie_table ORDER BY movie_id DESC LIMIT 12";
						$result = $database->query($sql);
						while($movie = $database->fetch_array($result)) { 
						// The Regular Express filter
						$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-z]{2,3}(\/\S*)?/";
						// The text you want to filter goes here. 
						$text = $movie['poster'];
						// Check if there is a url in the text
						if(preg_match($reg_exUrl, $text, $url)) {
							$poster = $url[0];
						} else {
							$poster = 'images/movie_poster/'.$movie['poster'];
						} ?>
						<li><a href="single.php?movie_id=<?php echo $movie['movie_id']; ?>"><img src="<?php echo $poster; ?>" class="img-responsive" style="width:269px; height:300px;"/><div class="grid-flex"><?php echo $movie['movie_title']; ?></a><p><?php echo $movie['release_date']; ?> | <?php echo '('.$movie['year'].')'; ?></p></div></li>
                        <?php } ?>
				    </ul>
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
				   <script type="text/javascript" src="js/jquery.flexisel.js"></script>		  
              </div>
      <?php } ?>
</div>
</div>
<?php include 'includes/footer.inc.php'; ?>