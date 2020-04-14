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

<script>
	function conf(id) {
		var value = window.confirm("Are you sure! You want to delete selected Item?");
		if(value == true) {
			window.location = "movie_list.php?movie_id="+id+"&task=delete";
		} else { 
			// Do something else
		}
	}
</script>
<?php include 'includes/nav.inc.php'; ?>

        <div id="page-wrapper">
        <?php if(isset($result)) { ?>
			<?php if($result == false) { ?>
            <div class="col-md-10">
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Oh Snap!</strong> Movie deletion was failed, please try again! :(
                </div>
            </div>
            <?php } else if($result == true) { ?>
            <div class="col-md-10">
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Well done!</strong> Movie deletion was successful! :)
                </div>
            </div>
            <?php } } ?>
        <div class="graphs">
        
        	<div class="xs">
  	       		<h3>Movies List</h3>
        		<div class="tab-content">
                	<div class="tab-pane active" id="horizontal-form">
                   		<p>
                                Search: <input id="filter" type="text" class="form-inline"/>
                              </p> <br />
                            <table class="footable metro-green" data-page-size="10" data-filter="#filter" data-filter-text-only="true">
                                <thead>
                                <tr>
                                    <th>
                                        Number
                                    </th>
                                    <th>
                                        Movie Title
                                    </th>
                                    <th data-hide="phone,tablet">
                                        Country
                                    </th>
                                    <th data-hide="phone,tablet">
                                        Year
                                    </th>
                                    <th data-hide="phone,tablet">
                                        Release Date
                                    </th>
                                    <th data-hide="phone,tablet">
                                        Genre
                                    </th>

                                    <th data-hide="phone,tablet">
                                        Trailer
                                    </th>
                                    <th data-hide="phone,tablet">
                                        Status
                                    </th>
                                    <th data-hide="phone,tablet">
                                        Action
                                    </th>
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
                                    <td><form action="add_genre.php" method="post" />
                                    <div class="input-group">
                                    	<select name="genre" id="genre" class="form-control1">
                                        	<option value="" disabled selected> -- Select Genre -- </option>
                                            <?php $genre_result = $database->query("SELECT * FROM genre ORDER BY genre ASC");
											while($genre = $database->fetch_array($genre_result)) { ?>
                                            <option value="<?php echo $genre['genre_id']; ?>"> 
												<?php echo $genre['genre']; ?> </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                        <input type="hidden" name="movie_id" id="movie_id" value="<?php echo $movie['movie_id']; ?>" />
                                        <div class="input-group">
                                        <input type="submit" name="submit_genre" id="submit_genre" value="Submit" class="btn btn-sm btn-success1" />
                                        </div>
                                    </form> 
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
                                    </td>
                                    <td><form action="movie_list.php" method="post" id="form_trailer">
                                    	<div class="input-group">
                                        <input type="text" required name="trailer" id="trailer" placeholder="Trailer URL" class="form-control1">
                                        <input type="hidden" name="movie_id" id="movie_id" value="<?php echo $movie['movie_id']; ?>"
                                        </div>
                                        <div class="input-group">
                                        <input type="submit" name="update_trailer" id="update_trailer" value="UPDATE" class="btn btn-sm btn-primary" />
                                        </div>
                                    </form> <br />
                                    <p> <strong> <?php if(empty($movie['trailer'])) { echo 'Trailer Not Available'; } else { echo 'Trailer Available'; } ?> </strong> </p>
                                    </td>
                                    <td><?php echo $movie['status']; ?></td>
                                    <td data-value="1">
                                    <button id="<?php echo $movie['movie_id']; ?>" onClick="conf(this.id)" data-toggle="tooltip" title="Delete this item" data-placement="top" class="btn status-metro status-suspended">
                                    <i class="fa fa-trash-o"></i> Delete
                                    </button></td>
                                </tr>
                                <?php } ?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="5">
                                        <div class="pagination pagination-centered"></div>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>                 
                    </div>
                </div>
        	</div>

<script type="text/javascript">
	$(document).ready(function() {
        
		// Validate add_movie form
		$("#add_movie").validate({
		
			rules: {
				movie_title: "required",
				country: "required",
				year: "required",
				release_date: "required",
				director: "required",
				rating: "required",
				movie_description: "required",
				status: "required"
				
			},
			messages: {
				movie_title: "Movie Title is required, Please enter valid movie title!",
				country: "Country is required, Please select country from the list!",
				year: "Year is required, Please select year from the list!",
				release_date: "Release date is required, Please enter release date!",
				director: "Director name is required, Please enter valid director name!",
				rating: "Rating is required! Please enter valid rating!",
				movie_description: "Movie Description is required! Please enter valid movie description",
				status: "Status is required! Please select status from the list!"
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
		
		// Validate form_trailer form
		$("#form_trailer").validate({
		
			rules: {
				trailer: { 
					required: true,
					url: true,
					minlenght: 5
				}
				
			},
			messages: {
				trailer: { 
					required: "Trailer is required! Please provide trailer Information.",
					url: "Please enter valid url for the Trailer",
					minlenght: "Trailer lenght should be more than 5 characters!"
				}
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
