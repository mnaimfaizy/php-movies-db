<?php include 'includes/header.inc.php'; 
	// 1. the current page number ($current_page)
	$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
	
	// 2. records per page ($per_page)
	$per_page = 20;
	
	// 3. total record count ($total_count)
	$sql = "SELECT COUNT(*) AS total FROM movie_table";
	$tot_count = $database->query($sql);
	$total = $database->fetch_array($tot_count);
	$total_count = $total['total'];
	
	@$pagination = new Pagination($page, $per_page, $total_count);
?>
	      <div class="content">
	   	   <h2 class="m_3">This Page is not available now, please try later.</h1>
      	       <div class="movie_top">
                  </div>		  
              </div>
      
</div>
</div>
<?php include 'includes/footer.inc.php'; ?>