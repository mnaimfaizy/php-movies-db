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
              <i class="fas fa-film mr-2" style="color: #667eea;"></i>
              Movies List
            </h1>
            <p class="text-muted mb-0 mt-1">Manage all your movies in one place</p>
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
        <div class="row">
          <div class="col-lg-12">

			<?php if(isset($_GET['msg']) && isset($_GET['type'])) {
					if($_GET['type'] === 'genre') {
						if($_GET['msg'] == 0) {
							echo alerts('danger', 'Sorry, there seems to be a problem, try again.'); 
						} else if($_GET['msg'] == 1) { 
							echo alerts('success', 'Genre updated successfully!'); 
						}
					} 
					else if($_GET['type'] === 'trailer') {
						if($_GET['msg'] == 0) {
							echo alerts('danger', 'Sorry, there seems to be a problem, try again.'); 
						} else if($_GET['msg'] == 1) { 
							echo alerts('success', 'Trailer updated successfully!'); 
						}
					}
					else if($_GET['type'] === 'movie') {
						if($_GET['msg'] == 0) {
							echo alerts('danger', 'Sorry, there seems to be a problem, try again.'); 
						} else if($_GET['msg'] == 1) { 
							echo alerts('success', 'Movie deleted successfully!'); 
						}
					}
			} ?>

            <div class="card card-primary card-outline">
              <div class="card-body">

				<table class="table table-hovered" id="movies_list">
					<thead>
					<tr>
						<th>#</th>
						<th>Movie Title</th>
						<th>Country</th>
						<th>Year</th>
						<th>Release Date</th>
						<th>Genre</th>
						<th>Trailer</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
					</thead>

				</table>  

              </div>
            </div><!-- /.card -->
          </div>
          <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
        
<?php include 'includes/footer.inc.php'; ?>
