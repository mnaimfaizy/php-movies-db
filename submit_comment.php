<?php require_once("Admin/includes/initialize.php"); ?>
<?php
	// Submit comment of the movie
	if(isset($_POST['submit'])) {
		echo $movie_id = $_POST['movie_id'];
		echo $name = $_POST['name'];
		echo $email = $_POST['email'];
		echo $message = $_POST['message'];
		echo $date = time();
		
		$sql = "INSERT INTO comments(name, email, message, date, movie_id)
				VALUES('$name', '$email', '$message', $date, $movie_id)";
		
		if($database->query($sql)) {
			header("Location: single.php?movie_id=".$movie_id."&error=0");
		} else {
			header("Location: single.php?movie_id=".$movie_id."&error=1");
		}
		
	}
?>