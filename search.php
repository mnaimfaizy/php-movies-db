<?php include 'includes/header.inc.php'; ?>
<?php
	// 1. the current page number ($current_page)
	$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
	
	// 2. records per page ($per_page)
	$per_page = 12;
	
	// 3. total record count ($total_count)
	$sql = "SELECT COUNT(*) AS total FROM movie_table";
	$tot_count = $database->query($sql);
	$total = $database->fetch_array($tot_count);
	$total_count = $total['total'];
	
	@$pagination = new Pagination($page, $per_page, $total_count);
	
?>
      <div class="content">
      	<div class="box_1">
      	 
        	<div class="row">
            	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" name="search_form" id="search_form" method="get">
                <div class="col-md-12">
                	<div class="row">
                	<div class="col-md-9">
                    	<input type="text" class="form-control" name="search_query" id="search_query" placeholder="Search Movie" />
                    </div>
                    <div class="col-md-3">
                    	<input type="submit" name="submit" id="submit" value="Search" class="btn btn-success" />
                    </div>
                    </div>
                    <br />
                    <!--<div class="row">
                    	<div class="col-md-3">
                        	<label for="genre"> Genrer </label>
                        	<select name="genre" id="genre" class="form-control">
                            	<option value="all" disabled selected> All </option>
                                <?php $sql = "SELECT * FROM genre ORDER BY genre ASC";
									$genre_result = $database->query($sql);
									while($genre = $database->fetch_array($genre_result)) { ?>
                                	<option value="<?php echo $genre['genre_id']; ?>"> 
										<?php echo $genre['genre']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                        	<label for="year"> Year </label>
                        	<select name="year" id="year" class="form-control">
                            	<option value="all" disabled selected> All </option>
                                <?php $sql = "SELECT * FROM year ORDER BY year DESC";
									$year_result = $database->query($sql);
									while($year = $database->fetch_array($year_result)) { ?>
                                <option value="<?php echo $year['year']; ?>"> <?php echo $year['year']; ?> </option>
								<?php } ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                        	<label for="rating"> Rating </label>
                        	<select name="rating" id="rating" class="form-control">
                            	<option value="all" disabled selected> All </option>
                                <option value="9"> 9+ </option>
                                <option value="8"> 8+ </option>
                                <option value="7"> 7+ </option>
                                <option value="6"> 6+ </option>
                                <option value="5"> 5+ </option>
                                <option value="4"> 4+ </option>
                                <option value="3"> 3+ </option>
                                <option value="2"> 2+ </option>
                                <option value="1"> 1+ </option>
                            </select>
                        </div>
                        <div class="col-md-3"></div>
                    </div>-->
                </div>
                </form>
            </div>
		<div class="clearfix"> </div>
		</div>
		<hr />
        <?php if(isset($_GET['search_query']) || isset($_GET['genre']) 
	   			|| isset($_GET['year']) || isset($_GET['rating'])) { ?>
        <div class="box_2">
        	<?php
					$searchQuery = $_GET['search_query'];
					$query = "SELECT COUNT(*) AS total FROM `movie_table` WHERE status='Active' AND movie_title LIKE '%$searchQuery%'";
					$query_result = $database->query($query);
					$total = $database->fetch_array($query_result);
					$total = $total['total'];
					
					?>
        		<h1 style="text-align:center; font-size: 26px;"><?php if(!empty($total)) { 
					if($total > 1) { echo $total . ' Movies Found'; } else { echo $total . ' Movie Found'; } 
				} else { echo '0'; } ?></h1>
            	<div class="row">
                	
                	<?php 
						$sql = "SELECT * FROM movie_table WHERE status='Active' AND movie_title LIKE '%$searchQuery%' LIMIT {$per_page} OFFSET {$pagination->offset()}";
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
                    <div class="col-md-3" style="margin-bottom: 20px;"><a href="single.php?movie_id=<?php echo $movie['movie_id']; ?>" data-toggle="tooltip" data-placement="top" title="<?php echo $movie['movie_title']; ?>">
                    	<div class="grid_2">
                        <img src="<?php echo $poster; ?>" width="250" height="229" style="width:250px; height:229px;" class="img-responsive" alt="<?php echo $movie['movie_title']; ?>"/>
                        <div class="caption1">
                            <ul class="list_3">
                                <li><i class="icon5"> </i><p><?php echo $movie['rating']; ?></p></li>
                            </ul>
                            <i class="icon4"> </i>
                            <p class="m_3"><?php echo $movie['movie_title']; ?></p>
                        </div>
                       </div></a>
                    </div>
                <?php } ?>
                
                
            </div>
			<div class="row">
            	<div class="col-md-12">
                	<?php
						if($pagination->total_pages() > 1) {
								
                    	//echo '<div class="row">';
                		echo '<div class="col-sm-6">';
                        	echo '<ul class="pagination">';
							// To show the Previous Page button if it exists
							if($pagination->has_previous_page()) {
								echo " <li><a href=\"index.php?page=";
								echo $pagination->previous_page();
								echo "\">&laquo; Previous</a></li> ";
							} else {
								echo "<li class=\"active\"><a href=\"\">Previous</a></li> ";
							}
							
							for($i=1; $i <= $pagination->total_pages(); $i++) {
								if($i == $page) {
									echo "<li class=\"active\"><a href=\"\">{$i}</a></li>";
								} else {
									echo " <li><a href=\"index.php?page={$i}\">{$i}</a></li> ";
								}
							}
							
							// To show the Next Page button if it exists
							if($pagination->has_next_page()) {
								echo " <li><a href=\"index.php?page=";
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
		</div>    
        <?php } ?>  
      </div>
   </div>
 </div>
 
<?php include 'includes/footer.inc.php'; ?>