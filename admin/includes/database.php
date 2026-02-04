<?php

// Load environment variables from .env file
function loadEnv($path) {
    if (!file_exists($path)) {
        return;
    }
    
    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        // Skip comments
        if (strpos(trim($line), '#') === 0) {
            continue;
        }
        
        // Parse line
        if (strpos($line, '=') !== false) {
            list($name, $value) = explode('=', $line, 2);
            $name = trim($name);
            $value = trim($value);
            
            if (!array_key_exists($name, $_ENV)) {
                putenv("$name=$value");
                $_ENV[$name] = $value;
                $_SERVER[$name] = $value;
            }
        }
    }
}

// Load .env file (go up two directories from admin/includes/)
loadEnv(__DIR__ . '/../../.env');

class MySQLDatabase {
	
	private $connection;
	public $last_query;
	private $magic_quotes_active;
	private $real_escape_string;
    private $host;
    private $user;
    private $password;
    private $database;
    private $port;

    function __construct() {
        // Load from environment variables or use defaults
        $this->host = getenv('DB_HOST') ?: 'php_movies_db';
        $this->user = getenv('DB_USERNAME') ?: 'admin';
        $this->password = getenv('DB_PASSWORD') ?: 'Kabul@123';
        $this->database = getenv('DB_DATABASE') ?: 'php_movies_db';
        $this->port = getenv('DB_PORT') ?: 3306;
        
        $this->open_connection();
        $this->magic_quotes_active = (bool) ini_get('magic_quotes_gpc');
        $this->real_escape_string = function_exists('mysqli_real_escape_string');
    }
	
	public function open_connection() {
		$this->connection = mysqli_connect($this->host, $this->user, $this->password, $this->database, $this->port);
		if(!$this->connection) {
			die("Database connection failed: " . mysqli_connect_error());	
		}
	}
	
	public function close_connection() {
		if(isset($this->connection)) {
			mysqli_close($this->connection);
			unset($this->connection);	
		}
	}
	
	public function query($sql) {
		$this->last_query = $sql;
		$result = mysqli_query($this->connection, $sql);
		$this->confirm_query($result);
		return $result;
	}

    private function confirm_query($result) {
        if (!$result) {
            $output = "Database query failed: " . mysqli_error($this->connection) . "<br /><br />";
            $output .= "Last SQL query: " . $this->last_query;
            die($output);
        }
    }

	
	public function escape_value($value) {
		
		  if($this->real_escape_string) { // PHP v4.3.0 or higher
		// undo any magic quote effects so mysql_real_escape_string can do the work
		if($this->magic_quotes_active) { $value = stripslashes($value); }
			$value = mysqli_real_escape_string($this->connection, $value);
		} else { // before PHP v4.3.0
		// If magic quotes aren't already on then add slases manually
		if(!$this->magic_quotes_active) { $value = addslashes($value); }
		// if magic quotes are active, then teh slashes already exist
		}
		return $value;
	}
	
	// "Database-neutral" methods
	public function fetch_array($result_set) {
		return mysqli_fetch_array($result_set);	
	}
	
	public function num_rows($result_set) {
		return mysqli_num_rows($result_set);	
	}
	
	public function insert_id() {
		// get the last id inserted over the current db connection
		return mysqli_insert_id($this->connection);	
	}
	
	public function affected_rows() {
		return mysqli_affected_rows($this->connection);	
	}

	function runQuery($query) {
		$result = mysqli_query($this->connection,$query);
		while($row=mysqli_fetch_assoc($result)) {
			$resultset[] = $row;
		}		
		if(!empty($resultset))
			return $resultset;
	}
	
	function numRows($query) {
		$result  = mysqli_query($this->connection,$query);
		$rowcount = mysqli_num_rows($result);
		return $rowcount;	
	}

	function getMoviePoster($movie_id) {
		$query = $this->query("SELECT poster FROM movies WHERE movie_id={$movie_id} LIMIT 1");
		$result = $this->fetch_array($query);
		return $result['poster'];
	}

}

$database = new MySQLDatabase();
$db =& $database;
?>