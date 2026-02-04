<?php include 'includes/header.inc.php'; ?>

<?php 
// Get statistics from database
$total_movies = $database->fetch_array($database->query("SELECT COUNT(*) as total FROM movie_table"))['total'];
$active_movies = $database->fetch_array($database->query("SELECT COUNT(*) as total FROM movie_table WHERE status='Active'"))['total'];
$total_genres = $database->fetch_array($database->query("SELECT COUNT(*) as total FROM genre"))['total'];
$total_comments = $database->fetch_array($database->query("SELECT COUNT(*) as total FROM comments"))['total'];

// Get trailers count - handle if table doesn't exist
$total_trailers = 0;
$trailers_result = @$database->query("SELECT COUNT(*) as total FROM movie_table WHERE trailer IS NOT NULL AND trailer != ''");
if($trailers_result) {
    $total_trailers = $database->fetch_array($trailers_result)['total'];
}

// Get recent movies
$recent_movies_query = $database->query("SELECT movie_id, movie_title, year, status, poster, date_added FROM movie_table ORDER BY date_added DESC LIMIT 5");

// Get recent comments
$recent_comments_query = $database->query("SELECT c.*, m.movie_title FROM comments c LEFT JOIN movie_table m ON c.movie_id = m.movie_id ORDER BY c.date DESC LIMIT 5");
?>

<?php include 'includes/nav.inc.php'; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">
              <i class="fas fa-tachometer-alt mr-2" style="color: #667eea;"></i>
              Dashboard
            </h1>
            <p class="text-muted mb-0 mt-1">Welcome back! Here's what's happening with your movies.</p>
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
        
        <!-- Stats Cards Row -->
        <div class="row">
          <!-- Total Movies Card -->
          <div class="col-lg-3 col-6">
            <div class="small-box bg-gradient-primary hover-lift">
              <div class="inner">
                <h3><?php echo $total_movies; ?></h3>
                <p>Total Movies</p>
              </div>
              <div class="icon">
                <i class="fas fa-film"></i>
              </div>
              <a href="movie_list.php" class="small-box-footer">
                View all <i class="fas fa-arrow-circle-right ml-1"></i>
              </a>
            </div>
          </div>
          
          <!-- Active Movies Card -->
          <div class="col-lg-3 col-6">
            <div class="small-box bg-gradient-success hover-lift">
              <div class="inner">
                <h3><?php echo $active_movies; ?></h3>
                <p>Active Movies</p>
              </div>
              <div class="icon">
                <i class="fas fa-check-circle"></i>
              </div>
              <a href="movie_list.php" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right ml-1"></i>
              </a>
            </div>
          </div>
          
          <!-- Genres Card -->
          <div class="col-lg-3 col-6">
            <div class="small-box bg-gradient-warning hover-lift">
              <div class="inner">
                <h3><?php echo $total_genres; ?></h3>
                <p>Total Genres</p>
              </div>
              <div class="icon">
                <i class="fas fa-tags"></i>
              </div>
              <a href="year_genre_country.php" class="small-box-footer">
                Manage <i class="fas fa-arrow-circle-right ml-1"></i>
              </a>
            </div>
          </div>
          
          <!-- Comments Card -->
          <div class="col-lg-3 col-6">
            <div class="small-box bg-gradient-info hover-lift">
              <div class="inner">
                <h3><?php echo $total_comments; ?></h3>
                <p>Comments</p>
              </div>
              <div class="icon">
                <i class="fas fa-comments"></i>
              </div>
              <a href="comment.php" class="small-box-footer">
                View all <i class="fas fa-arrow-circle-right ml-1"></i>
              </a>
            </div>
          </div>
        </div>
        <!-- /.Stats Cards Row -->
        
        <div class="row">
          <!-- Recent Movies Card -->
          <div class="col-lg-8">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="m-0">
                  <i class="fas fa-clock mr-2" style="color: #667eea;"></i>
                  Recently Added Movies
                </h5>
                <div class="card-tools">
                  <a href="movie_list.php" class="btn btn-sm btn-outline-primary">
                    View All
                  </a>
                </div>
              </div>
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table table-hover mb-0">
                    <thead>
                      <tr>
                        <th style="width: 60px;">Poster</th>
                        <th>Title</th>
                        <th>Year</th>
                        <th>Status</th>
                        <th>Added</th>
                        <th style="width: 100px;">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php while($movie = $database->fetch_array($recent_movies_query)) { ?>
                      <tr>
                        <td>
                          <?php if($movie['poster']) { ?>
                            <img src="../assets/images/movie_poster/<?php echo $movie['poster']; ?>" alt="<?php echo $movie['movie_title']; ?>" style="width: 45px; height: 65px; object-fit: cover; border-radius: 6px;">
                          <?php } else { ?>
                            <div style="width: 45px; height: 65px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 6px; display: flex; align-items: center; justify-content: center;">
                              <i class="fas fa-film text-white"></i>
                            </div>
                          <?php } ?>
                        </td>
                        <td>
                          <strong><?php echo $movie['movie_title']; ?></strong>
                        </td>
                        <td><?php echo $movie['year']; ?></td>
                        <td>
                          <?php if($movie['status'] == 'Active') { ?>
                            <span class="status-active"><?php echo $movie['status']; ?></span>
                          <?php } else { ?>
                            <span class="status-inactive"><?php echo $movie['status']; ?></span>
                          <?php } ?>
                        </td>
                        <td>
                          <small class="text-muted">
                            <i class="far fa-clock mr-1"></i>
                            <?php echo date('M d, Y', $movie['date_added']); ?>
                          </small>
                        </td>
                        <td>
                          <a href="view_details.php?movie_id=<?php echo $movie['movie_id']; ?>" class="btn btn-sm btn-info" title="View">
                            <i class="fas fa-eye"></i>
                          </a>
                          <button class="btn btn-sm btn-danger" onclick="deleteMovie(<?php echo $movie['movie_id']; ?>)" title="Delete">
                            <i class="fas fa-trash"></i>
                          </button>
                        </td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Quick Actions & Stats -->
          <div class="col-lg-4">
            <!-- Quick Actions Card -->
            <div class="card card-success card-outline">
              <div class="card-header">
                <h5 class="m-0">
                  <i class="fas fa-bolt mr-2" style="color: #11998e;"></i>
                  Quick Actions
                </h5>
              </div>
              <div class="card-body">
                <a href="add_movie.php" class="btn btn-primary btn-block mb-2">
                  <i class="fas fa-plus mr-2"></i> Add New Movie
                </a>
                <a href="add_trailer.php" class="btn btn-success btn-block mb-2">
                  <i class="fas fa-video mr-2"></i> Add Trailer
                </a>
                <a href="add_user.php" class="btn btn-info btn-block mb-2">
                  <i class="fas fa-user-plus mr-2"></i> Add User
                </a>
                <a href="year_genre_country.php" class="btn btn-warning btn-block">
                  <i class="fas fa-tags mr-2"></i> Manage Categories
                </a>
              </div>
            </div>
            
            <!-- Recent Comments Card -->
            <div class="card card-info card-outline">
              <div class="card-header">
                <h5 class="m-0">
                  <i class="fas fa-comments mr-2" style="color: #4facfe;"></i>
                  Recent Comments
                </h5>
              </div>
              <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                  <?php 
                  $comment_count = 0;
                  while($comment = $database->fetch_array($recent_comments_query)) { 
                    $comment_count++;
                  ?>
                  <li class="list-group-item">
                    <div class="d-flex">
                      <div style="width: 36px; height: 36px; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 12px; flex-shrink: 0;">
                        <i class="fas fa-user text-white" style="font-size: 0.8rem;"></i>
                      </div>
                      <div style="flex: 1; min-width: 0;">
                        <strong style="font-size: 0.9rem;"><?php echo $comment['name']; ?></strong>
                        <p class="mb-1 text-muted" style="font-size: 0.8rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                          <?php echo substr($comment['message'], 0, 40) . (strlen($comment['message']) > 40 ? '...' : ''); ?>
                        </p>
                        <small class="text-muted">
                          <i class="far fa-clock mr-1"></i>
                          <?php echo date('M d', $comment['date']); ?>
                          <?php if($comment['movie_title']) { ?>
                            - <i class="fas fa-film mr-1"></i><?php echo substr($comment['movie_title'], 0, 15); ?>
                          <?php } ?>
                        </small>
                      </div>
                    </div>
                  </li>
                  <?php } ?>
                  <?php if($comment_count == 0) { ?>
                  <li class="list-group-item text-center text-muted py-4">
                    <i class="fas fa-comments" style="font-size: 2rem; opacity: 0.3;"></i>
                    <p class="mb-0 mt-2">No comments yet</p>
                  </li>
                  <?php } ?>
                </ul>
                <div class="card-footer bg-white text-center">
                  <a href="comment.php" style="color: #667eea; font-weight: 500;">
                    View All Comments <i class="fas fa-arrow-right ml-1"></i>
                  </a>
                </div>
              </div>
            </div>
            
            <!-- Database Stats Card -->
            <div class="card card-danger card-outline">
              <div class="card-header">
                <h5 class="m-0">
                  <i class="fas fa-chart-pie mr-2" style="color: #eb3349;"></i>
                  Statistics
                </h5>
              </div>
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <span><i class="fas fa-film mr-2 text-primary"></i> Movies</span>
                  <strong><?php echo $total_movies; ?></strong>
                </div>
                <div class="progress mb-3" style="height: 6px;">
                  <div class="progress-bar bg-gradient-primary" style="width: 100%"></div>
                </div>
                
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <span><i class="fas fa-video mr-2 text-success"></i> Trailers</span>
                  <strong><?php echo $total_trailers; ?></strong>
                </div>
                <div class="progress mb-3" style="height: 6px;">
                  <div class="progress-bar bg-gradient-success" style="width: <?php echo min(($total_trailers / max($total_movies, 1)) * 100, 100); ?>%"></div>
                </div>
                
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <span><i class="fas fa-tags mr-2 text-warning"></i> Genres</span>
                  <strong><?php echo $total_genres; ?></strong>
                </div>
                <div class="progress mb-3" style="height: 6px;">
                  <div class="progress-bar bg-gradient-warning" style="width: <?php echo min($total_genres * 5, 100); ?>%"></div>
                </div>
                
                <div class="d-flex justify-content-between align-items-center">
                  <span><i class="fas fa-comments mr-2 text-info"></i> Comments</span>
                  <strong><?php echo $total_comments; ?></strong>
                </div>
                <div class="progress" style="height: 6px;">
                  <div class="progress-bar bg-gradient-info" style="width: <?php echo min($total_comments * 2, 100); ?>%"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
        
<?php include 'includes/footer.inc.php'; ?>
