<?php include 'includes/header.inc.php'; ?>
<?php 
	// Get current logged-in user ID
	$current_user_id = $session->user_id;
	
	// Delete User from the table
	if(isset($_GET['user_id']) && isset($_GET['delete'])) {
		$user_id = (int)$_GET['user_id'];
		
		// Prevent user from deleting themselves
		if($user_id == $current_user_id) {
			$delete_result = false;
			$self_delete_error = true;
		} else {
			$del_query = "DELETE FROM user WHERE id=$user_id LIMIT 1";
			if($database->query($del_query)) {
				$delete_result = true;
			} else {
				$delete_result = false;
			}
		}
	}
	
	// Get all users from the database
	$users_query = $database->query("SELECT * FROM user ORDER BY id DESC");
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
              <i class="fas fa-users mr-2" style="color: #667eea;"></i>
              Users List
            </h1>
            <p class="text-muted mb-0 mt-1">Manage all administrator accounts</p>
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

            <?php if(isset($self_delete_error) && $self_delete_error) { ?>
                    <div class="alert alert-warning">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        <strong>Warning!</strong> You cannot delete your own account.
                    </div>
            <?php } else if(isset($delete_result)) { 
                if($delete_result == false) { ?>
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <strong>Error!</strong> User deletion failed, please try again.
                    </div>
                <?php } else if($delete_result == true) { ?>
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <i class="fas fa-check-circle mr-2"></i>
                        <strong>Success!</strong> User deleted successfully.
                    </div>
            <?php } 
                } ?>

            <div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="m-0">
                  <i class="fas fa-list mr-2"></i>
                  All Users
                </h5>
                <div class="card-tools">
                  <a href="add_user.php" class="btn btn-sm btn-primary">
                    <i class="fas fa-user-plus mr-1"></i> Add New User
                  </a>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-hover" id="users_table">
                    <thead>
                      <tr>
                        <th style="width: 60px;">#</th>
                        <th>User</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Gender</th>
                        <th style="width: 120px;">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $no = 1;
                      while($user = $database->fetch_array($users_query)) { ?>
                      <tr>
                        <td><?php echo $no++; ?></td>
                        <td>
                          <div class="d-flex align-items-center">
                            <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-right: 12px;">
                              <i class="fas fa-user text-white"></i>
                            </div>
                            <div>
                              <strong><?php echo htmlspecialchars($user['name']); ?></strong>
                              <br>
                              <small class="text-muted">ID: <?php echo $user['id']; ?></small>
                            </div>
                          </div>
                        </td>
                        <td>
                          <span class="badge badge-secondary" style="font-size: 0.85rem; padding: 0.4rem 0.6rem;">
                            <i class="fas fa-at mr-1"></i>
                            <?php echo htmlspecialchars($user['username']); ?>
                          </span>
                        </td>
                        <td>
                          <?php if(!empty($user['email'])) { ?>
                            <a href="mailto:<?php echo htmlspecialchars($user['email']); ?>" style="color: #667eea;">
                              <i class="fas fa-envelope mr-1"></i>
                              <?php echo htmlspecialchars($user['email']); ?>
                            </a>
                          <?php } else { ?>
                            <span class="text-muted">-</span>
                          <?php } ?>
                        </td>
                        <td>
                          <?php if(!empty($user['phone'])) { ?>
                            <i class="fas fa-phone mr-1 text-success"></i>
                            <?php echo htmlspecialchars($user['phone']); ?>
                          <?php } else { ?>
                            <span class="text-muted">-</span>
                          <?php } ?>
                        </td>
                        <td>
                          <?php if(!empty($user['gender'])) { ?>
                            <?php if(strtolower($user['gender']) == 'male') { ?>
                              <span class="badge badge-info">
                                <i class="fas fa-mars mr-1"></i> Male
                              </span>
                            <?php } else { ?>
                              <span class="badge badge-pink" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                                <i class="fas fa-venus mr-1"></i> Female
                              </span>
                            <?php } ?>
                          <?php } else { ?>
                            <span class="text-muted">-</span>
                          <?php } ?>
                        </td>
                        <td>
                          <?php if($user['id'] == $current_user_id) { ?>
                            <span class="badge badge-secondary" style="padding: 0.5rem 0.75rem;" title="This is your account">
                              <i class="fas fa-user-shield mr-1"></i> You
                            </span>
                          <?php } else { ?>
                            <a href="edit_user.php?user_id=<?php echo $user['id']; ?>" class="btn btn-sm btn-info" title="Edit User">
                              <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn btn-sm btn-danger" onclick="deleteUser(<?php echo $user['id']; ?>)" title="Delete User">
                              <i class="fas fa-trash"></i>
                            </button>
                          <?php } ?>
                        </td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
                
                <?php if($database->num_rows($database->query("SELECT * FROM user")) == 0) { ?>
                <div class="empty-state">
                  <i class="fas fa-users"></i>
                  <h4>No Users Found</h4>
                  <p>There are no users in the system yet.</p>
                  <a href="add_user.php" class="btn btn-primary">
                    <i class="fas fa-user-plus mr-1"></i> Add First User
                  </a>
                </div>
                <?php } ?>
                
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

<script>
function deleteUser(id) {
    var value = window.confirm("Are you sure you want to delete this user? This action cannot be undone.");
    if(value == true) {
        window.location = "users_list.php?user_id="+id+"&delete=true";
    }
}
</script>
   
<?php include 'includes/footer.inc.php'; ?>
