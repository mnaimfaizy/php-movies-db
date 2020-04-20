    <ul id="flexiselDemo3">
        <?php $sql = "SELECT * FROM movie_table WHERE status='Active' ORDER BY movie_id DESC LIMIT 10";
        //$sql = "SELECT * FROM movie_table ORDER BY movie_id DESC LIMIT 12";
        $result = $database->query($sql);
        while($movie = $database->fetch_array($result)) { 
        // The Regular Express filter
        $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-z]{2,3}(\/\S*)?/";
        // The text you want to filter goes here. 
        $text = $movie['poster'];
        // Check if there is a url in the text
        if(preg_match($reg_exUrl, $text, $url)) {
            $poster = $url[0];
        } else {
            $poster = 'assets/images/movie_poster/'.$movie['poster'];
        } ?>
        <li><a href="single.php?movie_id=<?php echo $movie['movie_id']; ?>"><img src="<?php echo $poster; ?>" class="img-responsive" style="width:269px; height:300px;"/><div class="grid-flex"><?php echo $movie['movie_title']; ?></a><p><?php echo $movie['release_date']; ?> | <?php echo '('.$movie['year'].')'; ?></p></div></li>
        <?php } ?>
    </ul>	