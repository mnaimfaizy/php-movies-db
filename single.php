<?php include 'includes/header.inc.php'; ?>
<?php 
	// Retrive data from the movie table according to the selected movie id.
	if(isset($_GET['movie_id'])) {
		$movie_id = $_GET['movie_id'];
		$sql = "SELECT * FROM movie_table WHERE movie_id=$movie_id LIMIT 1";
		$result = $database->query($sql);
		$movie_info = $database->fetch_array($result);
		
		// Data fetched from table
		$movie_id = $movie_info['movie_id'];
		$movie_title = $movie_info['movie_title'];
		$country = $movie_info['country'];
		$year = $movie_info['year'];
		$rating = $movie_info['rating'];
		$release_date = $movie_info['release_date'];
		$directors = $movie_info['director'];
		$movie_description = $movie_info['movie_desc'];
		$trailer = $movie_info['trailer'];
		// The Regular Express filter
		$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-z]{2,3}(\/\S*)?/";
		// The text you want to filter goes here. 
		$text = $movie_info['poster'];
		// Check if there is a url in the text
		if(preg_match($reg_exUrl, $text, $url)) {
			$poster = $url[0];
		} else {
			$poster = 'assets/images/movie_poster/'.$movie_info['poster'];
		}
		$duration = $movie_info['duration'];
		$imdb_link = $movie_info['imdb_link'];
		
	}
?>

<!-- Modern Movie Backdrop Header -->
<div class="movie-backdrop" style="background-image: linear-gradient(to right, rgba(20,20,20,0.95) 0%, rgba(20,20,20,0.7) 50%, rgba(20,20,20,0.95) 100%), url('<?php echo $poster; ?>');">
	<div class="container py-5">
		<div class="row align-items-center" style="min-height: 400px;">
			<!-- Movie Poster -->
			<div class="col-md-3">
				<div class="movie-poster-large shadow-lg" style="border-radius: 12px; overflow: hidden;">
					<img src="<?php echo $poster; ?>" alt="<?php echo htmlspecialchars($movie_title); ?>" class="img-fluid">
				</div>
			</div>
			
			<!-- Movie Info -->
			<div class="col-md-9 text-white">
				<h1 class="display-4 fw-bold mb-3"><?php echo htmlspecialchars($movie_title); ?></h1>
				
				<!-- Meta Badges -->
				<div class="d-flex flex-wrap gap-2 mb-3">
					<span class="badge bg-warning text-dark fs-6">
						<i class="fas fa-star"></i> <?php echo $rating; ?>/10
					</span>
					<span class="badge bg-secondary fs-6">
						<i class="far fa-calendar"></i> <?php echo $year; ?>
					</span>
					<span class="badge bg-secondary fs-6">
						<i class="far fa-clock"></i> <?php echo $duration; ?>
					</span>
					<span class="badge bg-secondary fs-6">
						<i class="fas fa-globe"></i> <?php echo $country; ?>
					</span>
					<?php 
					$sql1 = "SELECT genre.genre_id, genre.genre FROM `movie_genre_table`
							LEFT JOIN genre ON genre.genre_id=movie_genre_table.genre_id
							WHERE movie_genre_table.movie_id=$movie_id LIMIT 3";
					$sql1_result = $database->query($sql1);
					while($genre = $database->fetch_array($sql1_result)) { ?>
						<span class="badge bg-danger">
							<a href="movie.php?genre_id=<?php echo $genre['genre_id']; ?>" class="text-white text-decoration-none">
								<?php echo $genre['genre']; ?>
							</a>
						</span>
					<?php } ?>
				</div>
				
				<!-- Tagline/Description Preview -->
				<p class="lead mb-4" style="max-width: 800px;">
					<?php echo substr(strip_tags($movie_description), 0, 200); ?>...
				</p>
				
				<!-- Action Buttons -->
				<div class="d-flex gap-3 mb-3">
					<a href="<?php echo $trailer; ?>" class="btn btn-primary btn-lg popup-youtube">
						<i class="fas fa-play"></i> Watch Trailer
					</a>
					<a href="<?php echo $imdb_link; ?>" target="_blank" class="btn btn-outline-light btn-lg">
						<i class="fab fa-imdb"></i> IMDb
					</a>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Main Content Area -->
<div class="container my-5">
	<div class="row">
		<div class="col-lg-8">
			<!-- Tabbed Content -->
			<ul class="nav nav-tabs mb-4" id="movieTabs" role="tablist">
				<li class="nav-item" role="presentation">
					<button class="nav-link active" id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview" type="button" role="tab">
						<i class="fas fa-info-circle"></i> Overview
					</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link" id="cast-tab" data-bs-toggle="tab" data-bs-target="#cast" type="button" role="tab">
						<i class="fas fa-users"></i> Cast & Crew
					</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab">
						<i class="fas fa-comments"></i> Reviews (<?php 
							$sql = "SELECT COUNT(*) AS total FROM comments WHERE movie_id=$movie_id";
							$result = $database->query($sql);
							$comment_count = $database->fetch_array($result);
							echo $comment_count['total']; 
						?>)
					</button>
				</li>
			</ul>

			<div class="tab-content" id="movieTabContent">
				<!-- Overview Tab -->
				<div class="tab-pane fade show active" id="overview" role="tabpanel">
					<div class="card glass-effect border-0 mb-4">
						<div class="card-body p-4">
							<h4 class="mb-3"><i class="fas fa-film me-2 text-primary"></i>Synopsis</h4>
							<p class="text-secondary" style="line-height: 1.8;">
								<?php echo nl2br(htmlspecialchars($movie_description)); ?>
							</p>
						</div>
					</div>
					
					<div class="card glass-effect border-0">
						<div class="card-body p-4">
							<h4 class="mb-3"><i class="fas fa-info me-2 text-primary"></i>Movie Details</h4>
							<div class="row">
								<div class="col-md-6 mb-3">
									<strong class="text-secondary">Release Date:</strong><br>
									<span class="text-white"><?php echo $release_date; ?></span>
								</div>
								<div class="col-md-6 mb-3">
									<strong class="text-secondary">Duration:</strong><br>
									<span class="text-white"><?php echo $duration; ?></span>
								</div>
								<div class="col-md-6 mb-3">
									<strong class="text-secondary">Country:</strong><br>
									<span class="text-white"><?php echo $country; ?></span>
								</div>
								<div class="col-md-6 mb-3">
									<strong class="text-secondary">Rating:</strong><br>
									<span class="text-warning fs-5">
										<i class="fas fa-star"></i> <?php echo $rating; ?>/10
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Cast & Crew Tab -->
				<div class="tab-pane fade" id="cast" role="tabpanel">
					<!-- Directors -->
					<div class="card glass-effect border-0 mb-4">
						<div class="card-body p-4">
							<h4 class="mb-3"><i class="fas fa-video me-2 text-primary"></i>Directors</h4>
							<div class="d-flex flex-wrap gap-3">
								<?php 
								$dir = explode(', ', $directors);
								foreach($dir as $director) { ?>
									<div class="director-card p-3 glass-effect rounded">
										<a href="actor_details.php?actor_name=<?php echo urlencode($director); ?>" class="text-decoration-none">
											<i class="fas fa-user-tie fa-2x text-primary mb-2"></i>
											<p class="mb-0 text-white"><?php echo htmlspecialchars($director); ?></p>
										</a>
									</div>
								<?php } ?>
							</div>
						</div>
					</div>

					<!-- Cast Members -->
					<div class="card glass-effect border-0">
						<div class="card-body p-4">
							<h4 class="mb-4"><i class="fas fa-users me-2 text-primary"></i>Cast Members</h4>
							<div class="row g-3">
								<?php 
								$sql = "SELECT actor_id FROM movie_actors_table WHERE movie_id=$movie_id";
								$result = $database->query($sql);
								if($database->num_rows($result) > 0) {
									while($actor = $database->fetch_array($result)) {
										$actor_id = $actor['actor_id'];
										$sql1 = "SELECT actor_name FROM actors_table WHERE actor_id=$actor_id";
										$sql1_result1 = $database->query($sql1);
										while($actor1 = $database->fetch_array($sql1_result1)) { ?>
											<div class="col-md-4 col-sm-6">
												<div class="cast-card p-3 glass-effect rounded text-center hover-lift">
													<a href="actor_details.php?actor_name=<?php echo urlencode($actor1['actor_name']); ?>" class="text-decoration-none">
														<div class="cast-avatar mb-2">
															<i class="fas fa-user-circle fa-3x text-primary"></i>
														</div>
														<p class="mb-0 text-white fw-semibold"><?php echo htmlspecialchars($actor1['actor_name']); ?></p>
													</a>
												</div>
											</div>
										<?php }
									}
								} else { 
									echo '<p class="text-secondary">No cast information available.</p>';
								} ?>
							</div>
						</div>
					</div>
				</div>

				<!-- Reviews Tab -->
				<div class="tab-pane fade" id="reviews" role="tabpanel">
					<!-- Add Review Form -->
					<div class="card glass-effect border-0 mb-4">
						<div class="card-body p-4">
							<h4 class="mb-3"><i class="fas fa-pen me-2 text-primary"></i>Write a Review</h4>
							
							<form action="submit_comment.php" method="post" class="needs-validation" novalidate>
								<div class="row mb-3">
									<div class="col-md-6">
										<label for="name" class="form-label text-secondary">Name *</label>
										<input type="text" class="form-control" id="name" name="name" required placeholder="Your name">
									</div>
									<div class="col-md-6">
										<label for="email" class="form-label text-secondary">Email *</label>
										<input type="email" class="form-control" id="email" name="email" required placeholder="your@email.com">
									</div>
								</div>
								<div class="mb-3">
									<label for="message" class="form-label text-secondary">Your Review *</label>
									<textarea class="form-control" id="message" name="message" rows="4" required placeholder="Share your thoughts about this movie..."></textarea>
								</div>
								<input type="hidden" name="movie_id" value="<?php echo $movie_id; ?>">
								<button type="submit" name="submit" class="btn btn-primary">
									<i class="fas fa-paper-plane"></i> Submit Review
								</button>
							</form>
						</div>
					</div>

					<!-- Reviews List -->
					<div class="card glass-effect border-0">
						<div class="card-body p-4">
							<h4 class="mb-4"><i class="fas fa-comments me-2 text-primary"></i>User Reviews</h4>
							<?php 
							$sql = "SELECT * FROM comments WHERE movie_id=$movie_id ORDER BY comment_id DESC";
							$result = $database->query($sql);
							if($database->num_rows($result) > 0) {
								while($comment = $database->fetch_array($result)) { ?>
									<div class="review-item mb-4 pb-4 border-bottom border-secondary">
										<div class="d-flex gap-3">
											<div class="review-avatar">
												<img src="assets/images/Woman_Man_Avatar_45x45.png" class="rounded-circle" alt="User" width="50" height="50">
											</div>
											<div class="flex-grow-1">
												<div class="d-flex justify-content-between align-items-start mb-2">
													<div>
														<h6 class="mb-1 text-white"><?php echo htmlspecialchars($comment['name']); ?></h6>
														<small class="text-secondary">
															<i class="far fa-clock"></i> <?php echo date("F j, Y", $comment['date']); ?>
														</small>
													</div>
												</div>
												<p class="text-secondary mb-0"><?php echo nl2br(htmlspecialchars($comment['message'])); ?></p>
											</div>
										</div>
									</div>
								<?php }
							} else { ?>
								<div class="text-center py-5">
									<i class="fas fa-comments fa-3x text-secondary mb-3"></i>
									<p class="text-secondary">No reviews yet. Be the first to review this movie!</p>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Sidebar: Related Movies -->
		<div class="col-lg-4">
			<div class="card glass-effect border-0">
				<div class="card-body p-4">
					<h4 class="mb-4"><i class="fas fa-film me-2 text-primary"></i>Related Movies</h4>
					<div class="related-movies">
						<?php 
						$sql = "SELECT genre_id FROM movie_genre_table WHERE movie_id=$movie_id LIMIT 1";
						$genre_result = $database->query($sql);
						if($database->num_rows($genre_result) > 0) {
							$genre_id_row = $database->fetch_array($genre_result);
							$genre_id = $genre_id_row['genre_id'];
							$query = "SELECT DISTINCT mt.movie_id, mt.movie_title, mt.poster, mt.rating, mt.year 
									  FROM movie_table mt
									  JOIN movie_genre_table mgt ON mt.movie_id = mgt.movie_id
									  WHERE mgt.genre_id=$genre_id AND mt.movie_id != $movie_id
									  ORDER BY RAND() LIMIT 6";
							$query_res = $database->query($query);
							
							while($related_movie = $database->fetch_array($query_res)) {
								$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-z]{2,3}(\/\S*)?/";
								$text = isset($related_movie['poster']) ? $related_movie['poster'] : '';
								if(preg_match($reg_exUrl, $text, $url)) {
									$related_poster = $url[0];
								} else {
									$related_poster = !empty($related_movie['poster']) ? 'assets/images/movie_poster/'.$related_movie['poster'] : 'assets/images/movie_poster/default.jpg';
								}
								?>
								<div class="related-movie-item mb-3">
									<a href="single.php?movie_id=<?php echo $related_movie['movie_id']; ?>" class="text-decoration-none">
										<div class="d-flex gap-3 p-2 rounded hover-lift" style="transition: all 0.3s ease;">
											<img src="<?php echo $related_poster; ?>" alt="<?php echo htmlspecialchars($related_movie['movie_title']); ?>" class="rounded" style="width: 80px; height: 120px; object-fit: cover;">
											<div class="flex-grow-1">
												<h6 class="text-white mb-1"><?php echo htmlspecialchars($related_movie['movie_title']); ?></h6>
												<small class="text-secondary">
													<i class="far fa-calendar"></i> <?php echo $related_movie['year']; ?>
												</small><br>
												<small class="text-warning">
													<i class="fas fa-star"></i> <?php echo $related_movie['rating']; ?>/10
												</small>
											</div>
										</div>
									</a>
								</div>
							<?php }
						} else {
							echo '<p class="text-secondary">No related movies found.</p>';
						} ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<style>
/* Movie Backdrop Styles */
.movie-backdrop {
	background-size: cover;
	background-position: center;
	min-height: 500px;
	margin-top: 70px;
	position: relative;
}

.movie-poster-large {
	transition: transform 0.3s ease;
}

.movie-poster-large:hover {
	transform: scale(1.05);
}

/* Tab Styles */
.nav-tabs {
	border-bottom: 2px solid rgba(255,255,255,0.1);
}

.nav-tabs .nav-link {
	color: var(--text-secondary);
	border: none;
	padding: 1rem 1.5rem;
	transition: all 0.3s ease;
}

.nav-tabs .nav-link:hover {
	color: var(--text-primary);
	background: rgba(255,255,255,0.05);
}

.nav-tabs .nav-link.active {
	color: var(--primary-color);
	background: transparent;
	border-bottom: 3px solid var(--primary-color);
}

/* Cast & Director Cards */
.cast-card, .director-card {
	transition: all 0.3s ease;
	cursor: pointer;
}

.cast-card:hover, .director-card:hover {
	transform: translateY(-5px);
	background: rgba(255,255,255,0.1) !important;
}

/* Review Items */
.review-item:last-child {
	border-bottom: none !important;
	padding-bottom: 0 !important;
	margin-bottom: 0 !important;
}

/* Related Movies Hover */
.related-movie-item:hover {
	background: rgba(255,255,255,0.05);
}

/* Form Styles */
.form-control {
	background: rgba(255,255,255,0.05);
	border: 1px solid rgba(255,255,255,0.1);
	color: var(--text-primary);
}

.form-control:focus {
	background: rgba(255,255,255,0.08);
	border-color: var(--primary-color);
	color: var(--text-primary);
	box-shadow: 0 0 0 0.2rem rgba(229,9,20,0.25);
}

.form-control::placeholder {
	color: var(--text-muted);
}

.form-label {
	font-weight: 500;
}
</style>

<script>
// Show toast notification based on URL parameters (from comment submission)
document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    
    if(urlParams.has('success') && urlParams.get('success') === '1') {
        showToast('Your review has been submitted successfully! Thanks for sharing your thoughts.', 'success');
        // Switch to reviews tab
        const reviewsTab = new bootstrap.Tab(document.getElementById('reviews-tab'));
        reviewsTab.show();
        // Clean URL
        const movieId = urlParams.get('movie_id');
        window.history.replaceState({}, document.title, window.location.pathname + '?movie_id=' + movieId);
    } else if(urlParams.has('error')) {
        const errorMsg = urlParams.get('error') === '1' 
            ? 'Sorry! There was a problem submitting your review. Please try again.' 
            : decodeURIComponent(urlParams.get('error'));
        showToast(errorMsg, 'error');
        // Switch to reviews tab
        const reviewsTab = new bootstrap.Tab(document.getElementById('reviews-tab'));
        reviewsTab.show();
        // Clean URL
        const movieId = urlParams.get('movie_id');
        window.history.replaceState({}, document.title, window.location.pathname + '?movie_id=' + movieId);
    }
});
</script>

<?php include 'includes/footer.inc.php'; ?>