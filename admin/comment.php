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
<script type="text/javascript">
	function conf(id) {
		var value = window.confirm("Are You sure! You want to DELETE selected Item?");
		if(value == true) {
			window.location = "comment.php?comment_id="+id;
			//console.log(id);	
		} else {
			alert("Please Select Correct Item");	
		}
	}
	
</script>
<?php include 'includes/nav.inc.php'; ?>

        <div id="page-wrapper">
        <?php if(isset($result)) { ?>
			<?php if($result == false) { ?>
            <div class="col-md-10">
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Oh Snap!</strong> Movie deletion was failed, please try again! :(
                </div>
            </div>
            <?php } else if($result == true) { ?>
            <div class="col-md-10">
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Well done!</strong> Movie deletion successfully! :)
                </div>
            </div>
            <?php } } ?>
        <div class="graphs">
        
        	<div class="xs">
  	       		<h3>Movies List</h3>
        		<div class="tab-content">
                	<div class="tab-pane active" id="horizontal-form">
                   		<p>
                                Search: <input id="filter" type="text" class="form-inline"/>
                              </p> <br />
                            <table class="footable metro-green" data-page-size="10" data-filter="#filter" data-filter-text-only="true">
                                <thead>
                                <tr>
                                    <th>
                                        Number
                                    </th>
                                    <th>
                                        Name
                                    </th>
                                    <th data-hide="phone,tablet">
                                        E-mail
                                    </th>
                                    <th data-hide="phone,tablet">
                                        Message
                                    </th>
                                    <th data-hide="phone,tablet">
                                        Movie
                                    </th>
                                    <th data-hide="phone,tablet">
                                        Date
                                    </th>
                                    <th data-hide="phone,tablet">
                                        Action
                                    </th>
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
                                    <button id="<?php echo $comment['comment_id']; ?>" onClick="conf(this.id)" data-toggle="tooltip" title="Delete this item" data-placement="top" class="btn status-metro status-suspended">
                                    <i class="fa fa-trash-o"></i> Delete
                                    </button></td>
                                </tr>
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
                </div>
        	</div>

<script type="text/javascript">
	$(document).ready(function() {
        
		// Validate add_user form
		$("#add_movie").validate({
		
			rules: {
				movie_title: "required",
				country: "required",
				year: "required",
				release_date: "required",
				director: "required",
				rating: "required",
				movie_description: "required",
				status: "required"
				
			},
			messages: {
				movie_title: "Movie Title is required, Please enter valid movie title!",
				country: "Country is required, Please select country from the list!",
				year: "Year is required, Please select year from the list!",
				release_date: "Release date is required, Please enter release date!",
				director: "Director name is required, Please enter valid director name!",
				rating: "Rating is required! Please enter valid rating!",
				movie_description: "Movie Description is required! Please enter valid movie description",
				status: "Status is required! Please select status from the list!"
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
