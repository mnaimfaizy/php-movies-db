# Developer Guide 👨‍💻

This guide provides comprehensive information for developers who want to work on the PHP Movies Database project.

## Table of Contents

- [Development Environment Setup](#development-environment-setup)
- [Project Architecture](#project-architecture)
- [Development Workflow](#development-workflow)
- [Coding Standards](#coding-standards)
- [Testing](#testing)
- [Common Tasks](#common-tasks)
- [Troubleshooting](#troubleshooting)

## Development Environment Setup

### Method 1: Using Docker (Recommended)

#### Prerequisites

- Docker Desktop (Windows/Mac) or Docker Engine (Linux)
- Docker Compose
- Git
- Code editor (VS Code, PHPStorm, etc.)

#### Setup Steps

1. **Clone the repository**

   ```bash
   git clone https://github.com/yourusername/php-movies-db.git
   cd php-movies-db
   ```

2. **Start Docker containers**

   ```bash
   docker compose up --build -d
   ```

   This will create two containers:
   - `php_movies_app`: Apache + PHP 8.0 (Port 9001)
   - `php_movies_db`: MySQL database (Port 33067)

3. **Import the database**

   ```bash
   # Wait for MySQL to fully start (about 30 seconds)
   docker exec -i php_movies_db mysql -uadmin -pKabul@123 php_movies_db < admin/sql/php_movies_db.sql
   ```

4. **Configure database connection**

   Update `admin/includes/configuration.php`:

   ```php
   define("DB_SERVER", "php_movies_db");  // Use container name
   define("DB_USER", "admin");
   define("DB_PASS", "Kabul@123");
   define("DB_NAME", "php_movies_db");
   ```

5. **Access the application**
   - Frontend: http://localhost:9001
   - Admin: http://localhost:9001/admin

#### Useful Docker Commands

```bash
# View container logs
docker compose logs -f php_movies_app

# Stop containers
docker compose down

# Restart containers
docker compose restart

# Access MySQL CLI
docker exec -it php_movies_db mysql -uadmin -pKabul@123 php_movies_db

# Access container shell
docker exec -it php_movies_app bash

# Rebuild containers
docker compose up --build -d
```

### Method 2: Local Development (XAMPP/WAMP)

#### Prerequisites

- XAMPP/WAMP/MAMP or similar (PHP 8.0+, Apache, MySQL)
- Git
- Code editor

#### Setup Steps

1. **Install XAMPP** (or your preferred stack)
   - Download from https://www.apachefriends.org/

2. **Clone repository to htdocs**

   ```bash
   cd C:\xampp\htdocs  # or your web root
   git clone https://github.com/yourusername/php-movies-db.git
   ```

3. **Create database**
   - Open phpMyAdmin: http://localhost/phpmyadmin
   - Create database: `php_movies_db`
   - Import: `admin/sql/php_movies_db.sql`

4. **Configure database connection**

   Update `admin/includes/configuration.php`:

   ```php
   define("DB_SERVER", "localhost");
   define("DB_USER", "root");
   define("DB_PASS", "");  // Empty for XAMPP default
   define("DB_NAME", "php_movies_db");
   ```

5. **Enable PHP extensions**

   In `php.ini`, ensure these are enabled:

   ```ini
   extension=mysqli
   extension=gd
   extension=mbstring
   ```

6. **Access the application**
   - Frontend: http://localhost/php-movies-db
   - Admin: http://localhost/php-movies-db/admin

## Project Architecture

### Directory Structure Explained

```
php-movies-db/
│
├── admin/                          # Admin Panel (Backend Management)
│   ├── assets/                     # AdminLTE theme assets
│   │   ├── css/                    # Admin stylesheets
│   │   ├── js/                     # Admin JavaScript
│   │   │   └── ckeditor/           # Rich text editor
│   │   └── plugins/                # jQuery plugins, DataTables, etc.
│   │
│   ├── includes/                   # Admin core files
│   │   ├── configuration.php       # Database configuration
│   │   ├── database.php            # Database class
│   │   ├── functions.php           # Utility functions
│   │   ├── session.php             # Session management
│   │   ├── user.php                # User class
│   │   ├── pagination.php          # Pagination class
│   │   ├── UploadFile.php          # File upload handler
│   │   ├── header.inc.php          # Admin header
│   │   ├── nav.inc.php             # Admin navigation
│   │   └── footer.inc.php          # Admin footer
│   │
│   ├── operation/                  # Backend operations
│   │   ├── add_genre.php           # Genre operations
│   │   ├── add_trailer.php         # Trailer operations
│   │   └── delete_movie.php        # Movie deletion
│   │
│   ├── ajax/                       # AJAX endpoints
│   │   ├── getMovies.php           # Fetch movies data
│   │   └── getTrailers.php         # Fetch trailers data
│   │
│   ├── sql/                        # Database files
│   │   └── php_movies_db.sql       # Database dump
│   │
│   └── *.php                       # Admin pages
│       ├── index.php               # Dashboard
│       ├── add_movie.php           # Add/Edit movies
│       ├── movie_list.php          # Movies listing
│       ├── add_trailer.php         # Trailer management
│       ├── comment.php             # Comment moderation
│       └── add_user.php            # User management
│
├── ajax/                           # Frontend AJAX endpoints
│   ├── loadAllMovies.php           # Load all movies
│   ├── loadMoviesByGenre.php       # Filter by genre
│   ├── loadMoviesByYear.php        # Filter by year
│   ├── loadSearchedMovies.php      # Search results
│   └── search_result.php           # Search autocomplete
│
├── assets/                         # Frontend assets
│   ├── css/                        # Stylesheets
│   │   ├── bootstrap.css           # Bootstrap framework
│   │   ├── style.css               # Main stylesheet
│   │   └── search_style.css        # Search styles
│   │
│   ├── js/                         # JavaScript files
│   │   ├── jquery-1.11.1.min.js    # jQuery library
│   │   ├── responsiveslides.min.js # Image slider
│   │   ├── jquery.flexisel.js      # Flexible carousel
│   │   └── search_script.js        # Search functionality
│   │
│   ├── images/                     # Static images
│   │   └── movie_poster/           # Movie poster uploads
│   │
│   ├── font-awesome/               # Icon library
│   └── favicon/                    # Browser icons
│
├── includes/                       # Frontend includes
│   ├── header.inc.php              # Main header
│   ├── footer.inc.php              # Main footer
│   ├── pagination.class.php        # Pagination utility
│   ├── by_genre_year.php           # Filter sidebar
│   └── latest_uploaded_movies.php  # Latest movies widget
│
└── *.php                           # Main pages
    ├── index.php                   # Homepage
    ├── movie.php                   # Movies listing
    ├── single.php                  # Movie detail page
    ├── actor_details.php           # Actor profile
    ├── trailers.php                # Trailers gallery
    ├── search.php                  # Search results
    ├── login.php                   # User login
    ├── contact.php                 # Contact page
    └── submit_comment.php          # Comment submission
```

### Core Components

#### 1. Database Layer (`admin/includes/database.php`)

- Custom database class wrapping MySQLi
- Provides methods for queries, inserts, updates, deletes
- Connection management

#### 2. Session Management (`admin/includes/session.php`)

- Handles user authentication
- Session security
- Login/logout functionality

#### 3. User Management (`admin/includes/user.php`)

- User CRUD operations
- Password hashing
- User authentication

#### 4. File Upload (`admin/includes/UploadFile.php`)

- Handles movie poster uploads
- Image validation
- File naming and storage

#### 5. Pagination (`includes/pagination.class.php` & `admin/includes/pagination.php`)

- Reusable pagination component
- Page number calculation
- SQL LIMIT/OFFSET handling

### Data Flow

#### Frontend Movie Display Flow

```
User Request → index.php
    ↓
includes/header.inc.php (Database connection)
    ↓
SQL Query (SELECT movies)
    ↓
Loop through results
    ↓
Render HTML with movie data
    ↓
includes/footer.inc.php
```

#### AJAX Search Flow

```
User types in search box
    ↓
jQuery captures input (assets/js/search_script.js)
    ↓
AJAX request to ajax/search_result.php
    ↓
Database query with LIKE clause
    ↓
JSON response
    ↓
JavaScript renders results
```

#### Admin Movie Add Flow

```
User submits form (admin/add_movie.php)
    ↓
Validate input
    ↓
Upload poster (UploadFile.php)
    ↓
Insert into movie_table
    ↓
Link actors (movie_actors_table)
    ↓
Link genres (movie_genre_table)
    ↓
Redirect with success message
```

## Development Workflow

### 1. Making Changes

#### Adding a New Page

1. Create the PHP file in the root directory
2. Include the header:
   ```php
   <?php include 'includes/header.inc.php'; ?>
   ```
3. Add your content
4. Include the footer:
   ```php
   <?php include 'includes/footer.inc.php'; ?>
   ```

#### Modifying Admin Pages

1. Navigate to `admin/` directory
2. Use AdminLTE components
3. Include admin header and nav:
   ```php
   <?php include 'includes/header.inc.php'; ?>
   <?php include 'includes/nav.inc.php'; ?>
   ```

### 2. Database Operations

#### Running Queries

```php
// Include database
include 'admin/includes/configuration.php';
include 'admin/includes/database.php';

$database = new Database();

// SELECT query
$query = "SELECT * FROM movie_table WHERE genre = 'Action'";
$result = $database->query($query);

while($row = $database->fetch_array($result)) {
    echo $row['title'];
}

// INSERT query
$query = "INSERT INTO movie_table (title, year) VALUES ('New Movie', 2024)";
$database->query($query);

// Get last insert ID
$id = $database->insert_id();
```

### 3. Working with AJAX

#### Creating an AJAX Endpoint

```php
// ajax/my_endpoint.php
<?php
include '../admin/includes/configuration.php';
include '../admin/includes/database.php';

$database = new Database();

// Get POST data
$search = $_POST['search'];

// Query database
$query = "SELECT * FROM movie_table WHERE title LIKE '%{$search}%'";
$result = $database->query($query);

$data = array();
while($row = $database->fetch_array($result)) {
    $data[] = $row;
}

// Return JSON
header('Content-Type: application/json');
echo json_encode($data);
?>
```

#### Frontend AJAX Call

```javascript
$.ajax({
  url: "ajax/my_endpoint.php",
  method: "POST",
  data: { search: searchTerm },
  dataType: "json",
  success: function (response) {
    // Handle response
    console.log(response);
  },
  error: function (xhr, status, error) {
    console.error("Error:", error);
  },
});
```

## Coding Standards

### PHP Coding Standards

1. **File Structure**

   ```php
   <?php
   // Includes at top
   include 'includes/header.inc.php';

   // Logic in the middle
   $query = "SELECT * FROM table";

   // Output at the end
   ?>
   <html>...</html>
   ```

2. **Naming Conventions**
   - Variables: `$snake_case`
   - Functions: `snake_case()`
   - Classes: `PascalCase`
   - Constants: `UPPER_CASE`

3. **SQL Queries**

   ```php
   // ❌ Bad - SQL injection vulnerable
   $query = "SELECT * FROM users WHERE id = {$_GET['id']}";

   // ✅ Good - Use prepared statements (when updating code)
   $stmt = $mysqli->prepare("SELECT * FROM users WHERE id = ?");
   $stmt->bind_param("i", $id);
   ```

4. **Comments**
   ```php
   /**
    * Function description
    * @param string $param Description
    * @return bool Success status
    */
   function my_function($param) {
       // Implementation
   }
   ```

### JavaScript Coding Standards

1. **Use jQuery consistently**

   ```javascript
   // ❌ Bad - mixing vanilla JS and jQuery
   document.getElementById("search").value = "";

   // ✅ Good - use jQuery
   $("#search").val("");
   ```

2. **Event Handlers**
   ```javascript
   $(document).ready(function () {
     $("#searchQuery").on("keyup", function () {
       // Handler code
     });
   });
   ```

### CSS/HTML Standards

1. **Use Bootstrap classes when possible**
2. **Maintain responsive design**
3. **Keep inline styles minimal**

## Testing

### Manual Testing Checklist

#### Frontend

- [ ] Homepage loads correctly
- [ ] Search functionality works
- [ ] Movie details page displays
- [ ] Comments can be submitted
- [ ] Pagination works
- [ ] Filtering by genre/year works
- [ ] Trailers play correctly
- [ ] Responsive on mobile

#### Admin Panel

- [ ] Login/logout works
- [ ] Add movie with poster upload
- [ ] Edit movie
- [ ] Delete movie
- [ ] Add trailer
- [ ] View comments
- [ ] DataTables sorting/filtering

### Database Testing

```sql
-- Test movie count
SELECT COUNT(*) FROM movie_table;

-- Test relationships
SELECT m.title, a.actor_name
FROM movie_table m
JOIN movie_actors_table mat ON m.movie_id = mat.movie_id
JOIN actors_table a ON mat.actor_id = a.actor_id;

-- Test search functionality
SELECT * FROM movie_table WHERE title LIKE '%action%';
```

## Common Tasks

### Adding a New Movie Genre

1. **Via Admin Panel**:
   - Go to `admin/year_genre_country.php`
   - Add genre in the appropriate section

2. **Via SQL**:
   ```sql
   INSERT INTO genre (genre_name, genre_added_date)
   VALUES ('Sci-Fi', UNIX_TIMESTAMP());
   ```

### Adding a New Actor

```sql
INSERT INTO actors_table (actor_name, date_added)
VALUES ('Tom Hanks', UNIX_TIMESTAMP());
```

### Changing Upload Directory

Edit `admin/includes/UploadFile.php`:

```php
$this->upload_directory = "../../assets/images/movie_poster/";
```

### Modifying Pagination

Edit `includes/pagination.class.php` or `admin/includes/pagination.php`:

```php
$per_page = 12; // Change number of items per page
```

## Troubleshooting

### Database Connection Issues

**Problem**: Can't connect to database

**Solutions**:

1. Check `admin/includes/configuration.php` settings
2. Verify MySQL is running: `docker ps` or check XAMPP
3. Test connection:
   ```php
   $conn = mysqli_connect("localhost", "user", "pass", "db");
   if (!$conn) die("Connection failed: " . mysqli_connect_error());
   echo "Connected successfully";
   ```

### File Upload Issues

**Problem**: Posters not uploading

**Solutions**:

1. Check folder permissions:
   ```bash
   chmod 777 assets/images/movie_poster/
   ```
2. Check PHP upload limits in `php.ini`:
   ```ini
   upload_max_filesize = 20M
   post_max_size = 20M
   ```

### AJAX Not Working

**Problem**: AJAX requests failing

**Solutions**:

1. Check browser console for errors (F12)
2. Verify endpoint path is correct
3. Check Content-Type headers
4. Enable error display:
   ```php
   error_reporting(E_ALL);
   ini_set('display_errors', 1);
   ```

### Docker Issues

**Problem**: Containers won't start

**Solutions**:

```bash
# Remove all containers and volumes
docker compose down -v

# Rebuild from scratch
docker compose up --build -d

# Check logs
docker compose logs
```

### Session Issues

**Problem**: Admin login not persisting

**Solutions**:

1. Check session_start() is called
2. Verify session folder permissions
3. Check if cookies are enabled in browser

## Additional Resources

- [PHP Documentation](https://www.php.net/docs.php)
- [MySQL Documentation](https://dev.mysql.com/doc/)
- [Bootstrap Documentation](https://getbootstrap.com/docs/3.4/)
- [AdminLTE Documentation](https://adminlte.io/docs)
- [jQuery Documentation](https://api.jquery.com/)

## Getting Help

If you encounter issues:

1. Check this guide first
2. Search existing GitHub issues
3. Check error logs:
   - PHP: Check Apache error logs
   - MySQL: Check MySQL error logs
4. Create a new GitHub issue with:
   - Description of the problem
   - Steps to reproduce
   - Error messages
   - Environment details

---

Happy coding! 🚀
