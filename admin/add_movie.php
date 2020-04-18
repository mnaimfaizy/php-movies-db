<?php include 'includes/header.inc.php'; ?>
<?php error_reporting(E_ALL & ~E_WARNING); 
	// Insert user data to the database
	if(isset($_POST['submit'])) {
		$movie_title = $database->escape_value($_POST['movie_title']);
		$duration = $database->escape_value($_POST['duration']);
		$country = $database->escape_value($_POST['country']);	
		$year = $database->escape_value($_POST['year']);
		$release_date = $database->escape_value($_POST['release_date']);
		$director = $database->escape_value($_POST['director']);
		$rating = $database->escape_value($_POST['rating']);
		$movie_description = $database->escape_value($_POST['movie_description']);
		$trailer = $database->escape_value($_POST['trailer']);
		$status = $database->escape_value($_POST['status']);
		$imdb_link = $database->escape_value($_POST['imdb_link']);
		$date_added = time();
		
		// Upload image and save to image table in the database	
		
		if(isset($_FILES['poster'])) {
			$file = $_FILES['poster'];
			$temp_path		= $file['tmp_name'];
			$filename		= basename($file['name']);
			$type			= $file['type'];
			$size			= $file['size'];
			
			// Determine the target Path
			$target_path = '../images/movie_poster/'.$filename;
			if(file_exists($target_path)) {
				echo "<script> alert('The file {$filename} already exists.'); </script>";
			}
			
			// Attempt to move the file
			if(move_uploaded_file($temp_path, $target_path)) {
				// Success	
				// Save a corresponding entry to the database
				$sql = "INSERT INTO `movie_table`(`movie_title`, `duration`, `country`, `year`, `release_date`, `director`, `rating`, `movie_desc`, `trailer`, `imdb_link`, `status`, `poster`, `date_added`) 
		VALUES ('$movie_title', '$duration','$country','$year','$release_date','$director','$rating','$movie_description','$trailer', '$imdb_link', '$status', '$filename', $date_added)";
		
				if($database->query($sql)) {
					$result = true;	
				} else {
					$result = false;	
				}
				
			} else {
				// File was not moved
				// echo "The file upload failed, possibly due to incorrect permissions on the upload folder.";
			}
		} else {
				$result = false;
		}
		
		
	}
	
	if(isset($_POST['add_api_movie'])) {
		$imdb_id = $_POST['imdb_id'];
		//$imdb_id = 'tt0460946';
		$url = "http://www.omdbapi.com/?i=$imdb_id&plot=full&r=xml";
		
		$result = xml2array($url);
		$date_added = time();
		$status = 'Active';
		foreach($result as $result1) {
			foreach($result1 as $result2) {
				if(isset($result2['title'])) {
					$title = $database->escape_value($result2['title']);
					$year = $result2['year'];
					$released = $result2['released'];
					$runtime = $result2['runtime'];
					
					$director = $result2['director'];
					$actors = $result2['actors'];
					$description = $database->escape_value($result2['plot']);
					$language = $result2['language'];
					$country = $result2['country'];
					
					$rating = $result2['imdbRating'];
					$imdbVotes = $result2['imdbVotes'];
					$imdbID = $result2['imdbID'];
					$type = $result2['type'];
					
					// Check for duplicate entry 
					$dupSql = "SELECT COUNT(*) AS total FROM movie_table WHERE (
						movie_title='$title' 
						AND duration='$runtime' 
						AND country='$country' 
						AND year='$year' 
						AND release_date='$released'  
						AND director='$director' 
						AND rating='$rating' 
						AND imdb_link='$imdbID'
						)";
					$dupRaw = $database->query($dupSql);
					$dupRaw = $database->fetch_array($dupRaw);
					if($dupRaw['total'] > 0) {
						echo '<script type="text/javascript"> alert("$title already exists in database"); </script>';
					} else {
						if(!empty($result2['poster'])) {
						$img = "../images/movie_poster/".$result2['imdbID'].".jpg";
						
						$image = file_get_contents($result2['poster']);
						$poster = $database->escape_value(trim($result2['imdbID'])).'.jpg';
						$handle = fopen($poster, 'w') or die('Cannot open file: '.$poster); // implicitly creates file
						
						file_put_contents($img, $image); // Where to save the image on your server
						fclose($handle);
						} else {
							$poster = null;
						}
					$sql = "INSERT INTO `movie_table`(`movie_title`, `duration`, `country`, `year`, `release_date`, `director`, `rating`, `movie_desc`, `imdb_link`, `status`, `poster`, `date_added`) 
		VALUES ('$title', '$runtime','$country','$year','$released','$director','$rating','$description', '$imdbID', '$status', '$poster', $date_added)";
					
					if($database->query($sql)) {
						// Add actor to movie_actor_table along with his/her movie
						$movie_id = $database->insert_id();
						$actors = $database->escape_value($result2['actors']);
						$actor = explode(", ", $actors);
						$count = count($actor);
						for($i = 0; $count > $i; $i++) {
							
							$actor_name = $actor[$i];
							$sql = "SELECT actor_name FROM actors_table WHERE actor_name='$actor_name'";
							$result = $database->query($sql);
							if($database->num_rows($result) > 0) {
								//echo "The name exists";
							} else {
								$date_added = time();
								$query = "INSERT INTO actors_table(actor_name, date_added) 
										VALUES('$actor_name', $date_added)";
								$database->query($query);
							}
							
							$actor_result = $database->query("SELECT actor_id FROM actors_table WHERE actor_name='$actor_name' LIMIT 1");
							$actor_id = $database->fetch_array($actor_result);
							if($actor_id['actor_id']) {
								$actor_id = $actor_id['actor_id'];
								$insert_query = "INSERT INTO movie_actors_table(movie_id, actor_id) VALUES($movie_id, $actor_id)";
								if($database->query($insert_query)) {
									$result = true;	
								}
							}
						}
						$result = true;
						
						// Add Genre to movie_genre_table along with its movie
						$genre = $result2['genre'];
						$genre = explode(", ", $genre);
						$count = count($genre);
						for($i = 0; $count > $i; $i++) {
							
							$genre_name = $genre[$i];
							$sql = "SELECT * FROM genre WHERE genre='$genre_name'";
							$result = $database->query($sql);
							if($database->num_rows($result) > 0) {
								//echo "The name exists";
							} else {
								$query = "INSERT INTO genre(genre) 
										VALUES('$genre_name')";
								$database->query($query);
							}
							$sql = "SELECT genre_id FROM genre WHERE genre='$genre_name' LIMIT 1";
							$genre_result = $database->query($sql);
							$genre_id = $database->fetch_array($genre_result);
							if($genre_id['genre_id']) {
								$genre_id = $genre_id['genre_id'];
								$insert_query = "INSERT INTO movie_genre_table(movie_id, genre_id) VALUES($movie_id, $genre_id)";
								if($database->query($insert_query)) {
									$result = true;	
								}
							}
						}
						$result = true;	
					} else {
						$result = false;	
					} // End of IF-ELSE for checking movie is inserted or not
				} // End of IF-ELSE for checking Duplicate entries
				}
			}
		}	
	}
?>
<?php include 'includes/nav.inc.php'; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Add New Movie</h1>
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

			<?php if(isset($result)) { 
				if($result == false) { ?>
					<div class="alert alert-danger">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>Oh Snap!</strong> Movie insertion was failed, please try again! :(
					</div>
			<?php } else if($result == true) { ?>
					<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>Well done!</strong> Movie inserted successfully! :)
					</div>
			<?php }
				} ?>

				<div class="card card-primary card-tabs">
					<div class="card-header p-0 pt-1">
						<ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#api" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Using API</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#manual" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Add Manualy</a>
						</li>
						</ul>
					</div> <!-- /.card-header -->

					<div class="card-body">
						<div class="tab-content" id="custom-tabs-one-tabContent">
							<div class="tab-pane fade show active" id="api" role="tabpanel" aria-labelledby="api-tab">
								<h3>Add Movie Using API</h3>

								<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="add_movie_api">

									<div class="row">
										<div class="col-8">
											<div class="input-group mb-3">
												<div class="input-group-prepend">
													<span class="input-group-text"><i class="fa fa-film"></i></span>
												</div>
												<input type="text" class="form-control" placeholder="Movie Title" name="movie_title" id="movie_title" autofocus />
											</div>
										</div> <!-- /.col-8 -->
										<div class="col-4">
											<input type="submit" name="api_movie" id="api_movie" class="btn btn-success" value="Search for Movie" />
										</div> <!-- /.col-4 -->
									</div> <!-- /.row -->

								</form>

								<?php if(isset($_POST['api_movie'])) { 
										$title = urlencode($_POST['movie_title']);
										$url = "http://www.omdbapi.com/?s=$title&plot=full&r=xml";
										//echo $url = "http://www.omdbapi.com/?i=$title&plot=full&r=xml"; ?>
									<div class="table-responsive">
									<table class="table">
										<thead>
											<tr>
												<th> No. </th>
												<th> Movie </th>
												<th> Year </th>
												<th> Type </th>
												<th> IMDb ID </th>
												<th> Action </th>
											</tr>
										</thead>
										<tbody>
										
									<?php
									$result = xml2array($url);
									$no = 1;
									foreach($result as $res) {
										foreach($res as $res1) {
											foreach($res1 as $res2) {
												if(isset($res2['Title'], $res2['Year'], $res2['Type'], $res2['imdbID'])) {
													$title = $database->escape_value($res2['Title']);
													$imdb_id = $res2['imdbID'];
													$sql = "SELECT COUNT(*) AS total FROM movie_table WHERE movie_title LIKE '%$title%' AND imdb_link='$imdb_id'";
													$sql_result = $database->query($sql);
													$total = $database->fetch_array($sql_result);
													if($total['total'] > 0) {
														echo '<tr style="background-color: #d6d6d6;">';
													} else {
														echo '<tr>';
													}
													echo '<td> '.$no++.' </td>';
													echo '<td> '. $res2['Title'] .' </td>';
													echo '<td> '. $res2['Year'] .' </td>';
													echo '<td> '. $res2['Type'] .' </td>';
													echo '<td> '. $res2['imdbID'] .' </td>';
													echo '<td> ';
													
													if($total['total'] > 0) {
														// Do nothing
													} else {
													echo '<form action="add_movie.php" method="post">
																<input type="hidden" name="imdb_id" id="imdb_id" value="'.$res2['imdbID'] .'" />
																<input type="submit" name="add_api_movie" id="add_api_movie" value="Save Info" class="btn btn-sm btn-success" />
															</form>
															<br />';
													}
													echo '<a href="view_details.php?imdb_id='.$res2['imdbID'].'" class="btn btn-sm btn-info" target="_blank"> View Details </a>
													</td>';
													echo '</tr>';	
												} 
											}
										}
									} ?>
									
								
									</tbody>
								</table></div>
								<?php } ?>

							</div> <!-- /#api -->

							<div class="tab-pane fade" id="manual" role="tabpanel" aria-labelledby="manual-tab">
								<h3>Add Movie Manualy</h3>

								<form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="add_movie" enctype="multipart/form-data">
									<div class="row">
										<div class="col-4">
											<div class="form-group">
												<div class="input-group mb-3">
													<div class="input-group-prepend">
														<span class="input-group-text"><i class="fa fa-film"></i></span>
													</div>
													<input type="text" class="form-control" placeholder="Movie Title" name="movie_title" id="movie_title">
												</div>
											</div>
										</div>
										<div class="col-4">
											<div class="form-group">
												<div class="input-group mb-3">
													<div class="input-group-prepend">
														<span class="input-group-text"><i class="far fa-clock"></i></span>
													</div>
													<input type="text" class="form-control" placeholder="Movie Duration" name="duration" id="duration">
												</div>
											</div>
										</div>
										<div class="col-4">
											<div class="form-group">
												<div class="input-group mb-3">
													<div class="input-group-prepend">
														<span class="input-group-text"><i class="fa fa-globe"></i></span>
													</div>
													<select name="country" id="country" class="form-control">
														<option value="" disabled selected> -- Select Country -- </option>
														<?php $sql = "SELECT * FROM Country ORDER BY country ASC";
															$result = $database->query($sql);
															while($country = $database->fetch_array($result)) { ?>
														<option value="<?php echo $country['country']; ?>"> 
															<?php echo $country['country']; ?> </option>
														<?php } ?>
													</select>
												</div>
											</div>
										</div>

										<div class="col-4">
											<div class="form-group">
												<div class="input-group mb-3">
													<div class="input-group-prepend">
														<span class="input-group-text"><i class="fa fa-calendar"></i></span>
													</div>
													<select name="year" id="year" class="form-control">
														<option value="" disabled selected> -- Select Year -- </option>
														<?php $sql = "SELECT * FROM year ORDER BY year ASC";
															$result = $database->query($sql);
															while($year = $database->fetch_array($result)) { ?>
															<option value="<?php echo $year['year']; ?>"> 
																<?php echo $year['year']; ?> </option>
														<?php } ?>	
													</select>
												</div>
											</div>
										</div>
										<div class="col-4">
											<div class="form-group">
												<div class="input-group mb-3">
													<div class="input-group-prepend">
														<span class="input-group-text"><i class="fa fa-calendar"></i></span>
													</div>
													<input type="date" class="form-control" placeholder="Release Date" id="release_date" name="release_date">
												</div>
											</div>
										</div>
										<div class="col-4">
											<div class="form-group">
												<div class="input-group mb-3">
													<div class="input-group-prepend">
														<span class="input-group-text"><i class="fa fa-users"></i></span>
													</div>
													<input type="text" name="director" id="director" class="form-control" placeholder="Director" />                                   
												</div>
											</div>
										</div>

										<div class="col-4">
											<div class="form-group">
												<div class="input-group mb-3">
													<div class="input-group-prepend">
														<span class="input-group-text"><i class="far fa-star-half"></i></span>
													</div>
													<input type="text" class="form-control" placeholder="Rating for Movie" name="rating" id="rating">                                  
												</div>
											</div>
										</div>
										<div class="col-4">
											<div class="form-group">
												<div class="input-group mb-3">
													<div class="input-group-prepend">
														<span class="input-group-text"><i class="fab fa-youtube"></i></span>
													</div>
													<input type="text" class="form-control" placeholder="Movie Trailer" name="trailer" id="trailer">                                
												</div>
											</div>
										</div>
										<div class="col-4">
											<div class="form-group">
												<div class="input-group mb-3">
													<div class="input-group-prepend">
														<span class="input-group-text"><i class="fab fa-imdb"></i></span>
													</div>
													<input type="text" class="form-control" placeholder="IMDb Link" name="imdb_link" id="imdb_link">                               
												</div>
											</div>
										</div>

										<div class="col-4">
											<div class="form-group">
												<div class="input-group mb-3">
													<div class="input-group-prepend">
														<span class="input-group-text"><i class="fa fa-check"></i></i></span>
													</div>
													<select name="status" id="status" class="form-control">
														<option value="" selected disabled> --- Select Status --- </option>
														<option value="Active" selected> Active </option>
														<option value="De-Active"> De-Active </option>
													</select>                             
												</div>
											</div>
										</div>
										<div class="col-4">
											<div class="form-group">
												<div class="input-group">
												<div class="custom-file">
													<input type="file" class="custom-file-input" name="poster" id="poster" class="form-control" /> 
													<label class="custom-file-label" for="exampleInputFile">Movie Poster</label>
												</div>
												<div class="input-group-append">
													<span class="input-group-text" id=""><i class="far fa-image"></i></span>
												</div>
												</div>
											</div>
										</div>


										<div class="col-12">
											<div class="form-group">
												<label>Movie Description</label>
												<textarea class="form-control" name="movie_description" id="movie_description" rows="10" cols="80"></textarea>
											</div>
										</div>

										<div class="col-12">
											<input type="submit" name="submit" id="submit" class="btn btn-success" value="Add Movie" />
										</div>
									</div>

									</div>
								</form>

							</div> <!-- /#manual -->
						</div> <!-- /.tab-content -->
					</div> <!-- /.card-body -->
				</div> <!-- /.card -->

			</div><!-- /.container-fluid -->
		</div>
		<!-- /.content -->

       
<?php include 'includes/footer.inc.php'; ?>
