<?php include 'includes/header.inc.php'; ?>

<?php
// Get all genres for filter dropdown
$genresQuery = "SELECT genre_id, genre FROM genre ORDER BY genre ASC";
$genresResult = $database->query($genresQuery);
$genres = array();
while($row = $database->fetch_array($genresResult)) {
    $genres[] = $row;
}

// Get all years for filter dropdown
$yearsQuery = "SELECT DISTINCT year FROM year ORDER BY year DESC";
$yearsResult = $database->query($yearsQuery);
$years = array();
while($row = $database->fetch_array($yearsResult)) {
    $years[] = $row;
}

// Get current filter values
$currentSearch = isset($_GET['search_query']) ? htmlspecialchars($_GET['search_query']) : '';
$currentGenre = isset($_GET['genre']) ? htmlspecialchars($_GET['genre']) : '';
$currentYear = isset($_GET['year']) ? htmlspecialchars($_GET['year']) : '';
$currentRating = isset($_GET['rating']) ? htmlspecialchars($_GET['rating']) : '';
$currentSort = isset($_GET['sort']) ? htmlspecialchars($_GET['sort']) : 'newest';
?>

<!-- Page Header -->
<div class="page-header" style="margin-top: 70px;">
    <div class="container">
        <h1 class="display-6 fw-bold"><i class="fas fa-search me-2 text-primary"></i>Advanced Movie Search</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Search</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container py-4">
    <!-- Enhanced Search Box -->
    <div class="search-panel content-card p-4 mb-4">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" name="search_form" id="search_form" method="get">
            <!-- Main Search Input -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="hero-search">
                        <input type="text" class="form-control form-control-lg" name="search_query" id="search_query" 
                               placeholder="Search movies, actors, directors, or descriptions..." 
                               value="<?php echo $currentSearch; ?>"
                               autocomplete="off" />
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-search"></i> Search
                        </button>
                    </div>
                    <small class="text-secondary mt-2 d-block">
                        <i class="fas fa-info-circle me-1"></i> Search across movie titles, actors, directors, and plot descriptions
                    </small>
                </div>
            </div>
            
            <!-- Filter Row -->
            <div class="row g-3 filter-row">
                <!-- Genre Filter -->
                <div class="col-md-3 col-sm-6">
                    <label class="filter-label"><i class="fas fa-theater-masks me-1"></i> Genre</label>
                    <select name="genre" id="filter_genre" class="modern-select w-100">
                        <option value="">All Genres</option>
                        <?php foreach($genres as $genre) { ?>
                            <option value="<?php echo htmlspecialchars($genre['genre']); ?>" 
                                    <?php echo ($currentGenre == $genre['genre']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($genre['genre']); ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                
                <!-- Year Filter -->
                <div class="col-md-3 col-sm-6">
                    <label class="filter-label"><i class="fas fa-calendar-alt me-1"></i> Year</label>
                    <select name="year" id="filter_year" class="modern-select w-100">
                        <option value="">All Years</option>
                        <?php foreach($years as $year) { ?>
                            <option value="<?php echo $year['year']; ?>" 
                                    <?php echo ($currentYear == $year['year']) ? 'selected' : ''; ?>>
                                <?php echo $year['year']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                
                <!-- Rating Filter -->
                <div class="col-md-3 col-sm-6">
                    <label class="filter-label"><i class="fas fa-star me-1"></i> Rating</label>
                    <select name="rating" id="filter_rating" class="modern-select w-100">
                        <option value="">All Ratings</option>
                        <option value="9+" <?php echo ($currentRating == '9+') ? 'selected' : ''; ?>>9+ Excellent</option>
                        <option value="8+" <?php echo ($currentRating == '8+') ? 'selected' : ''; ?>>8+ Great</option>
                        <option value="7+" <?php echo ($currentRating == '7+') ? 'selected' : ''; ?>>7+ Good</option>
                        <option value="6+" <?php echo ($currentRating == '6+') ? 'selected' : ''; ?>>6+ Average</option>
                        <option value="5+" <?php echo ($currentRating == '5+') ? 'selected' : ''; ?>>5+ Below Average</option>
                    </select>
                </div>
                
                <!-- Sort By -->
                <div class="col-md-3 col-sm-6">
                    <label class="filter-label"><i class="fas fa-sort me-1"></i> Sort By</label>
                    <select name="sort" id="filter_sort" class="modern-select w-100">
                        <option value="newest" <?php echo ($currentSort == 'newest') ? 'selected' : ''; ?>>Newest First</option>
                        <option value="oldest" <?php echo ($currentSort == 'oldest') ? 'selected' : ''; ?>>Oldest First</option>
                        <option value="title_asc" <?php echo ($currentSort == 'title_asc') ? 'selected' : ''; ?>>Title (A-Z)</option>
                        <option value="title_desc" <?php echo ($currentSort == 'title_desc') ? 'selected' : ''; ?>>Title (Z-A)</option>
                        <option value="rating_high" <?php echo ($currentSort == 'rating_high') ? 'selected' : ''; ?>>Rating (High to Low)</option>
                        <option value="rating_low" <?php echo ($currentSort == 'rating_low') ? 'selected' : ''; ?>>Rating (Low to High)</option>
                        <option value="year_new" <?php echo ($currentSort == 'year_new') ? 'selected' : ''; ?>>Year (Newest)</option>
                        <option value="year_old" <?php echo ($currentSort == 'year_old') ? 'selected' : ''; ?>>Year (Oldest)</option>
                    </select>
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="row mt-4">
                <div class="col-12 d-flex flex-wrap gap-2 justify-content-between align-items-center">
                    <div class="d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-filter me-1"></i> Apply Filters
                        </button>
                        <a href="search.php" class="btn btn-outline-secondary">
                            <i class="fas fa-times me-1"></i> Clear All
                        </a>
                    </div>
                    
                    <!-- Quick Search Tags -->
                    <div class="quick-search-tags d-none d-md-flex align-items-center gap-2">
                        <span class="text-secondary">Quick:</span>
                        <a href="search.php?search_query=action&sort=rating_high" class="badge bg-primary text-decoration-none">Top Action</a>
                        <a href="search.php?rating=9%2B&sort=rating_high" class="badge bg-warning text-dark text-decoration-none">Best Rated</a>
                        <a href="search.php?year=2015&sort=newest" class="badge bg-info text-decoration-none">2015 Films</a>
                        <a href="search.php?genre=Comedy&sort=rating_high" class="badge bg-success text-decoration-none">Top Comedies</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
    
    <?php 
    // Check if any search/filter is applied
    $hasSearch = !empty($currentSearch) || !empty($currentGenre) || !empty($currentYear) || !empty($currentRating);
    
    if($hasSearch) { 
        // Build the count query using the movies view (which already has actors and genre)
        $countSql = "SELECT COUNT(*) AS total FROM movies WHERE status='Active' ";
        
        if(!empty($currentSearch)) {
            $searchQuery = $database->escape_value($currentSearch);
            $countSql .= "AND (movie_title LIKE '%$searchQuery%' ";
            $countSql .= "OR director LIKE '%$searchQuery%' ";
            $countSql .= "OR movie_desc LIKE '%$searchQuery%' ";
            $countSql .= "OR actors LIKE '%$searchQuery%') ";
        }
        
        if(!empty($currentGenre)) {
            $genreEsc = $database->escape_value($currentGenre);
            $countSql .= "AND genre LIKE '%$genreEsc%' ";
        }
        
        if(!empty($currentYear)) {
            $yearEsc = $database->escape_value($currentYear);
            $countSql .= "AND year = '$yearEsc' ";
        }
        
        if(!empty($currentRating)) {
            $ratingVal = str_replace('+', '', $currentRating);
            $countSql .= "AND rating >= $ratingVal ";
        }
        
        $countResult = $database->query($countSql);
        $totalRow = $database->fetch_array($countResult);
        $total = $totalRow['total'];
    ?>
    
    <!-- Search Results -->
    <div class="row">
        <div class="col-12">
            <!-- Results Header -->
            <div class="results-header content-card p-3 mb-4">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                    <div class="results-info">
                        <h4 class="mb-0">
                            <i class="fas fa-film text-primary me-2"></i>
                            <?php if($total > 0) { 
                                echo '<span class="text-primary">' . $total . '</span> ' . ($total > 1 ? 'Movies' : 'Movie') . ' Found';
                            } else {
                                echo 'No Movies Found';
                            } ?>
                        </h4>
                        <?php if(!empty($currentSearch) || !empty($currentGenre) || !empty($currentYear) || !empty($currentRating)) { ?>
                        <div class="active-filters mt-2">
                            <?php if(!empty($currentSearch)) { ?>
                                <span class="filter-tag"><i class="fas fa-search"></i> "<?php echo $currentSearch; ?>"</span>
                            <?php } ?>
                            <?php if(!empty($currentGenre)) { ?>
                                <span class="filter-tag"><i class="fas fa-theater-masks"></i> <?php echo $currentGenre; ?></span>
                            <?php } ?>
                            <?php if(!empty($currentYear)) { ?>
                                <span class="filter-tag"><i class="fas fa-calendar"></i> <?php echo $currentYear; ?></span>
                            <?php } ?>
                            <?php if(!empty($currentRating)) { ?>
                                <span class="filter-tag"><i class="fas fa-star"></i> <?php echo $currentRating; ?></span>
                            <?php } ?>
                        </div>
                        <?php } ?>
                    </div>
                    
                    <?php if($total > 0) { ?>
                    <div class="d-flex align-items-center gap-3">
                        <div class="view-options d-flex gap-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary active" id="gridViewBtn" title="Grid View">
                                <i class="fas fa-th"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-secondary" id="listViewBtn" title="List View">
                                <i class="fas fa-list"></i>
                            </button>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <label for="pagination-setting" class="text-secondary mb-0">
                                <i class="fas fa-cog"></i>
                            </label>
                            <select name="pagination-setting" onChange="changePagination(this.value);" class="modern-select" id="pagination-setting">
                                <option value="all-links" selected>All Pages</option>
                                <option value="prev-next">Prev/Next Only</option>
                            </select>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
            
            <?php if($total > 0) { ?>
            <!-- Results Grid -->
            <div id="pagination-result">
                <input type="hidden" name="rowcount" id="rowcount" />
            </div>
            <?php } else { ?>
            <!-- Empty State -->
            <div class="empty-state">
                <i class="fas fa-search"></i>
                <h4>No Results Found</h4>
                <p>We couldn't find any movies matching your search criteria.</p>
                <p class="text-muted">Try adjusting your filters or using different keywords</p>
                <div class="mt-4 d-flex flex-wrap gap-2 justify-content-center">
                    <a href="search.php" class="btn btn-outline-light">
                        <i class="fas fa-redo"></i> Reset Filters
                    </a>
                    <a href="movie.php" class="btn btn-primary">
                        <i class="fas fa-film"></i> Browse All Movies
                    </a>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
    
    <?php } else { ?>
    <!-- Initial State - No Search Yet -->
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="empty-state">
                <i class="fas fa-film" style="color: var(--primary-color);"></i>
                <h4>Discover Your Next Favorite Movie</h4>
                <p class="text-secondary">Search through our collection of 600+ movies or use the filters above</p>
                
                <!-- Feature Cards -->
                <div class="row g-4 mt-4">
                    <div class="col-md-4">
                        <div class="feature-card">
                            <i class="fas fa-search text-primary"></i>
                            <h5>Smart Search</h5>
                            <p>Search across titles, actors, directors, and plot descriptions</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="feature-card">
                            <i class="fas fa-filter text-primary"></i>
                            <h5>Advanced Filters</h5>
                            <p>Filter by genre, year, and rating to find exactly what you want</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="feature-card">
                            <i class="fas fa-sort text-primary"></i>
                            <h5>Custom Sorting</h5>
                            <p>Sort results by title, rating, year, or date added</p>
                        </div>
                    </div>
                </div>
                
                <!-- Genre Quick Links -->
                <div class="mt-5">
                    <h5 class="text-secondary mb-3">Popular Genres:</h5>
                    <div class="d-flex flex-wrap justify-content-center gap-2">
                        <a href="search.php?genre=Action" class="btn btn-outline-light">Action</a>
                        <a href="search.php?genre=Comedy" class="btn btn-outline-light">Comedy</a>
                        <a href="search.php?genre=Drama" class="btn btn-outline-light">Drama</a>
                        <a href="search.php?genre=Thriller" class="btn btn-outline-light">Thriller</a>
                        <a href="search.php?genre=Sci-Fi" class="btn btn-outline-light">Sci-Fi</a>
                        <a href="search.php?genre=Horror" class="btn btn-outline-light">Horror</a>
                        <a href="search.php?genre=Romance" class="btn btn-outline-light">Romance</a>
                        <a href="search.php?genre=Adventure" class="btn btn-outline-light">Adventure</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>

<style>
/* Enhanced Search Page Styles */
.search-panel {
    background: linear-gradient(145deg, var(--card-bg), rgba(31, 31, 31, 0.9));
    border: 1px solid rgba(255, 255, 255, 0.05);
}

.filter-label {
    display: block;
    color: var(--text-secondary);
    font-size: 0.85rem;
    margin-bottom: 0.5rem;
    font-weight: 500;
}

.filter-row {
    padding-top: 1rem;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.results-header {
    background: var(--card-bg);
    border-radius: var(--radius-lg);
}

.active-filters {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.filter-tag {
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    padding: 0.25rem 0.75rem;
    background: rgba(229, 9, 20, 0.2);
    border: 1px solid rgba(229, 9, 20, 0.3);
    border-radius: 20px;
    font-size: 0.8rem;
    color: var(--primary-light);
}

.filter-tag i {
    font-size: 0.7rem;
}

.quick-search-tags .badge {
    padding: 0.5rem 0.75rem;
    font-weight: 500;
    transition: all var(--transition-fast);
}

.quick-search-tags .badge:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
}

.feature-card {
    background: var(--card-bg);
    padding: 1.5rem;
    border-radius: var(--radius-lg);
    text-align: center;
    height: 100%;
    transition: all var(--transition-base);
    border: 1px solid rgba(255, 255, 255, 0.05);
}

.feature-card:hover {
    transform: translateY(-5px);
    border-color: rgba(229, 9, 20, 0.3);
}

.feature-card i {
    font-size: 2rem;
    margin-bottom: 1rem;
}

.feature-card h5 {
    color: var(--text-primary);
    margin-bottom: 0.5rem;
}

.feature-card p {
    color: var(--text-secondary);
    font-size: 0.9rem;
    margin: 0;
}

.view-options .btn {
    padding: 0.35rem 0.6rem;
}

.view-options .btn.active {
    background: var(--primary-color);
    border-color: var(--primary-color);
    color: white;
}

/* List view styles */
.movies-grid.list-view {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.movies-grid.list-view .movie-card {
    display: flex;
    flex-direction: row;
    height: auto;
}

.movies-grid.list-view .movie-card-image {
    width: 120px;
    min-width: 120px;
    padding-top: 0;
    height: 180px;
}

.movies-grid.list-view .movie-card-body {
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: 1rem 1.5rem;
}

.movies-grid.list-view .movie-card-overlay {
    display: none;
}

@media (max-width: 768px) {
    .hero-search {
        flex-direction: column;
    }
    
    .hero-search button {
        width: 100%;
    }
    
    .view-options {
        display: none !important;
    }
    
    .quick-search-tags {
        display: none !important;
    }
}
</style>

<?php include 'includes/footer.inc.php'; ?>