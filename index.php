<?php include 'includes/header.inc.php'; ?>
<?php
	// 1. the current page number ($current_page)
	$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
	
	// 2. records per page ($per_page)
	$per_page = 50;
	
	// 3. total record count ($total_count)
	$sql = "SELECT COUNT(*) AS total FROM movie_table";
	$tot_count = $database->query($sql);
	$total = $database->fetch_array($tot_count);
	$total_count = $total['total'];
	
	@$pagination = new Pagination($page, $per_page, $total_count);
	
?>

	      <div class="slider">
	   <div class="callbacks_container">
	      <ul class="rslides" id="slider">
	        <li><img src="assets/images/banner.jpg" class="img-responsive" alt=""/>
			</li>
	        <li><img src="assets/images/banner1.jpg" class="img-responsive" alt=""/>
			</li>
	        <li><img src="assets/images/banner2.jpg" class="img-responsive" alt=""/>
			</li>
	      </ul>
	    </div>
	    <div class="banner_desc">
			    	<div class="col-md-9">
			    		<ul class="list_1">
			    			<li>Movies <span class="m_1"> &nbsp;&nbsp;&nbsp; <?php 
								$query = "SELECT COUNT(*) AS total_movies FROM movie_table";
								$query_result = $database->query($query);
								$movies_total = $database->fetch_array($query_result);
								if($database->num_rows($query_result) > 0) { echo $movies_total['total_movies']; } else {
									echo ' 0 '; }
							?></span></li>
			    			<li>TV Series <span class="m_1">&nbsp;&nbsp;&nbsp; <?php 
								/*$query = "SELECT COUNT(*) AS total_tv FROM tv_table";
								$query_result = $database->query($query);
								$movies_total = $database->fetch_array($query_result);
								if($database->num_rows($query_result) > 0) { echo $movies_total['total_tv']; } else {
									echo ' 0 '; }*/
							?> </span></li>
			    			<li>Actors <span class="m_1">&nbsp;&nbsp;&nbsp; <?php 
								$query = "SELECT COUNT(*) AS total_actors FROM actors_table";
								$query_result = $database->query($query);
								$movies_total = $database->fetch_array($query_result);
								if($database->num_rows($query_result) > 0) { echo $movies_total['total_actors']; } else {
									echo ' 0 '; }
							?></span></li>
			    		</ul>
			    	</div>
			    	<div class="col-md-3 grid_1">
			    		<ul class="list_1 list_2">
			    			
			    			<li style="width:200px;"><i class="icon3"> </i><p><?php echo date('d M Y', time()); ?></p></li>
			    		</ul>
			    	</div>
			    </div>
      </div>
      <div class="content">
      	<div class="box_1">
      	 <h1 class="m_2">Featured Movies</h1>
      	 <!-- Search Box Area -->
         <div class="search">
		    <form>
				<input type="text" name="searchQuery" id="searchQuery" placeholder="Search Movie..." autocomplete="off" />
		    </form>
		</div> <!-- End Search Box Area -->
        <div class="row">
        	<div class="col-md-12" style="margin-top:-20px;">
        		<!-- Search Result Section -->
                <div id="update">
                    <ul class="searchresults">
                    
                    </ul>
                </div>
                <!-- End Search Result -->    	
            </div>
        </div>
        
		<div class="clearfix"> </div>
		</div>
		
        <div class="box_2">

            	<div class="row">
					<div class="col-md-12">
						Pagination Setting:<br> <select name="pagination-setting" onChange="changePagination(this.value);" class="pagination-setting" id="pagination-setting">
							<option value="all-links" selected="selected">Display All Page Link</option>
							<option value="prev-next">Display Prev Next Only</option>
						</select>
					</div>


					<div id="pagination-result">
						<input type="hidden" name="rowcount" id="rowcount" />
					</div>
            </div>
			<div class="clearfix"> </div>
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
					$poster = 'assets/images/movie_poster/'.$movie['poster'];
				} ?>
				<li><a href="single.php?movie_id=<?php echo $movie['movie_id']; ?>"><img src="<?php echo $poster; ?>" class="img-responsive" style="width:269px; height:300px;"/><div class="grid-flex"><?php echo $movie['movie_title']; ?></a><p><?php echo $movie['release_date']; ?> | <?php echo '('.$movie['year'].')'; ?></p></div></li>
				<?php } ?>
			</ul>
			
      </div>
   </div>
 </div>
 
<?php include 'includes/footer.inc.php'; ?>