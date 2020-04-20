<?php
require_once("../admin/includes/initialize.php");
require_once("../includes/pagination.class.php");
$db_handle = $database;
$perPage = new PerPage();

// set the amount of records to be displayed on a single page
$perPage->perpage = 20;

$sql = "SELECT * from movies WHERE status='Active' ORDER BY movie_id DESC ";
$paginationlink = "ajax/loadAllMovies.php?page=";	
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

	$output .= '<div class="movie movie-test movie-test-dark movie-test-left">';
	$output .= '<div class="movie__images">';
	$output .= '<a href="single.php?movie_id='.$movie['movie_id'].'" class="movie-beta__link">';
	$output .= '<img alt="" src="'.$poster.'" class="img-responsive" alt="'.$movie['movie_title'].'" width="250" height="240" style="width:250px; height:240px;"/>';
	$output .= '</a></div>';
	$output .= '<div class="movie__info">';
	$output .= '<a href="single.php?movie_id='.$movie['movie_id'].'" class="movie__title">';
	$output .= $movie['movie_title']; 
	$output .= (!empty($movie_info['year'])) ? '('.$movie_info['year'].')' : '';  
	$output .= '</a>';
	$output .= '<p class="movie__time">'.$movie['duration'].'</p>';
	$output .= '<p class="movie__option">';
	$output .= $movie['genre'];
	$output .= '</a></p></div>';
	$output .= '<ul class="list_6">';
	$output .= '<li><p>'.$movie['country'].'</p></li>';
	$output .= '<li><i class="icon3"> </i><p>'. $movie['release_date'].'</p></li>';
	$output .= '<li>Rating : &nbsp;&nbsp;<p class="btn btn-danger btn-sm btn-circle">'.$movie['rating'].'</p></li>';
	$output .= '<div class="clearfix"> </div>';
	$output .= '</ul></div>';
}
if(!empty($perpageresult)) {
	$output .= '<div class="col-md-12"><div id="pagination">' . $perpageresult . '</div></div>';
} else {
	$output .= '<h3>Sorry! no movie for this year</h3>';
}
print $output;
?>
