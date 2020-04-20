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

      	<div class="content">
	   	   <h2 class="m_3">All Movies Trailers</h1>
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
										$poster = 'assets/images/movie_poster/'.$movie_info['poster'];
									} 
								?>
									
                                <!-- Movie variant with time -->
                                <div class="col-md-3" style="margin-bottom: 20px;"><a class="popup-youtube" href="<?php echo $movie_info['trailer']; ?>">
                                <div class="grid_2">
                                <img src="<?php echo $poster; ?>" width="250" height="229" style="width:250px; height:229px;" class="img-responsive" alt="<?php echo $movie['movie_title']; ?>"/>
                               </div></a>
                            </div>
                             <!-- Movie variant with time -->
                                
								<?php	
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
              </div>
</div>
</div>
<?php include 'includes/footer.inc.php'; ?>