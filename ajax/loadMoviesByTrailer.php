<?php
require_once("../admin/includes/initialize.php");
require_once("../includes/pagination.class.php");
$db_handle = $database;
$perPage = new PerPage();

// set the amount of records to be displayed on a single page
$perPage->perpage = 40;

$sql = "SELECT * from movies WHERE status='Active' ORDER BY movie_id DESC ";
$paginationlink = "ajax/loadMoviesByTrailer.php?page=";	
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
$output .= '<div class="row g-4">';
foreach($faq as $movie) {
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
	
	$year = $movie['year'] ?? '';
	$rating = $movie['rating'] ?? 'N/A';

	$output .= '<div class="col-6 col-md-4 col-lg-3">';
	$output .= '<div class="trailer-card">';
	$output .= '<a class="popup-youtube" href="'.$movie['trailer'].'">';
	$output .= '<div class="trailer-poster">';
	$output .= '<img src="'.$poster.'" class="img-fluid" alt="'.htmlspecialchars($movie['movie_title']).'" loading="lazy"/>';
	$output .= '<div class="trailer-play-overlay"><i class="fas fa-play-circle"></i></div>';
	$output .= '</div>';
	$output .= '<div class="trailer-info">';
	$output .= '<h6 class="trailer-title">'.htmlspecialchars($movie['movie_title']).'</h6>';
	$output .= '<div class="trailer-meta">';
	$output .= '<span class="trailer-year"><i class="far fa-calendar-alt"></i> '.$year.'</span>';
	$output .= '<span class="trailer-rating"><i class="fas fa-star text-warning"></i> '.$rating.'</span>';
	$output .= '</div>';
	$output .= '</div>';
	$output .= '</a>';
	$output .= '</div>';
	$output .= '</div>';
}
$output .= '</div>';
if(!empty($perpageresult)) {
$output .= '<div class="col-12 mt-4"><div id="pagination" class="d-flex justify-content-center">' . $perpageresult . '</div></div>';
}
print $output;
?>
