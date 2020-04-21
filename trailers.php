<?php include 'includes/header.inc.php'; ?>

	<div class="content">
		<h2 class="m_3">All Movies Trailers</h1>
				<div class="movie_top">
					<div class="col-md-9 movie_box">

						Pagination Setting:<br> 
						<select name="pagination-setting" onChange="changePagination(this.value);" class="pagination-setting" id="pagination-setting">
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
	</div>
</div>
</div>
<?php include 'includes/footer.inc.php'; ?>