  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

   </div>
    <!-- /#wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- jquery-validation -->
    <script src="assets/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="assets/plugins/jquery-validation/additional-methods.min.js"></script>

    <!-- DataTables -->
    <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#movies_list").DataTable({
                "responsive": true,
                "autoWidth": false,
            });

            var dataTable = $('#add_trailer').DataTable({
                "responsive": true,
                "processing": true,
                "serverSide": true,
                "ajax": {
                    url: "ajax/getTrailers.php", // json datasource
                    data: {action: 'getTrailer'},
                    type: 'post',  // method  , by default get

                },
                error: function () {  // error handling
                    $(".add_trailer-error").html("");
                    $("#add_trailer").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $("#add_trailer_processing").css("display", "none");

                }

            });

            $("#year_table").DataTable({
                "responsive": true,
                "autoWidth": false,
            });

            $("#genre_table").DataTable({
                "responsive": true,
                "autoWidth": false,
            });

            $("#country_table").DataTable({
                "responsive": true,
                "autoWidth": false,
            });

            $("#comments_table").DataTable({
                "responsive": true,
                "autoWidth": false,
            });

        });
    </script>

    <!-- AdminLTE App -->
    <script src="assets/js/adminlte.min.js"></script>

    <script src="assets/js/ckeditor/ckeditor.js"></script>
    <script>
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace( 'movie_description' );
    </script>

<script type="text/javascript">
	$(document).ready(function() {
        
		// Validate add_user form
		$("#add_movie").validate({
		
			rules: {
				movie_title: "required",
				duration: "required",
				country: "required",
				year: "required",
				release_date: "required",
				director: "required",
				rating: "required",
				movie_description: "required",
				status: "required",
				poster: "required"
				
			},
			messages: {
				movie_title: "Movie Title is required, Please enter valid movie title!",
				duration: "Movie Duration is required, Please enter valid movie duration!",
				country: "Country is required, Please select country from the list!",
				year: "Year is required, Please select year from the list!",
				release_date: "Release date is required, Please enter release date!",
				director: "Director name is required, Please enter valid director name!",
				rating: "Rating is required! Please enter valid rating!",
				movie_description: "Movie Description is required! Please enter valid movie description",
				status: "Status is required! Please select status from the list!",
				poster: "Movie poster is requied! Please upload an image!"
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
               $(element).removeClass('is-invalid');
            }
        });
        
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
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });

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
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
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
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
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
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script> 

<script>
    function conf(id) {
		var value = window.confirm("Are you sure! You want to delete selected Item?");
		if(value == true) {
			window.location = "movie_list.php?movie_id="+id+"&task=delete";
		} else { 
			// Do something else
		}
    }
    
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

</body>
</html>