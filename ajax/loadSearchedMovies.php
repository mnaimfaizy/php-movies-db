<?php
require_once("../admin/includes/initialize.php");
require_once("../includes/pagination.class.php");
$db_handle = $database;
$perPage = new PerPage();

// set the amount of records to be displayed on a single page
$perPage->perpage = 20;

$searchQuery = $_GET['search_query'];
$sql = "SELECT * from movies WHERE status='Active' AND movie_title LIKE '%$searchQuery%' ORDER BY movie_id DESC ";
$paginationlink = "ajax/loadSearchedMovies.php?page=";	
$pagination_setting = $_GET["pagination_setting"];
				
$page = 1;
if(!empty($_GET["page"])) {
$page = $_GET["page"];
}

$start = ($page-1)*$perPage->perpage;
if($start < 0) $start = 0;

$query =  $sql . " limit " . $start . "," . $perPage->perpage; 
$faq = $db_handle->runQuery($query);

if(empty($_GET["rowcount"])) {
$_GET["rowcount"] = $db_handle->numRows($sql);
}

if($pagination_setting == "prev-next") {
	$perpageresult = $perPage->getPrevNext($_GET["rowcount"], $paginationlink,$pagination_setting);	
} else {
	$perpageresult = $perPage->getAllPageLinks($_GET["rowcount"], $paginationlink,$pagination_setting);	
}


$output = '';
if(!empty($faq)) {
	$output .= '<div class="movies-grid">'; // Start modern grid
	
	foreach($faq as $movie) {
		// The Regular Express filter
		$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-z]{2,3}(\/\S*)?/";
		// The text you want to filter goes here.
		$text = isset($movie['poster']) ? $movie['poster'] : '';
		// Check if there is a url in the text
		if(preg_match($reg_exUrl, $text, $url)) {
			$poster = $url[0];
		} else {
			$poster = !empty($movie['poster']) ? 'assets/images/movie_poster/'.$movie['poster'] : 'assets/images/movie_poster/default.jpg';
		}

		// Modern Movie Card
		$output .= '<div class="movie-card">';
		$output .= '  <div class="movie-card-image">';
		$output .= '    <img src="'.$poster.'" alt="'.htmlspecialchars($movie['movie_title']).'">';
		$output .= '    <span class="movie-card-rating"><i class="fas fa-star"></i> '.$movie['rating'].'</span>';
		$output .= '    <div class="movie-card-overlay">';
		$output .= '      <div class="movie-card-actions">';
		$output .= '        <a href="single.php?movie_id='.$movie['movie_id'].'" class="btn btn-primary btn-sm"><i class="fas fa-play"></i> Watch</a>';
		$output .= '        <a href="single.php?movie_id='.$movie['movie_id'].'" class="btn btn-outline-light btn-sm"><i class="fas fa-info-circle"></i> Info</a>';
		$output .= '      </div>';
		$output .= '    </div>';
		$output .= '  </div>';
		$output .= '  <div class="movie-card-body">';
		$output .= '    <h5 class="movie-card-title">';
		$output .= '      <a href="single.php?movie_id='.$movie['movie_id'].'" class="text-white text-decoration-none">';
		$output .= htmlspecialchars($movie['movie_title']);
		$output .= '      </a>';
		$output .= '    </h5>';
		$output .= '    <div class="movie-card-meta">';
		$output .= '      <span class="movie-card-year"><i class="far fa-calendar"></i> '.(!empty($movie['year']) ? $movie['year'] : 'N/A').'</span>';
		$output .= '      <span class="movie-card-genre">'.(isset($movie['genre']) ? $movie['genre'] : '').'</span>';
		$output .= '    </div>';
		$output .= '  </div>';
		$output .= '</div>';
	}
	
	$output .= '</div>'; // End movies grid
} else {
	$output .= '<div class="empty-state"><i class="fas fa-search"></i><h4>No Results Found</h4><p>No movies found matching your search.</p></div>';
}

if(!empty($perpageresult)) {
	$output .= '<div class="row mt-4"><div class="col-12"><div id="pagination" class="d-flex justify-content-center">' . $perpageresult . '</div></div></div>';
}
print $output;
?>
