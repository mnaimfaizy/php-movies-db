<?php require_once('../Admin/includes/initialize.php'); ?>

<?php 
	global $database;
	if(isset($_POST['query']) === true && empty($_POST['query']) === false) {
		
		$searchQuery = $database->escape_value($_POST['query']);
		$query = "SELECT * FROM movie_table WHERE movie_title LIKE '%" . $searchQuery . "%' LIMIT 5";
		$queryResult = $database->query($query);
		if($database->num_rows($queryResult) > 0) {
			while($row = $database->fetch_array($queryResult)) {
				// The Regular Express filter
				$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-z]{2,3}(\/\S*)?/";
				// The text you want to filter goes here. 
				$text = $row['poster'];
				// Check if there is a url in the text
				if(preg_match($reg_exUrl, $text, $url)) {
					$poster = $url[0];
				} else {
					$poster = 'images/movie_poster/'.$row['poster'];
				}
				//$output = '<ul class="searchresults">';
				$output =	'<a href="single.php?movie_id=' . $row['movie_id'] . '">';
				$output .=		'<li>';
				$output .=		'<span class="product_image">';
				$output .=		'<img src="'.$poster.'" alt="Test Product" />';
				$output .=		'</span>'; 
				$output .=		'<span class="product_name">';
				$output .=		'<strong>' . $row['movie_title'] . '</strong>';
				$output .=		'</span>';   
				$output .=		'<span class="product_price">';
				$output .=		' (<strong>' . $row['year'] . '</strong>)';
				$output .=		'</span>';
				$output .=		 '</li>';
				$output .=	'</a>';
				//$output .= '</ul>';
				echo $output;
			} // End of While Loop
		} // End of if 
		else {
			// $output = '<ul class="searchresults">';
			$output = '<li>';
			$output .= '<h2> No Movie found <i class="fa fa-frown-o"></i> </h2>';
			$output .= '</li>';
			// $output .= '</ul>';
			echo $output;
		} // End of IF-Else
	} // End of IF	
?>