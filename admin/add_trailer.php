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

        <div id="page-wrapper">
        <div class="graphs">
        
        	<div class="xs">
  	       		<h3>Those movies which doesn't have any trailer</h3>
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
                </div>
        	</div>

<script type="text/javascript">
	$(document).ready(function() {
        
		// Validate add_movie form
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
		
		// Validate form_trailer form
		$("#form_trailer").validate({
		
			rules: {
				trailer: { 
					required: true,
					url: true,
					minlenght: 5
				}
				
			},
			messages: {
				trailer: { 
					required: "Trailer is required! Please provide trailer Information.",
					url: "Please enter valid url for the Trailer",
					minlenght: "Trailer lenght should be more than 5 characters!"
				}
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
