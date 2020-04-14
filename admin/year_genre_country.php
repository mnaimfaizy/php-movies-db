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
<script type="text/javascript">
	function conf(id) {
		var value = window.confirm("Are You sure! You want to DELETE selected Item?");
		if(value == true) {
			window.location = "year_genre_country.php?year_id="+id+"&delete=year";
			//console.log(id);	
		} else {
			alert("Please Select Correct Item");	
		}
	}
	function conf_genre(id) {
		var value = window.confirm("Are You sure! You want to DELETE selected Item?");
		if(value == true) {
			window.location = "year_genre_country.php?genre_id="+id+"&delete=genre";
			//console.log(id);	
		} else {
			alert("Please Select Correct Item");	
		}
	}
	function conf_country(id) {
		var value = window.confirm("Are You sure! You want to DELETE selected Item?");
		if(value == true) {
			window.location = "year_genre_country.php?country_id="+id+"&delete=country";
			//console.log(id);	
		} else {
			alert("Please Select Correct Item");	
		}
	}
	
</script>
<?php include 'includes/nav.inc.php'; ?>

        <div id="page-wrapper">
        <div class="graphs">
        
        	 <div class="xs">
  	       		<h3>Add Year / Genre / Country</h3>
        		<div class="tab-content">
                <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
                    <li class="active"><a href="#year" data-toggle="tab">Year</a></li>
                    <li><a href="#genre" data-toggle="tab">Genre</a></li>
                    <li><a href="#country" data-toggle="tab">Country</a></li>
                </ul>
            <div id="my-tab-content" class="tab-content">
                <div class="tab-pane active" id="year">
                    <h1>Add Year</h1>
                    <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="add_year">
                    <div class="form-group">
                        <label class="col-md-2 control-label"> Year </label>
                        <div class="col-md-8">
                            <div class="input-group">							
                                <span class="input-group-addon">
                                    <i class="fa fa-film"></i>
                                </span>
                                <input type="text" class="form-control1" placeholder="Year" name="year" id="year">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-8">
                            <input type="submit" name="add_year" id="add_year" class="btn btn-success" value="Add Year" />
                        </div>
                    </div>
                    </form>
                    <div class="tab-content">
    					<div class="tab-pane active">
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
                                        Year
                                    </th>
                                    <th data-hide="phone,tablet">
                                        Action
                                    </th>
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
                                    <button id="<?php echo $year['year_id']; ?>" onClick="conf(this.id)" data-toggle="tooltip" title="Delete this item" data-placement="top" class="btn status-metro status-suspended">
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
                <div class="tab-pane" id="genre">
                    <h1>Add Genre</h1>
                    <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="add_genre">
                    <div class="form-group">
                        <label class="col-md-2 control-label"> Genre </label>
                        <div class="col-md-8">
                            <div class="input-group">							
                                <span class="input-group-addon">
                                    <i class="fa fa-film"></i>
                                </span>
                                <input type="text" class="form-control1" placeholder="Genre" name="genre" id="genre">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-8">
                            <input type="submit" name="add_genre" id="add_genre" class="btn btn-success" value="Add Genere" />
                        </div>
                    </div>
                    </form>
                    
                    <div class="tab-content">
    					<div class="tab-pane active">
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
                                        Genre
                                    </th>
                                    <th data-hide="phone,tablet">
                                        Action
                                    </th>
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
                                    <button id="<?php echo $year['genre_id']; ?>" onClick="conf_genre(this.id)" data-toggle="tooltip" title="Delete this item" data-placement="top" class="btn status-metro status-suspended">
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
                <div class="tab-pane" id="country">
                    <h1>Add Country</h1>
                    <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="add_country">
                    <div class="form-group">
                        <label class="col-md-2 control-label"> Country </label>
                        <div class="col-md-8">
                            <div class="input-group">							
                                <span class="input-group-addon">
                                    <i class="fa fa-film"></i>
                                </span>
                                <input type="text" class="form-control1" placeholder="Country" name="country" id="country">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-8">
                            <input type="submit" name="add_country" id="add_country" class="btn btn-success" value="Add Country" />
                        </div>
                    </div>
                    </form>
                    
                    <div class="tab-content">
    					<div class="tab-pane active">
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
                                        Country
                                    </th>
                                    <th data-hide="phone,tablet">
                                        Action
                                    </th>
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
                                    <button id="<?php echo $year['country_id']; ?>" onClick="conf_country(this.id)" data-toggle="tooltip" title="Delete this item" data-placement="top" class="btn status-metro status-suspended">
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
            </div>
                </div>
        	</div>

<script type="text/javascript">
	$(document).ready(function() {
        
		// Validate add_year form
		$("#add_year").validate({
		
			rules: {
				year: {
					required: true,
					minlength: 4
				}
				
			},
			messages: {
				year: {
					required: "Year is required!",
					minlenght: "Year must be at least 4 characters"
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
		
		// Validate add_year form
		$("#add_genre").validate({
		
			rules: {
				genre: {
					required: true
				}
				
			},
			messages: {
				genre: {
					required: "Genre is required!"
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
		
		// Validate add_country form
		$("#add_country").validate({
		
			rules: {
				country: {
					required: true
				}
				
			},
			messages: {
				country: {
					required: "Country is required!"
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
