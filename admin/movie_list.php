<?php include 'includes/header.inc.php'; ?>
<?php 
	// Update trailer column in movie_table
	if(isset($_POST['update_trailer'])) {
		$trailer = $_POST['trailer'];
		$movie_id = $_POST['movie_id'];
		
		$sql = "UPDATE movie_table SET trailer='$trailer' WHERE movie_id=$movie_id LIMIT 1";
		if($database->query($sql)) {
			// do nothing	
		} else {
			echo '<script> alert("Trailer updationg was unsuccessful please try again! :("); </script>';
		}
	}
	
	// Delete Movie from the database
	if(isset($_GET['movie_id'], $_GET['task']) && @$_GET['task'] == 'delete') {
		$movie_id = $_GET['movie_id'];
		$get_image = "SELECT poster FROM movie_table WHERE movie_id=$movie_id LIMIT 1";
		$get_result = $database->query($get_image);
		$poster = $database->fetch_array($get_result);
		// The Regular Express filter
		$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-z]{2,3}(\/\S*)?/";
		// The text you want to filter goes here. 
		$text = $poster['poster'];
		// Check if there is a url in the text
		if(preg_match($reg_exUrl, $text, $url)) {
			// Do nothing
		} else {
			$poster = '../images/movie_poster/'.$poster['poster'];
			@unlink($poster);
		}
		$sql = "DELETE FROM movie_table WHERE movie_id=$movie_id LIMIT 1";
			if($database->query($sql)) {
				$sql = "DELETE FROM movie_actors_table WHERE movie_id=$movie_id";
				if($database->query($sql)) {
					$sql = "DELETE FROM movie_genre_table WHERE movie_id=$movie_id";
					if($database->query($sql)) {
						$result = true;	
					} else {
						$result = false;
					}
				}
			}
	}
?>

<?php include 'includes/nav.inc.php'; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

	<?php if(isset($result)) { 
		if($result == false) { ?>
			<div class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>Oh Snap!</strong> Movie deletion was failed, please try again! :(
			</div>
		<?php } else if($result == true) { ?>
			<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>Well done!</strong> Movie deletion was successful! :)
			</div>
	<?php } 
	} ?>
			
	<!-- Content Header (Page header) -->
	<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Movies List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">

		  	<?php include 'includes/breadcrumbs.php'; ?>

          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">

            <div class="card card-primary card-outline">
              <div class="card-body">

				<table class="table table-hovered" id="movies_list">
					<thead>
					<tr>
						<th>#</th>
						<th>Movie Title</th>
						<th>Country</th>
						<th>Year</th>
						<th>Release Date</th>
						<th>Genre</th>
						<th>Trailer</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
					</thead>
					<tbody>
					<?php $no = 1;
						$sql = "SELECT * FROM movie_table ORDER BY movie_id DESC";
						$res = $database->query($sql);
						while($movie = $database->fetch_array($res)) { ?>
					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo $movie['movie_title']; ?></td>
						<td data-value="1"><?php /*if(isset($movie['country'])) { 
								$country_result = $database->query("SELECT country FROM country WHERE country_id=".$movie['country']." LIMIT 1");
								$country = $database->fetch_array($country_result);
								echo $country['country'];	
						}*/ echo $movie['country'] ?></td>
						<td data-value="2"><?php /*if(isset($movie['year'])) { 
							$year_result = $database->query("SELECT year FROM year WHERE year_id=".$movie['year']." LIMIT 1");
							$year = $database->fetch_array($year_result);
							echo $year['year'];
						}*/ echo $movie['year']; ?></td>
						<td><?php echo $movie['release_date']; ?></td>
						<td>
							<form class="form-horizontal" action="add_genre.php" method="post">
								<div class="row">
									<div class="col-8">
										<div class="input-group">
											<select name="genre" id="genre" class="form-control">
												<option value="" disabled selected> -- Select Genre -- </option>
												<?php $genre_result = $database->query("SELECT * FROM genre ORDER BY genre ASC");
												while($genre = $database->fetch_array($genre_result)) { ?>
												<option value="<?php echo $genre['genre_id']; ?>" 
													<?php // TODO: make the genre disabled when it is available in the Database for the selected movie ?>> 
													<?php echo $genre['genre']; ?> </option>
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="col-4">
										<div class="input-group">
											<input type="hidden" name="movie_id" id="movie_id" value="<?php echo $movie['movie_id']; ?>" />
											<input type="submit" name="submit_genre" id="submit_genre" value="Submit" class="btn btn-sm btn-success" />
										</div>
									</div>
								</div>
							</form> 
							<span class="text-info" style="font-size: 0.8rem;">
								<?php $sql = "SELECT genre_id FROM movie_genre_table WHERE movie_id=".$movie['movie_id'];
									$result = $database->query($sql);
									while($genre = $database->fetch_array($result)) {
										$genre_id = $genre['genre_id'];
										$sql1 = "SELECT genre FROM genre WHERE genre_id=$genre_id";
										$sql1_result = $database->query($sql1);
										while($genre1 = $database->fetch_array($sql1_result)) {
											echo $genre1['genre'] . " - ";	
										}
									}
								?>
							</span>
						</td>
						<td><form class="form-horizontal" action="movie_list.php" method="post" id="form_trailer">
							<div class="row">
								<div class="col-8">
									<div class="form-group mb-0">
									<input type="text" required name="trailer" id="trailer" placeholder="Trailer URL" class="form-control1">
									</div>
								</div>
								<div class="col-4">
									<input type="hidden" name="movie_id" id="movie_id" value="<?php echo $movie['movie_id']; ?>">
									<input type="submit" name="update_trailer" id="update_trailer" value="UPDATE" class="btn btn-sm btn-primary" />
								</div>
							</div>
						</form>
						<?php echo (empty($movie['trailer'])) ? '<span class="text-danger" style="font-size: 0.8rem;">Trailer Not Available</span>' : '<span class="text-success">Trailer Available</span>'; ?>
						</td>
						<td><?php echo $movie['status']; ?></td>
						<td data-value="1">
						<button id="<?php echo $movie['movie_id']; ?>" onClick="conf(this.id)" data-toggle="tooltip" title="Delete this item" data-placement="top" class="btn status-metro status-suspended">
						<i class="fa fa-trash-o"></i> Delete
						</button></td>
					</tr>
					<?php } ?>
					</tbody>
				</table>  

              </div>
            </div><!-- /.card -->
          </div>
          <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
        
<?php include 'includes/footer.inc.php'; ?>
