<?php include 'includes/header.inc.php'; ?>
<?php 
	error_reporting(E_ALL & ~E_WARNING);
	// Retrive data from the movie table according to the selected movie id.
	if(isset($_GET['actor_name'])) {
		$actor_name = urlencode($_GET['actor_name']);
		$url = "http://www.myapifilms.com/name?name=$actor_name&actorActress=1&bornDied=1&filmography=1&salary=1&format=XML";
		
		$result = xml2array($url);
		foreach($result as $result1) {
			foreach($result1 as $result2) {
				$actorActress = $result2['actorActress'];
				$bio = $result2['bio'];
				$birthname = $result2['birthName'];
				$dateOfBirth = $result2['dateOfBirth'];
				$height = $result2['height'];
				$idIMDB = $result2['idIMDB'];
				$name = $result2['name'];
				$placeOfBirth = $result2['placeOfBirth'];
				$photo = $result2['urlPhoto'];
				$born = $result2['born'];
				@$died = $result2['died'];
				@$filmography = $result2['filmographies'];
				@$salary = $result2['salaries'];
			}
		}
		
	}
?>
<?php if(isset($_GET['actor_name'])) { ?>
	   <div class="content">
      	   <div class="movie_top">
      	         <div class="col-md-9 movie_box">
                        <div class="grid images_3_of_2">
                        	<div class="movie_image">
                                <img src="<?php echo $photo; ?>" class="img-responsive" alt="<?php echo $name; ?>" width="299" height="406"/>
                            </div>
                        </div>
                        <div class="desc1 span_3_of_2">
                        	<p class="movie_option"><strong>Name: </strong> <?php echo $name; ?> | <?php echo $actorActress; ?></p>
                            <p class="movie_option"><strong>Born: </strong><?php echo $born; ?></p>
                            <p class="movie_option"><strong>Birth Name: </strong> <?php echo $birthname; ?></p>
                            <p class="movie_option"><strong>Date of Birth: </strong> <?php echo $dateOfBirth; ?></p>
                        	<p class="movie_option"><strong>Place of Birth: </strong> <?php echo $placeOfBirth; ?></p>
                            <p class="movie_option"><strong>Died: </strong><?php if(!empty($died)) { echo $died; } else { echo "Alive"; } ?></p>
                        	<p class="movie_option"><strong>Height: </strong><?php echo $height; ?></p>
                            
                            <p class="movie_option"><strong>IMDb Link: </strong><a href="http://www.imdb.com/name/<?php echo $idIMDB; ?>/" target="_blank"> IMDb Link </a></p>
                         </div>
                        <div class="clearfix"> </div>
                        <p class="m_4"> <?php echo $bio; ?> </p>
                        
                        <div class="box_2">
                            
                        	<h2> <?php echo $name; ?> movies in this website </h2>
                            <div class="row">
                                <?php $sql = "SELECT actor_id FROM actors_table WHERE actor_name='$name'";
										$sql_result = $database->query($sql);
										while($row = $database->fetch_array($sql_result)) {
											$actor_id = $row['actor_id'];
											$sql1 = "SELECT movie_id FROM movie_actors_table WHERE actor_id=$actor_id";
											$sql1_result = $database->query($sql1);
											while($movie_id = $database->fetch_array($sql1_result)) {
											$movie_id['movie_id'];
												$movie_id = $movie_id['movie_id'];
												$sql2 = "SELECT * FROM movie_table WHERE movie_id=$movie_id";
												$sql2_result = $database->query($sql2);
												while($movie = $database->fetch_array($sql2_result)) { 
												// The Regular Express filter
												$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-z]{2,3}(\/\S*)?/";
												// The text you want to filter goes here. 
												$text = $movie['poster'];
												// Check if there is a url in the text
												if(preg_match($reg_exUrl, $text, $url)) {
													$poster = $url[0];
												} else {
													$poster = 'images/movie_poster/'.$movie['poster'];
												}
												?>
                            
                               <div class="col-md-3" style="margin-bottom: 20px;"><a href="single.php?movie_id=<?php echo $movie['movie_id']; ?>">
                                    <div class="grid_2">
                                    <img src="<?php echo $poster; ?>" width="250" height="229" style="width:250px; height:229px;" class="img-responsive" alt="<?php echo $movie['movie_title']; ?>"/>
                                    <div class="caption1">
                                    	<p class="m_3"><?php echo $movie['movie_title']; ?></p>
                                    </div>
                                   </div></a>
                                </div>
                         
							<?php
												}
											}
										} 
								?>
							</div>
                        
                      </div>
                      </div>
                      
                      <div class="col-md-3">
                        	<h2> Filmography </h2><br />
                            <?php 
								foreach($filmography as $filmograph) {
									foreach($filmograph as $film) {
										foreach($film as $film1) {
											foreach($film1 as $film2) {
												foreach($film2 as $film3) {
													$imdb_id = $film3['IMDBId'];
													$title = $film3['title'];
													$year = $film3['year'];
													echo '<p class="movie_option"> <strong><a href="http://www.imdb.com/title/'.$imdb_id.'/" target="_blank"> '.$title.' </a></strong> ('.$year.') </p>';
												}
											}
										}
									}
								}
							?>
                            
                        </div>
                      <div class="clearfix"> </div>
                  </div>
           </div>
    <?php } else { ?>
    	<div class="content">
      	   <div class="movie_top">
      	         <div class="col-md-9 movie_box">
              		<h1> Please select an actor to see his/her biography </h1>   
                 </div>
           </div>
       	</div>
    <?php } ?>
    </div>
</div>

<?php include 'includes/footer.inc.php'; ?>