<h2> By Genre </h2>
<?php $query = "SELECT * FROM genre";
    $query_result = $database->query($query);
    while($genre = $database->fetch_array($query_result)) { ?>
    <p style="padding-left: 20px; padding-bottom: 10px;"> <strong> -> </strong> <a href="movie.php?genre=<?php echo $genre['genre']; ?>"> 
        <?php echo $genre['genre']; ?> </a> </p>
<?php } ?>
<br /> <br />
<h2> By Year </h2>
<?php $query = "SELECT * FROM year ORDER BY year DESC";
    $query_result = $database->query($query);
    while($year = $database->fetch_array($query_result)) { ?>
    <p style="padding-left: 20px; padding-bottom: 10px;"> <strong> -> </strong> <a href="movie.php?year=<?php echo $year['year']; ?>"> 
        <?php echo $year['year']; ?> </a> </p>
<?php } ?>