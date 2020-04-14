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
        <div id="page-wrapper">
        <?php if(isset($result)) { ?>
			<?php if($result == false) { ?>
            <div class="col-md-10">
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Oh Snap!</strong> User insertiong was failed, please try again! :(
                </div>
            </div>
            <?php } else if($result == true) { ?>
            <div class="col-md-10">
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Well done!</strong> User inserted successfully! :)
                </div>
            </div>
            <?php } } ?>
        <div class="graphs">
        
        	 <div class="xs">
  	       		<h3>Add New User</h3>
        		<div class="tab-content">
                	<div class="tab-pane active" id="horizontal-form">
                    	<form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="add_user">
                            <div class="form-group">
                                <label class="col-md-2 control-label"> Username </label>
                                <div class="col-md-8">
                                    <div class="input-group">							
                                        <span class="input-group-addon">
                                            <i class="fa fa-user"></i>
                                        </span>
                                        <input type="text" class="form-control1" placeholder="Username" name="username" id="username">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"> Password </label>
                                <div class="col-md-8">
                                    <div class="input-group">							
                                        <span class="input-group-addon">
                                            <i class="fa fa-key"></i>
                                        </span>
                                        <input type="password" class="form-control1" placeholder="Password" name="password" id="password">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"> Confirm Password </label>
                                <div class="col-md-8">
                                    <div class="input-group">							
                                        <span class="input-group-addon">
                                            <i class="fa fa-key"></i>
                                        </span>
                                        <input type="password" class="form-control1" placeholder="Re-type Password" id="conf_password" name="conf_password">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"> Fullname </label>
                                <div class="col-md-8">
                                    <div class="input-group">							
                                        <span class="input-group-addon">
                                            <i class="fa fa-male"></i>
                                        </span>
                                        <input type="text" class="form-control1" placeholder="Firstname + Lastname" id="fullname" name="fullname">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"> Gender </label>
                                <div class="col-md-8">
                                    <div class="input-group">							
                                        <span class="input-group-addon">
                                            <i class="fa fa-users"></i>
                                        </span>
                                        <select class="form-control1" name="gender" id="gender">
                                        	<option value="" disabled selected> -- Select Gender -- </option>
                                        	<option value="male"> Male </option>
                                            <option value="female"> Female </option>
                                        </select>                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"> Email </label>
                                <div class="col-md-8">
                                    <div class="input-group">							
                                        <span class="input-group-addon">
                                            <i class="fa fa-envelope-o"></i>
                                        </span>
                                        <input type="email" class="form-control1" placeholder="Email Address" name="email_address" id="email_address">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"> Phone </label>
                                <div class="col-md-8">
                                    <div class="input-group">							
                                        <span class="input-group-addon">
                                            <i class="fa fa-phone"></i>
                                        </span>
                                        <input type="text" class="form-control1" placeholder="Phone Number" name="phone" id="phone">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8">
                                    <input type="submit" name="submit" id="submit" class="btn btn-success" value="Add User" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
        	</div>
<script type="text/javascript">
	$(document).ready(function() {
        
		// Validate add_user form
		$("#add_user").validate({
		
			rules: {
				username: {
					required: true,
					minlength: 5
				},
				password: {
					required: true,
					minlength: 6
				},
				conf_password: {
					required: true,
					equalTo: "#password"
				},
				fullname: "required",
				gender: "required",
				email_address: {
					required: true,
					email: true
				},
				phone: "required"
				
			},
			messages: {
				username: {
					required: "Username is required!",
					minlenght: "Username must be grater than 5 characters"
				},
				password: {
					required: "Password is required!",
					minlenght: "Password must be grater than 6 characters"
				},
				conf_password: {
					required: "Confirm your password!",
					equalTo: "Password doesn't match please try again!"
				},
				fullname: "Fullname is required",
				gender: "Gender is required!",
				email_address: {
					required: "Email Address is required!",
					email: "Please type correct email address"
				},
				phone: "Phone is required!"
			},
			highlight:function(element, errorClass, validClass) {
				$(element).parents('.input-group').addClass('has-error');
				$(element).parents('.form-group').addClass('has-error');
			},
			unhighlight:function(element, errorClass, validClass) {
				$(element).parents('.input-group').removeClass('has-error');
				$(element).parents('.input-group').addClass('has-success');
				$(element).parents('.form-group').removeClass('has-error');
				$(element).parents('.form-group').addClass('has-success');
			}
		});
    });
</script>        
<?php include 'includes/footer.inc.php'; ?>
