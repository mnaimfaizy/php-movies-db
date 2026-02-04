<?php include 'includes/header.inc.php'; ?>

<!-- Page Header -->
<div class="page-header" style="margin-top: 70px;">
    <div class="container">
        <?php if(isset($_GET['genre'])) { ?>
            <h1 class="display-6 fw-bold"><i class="fas fa-theater-masks me-2 text-primary"></i>Movies by Genre: <?php echo htmlspecialchars($_GET['genre']); ?></h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="movie.php">Movies</a></li>
                    <li class="breadcrumb-item active"><?php echo htmlspecialchars($_GET['genre']); ?></li>
                </ol>
            </nav>
        <?php } else if(isset($_GET['year'])) { ?>
            <h1 class="display-6 fw-bold"><i class="fas fa-calendar me-2 text-primary"></i>Movies from <?php echo htmlspecialchars($_GET['year']); ?></h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="movie.php">Movies</a></li>
                    <li class="breadcrumb-item active"><?php echo htmlspecialchars($_GET['year']); ?></li>
                </ol>
            </nav>
        <?php } else { ?>
            <h1 class="display-6 fw-bold"><i class="fas fa-film me-2 text-primary"></i>Browse All Movies</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active">All Movies</li>
                </ol>
            </nav>
        <?php } ?>
    </div>
</div>

<div class="container py-4">
    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-9 order-2 order-lg-1">
            <!-- Filter Controls -->
            <div class="content-card mb-4">
                <div class="card-body d-flex flex-wrap justify-content-between align-items-center gap-3">
                    <div class="d-flex align-items-center gap-2">
                        <label for="pagination-setting" class="text-secondary mb-0">
                            <i class="fas fa-cog"></i> View:
                        </label>
                        <select name="pagination-setting" onChange="changePagination(this.value);" class="modern-select" id="pagination-setting">
                            <option value="all-links" selected>Show All Pages</option>
                            <option value="prev-next">Previous/Next Only</option>
                        </select>
                    </div>
                    <div class="text-secondary">
                        <i class="fas fa-film me-1"></i> Showing latest movies
                    </div>
                </div>
            </div>

            <!-- Movie Results -->
            <div id="pagination-result">
                <input type="hidden" name="rowcount" id="rowcount" />
            </div>
            
            <!-- Latest Movies Section -->
            <div class="section-header text-start mt-5">
                <h2><i class="fas fa-clock text-primary me-2"></i>Recently Added</h2>
                <p class="text-secondary">Check out the newest additions to our collection</p>
            </div>
            
            <?php include('includes/latest_uploaded_movies.php'); ?>
        </div>
        
        <!-- Sidebar -->
        <div class="col-lg-3 order-1 order-lg-2 mb-4 mb-lg-0">
            <?php include('includes/by_genre_year.php'); ?>
        </div>
    </div>
</div>

<?php include 'includes/footer.inc.php'; ?>