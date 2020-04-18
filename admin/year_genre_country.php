<?php include 'includes/header.inc.php'; ?>
<?php 
	// Insert year data to the database
	if(isset($_POST['add_year'])) {
		$year = $database->escape_value($_POST['year']);
				
		$sql = "INSERT INTO year(year) 
				VALUES('$year')";
		
		if($database->query($sql)) {
			echo '<script type="text/javascript"> alert("Year has been inserted successfully! :) "); </script>';	
		} else {
			echo '<script type="text/javascript"> alert("Year has not been inserted successfully! :("); </script>';	
		}
	}
	
	// Delete year from the table
	if(isset($_GET['year_id'], $_GET['delete']) && @$_GET['delete'] == 'year') {
		$year_id = $_GET['year_id'];
		
		$del_query = "DELETE FROM year WHERE year_id=$year_id LIMIT 1";
		if($database->query($del_query)) {
			echo '<script type="text/javascript"> alert("Record has been deleted successfully! :)"); </script>';	
		} else {
		   echo '<script type="text/javascript"> alert("Record has not been deleted, please try again! :("); </script>';	
		}
	}
	
	// Insert genre data to the database
	if(isset($_POST['add_genre'])) {
		$genre = $database->escape_value($_POST['genre']);
				
		$sql = "INSERT INTO genre(genre) 
				VALUES('$genre')";
		
		if($database->query($sql)) {
			echo '<script type="text/javascript"> alert("GENRE has been inserted successfully! :) "); </script>';	
		} else {
			echo '<script type="text/javascript"> alert("GENRE has not been inserted successfully! :("); </script>';	
		}
	}
	
	// Delete Genre from the table
	if(isset($_GET['genre_id'], $_GET['delete']) && @$_GET['delete'] == 'genre') {
		$genre_id = $_GET['genre_id'];
		
		$del_query = "DELETE FROM genre WHERE genre_id=$genre_id LIMIT 1";
		if($database->query($del_query)) {
			echo '<script type="text/javascript"> alert("Record has been deleted successfully! :)"); </script>';	
		} else {
		   echo '<script type="text/javascript"> alert("Record has not been deleted, please try again! :("); </script>';	
		}
	}
	
	// Insert Country data to the database
	if(isset($_POST['add_country'])) {
		$country = $database->escape_value($_POST['country']);
				
		$sql = "INSERT INTO country(country) 
				VALUES('$country')";
		
		if($database->query($sql)) {
			echo '<script type="text/javascript"> alert("COUNTRY has been inserted successfully! :) "); </script>';	
		} else {
			echo '<script type="text/javascript"> alert("COUNTRY has not been inserted successfully! :("); </script>';	
		}
	}
	
	// Delete Country from the table
	if(isset($_GET['country_id'], $_GET['delete']) && @$_GET['delete'] == 'country') {
		$country_id = $_GET['country_id'];
		
		$del_query = "DELETE FROM country WHERE country_id=$country_id LIMIT 1";
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
            <h1 class="m-0 text-dark">Add Year / Genre / Country</h1>
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
                <div class="card-header p-0 pt-1">
                    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="year-tab" data-toggle="pill" href="#year" role="tab" aria-controls="year" aria-selected="true">Year</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="genre-tab" data-toggle="pill" href="#genre" role="tab" aria-controls="genre" aria-selected="false">Genre</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="country-tab" data-toggle="pill" href="#country" role="tab" aria-controls="country" aria-selected="false">Country</a>
                        </li>
                    </ul>
                </div> <!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-one-tabContent">
                        <div class="tab-pane fade show active" id="year" role="tabpanel" aria-labelledby="year-tab">
                            <h3>Add Year</h3>
                            <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="add_year">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="form-group">
                                            <div class="input-group">							
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-film"></i></span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="Year" name="year" id="year">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <input type="submit" name="add_year" id="add_year_btn" class="btn btn-success" value="Add Year" />
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <hr />

                            <table class="table table-hovered" id="year_table">
                                <thead>
                                <tr>
                                    <th>Number</th>
                                    <th>Year</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                        $sql = "SELECT * FROM year";
                                        $res = $database->query($sql);
                                        while($year = $database->fetch_array($res)) { ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $year['year']; ?></td>
                                        <td data-value="1">
                                        <button id="<?php echo $year['year_id']; ?>" class="btn btn-danger btn-sm" onClick="conf(this.id)" data-toggle="tooltip" title="Delete this item" data-placement="top" class="btn status-metro status-suspended">
                                        <i class="fas fa-trash"></i> Delete
                                        </button></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade " id="genre" role="tabpanel" aria-labelledby="genre-tab">
                            <h3>Add Genre</h3>
                            <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="add_genre">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-film"></i></span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="Genre" name="genre" id="genre">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <input type="submit" name="add_genre" id="add_genre_btn" class="btn btn-success" value="Add Genere" />
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <hr />

                            <table class="table table-hovered" id="genre_table">
                                <thead>
                                <tr>
                                    <th>Number</th>
                                    <th>Genre</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $no = 1;
									$sql = "SELECT * FROM genre";
									$res = $database->query($sql);
									while($year = $database->fetch_array($res)) { ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $year['genre']; ?></td>
                                    <td data-value="1">
                                    <button id="<?php echo $year['genre_id']; ?>" class="btn btn-danger btn-sm" onClick="conf_genre(this.id)" data-toggle="tooltip" title="Delete this item" data-placement="top" class="btn status-metro status-suspended">
                                    <i class="fas fa-trash"></i> Delete
                                    </button></td>
                                </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade " id="country" role="tabpanel" aria-labelledby="country-tab">
                            <h3>Add Country</h3>
                            <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="add_country">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="form-group">
                                            <div class="input-group">	
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-film"></i></span>
                                                </div>						
                                                <input type="text" class="form-control" placeholder="Country" name="country" id="country">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <input type="submit" name="add_country" id="add_country_btn" class="btn btn-success" value="Add Country" />
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <hr />

                            <table class="table table-hovered" id="country_table">
                                <thead>
                                <tr>
                                    <th>Number</th>
                                    <th>Country</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $no = 1;
									$sql = "SELECT * FROM country";
									$res = $database->query($sql);
									while($year = $database->fetch_array($res)) { ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $year['country']; ?></td>
                                    <td data-value="1">
                                    <button id="<?php echo $year['country_id']; ?>" class="btn btn-danger btn-sm" onClick="conf_country(this.id)" data-toggle="tooltip" title="Delete this item" data-placement="top" class="btn status-metro status-suspended">
                                    <i class="fas fa-trash"></i> Delete
                                    </button></td>
                                </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div> <!-- /.tab-content -->

                </div> <!-- /.card-body -->
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
