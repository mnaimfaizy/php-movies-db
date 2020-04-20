<?php require_once("../includes/initialize.php"); ?>
<?php
	// First check the form is submited and there are values in for updating the table
	if(isset($_POST['submit_genre'])) {
		$movie_id = $_POST['movie_id'];
		$genre_id = $_POST['genre'];
		
		// Desing the query and insert the data to movie_genre_table
		$sql = "INSERT INTO movie_genre_table(movie_id, genre_id)
				VALUES($movie_id, $genre_id)";
		
		// Check the record has been inserted successfully and redirect the user to movie_list.php page
		if($database->query($sql)) {
			redirect_to("../movie_list.php?msg=1&type=genre");	
		} else {
			redirect_to("../movie_list.php?msg=0&type=genre");
		}
	}
?>