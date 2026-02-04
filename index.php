<?php include 'includes/header.inc.php'; ?>

<!-- Modern Hero Slider -->
<div class="hero-slider">
    <?php
    // Get 3 random featured movies for hero slider
    $sql = "SELECT movie_id, movie_title, movie_desc, poster, rating FROM movie_table WHERE rating >= 7.0 ORDER BY RAND() LIMIT 3";
    $hero_result = $database->query($sql);
    $slide_index = 0;
    
    while($hero_movie = $database->fetch_array($hero_result)) {
        $active_class = $slide_index === 0 ? 'active' : '';
        $bg_image = strpos($hero_movie['poster'], 'http') === 0 ? $hero_movie['poster'] : 'assets/images/movie_poster/'.$hero_movie['poster'];
        ?>
        <div class="hero-slide <?php echo $active_class; ?>" style="background-image: url('<?php echo $bg_image; ?>')">
            <div class="hero-overlay"></div>
            <div class="container hero-content">
                <h1 class="display-3 fw-bold text-white mb-3"><?php echo htmlspecialchars($hero_movie['movie_title']); ?></h1>
                <p class="lead text-white mb-4">
                    <i class="fas fa-star text-warning"></i> <?php echo $hero_movie['rating']; ?>/10 &nbsp;•&nbsp; 
                    <?php echo substr(strip_tags($hero_movie['movie_desc']), 0, 150); ?>...
                </p>
                <div class="d-flex gap-3">
                    <a href="single.php?movie_id=<?php echo $hero_movie['movie_id']; ?>" class="btn btn-primary btn-lg">
                        <i class="fas fa-play"></i> Watch Now
                    </a>
                    <a href="single.php?movie_id=<?php echo $hero_movie['movie_id']; ?>" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-info-circle"></i> More Info
                    </a>
                </div>
            </div>
        </div>
    <?php 
        $slide_index++;
    } 
    ?>
</div>

<!-- Hero Search Bar (Standalone below slider) -->
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="hero-search">
                <input type="text" class="form-control form-control-lg" placeholder="Search for movies, actors, genres..." id="heroSearch" autocomplete="off">
                <button class="btn btn-primary btn-lg">
                    <i class="fas fa-search"></i> Search
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Stats Section -->
<div class="stats-section py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="stat-card glass-effect p-4 rounded-3 text-center hover-lift">
                    <div class="stat-icon mb-3">
                        <i class="fas fa-film fa-3x text-primary"></i>
                    </div>
                    <h2 class="stat-number fw-bold mb-2"><?php 
                        $query = "SELECT COUNT(*) AS total_movies FROM movie_table";
                        $query_result = $database->query($query);
                        $movies_total = $database->fetch_array($query_result);
                        echo number_format($movies_total['total_movies']); 
                    ?></h2>
                    <p class="stat-label text-secondary mb-0">Total Movies</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card glass-effect p-4 rounded-3 text-center hover-lift">
                    <div class="stat-icon mb-3">
                        <i class="fas fa-users fa-3x text-primary"></i>
                    </div>
                    <h2 class="stat-number fw-bold mb-2"><?php 
                        $query = "SELECT COUNT(*) AS total_actors FROM actors_table";
                        $query_result = $database->query($query);
                        $actors_total = $database->fetch_array($query_result);
                        echo number_format($actors_total['total_actors']); 
                    ?></h2>
                    <p class="stat-label text-secondary mb-0">Total Actors</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card glass-effect p-4 rounded-3 text-center hover-lift">
                    <div class="stat-icon mb-3">
                        <i class="fas fa-calendar-alt fa-3x text-primary"></i>
                    </div>
                    <h2 class="stat-number fw-bold mb-2"><?php echo date('Y'); ?></h2>
                    <p class="stat-label text-secondary mb-0">Updated <?php echo date('F d'); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container">
        <!-- Search Results (Hidden by default) -->
        <div id="search-results-section" style="display: none;" class="mb-5">
            <div class="section-header">
                <h2>Search Results</h2>
                <p id="search-results-count"></p>
            </div>
            <div id="update">
                <ul class="searchresults"></ul>
            </div>
        </div>

        <!-- Featured Movies Section -->
        <div class="section-header mb-4">
            <h2><i class="fas fa-star text-warning me-2"></i>Featured Movies</h2>
            <p>Discover our handpicked collection of must-watch films</p>
        </div>

        <!-- Filters and Pagination -->
        <div class="row mb-4 align-items-center">
            <div class="col-md-6">
                <div class="d-flex align-items-center gap-2">
                    <label class="text-secondary mb-0">Pagination Style:</label>
                    <select name="pagination-setting" onChange="changePagination(this.value);" class="form-select form-select-sm" id="pagination-setting" style="max-width: 250px;">
                        <option value="all-links" selected="selected">Show All Pages</option>
                        <option value="prev-next">Previous/Next Only</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6 text-end">
                <span class="text-secondary"><i class="fas fa-filter me-2"></i>Showing latest movies</span>
            </div>
        </div>

        <!-- Movies Grid -->
        <div id="pagination-result" class="mb-5">
            <input type="hidden" name="rowcount" id="rowcount" />
        </div>
        
        <!-- Latest Movies Section -->
        <div class="section-header mt-5">
            <h2><i class="fas fa-clock text-primary me-2"></i>Recently Added</h2>
            <p>Check out the newest additions to our collection</p>
        </div>
        <div id="latest-movies" class="movies-grid mb-5">
            <?php 
            $sql = "SELECT * FROM movie_table WHERE status='Active' ORDER BY movie_id DESC LIMIT 12";
            $result = $database->query($sql);
            while($movie = $database->fetch_array($result)) { 
                $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-z]{2,3}(\/\S*)?/";
                $text = $movie['poster'];
                if(preg_match($reg_exUrl, $text, $url)) {
                    $poster = $url[0];
                } else {
                    $poster = !empty($movie['poster']) ? 'assets/images/movie_poster/'.$movie['poster'] : 'assets/images/movie_poster/default.jpg';
                }
                ?>
                <div class="movie-card">
                    <a href="single.php?movie_id=<?php echo $movie['movie_id']; ?>">
                        <div class="movie-poster">
                            <img src="<?php echo $poster; ?>" alt="<?php echo htmlspecialchars($movie['movie_title']); ?>" loading="lazy">
                            <div class="movie-overlay">
                                <div class="movie-actions">
                                    <button class="btn-circle" title="Watch Now">
                                        <i class="fas fa-play"></i>
                                    </button>
                                    <button class="btn-circle" title="More Info">
                                        <i class="fas fa-info"></i>
                                    </button>
                                </div>
                            </div>
                            <?php if(!empty($movie['rating'])) { ?>
                            <div class="movie-rating">
                                <i class="fas fa-star"></i> <?php echo $movie['rating']; ?>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="movie-info">
                            <h3 class="movie-title"><?php echo htmlspecialchars($movie['movie_title']); ?></h3>
                            <p class="movie-meta">
                                <span class="year"><?php echo $movie['year']; ?></span>
                                <?php if(!empty($movie['duration'])) { ?>
                                <span class="duration"><?php echo $movie['duration']; ?></span>
                                <?php } ?>
                            </p>
                        </div>
                    </a>
                </div>
            <?php } ?>
        </div>
      </div>
   </div>
 </div>
 
<?php include 'includes/footer.inc.php'; ?>