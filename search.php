<?php include 'includes/header.inc.php'; ?>

      <div class="content">
      	<div class="box_1">
      	 
        	<div class="row">
				<div class="col-md-12">
					<form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" name="search_form" id="search_form" method="get">
						<div class="row">
							<div class="col-md-9">
								<input type="text" class="form-control" name="search_query" id="search_query" placeholder="Search Movie" />
							</div>
							<div class="col-md-3">
								<input type="submit" name="submit" id="submit" value="Search" class="btn btn-success" />
							</div>
						</div>
                    <br />
                </form>
                </div>
            </div>
			<div class="clearfix"> </div>
		</div>
		<hr />
        <?php if(isset($_GET['search_query'])) { ?>
        <div class="box_2">
        		<?php
					$searchQuery = $_GET['search_query'];
					$query = "SELECT COUNT(*) AS total FROM `movie_table` WHERE status='Active' AND movie_title LIKE '%$searchQuery%'";
					$query_result = $database->query($query);
					$total = $database->fetch_array($query_result);
					$total = $total['total'];
				?>
				<h1 style="text-align:center; font-size: 26px;">
				<?php if(!empty($total)) { 
						if($total > 1) { 
							echo $total . ' Movies Found'; 
						} else { 
							echo $total . ' Movie Found'; 
						} 
					} else { 
						echo '0'; 
				} ?></h1>
			
			<div class="row">  
				<div class="col-md-12 movie_box">
					Pagination Setting:<br> 
					<select name="pagination-setting" onChange="changePagination(this.value);" class="pagination-setting" id="pagination-setting">
						<option value="all-links" selected="selected">Display All Page Link</option>
						<option value="prev-next">Display Prev Next Only</option>
					</select>


					<div id="pagination-result">
						<input type="hidden" name="rowcount" id="rowcount" />
					</div> <!-- pagination-result -->  
				</div>
            </div>
			<div class="clearfix"> </div>
		</div>    
        <?php } ?>  
    </div>
   </div>
 </div>
 
<?php include 'includes/footer.inc.php'; ?>