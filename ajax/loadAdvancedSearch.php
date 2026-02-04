<?php
require_once("../admin/includes/initialize.php");
require_once("../includes/pagination.class.php");
$db_handle = $database;
$perPage = new PerPage();

// set the amount of records to be displayed on a single page
$perPage->perpage = 20;

// Get search parameters
$searchQuery = isset($_GET['search_query']) ? $database->escape_value($_GET['search_query']) : '';
$genreFilter = isset($_GET['genre']) ? $database->escape_value($_GET['genre']) : '';
$yearFilter = isset($_GET['year']) ? $database->escape_value($_GET['year']) : '';
$ratingFilter = isset($_GET['rating']) ? $database->escape_value($_GET['rating']) : '';
$sortBy = isset($_GET['sort']) ? $database->escape_value($_GET['sort']) : 'newest';

// Build the base query using the movies view (which already has actors and genre)
$sql = "SELECT * FROM movies WHERE status='Active' ";

// Add search conditions - search across multiple fields
if(!empty($searchQuery)) {
    $sql .= "AND (movie_title LIKE '%$searchQuery%' ";
    $sql .= "OR director LIKE '%$searchQuery%' ";
    $sql .= "OR movie_desc LIKE '%$searchQuery%' ";
    $sql .= "OR actors LIKE '%$searchQuery%') ";
}

// Add genre filter
if(!empty($genreFilter)) {
    $sql .= "AND genre LIKE '%$genreFilter%' ";
}

// Add year filter
if(!empty($yearFilter)) {
    $sql .= "AND year = '$yearFilter' ";
}

// Add rating filter
if(!empty($ratingFilter)) {
    switch($ratingFilter) {
        case '9+':
            $sql .= "AND rating >= 9 ";
            break;
        case '8+':
            $sql .= "AND rating >= 8 ";
            break;
        case '7+':
            $sql .= "AND rating >= 7 ";
            break;
        case '6+':
            $sql .= "AND rating >= 6 ";
            break;
        case '5+':
            $sql .= "AND rating >= 5 ";
            break;
    }
}

// Add sorting
switch($sortBy) {
    case 'newest':
        $sql .= "ORDER BY movie_id DESC ";
        break;
    case 'oldest':
        $sql .= "ORDER BY movie_id ASC ";
        break;
    case 'title_asc':
        $sql .= "ORDER BY movie_title ASC ";
        break;
    case 'title_desc':
        $sql .= "ORDER BY movie_title DESC ";
        break;
    case 'rating_high':
        $sql .= "ORDER BY rating DESC ";
        break;
    case 'rating_low':
        $sql .= "ORDER BY rating ASC ";
        break;
    case 'year_new':
        $sql .= "ORDER BY year DESC ";
        break;
    case 'year_old':
        $sql .= "ORDER BY year ASC ";
        break;
    default:
        $sql .= "ORDER BY movie_id DESC ";
}

// Build pagination link with all parameters
$params = array();
if(!empty($searchQuery)) $params[] = "search_query=" . urlencode($searchQuery);
if(!empty($genreFilter)) $params[] = "genre=" . urlencode($genreFilter);
if(!empty($yearFilter)) $params[] = "year=" . urlencode($yearFilter);
if(!empty($ratingFilter)) $params[] = "rating=" . urlencode($ratingFilter);
if(!empty($sortBy)) $params[] = "sort=" . urlencode($sortBy);

$paginationlink = "ajax/loadAdvancedSearch.php?" . implode("&", $params) . "&page=";
$pagination_setting = isset($_GET["pagination_setting"]) ? $_GET["pagination_setting"] : 'all-links';

$page = 1;
if(!empty($_GET["page"])) {
    $page = $_GET["page"];
}

$start = ($page-1)*$perPage->perpage;
if($start < 0) $start = 0;

$query = $sql . " LIMIT " . $start . "," . $perPage->perpage;
$faq = $db_handle->runQuery($query);

if(empty($_GET["rowcount"])) {
    $_GET["rowcount"] = $db_handle->numRows($sql);
}

if($pagination_setting == "prev-next") {
    $perpageresult = $perPage->getPrevNext($_GET["rowcount"], $paginationlink, $pagination_setting);
} else {
    $perpageresult = $perPage->getAllPageLinks($_GET["rowcount"], $paginationlink, $pagination_setting);
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
        $output .= '      <span class="movie-card-director"><i class="fas fa-video"></i> '.(!empty($movie['director']) ? htmlspecialchars(substr($movie['director'], 0, 20)) : '').'</span>';
        $output .= '    </div>';
        $output .= '  </div>';
        $output .= '</div>';
    }

    $output .= '</div>'; // End movies grid

    if(!empty($perpageresult)) {
        $output .= '<div class="row mt-4"><div class="col-12"><div id="pagination" class="d-flex justify-content-center">' . $perpageresult . '</div></div></div>';
    }
} else {
    $output .= '<div class="empty-state">';
    $output .= '<i class="fas fa-search"></i>';
    $output .= '<h4>No Results Found</h4>';
    $output .= '<p>Try adjusting your search or filters to find what you\'re looking for.</p>';
    $output .= '</div>';
}

print $output;
?>
