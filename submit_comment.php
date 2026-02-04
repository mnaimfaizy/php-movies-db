<?php require_once("Admin/includes/initialize.php"); ?>
<?php
	// Submit comment of the movie
	if(isset($_POST['submit'])) {
		// Escape and validate all inputs
		$movie_id = $database->escape_value($_POST['movie_id']);
		$name = $database->escape_value(trim($_POST['name']));
		$email = $database->escape_value(trim($_POST['email']));
		$message = $database->escape_value(trim($_POST['message']));
		$date = time();
		
		// Validate required fields
		$errors = array();
		
		if(empty($name)) {
			$errors[] = "Name is required";
		}
		
		if(empty($email)) {
			$errors[] = "Email is required";
		} elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$errors[] = "Invalid email format";
		}
		
		if(empty($message)) {
			$errors[] = "Message is required";
		}
		
		if(!is_numeric($movie_id)) {
			$errors[] = "Invalid movie ID";
		}
		
		// If no errors, insert comment
		if(empty($errors)) {
			$sql = "INSERT INTO comments(name, email, message, date, movie_id)
					VALUES('$name', '$email', '$message', $date, $movie_id)";
			
			if($database->query($sql)) {
				header("Location: single.php?movie_id=".$movie_id."&success=1");
				exit();
			} else {
				header("Location: single.php?movie_id=".$movie_id."&error=1");
				exit();
			}
		} else {
			// Redirect with error
			$error_msg = urlencode(implode(", ", $errors));
			header("Location: single.php?movie_id=".$movie_id."&error=".$error_msg);
			exit();
		}
	}
?>