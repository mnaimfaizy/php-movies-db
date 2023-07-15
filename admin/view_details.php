<?php 	include 'includes/database.php'; 
		include 'includes/functions.php'; ?>
<!DOCTYPE HTML>
<html>
	<head>
    	<title> Movie Details | MNF Movies </title>
        <link href="css/bootstrap.min.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
    <?php if(isset($_GET['imdb_id'])) { 
		$imdb_id = urlencode($_GET['imdb_id']);
		$url = "http://omdbapi.com/?i=$imdb_id&apikey=2db3e567&plot=full&r=xml";
		
		$result = xml2array($url);
		
		foreach($result as $result1) {
			foreach($result1 as $result2) {
				if(isset($result2['title'])) {
					$title = $result2['title'];
					$year = $result2['year'];
					$released = $result2['released'];
					$runtime = $result2['runtime'];
					$genre = $result2['genre'];
					$director = $result2['director'];
					$actors = $result2['actors'];
					$description = $result2['plot'];
					$language = $result2['language'];
					$country = $result2['country'];
					$poster = $result2['poster'];
					$rating = $result2['imdbRating'];
					$imdbVotes = $result2['imdbVotes'];
					$imdbID = $result2['imdbID'];
					$type = $result2['type'];
				}
			}
		}
		
		
	?>
    	<div id="wrapper">
        	<div id="page-wrapper">
            	<div class="graphs">
        			<div class="xs">
                    <h3 style="text-align:center;">Movie Details</h3>
        			<div class="tab-content">
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <table class="table table-responsive">
                                        <tr>
                                            <td width="43%" rowspan="10"> <img src="<?php echo $poster; ?>" /> </td>
                                            <td width="57%"><strong> Title: </strong> <?php echo $title; ?> </td>
                                        </tr>
                                        <tr>
                                        	<td><strong> Rating: </strong><?php echo $rating; ?></td>
                                        </tr>
                                        <tr>
                                        	<td><strong> Lanugage: </strong><?php echo $language; ?></td>
                                        </tr>
                                        <tr>
                                        	<td><strong> Duration: </strong><?php echo $runtime; ?></td>
                                        </tr>
                                        <tr>
                                        	<td><strong> Country: </strong><?php echo $country; ?></td>
                                        </tr> 
                                        <tr>
                                        	<td><strong> Year: </strong><?php echo $year; ?></td>
                                        </tr>
                                        <tr>
                                        	<td><strong> Genre: </strong><?php echo $genre; ?></td>
                                        </tr>
                                        <tr>
                                        	<td><strong> Release Date: </strong> <?php echo $released; ?></td>
                                        </tr>
                                        <tr>
                                        	<td><strong> Director: </strong><?php echo $director; ?></td>
                                        </tr>
                                        <tr>
                                        	<td><strong> Cast: </strong><?php echo $actors; ?></td>
                                        </tr>
                                        <tr>
                                        	<td colspan="2"> <p><?php echo $description; ?> </p></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                    </div>    
                	</div>
                </div>
            </div>
        </div>
    
    <!-- Scripts to be used -->
    <script type="application/javascript" src="js/bootstrap.min.js" />
    <?php } ?>
	</body>
</html>