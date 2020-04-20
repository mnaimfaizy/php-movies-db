<?php
include '../includes/database.php';
include '../includes/functions.php';

if(isset($_POST['action']) && $_POST['action'] === 'getMovies') {

            // storing  request (ie, get/post) global array to a variable
                $requestData = $_REQUEST;
                $columns = array(
            // datatable column index  => database column name
                    0 => 'movie_title',
                    1 => 'duration',
                    2 => 'country',
                    3 => 'year',
                    4 => 'release_date',
                    5 => 'director',
                    6 => 'rating',
                    7 => 'movie_desc',
                    8 => 'trailer',
                    9 => 'imdb_link',
                    10 => 'status',
                    11 => 'poster',
                    12 => 'date_added',
                    13 => 'genre',
                    14 => 'actors'
                );
            // getting total number records without any search
                $sql = "SELECT `movie_id`, `movie_title`, `country`, `year`, `release_date`, `trailer`, `status`, `date_added`, `genre` ";
                $sql .= " FROM `movies` ";
                $query = $database->query($sql);
                $totalData = $database->num_rows($query);
                $totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.
                $sql = "SELECT `movie_id`, `movie_title`, `country`, `year`, `release_date`, `trailer`, `status`, `date_added`, `genre` ";
                $sql .= " FROM `movies` ";
                if (!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
                    $sql .= " WHERE movie_title LIKE '%" . $requestData['search']['value'] . "%' ";
                    $sql .= " OR country LIKE '%" . $requestData['search']['value'] . "%' ";
                    $sql .= " OR year LIKE '%" . $requestData['search']['value'] . "%' ";
                    $sql .= " OR release_date LIKE '%" . $requestData['search']['value'] . "%' ";
                    $sql .= " OR trailer LIKE '%" . $requestData['search']['value'] . "%' ";
                    $sql .= " OR status LIKE '%" . $requestData['search']['value'] . "%' ";
                }
                $query = $database->query($sql);
                $totalFiltered = $database->num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.
                $sql .= " ORDER BY movies." . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";
                /* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length. */
                $query = $database->query($sql);
    
                
                // Get the genre from the table
                $genres_results = '<option value="" disabled selected> -- Select Genre -- </option>';
                $genre_result = $database->query("SELECT * FROM genre ORDER BY genre ASC");
                while($genre = $database->fetch_array($genre_result)) {
                    $genres_results .= '<option value="'.$genre['genre_id'].'">'.$genre['genre'].'</option>';
                }

                $data = array();
                $no = 1;
                while ($row = $database->fetch_array($query)) {  // preparing an array
                    $trailer_status = (empty($row['trailer'])) ? '<span class="text-danger" style="font-size: 0.8rem;">Trailer Not Available</span>' : '<span class="text-success">Trailer Available</span>';

                    $nestedData = array();
                    $nestedData[] = $no++;
                    $nestedData[] = $row["movie_title"];
                    $nestedData[] = $row["country"];
                    $nestedData[] = $row["year"];
                    $nestedData[] = $row["release_date"];
                    $nestedData[] = '<form class="form-horizontal" action="operation/add_genre.php" method="post">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="input-group">
                                                    <select name="genre" class="form-control" required>'.$genres_results.'</select>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="input-group">
                                                    <input type="hidden" name="movie_id" value="'.$row['movie_id'].'" />
                                                    <input type="submit" name="submit_genre" value="Submit" class="btn btn-sm btn-success" />
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <span class="text-info" style="font-size: 0.8rem;">'.$row['genre'].'</span>';
                    $nestedData[] = '<form class="form-horizontal" action="operation/add_trailer.php" method="post">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="form-group mb-0">
                                                <input type="text" required name="trailer" placeholder="Trailer URL" class="form-control1" required>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <input type="hidden" name="movie_id" value="'.$row['movie_id'].'">
                                                <input type="submit" name="update_trailer" value="UPDATE" class="btn btn-sm btn-primary" />
                                            </div>
                                        </div>
                                    </form>'.$trailer_status;
                    $nestedData[] = $row["status"];
                    $nestedData[] = '<button id="'.$row['movie_id'].'" onClick="deleteMovie(this.id)" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i> Delete
                                    </button>';

                    $data[] = $nestedData;
                }
                $json_data = array(
                    "draw" => intval($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
                    "recordsTotal" => intval($totalData),  // total number of records
                    "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
                    "data" => $data   // total data array
                );
                echo json_encode($json_data);  // send data as json format
} else {
    echo json_encode(["error" => "There is some problem"]);
}