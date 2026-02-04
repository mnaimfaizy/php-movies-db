<div class="sidebar-filter">
    <h3><i class="fas fa-theater-masks text-primary"></i> Genres</h3>
    <ul class="filter-list">
        <?php $query = "SELECT g.*, COUNT(mg.movie_id) as movie_count 
                        FROM genre g 
                        LEFT JOIN movie_genre_table mg ON g.genre_id = mg.genre_id 
                        GROUP BY g.genre_id 
                        ORDER BY g.genre ASC";
            $query_result = $database->query($query);
            while($genre = $database->fetch_array($query_result)) { 
                $active = (isset($_GET['genre']) && $_GET['genre'] == $genre['genre']) ? 'active' : '';
            ?>
            <li>
                <a href="movie.php?genre=<?php echo urlencode($genre['genre']); ?>" class="<?php echo $active; ?>">
                    <i class="fas fa-chevron-right"></i>
                    <?php echo htmlspecialchars($genre['genre']); ?>
                    <span class="badge"><?php echo $genre['movie_count']; ?></span>
                </a>
            </li>
        <?php } ?>
    </ul>
    
    <h3><i class="fas fa-calendar-alt text-primary"></i> Years</h3>
    <ul class="filter-list">
        <?php $query = "SELECT y.year, COUNT(m.movie_id) as movie_count 
                        FROM year y 
                        LEFT JOIN movie_table m ON y.year = m.year 
                        GROUP BY y.year 
                        ORDER BY y.year DESC";
            $query_result = $database->query($query);
            while($year = $database->fetch_array($query_result)) { 
                $active = (isset($_GET['year']) && $_GET['year'] == $year['year']) ? 'active' : '';
            ?>
            <li>
                <a href="movie.php?year=<?php echo $year['year']; ?>" class="<?php echo $active; ?>">
                    <i class="fas fa-chevron-right"></i>
                    <?php echo $year['year']; ?>
                    <span class="badge"><?php echo $year['movie_count']; ?></span>
                </a>
            </li>
        <?php } ?>
    </ul>
</div>