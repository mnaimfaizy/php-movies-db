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

        <div id="page-wrapper">
        <div class="row">
        	<div class="col-md-12">
        <?php if(isset($result)) { ?>
			<?php if($result == false) { ?>
            <div class="col-md-10">
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Oh Snap!</strong> Movie insertion was failed, please try again! :(
                </div>
            </div>
            <?php } else if($result == true) { ?>
            <div class="col-md-10">
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Well done!</strong> Movie inserted successfully! :)
                </div>
            </div>
            <?php } } ?>
            </div>
            </div>
        <div class="graphs">
        
        	 <div class="xs">
  	       		<h3>Add New Movie</h3>
        		<div class="tab-content">
                <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
                    <li class="active"><a href="#api" data-toggle="tab">Using API</a></li>
                    <li><a href="#manual" data-toggle="tab">Add Manualy</a></li>
                    
                </ul>
                <div id="my-tab-content" class="tab-content">
                	<div class="tab-pane" id="manual">
                    <h1>Add Movie Manualy</h1>
                    	<div class="row">
                    	<div class="col-md-12">
                    	<form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="add_movie" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="col-md-2 control-label"> Movie Title </label>
                                <div class="col-md-8">
                                    <div class="input-group">							
                                        <span class="input-group-addon">
                                            <i class="fa fa-film"></i>
                                        </span>
                                        <input type="text" class="form-control1" placeholder="Movie Title" name="movie_title" id="movie_title">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"> Duration </label>
                                <div class="col-md-8">
                                    <div class="input-group">							
                                        <span class="input-group-addon">
                                            <i class="fa fa-clock-o"></i>
                                        </span>
                                        <input type="text" class="form-control1" placeholder="Movie Duration" name="duration" id="duration">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"> Country </label>
                                <div class="col-md-8">
                                    <div class="input-group">							
                                        <span class="input-group-addon">
                                            <i class="fa fa-globe"></i>
                                        </span>
                                        <select name="country" id="country" class="form-control1">
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
                            <div class="form-group">
                                <label class="col-md-2 control-label"> Year </label>
                                <div class="col-md-8">
                                    <div class="input-group">							
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <select name="year" id="year" class="form-control1">
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
                            <div class="form-group">
                                <label class="col-md-2 control-label"> Release Date </label>
                                <div class="col-md-8">
                                    <div class="input-group">							
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input type="date" class="form-control1" placeholder="Release Date" id="release_date" name="release_date">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"> Director/s </label>
                                <div class="col-md-8">
                                    <div class="input-group">							
                                        <span class="input-group-addon">
                                            <i class="fa fa-users"></i>
                                        </span>
                                        <input type="text" name="director" id="director" class="form-control1" placeholder="Director" />                                   
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"> Rating </label>
                                <div class="col-md-8">
                                    <div class="input-group">							
                                        <span class="input-group-addon">
                                            <i class="fa fa-star-half-o"></i>
                                        </span>
                                        <input type="text" class="form-control1" placeholder="Rating for Movie" name="rating" id="rating">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"> Movie Description </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <textarea name="movie_description" id="movie_description" rows="10" cols="80">
                                        </textarea>
                                        <script>
											// Replace the <textarea id="editor1"> with a CKEditor
											// instance, using default configuration.
											CKEDITOR.replace( 'movie_description' );
										</script>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"> Trailer </label>
                                <div class="col-md-8">
                                    <div class="input-group">							
                                        <span class="input-group-addon">
                                            <i class="fa fa-youtube"></i>
                                        </span>
                                        <input type="text" class="form-control1" placeholder="Movie Trailer" name="trailer" id="trailer">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"> IMDb Link </label>
                                <div class="col-md-8">
                                    <div class="input-group">							
                                        <span class="input-group-addon">
                                            <i class="fa fa-youtube"></i>
                                        </span>
                                        <input type="text" class="form-control1" placeholder="IMDb Link" name="imdb_link" id="imdb_link">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"> Status </label>
                                <div class="col-md-8">
                                    <div class="input-group">							
                                        <span class="input-group-addon">
                                            <i class="fa fa-check"></i>
                                        </span>
                                        <select name="status" id="status" class="form-control1">
                                        	<option value="Active" selected> Active </option>
                                            <option value="De-Active"> De-Active </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"> Movie Poster </label>
                                <div class="col-md-8">
                                    <div class="input-group">							
                                        <span class="input-group-addon">
                                            <i class="fa fa-picture-o"></i>
                                        </span>
                                        <input type="file" name="poster" id="poster" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8">
                                    <input type="submit" name="submit" id="submit" class="btn btn-success" value="Add Movie" />
                                </div>
                            </div>
                        </form>
                        </div>
                        </div>
                    </div>
                    
                    <div class="tab-pane  active" id="api">
                    <h1>Add Movie Using API</h1>
                    	<div class="row">
                    	<div class="col-md-12">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="add_movie_api">
                    	<div class="col-md-8">
                    	<div class="form-group">
                            <label class="col-md-2 control-label"> Movie Title </label>
                            <div class="col-md-8">
                                <div class="input-group">							
                                    <span class="input-group-addon">
                                        <i class="fa fa-film"></i>
                                    </span>
                                    <input type="text" class="form-control1" placeholder="Movie Title" name="movie_title" id="movie_title" autofocus>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="col-md-4">
                        <div class="form-group">
                            <div class="col-md-8">
                                <input type="submit" name="api_movie" id="api_movie" class="btn btn-success" value="Search for Movie" />
                            </div>
                        </div>
                        </div>
                    </form>
                    </div>
                    </div>
                    <br />
                    <div class="row">
                    	<div class="col-md-12">
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
                        </div>
                    </div>
                    </div>
                </div>
                    
                    </div>
                </div>
        	</div>

<script type="text/javascript">
	$(document).ready(function() {
        
		// Validate add_user form
		$("#add_movie").validate({
		
			rules: {
				movie_title: "required",
				duration: "required",
				country: "required",
				year: "required",
				release_date: "required",
				director: "required",
				rating: "required",
				movie_description: "required",
				status: "required",
				poster: "required"
				
			},
			messages: {
				movie_title: "Movie Title is required, Please enter valid movie title!",
				duration: "Movie Duration is required, Please enter valid movie duration!",
				country: "Country is required, Please select country from the list!",
				year: "Year is required, Please select year from the list!",
				release_date: "Release date is required, Please enter release date!",
				director: "Director name is required, Please enter valid director name!",
				rating: "Rating is required! Please enter valid rating!",
				movie_description: "Movie Description is required! Please enter valid movie description",
				status: "Status is required! Please select status from the list!",
				poster: "Movie poster is requied! Please upload an image!"
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
    });
</script>        
<?php include 'includes/footer.inc.php'; ?>
