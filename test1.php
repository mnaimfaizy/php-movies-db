<?php include 'includes/header.inc.php'; ?>
<?php if(isset($_GET['t'])) {
	$title = urlencode($_GET['t']);
	$url = 'http://www.omdbapi.com/?t='.$title.'&plot=full&r=xml';
	
	$result = xml2array($url);
	echo '<div class="content">
      	<div class="box_1">';
	foreach($result as $res) {
		foreach($res as $res1) {
			if(isset($res1['title'], $res1['year'], $res1['type'], $res1['imdbID'], $res1['poster'])) {
				//$res1['poster'];
				$url = "'".$res1['poster']."'";
				$img = "images/".$res1['title'].'.jpg';
				
				$image = file_get_contents($res1['poster']);
				$poster = $res1['title'].'.jpg';
				$handle = fopen($poster, 'w') or die('Cannot open file: '.$poster); // implicitly creates file
				
				file_put_contents($img, $image); // Where to save the image on your server
				fclose($handle);
			}
		}
	}
	

	echo '</div></div>';
}