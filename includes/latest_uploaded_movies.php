<div class="movie-list-grid">
    <?php $sql = "SELECT m.*, 
                         (SELECT GROUP_CONCAT(g.genre SEPARATOR ', ') 
                          FROM movie_genre_table mg 
                          JOIN genre g ON mg.genre_id = g.genre_id 
                          WHERE mg.movie_id = m.movie_id LIMIT 2) as genres
                  FROM movie_table m 
                  WHERE m.status='Active' 
                  ORDER BY m.movie_id DESC LIMIT 12";
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
        <a href="single.php?movie_id=<?php echo $movie['movie_id']; ?>" class="movie-list-item fade-in">
            <div class="position-relative overflow-hidden">
                <img src="<?php echo $poster; ?>" alt="<?php echo htmlspecialchars($movie['movie_title']); ?>" loading="lazy"/>
                <div class="position-absolute top-0 end-0 m-2">
                    <span class="badge bg-warning text-dark">
                        <i class="fas fa-star"></i> <?php echo $movie['rating']; ?>
                    </span>
                </div>
            </div>
            <div class="item-info">
                <h4 class="item-title"><?php echo htmlspecialchars($movie['movie_title']); ?></h4>
                <p class="item-meta">
                    <span class="me-2"><i class="far fa-calendar"></i> <?php echo $movie['year']; ?></span>
                    <span><i class="far fa-clock"></i> <?php echo $movie['duration']; ?></span>
                </p>
                <?php if(!empty($movie['genres'])) { ?>
                    <p class="item-meta text-primary" style="font-size: 0.8rem;">
                        <?php echo $movie['genres']; ?>
                    </p>
                <?php } ?>
            </div>
        </a>
    <?php } ?>
</div>	