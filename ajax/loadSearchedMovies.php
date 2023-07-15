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

		$output .= '<div class="col-md-3" style="margin-bottom: 20px;">';
		$output .= '<a href="single.php?movie_id='.$movie['movie_id'].'" title="'.$movie['movie_title'].'">';
		$output .= '<div class="grid_2">';
		$output .= '<img src="'.$poster.'" style="width:250px; height:229px;" class="img-responsive" alt="'.$movie['movie_title'].'"/>';
		$output .= '<div class="caption1">';
		$output .= '<ul class="list_3">';
		$output .= '<li><i class="icon5"> </i><p>'.$movie['rating'].'</p></li>';
		$output .= '</ul>';
		$output .= '<i class="icon4"> </i>';
		$output .= '<p class="m_3">'.$movie['movie_title'].'</p>';
		$output .= '</div>';
		$output .= '</div></a>';
		$output .= '</div>';
	}
}

if(!empty($perpageresult)) {
$output .= '<div class="col-md-12"><div id="pagination">' . $perpageresult . '</div></div>';
}
print $output;
?>
