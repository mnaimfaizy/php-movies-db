<?php include 'includes/header.inc.php'; ?>
<?php // Insert user data to the database
	if(isset($_POST['submit'])) {
		$username = $database->escape_value($_POST['username']);
		$password = $database->escape_value($_POST['password']);	
		$conf_password = $database->escape_value($_POST['conf_password']);
		$fullname = $database->escape_value($_POST['fullname']);
		$gender = $database->escape_value($_POST['gender']);
		$email = $database->escape_value($_POST['email_address']);
		$phone = $database->escape_value($_POST['phone']);
		
		$password = md5($password);
		
		$sql = "INSERT INTO user(username, password, name, gender, email, phone) 
				VALUES('$username', '$password', '$fullname', '$gender', '$email', '$phone')";
		
		if($database->query($sql)) {
			$result = true;	
		} else {
			$result = false;	
		}
	}
?>
<?php include 'includes/nav.inc.php'; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <?php if(isset($result)) { 
        if($result == false) { ?>
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Oh Snap!</strong> User insertiong was failed, please try again! :(
        </div>
    <?php } else if($result == true) { ?>
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Well done!</strong> User inserted successfully! :)
        </div>
    <?php } 
    } ?>

	<!-- Content Header (Page header) -->
	<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">
              <i class="fas fa-user-plus mr-2" style="color: #667eea;"></i>
              Add New User
            </h1>
            <p class="text-muted mb-0 mt-1">Create a new administrator account</p>
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
            <div class="card">
              <div class="card-body">

                <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="add_user">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <div class="input-group mb-3">							
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Username" name="username" id="username">
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <div class="input-group mb-3">							
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-key"></i></span>
                                    </div>
                                    <input type="password" class="form-control" placeholder="Password" name="password" id="password">
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <div class="input-group mb-3">							
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-key"></i></span>
                                    </div>
                                    <input type="password" class="form-control" placeholder="Confirm Password" id="conf_password" name="conf_password">
                                </div>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <div class="input-group mb-3">							
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-male"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Firstname + Lastname" id="fullname" name="fullname">
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <div class="input-group mb-3">							
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-users"></i></span>
                                    </div>
                                    <select class="form-control" name="gender" id="gender">
                                        <option value="" disabled selected> -- Select Gender -- </option>
                                        <option value="male"> Male </option>
                                        <option value="female"> Female </option>
                                    </select>     
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <div class="input-group mb-3">							
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-envelope-o"></i></span>
                                    </div>
                                    <input type="email" class="form-control" placeholder="Email Address" name="email_address" id="email_address">    
                                </div>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <div class="input-group mb-3">							
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Phone Number" name="phone" id="phone">   
                                </div>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="form-group">
                                <input type="submit" name="submit" id="submit" class="btn btn-success" value="Add User" />
                            </div>
                        </div>
                    </div>

                </form>

              </div>
            </div>
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
