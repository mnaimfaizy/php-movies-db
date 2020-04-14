<?php include 'includes/header.inc.php'; ?>
<?php
error_reporting(E_ALL & ~E_WARNING);	
?>

      <div class="content">
      	<div class="box_1">
      	 <h1 class="m_2">Search Movies</h1>
      	 <!-- Search Box Area -->
         <div class="row">
         	<div class="col-md-8">
		    <form action="test.php" method="post">
            	<div class="form-group">
                	<input type="text" name="title" id="title" placeholder="Movie Title" class="form-control" />
                </div>
                <div class="form-group">
                	<input type="submit" name="submit" id="submit" value="Search" class="btn btn-primary" />
                </div>
            </form>
            </div>
		</div> <!-- End Search Box Area -->
		<div class="clearfix"> </div>
        <div class="row">
        	<div class="col-md-12">
            <div class="table-responsive">
        	<table class="table">
            	<thead>
                	<tr>
                    	<th> No. </th>
                        <th> Movie </th>
                        <th> Year </th>
                        <th> Type </th>
                        <th> IMDb ID </th>
                        <th> Action </th>
                    </tr>
                </thead>
            	<tbody>
                
        	<?php if(isset($_POST['submit'])) { 
					$title = urlencode($_POST['title']);
					$url = "http://www.omdbapi.com/?s=$title&plot=full&r=xml";
					
					$result = xml2array($url);
					
					foreach($result as $res) {
						foreach($res as $res1) {
							foreach($res1 as $res2) {
								if(isset($res2['Title'], $res2['Year'], $res2['Type'], $res2['imdbID'])) {
									echo '<tr>';
									echo '<td> 1 </td>';
									echo '<td> '. $res2['Title'] .' </td>';
									echo '<td> '. $res2['Year'] .' </td>';
									echo '<td> '. $res2['Type'] .' </td>';
									echo '<td> '. $res2['imdbID'] .' </td>';
									echo '<td> <a href="#" class="btn btn-sm btn-info"> Save Info </a> - 
											<a href="test1.php?t='.urlencode($res2['Title']).'" class="btn btn-sm btn-success" target="_blank"> View Details </a>
									</td>';
									
									//save_image($res2['poster'], 'images/image.jpg');
									echo '</tr>';	
								} 
							}
						}
					}
					
				}
				function save_image($inPath, $outPath) 
				{ // Download images from remote server
					$in = fopen($inPath, "rb");
					$out = fopen($outPath, "wb");
					while($chunk = fread($in,8192))
					{
						fwrite($out, $chunk, 8192);
					}
					fclose($in);
					fclose($out);
				}
				 ?>
                </tbody>
            </table>
            </div>
            </div>
        </div>
		</div>
		   
      </div>
   </div>
 </div>
 
<?php include 'includes/footer.inc.php'; ?>