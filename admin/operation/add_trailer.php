<?php require_once("../includes/initialize.php"); ?>
<?php
	// Update trailer column in movie_table
	if(isset($_POST['update_trailer'])) {
		$trailer = $_POST['trailer'];
		$movie_id = $_POST['movie_id'];
		
        $sql = "UPDATE movie_table SET trailer='$trailer' WHERE movie_id=$movie_id LIMIT 1";
        
		if($database->query($sql)) {
            redirect_to("../movie_list.php?msg=1&type=trailer");
		} else {
            redirect_to("../movie_list.php?msg=0&type=trailer");
		}
    }
?>