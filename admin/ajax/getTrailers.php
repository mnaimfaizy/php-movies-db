<?php
include '../includes/database.php';

if(isset($_POST['action']) && $_POST['action'] === 'getTrailer') {

            // storing  request (ie, get/post) global array to a variable
                $requestData = $_REQUEST;
                $columns = array(
            // datatable column index  => database column name
                    0 => 'movie_title',
                    1 => 'country',
                    2 => 'year',
                    3 => 'trailer'
                );
            // getting total number records without any search
                $sql = "SELECT `movie_id`, `movie_title`, `country`, `year`, `trailer`, `status` ";
                $sql .= " FROM `movie_table` WHERE `trailer`='' OR `trailer`=null";
                $query = $database->query($sql);
                $totalData = $database->num_rows($query);
                $totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.
                $sql = "SELECT `movie_id`, `movie_title`, `country`, `year`, `trailer`, `status` ";
                $sql .= " FROM `movie_table` WHERE `trailer`='' OR `trailer`=null ";
                if (!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
                    $sql .= " AND ( movie_tilte LIKE '" . $requestData['search']['value'] . "%' ";
                    $sql .= " OR country LIKE '" . $requestData['search']['value'] . "%' ";
                    $sql .= " OR year LIKE '" . $requestData['search']['value'] . "%' )";
                    $sql .= " OR trailer LIKE '" . $requestData['search']['value'] . "%' )";
                }
                $query = $database->query($sql);
                $totalFiltered = $database->num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.
                $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";
                /* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length. */
                $query = $database->query($sql);
    
                $data = array();
                $no = 1;
                while ($row = $database->fetch_array($query)) {  // preparing an array
                    $nestedData = array();
                    $nestedData[] = $no++;
                    $nestedData[] = $row["movie_title"];
                    $nestedData[] = $row["country"];
                    $nestedData[] = $row["year"];
                    $nestedData[] = '<form class="form-horizontal" action="add_trailer.php" method="post" id="form_trailer">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="form-group">
                                                <div class="input-group">
                                                    <input type="text" required name="trailer" id="trailer" placeholder="Trailer URL" class="form-control" />
                                                    <input type="hidden" name="movie_id" id="movie_id" value="'.$row['movie_id'].'" />
                                                </div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                <div class="input-group">
                                                   <input type="submit" name="update_trailer" id="update_trailer" value="UPDATE" class="btn btn-sm btn-primary" />
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>';
                    $nestedData[] = $row["status"];

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