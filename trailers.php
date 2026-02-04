<?php include 'includes/header.inc.php'; ?>

<!-- Page Header -->
<div class="page-header" style="margin-top: 70px;">
    <div class="container">
        <h1 class="display-6 fw-bold"><i class="fas fa-play-circle me-2 text-primary"></i>Movie Trailers</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Trailers</li>
            </ol>
        </nav>
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
                        <i class="fas fa-video me-1"></i> Watch trailers for your favorite movies
                    </div>
                </div>
            </div>

            <!-- Trailers Grid -->
            <div id="pagination-result">
                <input type="hidden" name="rowcount" id="rowcount" />
            </div>
        </div>
        
        <!-- Sidebar -->
        <div class="col-lg-3 order-1 order-lg-2 mb-4 mb-lg-0">
            <?php include('includes/by_genre_year.php'); ?>
        </div>
    </div>
</div>

<?php include 'includes/footer.inc.php'; ?>