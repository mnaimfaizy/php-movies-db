<?php include 'includes/header.inc.php'; ?>
<?php 
	// Update trailer column in movie_table
	if(isset($_POST['update_trailer'])) {
		$trailer = $database->escape_value($_POST['trailer']);
		$movie_id = $database->escape_value($_POST['movie_id']);
		
		$sql = "UPDATE movie_table SET trailer='$trailer' WHERE movie_id=$movie_id LIMIT 1";
		if($database->query($sql)) {
			// do nothing	
		} else {
			echo '<script> alert("Trailer updationg was unsuccessful please try again! :("); </script>';
		}
	}
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
              <i class="fas fa-video mr-2" style="color: #667eea;"></i>
              Add Trailers
            </h1>
            <p class="text-muted mb-0 mt-1">Movies without trailers - add YouTube links</p>
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

            <div class="card card-primary card-outline">
              <div class="card-body">

			  	<table class="table table-bordered table-striped" id="add_trailer">
					<thead>
					<tr>
						<th>#</th>
						<th>Movie Title</th>
						<th>Country</th>
						<th>Year</th>
						<th>Trailer</th>
						<th>Status</th>
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