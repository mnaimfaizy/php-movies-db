/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

DROP VIEW IF EXISTS `movies`;
CREATE VIEW `movies` AS 
select `m`.`movie_id` AS `movie_id`,`m`.`movie_title` AS `movie_title`,`m`.`duration` AS `duration`,`m`.`country` AS `country`,`m`.`year` AS `year`,`m`.`release_date` AS `release_date`,
`m`.`director` AS `director`,`m`.`rating` AS `rating`,`m`.`movie_desc` AS `movie_desc`,`m`.`trailer` AS `trailer`,`m`.`imdb_link` AS `imdb_link`,`m`.`status` AS `status`,
`m`.`poster` AS `poster`,`m`.`date_added` AS `date_added`,group_concat(distinct `g`.`genre` order by `g`.`genre` DESC separator ', ') AS `genre`,
group_concat(distinct `ac`.`actor_name` order by `ac`.`actor_name` DESC separator ', ') AS `actors` 
from (
(((`movie_table` `m` join `movie_genre_table` `mg` on((`m`.`movie_id` = `mg`.`movie_id`))) 
join `genre` `g` on((`mg`.`genre_id` = `g`.`genre_id`))) 
join `movie_actors_table` `mac` on((`m`.`movie_id` = `mac`.`movie_id`))) 
join `actors_table` `ac` on((`mac`.`actor_id` = `ac`.`actor_id`))) 
group by `m`.`movie_id`,`m`.`movie_title`;



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;