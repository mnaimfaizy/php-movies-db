<?php include 'includes/header.inc.php'; ?>
<?php include 'includes/nav.inc.php'; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">
              <i class="fas fa-info-circle mr-2" style="color: #667eea;"></i>
              Movie Details
            </h1>
            <p class="text-muted mb-0 mt-1">View complete movie information</p>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <?php include 'includes/breadcrumbs.php'; ?>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

<?php if(isset($_GET['imdb_id'])) { 
	$imdb_id = urlencode($_GET['imdb_id']);
	$url = "http://omdbapi.com/?i=$imdb_id&apikey=2db3e567&plot=full&r=xml";
	
	$result = xml2array($url);
	
	foreach($result as $result1) {
		foreach($result1 as $result2) {
			if(isset($result2['title'])) {
				$title = $result2['title'];
				$year = $result2['year'];
				$released = $result2['released'];
				$runtime = $result2['runtime'];
				$genre = $result2['genre'];
				$director = $result2['director'];
				$actors = $result2['actors'];
				$description = $result2['plot'];
				$language = $result2['language'];
				$country = $result2['country'];
				$poster = $result2['poster'];
				$rating = $result2['imdbRating'];
				$imdbVotes = $result2['imdbVotes'];
				$imdbID = $result2['imdbID'];
				$type = $result2['type'];
			}
		}
	}
?>
        <div class="row">
          <div class="col-lg-4">
            <div class="card">
              <div class="card-body text-center">
                <img src="<?php echo $poster; ?>" alt="<?php echo $title; ?>" class="img-fluid" style="border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.2); max-width: 100%;">
                <h4 class="mt-3 mb-1"><?php echo $title; ?></h4>
                <p class="text-muted mb-2"><?php echo $year; ?> • <?php echo $runtime; ?></p>
                <div class="mb-3">
                  <span class="badge badge-warning" style="font-size: 1rem; padding: 0.5rem 1rem;">
                    <i class="fas fa-star mr-1"></i> <?php echo $rating; ?>/10
                  </span>
                </div>
                <a href="https://www.imdb.com/title/<?php echo $imdbID; ?>" target="_blank" class="btn btn-outline-primary">
                  <i class="fab fa-imdb mr-1"></i> View on IMDB
                </a>
              </div>
            </div>
          </div>
          
          <div class="col-lg-8">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="m-0"><i class="fas fa-film mr-2"></i> Movie Information</h5>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label class="text-muted mb-1"><small>GENRE</small></label>
                      <p class="mb-0"><strong><?php echo $genre; ?></strong></p>
                    </div>
                    <div class="mb-3">
                      <label class="text-muted mb-1"><small>DIRECTOR</small></label>
                      <p class="mb-0"><strong><?php echo $director; ?></strong></p>
                    </div>
                    <div class="mb-3">
                      <label class="text-muted mb-1"><small>LANGUAGE</small></label>
                      <p class="mb-0"><strong><?php echo $language; ?></strong></p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label class="text-muted mb-1"><small>COUNTRY</small></label>
                      <p class="mb-0"><strong><?php echo $country; ?></strong></p>
                    </div>
                    <div class="mb-3">
                      <label class="text-muted mb-1"><small>RELEASE DATE</small></label>
                      <p class="mb-0"><strong><?php echo $released; ?></strong></p>
                    </div>
                    <div class="mb-3">
                      <label class="text-muted mb-1"><small>IMDB VOTES</small></label>
                      <p class="mb-0"><strong><?php echo $imdbVotes; ?></strong></p>
                    </div>
                  </div>
                </div>
                
                <hr>
                
                <div class="mb-3">
                  <label class="text-muted mb-1"><small>CAST</small></label>
                  <p class="mb-0"><strong><?php echo $actors; ?></strong></p>
                </div>
                
                <hr>
                
                <div class="mb-0">
                  <label class="text-muted mb-1"><small>PLOT</small></label>
                  <p class="mb-0"><?php echo $description; ?></p>
                </div>
              </div>
            </div>
            
            <div class="text-right">
              <a href="movie_list.php" class="btn btn-secondary">
                <i class="fas fa-arrow-left mr-1"></i> Back to Movies
              </a>
            </div>
          </div>
        </div>
<?php } else if(isset($_GET['movie_id'])) { 
	$movie_id = (int)$_GET['movie_id'];
	$movie_query = $database->query("SELECT * FROM movie_table WHERE movie_id=$movie_id LIMIT 1");
	$movie = $database->fetch_array($movie_query);
	
	if($movie) {
?>
        <div class="row">
          <div class="col-lg-4">
            <div class="card">
              <div class="card-body text-center">
                <?php if($movie['poster']) { ?>
                  <img src="../assets/images/movie_poster/<?php echo $movie['poster']; ?>" alt="<?php echo $movie['movie_title']; ?>" class="img-fluid" style="border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.2); max-width: 100%;">
                <?php } else { ?>
                  <div style="height: 300px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-film text-white" style="font-size: 4rem;"></i>
                  </div>
                <?php } ?>
                <h4 class="mt-3 mb-1"><?php echo $movie['movie_title']; ?></h4>
                <p class="text-muted mb-2"><?php echo $movie['year']; ?> • <?php echo $movie['duration']; ?></p>
                <div class="mb-3">
                  <span class="badge badge-warning" style="font-size: 1rem; padding: 0.5rem 1rem;">
                    <i class="fas fa-star mr-1"></i> <?php echo $movie['rating']; ?>/10
                  </span>
                </div>
                <?php if($movie['imdb_link']) { ?>
                <a href="https://www.imdb.com/title/<?php echo $movie['imdb_link']; ?>" target="_blank" class="btn btn-outline-primary">
                  <i class="fab fa-imdb mr-1"></i> View on IMDB
                </a>
                <?php } ?>
              </div>
            </div>
          </div>
          
          <div class="col-lg-8">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="m-0"><i class="fas fa-film mr-2"></i> Movie Information</h5>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label class="text-muted mb-1"><small>DIRECTOR</small></label>
                      <p class="mb-0"><strong><?php echo $movie['director']; ?></strong></p>
                    </div>
                    <div class="mb-3">
                      <label class="text-muted mb-1"><small>COUNTRY</small></label>
                      <p class="mb-0"><strong><?php echo $movie['country']; ?></strong></p>
                    </div>
                    <div class="mb-3">
                      <label class="text-muted mb-1"><small>STATUS</small></label>
                      <p class="mb-0">
                        <?php if($movie['status'] == 'Active') { ?>
                          <span class="status-active"><?php echo $movie['status']; ?></span>
                        <?php } else { ?>
                          <span class="status-inactive"><?php echo $movie['status']; ?></span>
                        <?php } ?>
                      </p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label class="text-muted mb-1"><small>RELEASE DATE</small></label>
                      <p class="mb-0"><strong><?php echo $movie['release_date']; ?></strong></p>
                    </div>
                    <div class="mb-3">
                      <label class="text-muted mb-1"><small>ADDED ON</small></label>
                      <p class="mb-0"><strong><?php echo date('M d, Y', $movie['date_added']); ?></strong></p>
                    </div>
                    <?php if($movie['trailer']) { ?>
                    <div class="mb-3">
                      <label class="text-muted mb-1"><small>TRAILER</small></label>
                      <p class="mb-0">
                        <a href="<?php echo $movie['trailer']; ?>" target="_blank" class="btn btn-sm btn-danger">
                          <i class="fab fa-youtube mr-1"></i> Watch Trailer
                        </a>
                      </p>
                    </div>
                    <?php } ?>
                  </div>
                </div>
                
                <hr>
                
                <div class="mb-0">
                  <label class="text-muted mb-1"><small>DESCRIPTION</small></label>
                  <p class="mb-0"><?php echo $movie['movie_desc']; ?></p>
                </div>
              </div>
            </div>
            
            <div class="text-right">
              <button class="btn btn-danger mr-2" onclick="deleteMovie(<?php echo $movie['movie_id']; ?>)">
                <i class="fas fa-trash mr-1"></i> Delete Movie
              </button>
              <a href="movie_list.php" class="btn btn-secondary">
                <i class="fas fa-arrow-left mr-1"></i> Back to Movies
              </a>
            </div>
          </div>
        </div>
<?php 
	} else {
		echo '<div class="alert alert-danger"><i class="fas fa-exclamation-triangle mr-2"></i> Movie not found!</div>';
	}
} else { 
	echo '<div class="alert alert-warning"><i class="fas fa-exclamation-circle mr-2"></i> Please select a movie to view details.</div>';
} ?>

      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include 'includes/footer.inc.php'; ?>