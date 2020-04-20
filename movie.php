<?php include 'includes/header.inc.php'; ?>


		<?php if(isset($_GET['genre_id'])) { ?>
	      <div class="content">
	   	   <h2 class="m_3">Movies List sorted according to Genre</h1>
      	       <div class="movie_top">
      	         	<div class="col-md-9 movie_box">
						 
					   Pagination Setting:<br> <select name="pagination-setting" onChange="changePagination(this.value);" class="pagination-setting" id="pagination-setting">
							<option value="all-links" selected="selected">Display All Page Link</option>
							<option value="prev-next">Display Prev Next Only</option>
						</select>


						<div id="pagination-result">
							<input type="hidden" name="rowcount" id="rowcount" />
						</div> <!-- pagination-result -->   
					
					   <div class="clearfix"> </div>                         
                	</div>
                 
					<div class="col-md-3">
						<?php include('includes/by_genre_year.php'); ?>
					</div>   

					<div class="clearfix"></div>
				  </div>
				  
                  <h1 class="recent">Latest Uploaded Movies</h3>
				  	<?php include('includes/latest_uploaded_movies.php'); ?>	  
              </div>
      <?php } else if(isset($_GET['year'])) { ?>
	      <div class="content">
	   	   <h2 class="m_3">Movies List sorted according to Year</h1>
      	       <div class="movie_top">
      	         	<div class="col-md-9 movie_box">
					
					   Pagination Setting:<br> <select name="pagination-setting" onChange="changePagination(this.value);" class="pagination-setting" id="pagination-setting">
							<option value="all-links" selected="selected">Display All Page Link</option>
							<option value="prev-next">Display Prev Next Only</option>
						</select>


						<div id="pagination-result">
							<input type="hidden" name="rowcount" id="rowcount" />
						</div> <!-- pagination-result -->   

					<div class="clearfix"> </div>  
					</div>
			
					<div class="col-md-3">
						<?php include('includes/by_genre_year.php'); ?>
					</div>                         
					<div class="clearfix"> </div>
                  </div>
				  <h1 class="recent">Latest Uploaded Movies</h3>
				  <?php include('includes/latest_uploaded_movies.php'); ?>
  
              </div>
      <?php } else if(!isset($_GET['year']) && !isset($_GET['genre_id'])) { ?>
      	<div class="content">
	   	   <h2 class="m_3">All Movies list</h1>
      	       <div class="movie_top">
      	         <div class="col-md-9 movie_box">

					   Pagination Setting:<br> <select name="pagination-setting" onChange="changePagination(this.value);" class="pagination-setting" id="pagination-setting">
							<option value="all-links" selected="selected">Display All Page Link</option>
							<option value="prev-next">Display Prev Next Only</option>
						</select>


						<div id="pagination-result">
							<input type="hidden" name="rowcount" id="rowcount" />
						</div> <!-- pagination-result -->   
					<div class="clearfix"> </div>
                </div>
                           
					<div class="col-md-3">
						<?php include('includes/by_genre_year.php'); ?>
					</div>                        
					
					<div class="clearfix"> </div>
                  </div>
                  <h1 class="recent">Latest Uploaded Movies</h3>
				  	<?php include('includes/latest_uploaded_movies.php'); ?>	  
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
						<?php include('includes/by_genre_year.php'); ?>
					</div>                        
					
					<div class="clearfix"> </div>
                  </div>
                  <h1 class="recent">Latest Uploaded Movies</h3>
				  	<?php include('includes/latest_uploaded_movies.php'); ?>  
              </div>
      <?php } ?>
</div>
</div>
<?php include 'includes/footer.inc.php'; ?>