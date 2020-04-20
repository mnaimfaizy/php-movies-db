<?php require_once("../includes/initialize.php"); ?>
<?php
    // Delete Movie from the database
	if(isset($_GET['movie_id'])) {
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
                        redirect_to("../movie_list.php?msg=1&type=movie");	
					} else {
                        redirect_to("../movie_list.php?msg=0&type=movie");	
					}
				}
			}
    }
    
?>