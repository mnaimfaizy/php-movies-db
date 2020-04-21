<?php include 'includes/header.inc.php'; ?>
<?php 
	// Retrive data from the movie table according to the selected movie id.
	if(isset($_GET['movie_id'])) {
		$movie_id = $_GET['movie_id'];
		$sql = "SELECT * FROM movie_table WHERE movie_id=$movie_id LIMIT 1";
		$result = $database->query($sql);
		$movie_info = $database->fetch_array($result);
		
		// Data fetched from table
		$movie_id = $movie_info['movie_id'];
		$movie_title = $movie_info['movie_title'];
		$country = $movie_info['country'];
		$year = $movie_info['year'];
		$rating = $movie_info['rating'];
		$release_date = $movie_info['release_date'];
		$directors = $movie_info['director'];
		$movie_description = $movie_info['movie_desc'];
		$trailer = $movie_info['trailer'];
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
		$duration = $movie_info['duration'];
		$imdb_link = $movie_info['imdb_link'];
		
	}
?>
<?php
	// Submit comment of the movie
	if(isset($_POST['submit'])) {
		$output = '';
		$movie_id = $database->escape_value($_POST['movie_id']);
		if(empty($_POST['name'])) {
			$output .= '<p>Name is required, please right your name!</p>';	
		} else { 
			$name = $database->escape_value($_POST['name']);
		}
		if(empty($_POST['email'])) { 
			$output .= '<p>Email is required, Please right valid Email Address </p>';
		} else { 
			$email = $database->escape_value($_POST['email']);
		}
		if(empty($_POST['message'])) { 
			$output .= '<p> Message is required, Please right valid Message </p>';
		} else { 
			$message = $database->escape_value($_POST['message']);
		}
		$date = time();
		
		if(empty($output)) {
			$sql = "INSERT INTO comments(name, email, message, date, movie_id)
					VALUES('$name', '$email', '$message', $date, $movie_id)";
			
			if($database->query($sql)) {
				$error = true;
			} else {
				$error = false;
			}
		} else {
			$output .= '<p> Please fill all the required fields :( </p>';	
		}
		
	}
?>
	   <div class="content">
       	        <?php if(!empty($output)) { ?>
        <div class="alert alert-danger">
        	<?php echo $output; ?>
        </div>
        <?php } ?>
      	   <div class="movie_top">
      	         <div class="col-md-9 movie_box">
                        <div class="grid images_3_of_2">
                        	<div class="movie_image">
                                <span class="movie_rating"><?php echo $rating; ?></span>
                                <img src="<?php echo $poster; ?>" class="img-responsive" alt="<?php echo $movie_title; ?>" width="299" height="406"/>
                            </div>
                        </div>
                        <div class="desc1 span_3_of_2">
                        	<p class="movie_option"><strong>Title: </strong> <a href="#"><?php echo $movie_title; ?></a></p>
                            <p class="movie_option"><strong>Duration: </strong> <a href="#"><?php echo $duration; ?></a></p>
                        	<p class="movie_option"><strong>Country: </strong> <a href="#"><?php echo $country; ?></a></p>
                        	<p class="movie_option"><strong>Year: </strong><?php echo $year; ?></p>
                        	<p class="movie_option"><strong>Genre: </strong>
                            	<?php $sql1 = "SELECT genre.genre_id, genre.genre 
											FROM `movie_genre_table`
											LEFT JOIN genre ON
											genre.genre_id=movie_genre_table.genre_id
											WHERE movie_genre_table.movie_id=$movie_id";
									$sql1_result = $database->query($sql1);
									while($genre = $database->fetch_array($sql1_result)) { ?>
									<a href="movie.php?genre_id=<?php echo $genre['genre_id']; ?>">
									<?php echo $genre['genre']; ?></a>, 
									<?php } ?>
							</p>
                        	<p class="movie_option"><strong>Release date: </strong><?php echo $release_date; ?></p>
							<p class="movie_option"><strong>Director: </strong>
								<?php $dir = explode(', ', $directors);
								for($i = 0; $i < count($dir); $i++) {  ?>
								<a href="actor_details.php?actor_name=<?php echo urlencode($dir[$i]); ?>" target="_blank">
									<?php echo $dir[$i]; ?> 
								</a> |  
								<?php } ?>
							</p>
                        	<p class="movie_option"><strong>Actors: </strong>
                            <?php // Find actors of this movie
							$sql = "SELECT actor_id FROM movie_actors_table WHERE movie_id=$movie_id";
							$result = $database->query($sql);
								if($database->num_rows($result) > 0) {
									while($actor = $database->fetch_array($result)) {
										$actor_id = $actor['actor_id'];
										$sql1 = "SELECT actor_name FROM actors_table WHERE actor_id=$actor_id";
										$sql1_result1 = $database->query($sql1);
										while($actor1 = $database->fetch_array($sql1_result1)) {
											echo '<a href="actor_details.php?actor_name='.urlencode($actor1['actor_name']).'" target="_blank">
												'.$actor1['actor_name'].'</a>, '; 
										}
									} 
								} else { 
									echo " None "; 
								} 
							?></p>
                            
                            <p class="movie_option"><strong>IMDb Link: </strong><a href="<?php echo $imdb_link; ?>" target="_blank"><?php echo $imdb_link; ?> </a></p>
                            <div class="down_btn">
                            <a class="btn1 popup-youtube" href="<?php echo $trailer; ?>"><i class="fa fa-play-circle"></i> &nbsp;&nbsp; Watch Trailer</a></div>
                         </div>
                        <div class="clearfix"> </div>
                        <p class="m_4"> <?php echo $movie_description; ?> </p>
		                <form action="<?php echo $_SERVER['PHP_SELF']; ?>?movie_id=<?php echo $_GET['movie_id']; ?>" name="comment_form" id="comment_form" method="post" >
							<div class="to">
		                     	<input type="text" class="text" placeholder="Your Name" id="name" name="name" />
							 	<input type="text" class="text" id="email" name="email" placeholder="Your Email" style="margin-left:3%" />
							</div>
							<div class="text">
			                   <textarea name="message" id="message">Message:</textarea>
			                </div>
			                <div class="form-submit1">
                            	<input type="hidden" name="movie_id" id="movie_id" value="<?php echo $movie_id; ?>" />
					           <input name="submit" type="submit" id="submit" value="Submit Your Message" /><br>
					        </div>
							<div class="clearfix"></div>
                 		</form>
		                <div class="single">
		                <h1><?php $sql = "SELECT COUNT(*) AS total FROM comments WHERE movie_id=$movie_id";
								$result = $database->query($sql);
								$comment = $database->fetch_array($result);
								if($comment['total'] > 0) { echo $comment['total'] . " Comments"; } else { echo $comment['total'] . " Comments"; } ?></h1>
		                <ul class="single_list">
					        <?php $sql = "SELECT * FROM comments WHERE movie_id=$movie_id ORDER BY comment_id DESC";
								$result = $database->query($sql);
								while($comment = $database->fetch_array($result)) { ?>
                            <li>
					            <div class="preview"><a href="#"><img src="assets/images/Woman_Man_Avatar_45x45.png" class="img-responsive" alt=""></a></div>
					            <div class="data">
					                <div class="title"><?php echo $comment['name']; ?>  /  <?php echo date("d - M - Y, h:i:s", $comment['date']); ?> </div>
					                <p><?php echo $comment['message']; ?></p>
					            </div>
					            <div class="clearfix"></div>
					        </li>
                            <?php } ?>
			  			</ul>
                      </div>
                      </div>
                      <div class="col-md-3">
                      	
                        <?php $sql = "SELECT genre_id FROM movie_genre_table WHERE movie_id=$movie_id LIMIT 1";
							$genre_result = $database->query($sql);
							$genre_id = $database->fetch_array($genre_result);
								$genre_id = $genre_id['genre_id'];
								$query = " SELECT movie_id FROM movie_genre_table WHERE genre_id=$genre_id ORDER BY RAND(movie_id) LIMIT 10";
								$query_res = $database->query($query);
								while($movies = $database->fetch_array($query_res)) {
									$movie_ID = $movies['movie_id'];
							$sql = "SELECT * FROM movie_table WHERE movie_id=$movie_ID LIMIT 3";
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
							}
						} 
						?>
                        <div class="movie_img">
                            <div class="grid_2"><a href="single.php?movie_id=<?php echo $movie_ID; ?>">
                                <img src="<?php echo $poster; ?>" class="img-responsive" alt="<?php echo $movie['movie_title']; ?>" width="250" height="240" style="width:250px; height:230px;"> </a>
                                <div class="caption1">
                                        <p class="m_3"><?php echo $movie['movie_title']; ?></p>
                                </div>
                             </div>
                             </div>
                        <?php } ?>
						   
		               </div> 
                      <div class="clearfix"> </div>
                  </div>
           </div>
    </div>
</div>
   <?php if(isset($error)) {
			if($error == true) { 
				echo '<script type="text/javascript"> alert("Your comment has been submited! Thanks :)"); </script>';
			} else {
				echo '<script type="text/javascript"> alert("Sorry! There has been some problem, please try again :("); </script>';
			}
		} ?>

<?php include 'includes/footer.inc.php'; ?>