<?php include 'includes/header.inc.php'; ?>
<?php 
	// Delete Comment from the table
	if(isset($_GET['comment_id'])) {
		$comment_id = $_GET['comment_id'];
		
		$del_query = "DELETE FROM comments WHERE comment_id=$comment_id LIMIT 1";
		if($database->query($del_query)) {
			echo '<script type="text/javascript"> alert("Record has been deleted successfully! :)"); </script>';	
		} else {
		   echo '<script type="text/javascript"> alert("Record has not been deleted, please try again! :("); </script>';	
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
              <i class="fas fa-comments mr-2" style="color: #667eea;"></i>
              User Comments
            </h1>
            <p class="text-muted mb-0 mt-1">View and manage all user comments</p>
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

            <?php if(isset($result)) { 
                if($result == false) { ?>
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Oh Snap!</strong> Movie deletion was failed, please try again! :(
                    </div>
                <?php } else if($result == true) { ?>
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Well done!</strong> Movie deletion successfully! :)
                    </div>
            <?php } 
                } ?>

            <div class="card card-primary card-outline">
              <div class="card-body">
                <table class="table table-hovered" id="comments_table">
                    <thead>
                    <tr>
                        <th>Number</th>
                        <th>Name</th>
                        <th>E-mail</th>
                        <th>Message</th>
                        <th>Movie</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $no = 1;
                        $sql = "SELECT * FROM comments";
                        $res = $database->query($sql);
                        while($comment = $database->fetch_array($res)) { ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $comment['name']; ?></td>
                        <td><?php echo $comment['email']; ?></td>
                        <td><?php echo $comment['message']; ?></td>
                        <td><?php if(isset($comment['movie_id'])) { 
                                $movie_result = $database->query("SELECT movie_title FROM movie_table WHERE movie_id=".$comment['movie_id']." LIMIT 1");
                                $movie = $database->fetch_array($movie_result);
                                echo $movie['movie_title'];	
                        } ?></td>
                        <td><?php echo date("d-M-Y | h:i:s", $comment['date']); ?></td>
                        <td data-value="1">
                        <button class="btn btn-danger btn-sm" id="<?php echo $comment['comment_id']; ?>" onClick="conf(this.id)" data-toggle="tooltip" title="Delete this item" data-placement="top" class="btn status-metro status-suspended">
                        <i class="fas fa-trash"></i> Delete
                        </button></td>
                    </tr>
                    <?php } ?>
                    </tbody>
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
