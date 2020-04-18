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
            <h1 class="m-0 text-dark">Those movies which doesn't have any trailer</h1>
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
						<th>
							Number
						</th>
						<th>
							Movie Title
						</th>
						<th data-hide="phone,tablet">
							Country
						</th>
						<th data-hide="phone,tablet">
							Year
						</th>

						<th data-hide="phone,tablet">
							Trailer
						</th>
						<th data-hide="phone,tablet">
							Status
						</th>
					</tr>
					</thead>
					<tbody>
					<?php $no = 1;
						$sql = "SELECT * FROM movie_table WHERE trailer='' OR trailer=null ORDER BY movie_id DESC";
						$res = $database->query($sql);
						if($database->num_rows($res) > 0) {
						while($movie = $database->fetch_array($res)) { ?>
					<tr>
						<td><?php echo $no++; ?></td>
						<td width="25%"><?php echo $movie['movie_title']; ?></td>
						<td data-value="1" width="10%"><?php echo $movie['country'] ?></td>
						<td data-value="2" width="10%"><?php echo $movie['year']; ?></td>
						<td><form action="add_trailer.php" method="post" id="form_trailer">
							<div class="input-group">
							<input type="text" required name="trailer" id="trailer" placeholder="Trailer URL" class="form-control1">
							<input type="hidden" name="movie_id" id="movie_id" value="<?php echo $movie['movie_id']; ?>"
							</div>
							<div class="input-group">
							<input type="submit" name="update_trailer" id="update_trailer" value="UPDATE" class="btn btn-sm btn-primary" />
							</div>
						</form> <br />
						<p> <strong> <?php if(empty($movie['trailer'])) { echo 'Trailer Not Available'; } else { echo 'Trailer Available'; } ?> </strong> </p>
						</td>
						<td><?php echo $movie['status']; ?></td>
					</tr>
					<?php }
						} else { ?>
						<td colspan="6"> <h1 style="text-align:center;"> No more movies available for updating trailers. </h1> </td>
					<?php } ?>
					</tbody>
					<tfoot>
					<tr>
						<td colspan="5">
							<div class="pagination pagination-centered"></div>
						</td>
					</tr>
					</tfoot>
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
