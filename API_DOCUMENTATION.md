# API Documentation 📡

This document describes all the backend endpoints, AJAX calls, and API structure for the PHP Movies Database application.

## Table of Contents

- [Overview](#overview)
- [Frontend AJAX Endpoints](#frontend-ajax-endpoints)
- [Admin AJAX Endpoints](#admin-ajax-endpoints)
- [Form Submissions](#form-submissions)
- [Response Formats](#response-formats)
- [Authentication](#authentication)
- [Error Handling](#error-handling)

## Overview

The application uses AJAX for dynamic content loading without page refreshes. All AJAX endpoints are located in the `ajax/` directory for the frontend and `admin/ajax/` for the admin panel.

### Base URLs

- **Frontend AJAX**: `/ajax/`
- **Admin AJAX**: `/admin/ajax/`
- **Admin Operations**: `/admin/operation/`

### Common Headers

```http
Content-Type: application/json
X-Requested-With: XMLHttpRequest
```

## Frontend AJAX Endpoints

### 1. Load All Movies

**Endpoint**: `ajax/loadAllMovies.php`

**Method**: `GET`

**Description**: Loads all movies with pagination

**Parameters**:

- `page` (optional): Page number for pagination (default: 1)

**Request Example**:

```javascript
$.ajax({
  url: "ajax/loadAllMovies.php",
  method: "GET",
  data: { page: 1 },
  success: function (response) {
    $("#movies-container").html(response);
  },
});
```

**Response**: HTML markup of movie cards

```html
<div class="col-md-3 grid_2">
  <div class="grid_1">
    <a href="single.php?movie_id=123">
      <img src="assets/images/movie_poster/poster.jpg" alt="Movie Title" />
      <h3>Movie Title</h3>
    </a>
    <span class="m_4">Genre | Year</span>
  </div>
</div>
<!-- More movie cards... -->
```

---

### 2. Load Movies by Genre

**Endpoint**: `ajax/loadMoviesByGenre.php`

**Method**: `POST`

**Description**: Filters movies by selected genre

**Parameters**:

- `genre_id` (required): Genre ID to filter by

**Request Example**:

```javascript
$.ajax({
  url: "ajax/loadMoviesByGenre.php",
  method: "POST",
  data: { genre_id: 5 },
  success: function (response) {
    $("#movies-container").html(response);
  },
});
```

**Response**: HTML markup of filtered movie cards

---

### 3. Load Movies by Year

**Endpoint**: `ajax/loadMoviesByYear.php`

**Method**: `POST`

**Description**: Filters movies by release year

**Parameters**:

- `year` (required): Year to filter by

**Request Example**:

```javascript
$.ajax({
  url: "ajax/loadMoviesByYear.php",
  method: "POST",
  data: { year: 2020 },
  success: function (response) {
    $("#movies-container").html(response);
  },
});
```

**Response**: HTML markup of filtered movie cards

---

### 4. Load Movies by Trailer

**Endpoint**: `ajax/loadMoviesByTrailer.php`

**Method**: `POST`

**Description**: Loads movies that have trailers

**Parameters**: None

**Request Example**:

```javascript
$.ajax({
  url: "ajax/loadMoviesByTrailer.php",
  method: "POST",
  success: function (response) {
    $("#trailers-container").html(response);
  },
});
```

**Response**: HTML markup of movies with trailers

---

### 5. Search Movies

**Endpoint**: `ajax/search_result.php`

**Method**: `POST`

**Description**: Real-time search for movies (autocomplete)

**Parameters**:

- `search` (required): Search query string

**Request Example**:

```javascript
$.ajax({
  url: "ajax/search_result.php",
  method: "POST",
  data: { search: "batman" },
  dataType: "json",
  success: function (response) {
    // Display autocomplete results
  },
});
```

**Response Format**:

```json
[
  {
    "movie_id": "123",
    "title": "Batman Begins",
    "year": "2005",
    "genre": "Action",
    "poster": "batman_begins.jpg"
  },
  {
    "movie_id": "124",
    "title": "The Batman",
    "year": "2022",
    "genre": "Action",
    "poster": "the_batman.jpg"
  }
]
```

---

### 6. Load Searched Movies

**Endpoint**: `ajax/loadSearchedMovies.php`

**Method**: `POST`

**Description**: Loads full search results page

**Parameters**:

- `searchQuery` (required): Search query string

**Request Example**:

```javascript
$.ajax({
  url: "ajax/loadSearchedMovies.php",
  method: "POST",
  data: { searchQuery: "action" },
  success: function (response) {
    $("#search-results").html(response);
  },
});
```

**Response**: HTML markup of search results

---

## Admin AJAX Endpoints

### 1. Get Movies (DataTable)

**Endpoint**: `admin/ajax/getMovies.php`

**Method**: `GET`

**Description**: Retrieves movies data for DataTables (admin panel)

**Parameters**:

- `draw` (required): DataTables draw counter
- `start` (required): Pagination start
- `length` (required): Number of records per page
- `search[value]` (optional): Search query
- `order[0][column]` (optional): Column to sort by
- `order[0][dir]` (optional): Sort direction (asc/desc)

**Request Example**:

```javascript
$("#movies-table").DataTable({
  ajax: "ajax/getMovies.php",
  processing: true,
  serverSide: true,
  columns: [
    { data: "movie_id" },
    { data: "title" },
    { data: "year" },
    { data: "genre" },
    { data: "actions" },
  ],
});
```

**Response Format**:

```json
{
  "draw": 1,
  "recordsTotal": 500,
  "recordsFiltered": 50,
  "data": [
    {
      "movie_id": "123",
      "title": "The Godfather",
      "year": "1972",
      "genre": "Drama",
      "country": "USA",
      "actions": "<a href='edit.php?id=123'>Edit</a>"
    }
  ]
}
```

---

### 2. Get Trailers (DataTable)

**Endpoint**: `admin/ajax/getTrailers.php`

**Method**: `GET`

**Description**: Retrieves trailers data for DataTables

**Parameters**: Same as getMovies.php

**Response Format**:

```json
{
  "draw": 1,
  "recordsTotal": 200,
  "recordsFiltered": 20,
  "data": [
    {
      "trailer_id": "45",
      "movie_title": "The Godfather",
      "trailer_url": "https://youtube.com/watch?v=...",
      "actions": "<a href='edit.php?id=45'>Edit</a>"
    }
  ]
}
```

---

## Form Submissions

### 1. Submit Comment

**Endpoint**: `submit_comment.php`

**Method**: `POST`

**Description**: Submits a user comment for a movie

**Parameters**:

- `movie_id` (required): Movie ID
- `name` (required): Commenter name
- `email` (required): Commenter email
- `comment` (required): Comment text

**Request Example**:

```html
<form action="submit_comment.php" method="POST">
  <input type="hidden" name="movie_id" value="123" />
  <input type="text" name="name" required />
  <input type="email" name="email" required />
  <textarea name="comment" required></textarea>
  <button type="submit">Submit</button>
</form>
```

**Response**: Redirect to movie page with success message

**Validation**:

- Name: Required, max 100 characters
- Email: Valid email format
- Comment: Required, max 500 characters

---

### 2. Add Movie (Admin)

**Endpoint**: `admin/add_movie.php`

**Method**: `POST`

**Description**: Adds or updates a movie

**Parameters**:

- `movie_id` (optional): For editing existing movie
- `title` (required): Movie title
- `year` (required): Release year
- `plot` (required): Movie plot/description
- `poster` (file): Movie poster image
- `genres[]` (required): Array of genre IDs
- `actors[]` (required): Array of actor IDs
- `country_id` (required): Country ID
- `trailer_url` (optional): YouTube trailer URL

**Request Example**:

```html
<form action="add_movie.php" method="POST" enctype="multipart/form-data">
  <input type="text" name="title" required />
  <input type="number" name="year" required />
  <textarea name="plot" required></textarea>
  <input type="file" name="poster" accept="image/*" />
  <select name="genres[]" multiple required>
    <option value="1">Action</option>
    <option value="2">Drama</option>
  </select>
  <select name="actors[]" multiple required>
    <option value="1">Actor 1</option>
    <option value="2">Actor 2</option>
  </select>
  <button type="submit">Add Movie</button>
</form>
```

**Response**: Redirect to movie list with success message

**File Upload Requirements**:

- Allowed types: JPG, JPEG, PNG, GIF
- Max size: 5MB
- Stored in: `assets/images/movie_poster/`

---

### 3. Add Trailer (Admin)

**Endpoint**: `admin/operation/add_trailer.php`

**Method**: `POST`

**Description**: Adds a trailer to a movie

**Parameters**:

- `movie_id` (required): Movie ID
- `trailer_url` (required): YouTube URL
- `trailer_title` (required): Trailer title

**Request Example**:

```html
<form action="operation/add_trailer.php" method="POST">
  <select name="movie_id" required>
    <option value="123">The Godfather</option>
  </select>
  <input type="text" name="trailer_title" required />
  <input type="url" name="trailer_url" required />
  <button type="submit">Add Trailer</button>
</form>
```

**Response**: Redirect with success message

---

### 4. Delete Movie (Admin)

**Endpoint**: `admin/operation/delete_movie.php`

**Method**: `GET`

**Description**: Deletes a movie and all related data

**Parameters**:

- `movie_id` (required): Movie ID to delete

**Request Example**:

```javascript
if (confirm("Are you sure you want to delete this movie?")) {
  window.location.href = "operation/delete_movie.php?movie_id=123";
}
```

**Response**: Redirect to movie list with success message

**Cascading Deletes**:

- Removes from `movie_table`
- Removes from `movie_actors_table` (relationships)
- Removes from `movie_genre_table` (relationships)
- Removes associated comments
- Deletes poster file

---

### 5. Add Genre (Admin)

**Endpoint**: `admin/operation/add_genre.php`

**Method**: `POST`

**Description**: Adds a new genre

**Parameters**:

- `genre_name` (required): Genre name

**Request Example**:

```html
<form action="operation/add_genre.php" method="POST">
  <input type="text" name="genre_name" required />
  <button type="submit">Add Genre</button>
</form>
```

**Response**: Redirect with success message

---

## Response Formats

### Success Response (HTML)

Most endpoints return HTML markup that can be directly inserted into the page:

```html
<div class="success-message">Movie added successfully!</div>
```

### Success Response (JSON)

```json
{
  "status": "success",
  "message": "Operation completed successfully",
  "data": {
    "id": 123,
    "title": "New Movie"
  }
}
```

### Error Response (JSON)

```json
{
  "status": "error",
  "message": "Invalid movie ID",
  "errors": ["Movie not found", "Invalid parameters"]
}
```

### Empty Response

When no results are found:

```html
<div class="no-results">
  <p>No movies found matching your criteria.</p>
</div>
```

---

## Authentication

### Admin Authentication

All admin endpoints require authentication via PHP sessions.

**Login Process**:

1. User submits credentials to `admin/login.php`
2. System validates against `user` table
3. Creates session with user data
4. Redirects to admin dashboard

**Session Check**:

```php
session_start();
if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
```

**Session Variables**:

- `$_SESSION['user_id']`: User ID
- `$_SESSION['username']`: Username
- `$_SESSION['logged_in']`: Boolean login status

---

## Error Handling

### Common Error Codes

| Code | Meaning      | Example                        |
| ---- | ------------ | ------------------------------ |
| 200  | Success      | Request completed successfully |
| 400  | Bad Request  | Missing required parameters    |
| 401  | Unauthorized | Not logged in (admin)          |
| 404  | Not Found    | Movie/resource not found       |
| 500  | Server Error | Database connection failed     |

### Error Display

**Frontend**:

```javascript
$.ajax({
  url: "ajax/endpoint.php",
  error: function (xhr, status, error) {
    alert("An error occurred: " + error);
  },
});
```

**Backend**:

```php
// Enable error reporting in development
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Disable in production
error_reporting(0);
ini_set('display_errors', 0);
```

### Database Error Handling

```php
$result = $database->query($query);
if(!$result) {
    die("Database query failed: " . $database->error());
}
```

---

## Code Examples

### Complete AJAX Movie Load Example

**JavaScript (Frontend)**:

```javascript
$(document).ready(function () {
  // Load all movies on page load
  loadMovies();

  // Filter by genre
  $(".genre-filter").on("click", function (e) {
    e.preventDefault();
    var genreId = $(this).data("genre-id");
    loadMoviesByGenre(genreId);
  });

  function loadMovies() {
    $.ajax({
      url: "ajax/loadAllMovies.php",
      method: "GET",
      beforeSend: function () {
        $("#movies-container").html('<div class="loader">Loading...</div>');
      },
      success: function (response) {
        $("#movies-container").html(response);
      },
      error: function () {
        $("#movies-container").html(
          '<div class="error">Error loading movies</div>',
        );
      },
    });
  }

  function loadMoviesByGenre(genreId) {
    $.ajax({
      url: "ajax/loadMoviesByGenre.php",
      method: "POST",
      data: { genre_id: genreId },
      success: function (response) {
        $("#movies-container").html(response);
      },
    });
  }
});
```

**PHP (Backend - ajax/loadAllMovies.php)**:

```php
<?php
include '../admin/includes/configuration.php';
include '../admin/includes/database.php';

$database = new Database();

// Pagination
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$per_page = 12;
$offset = ($page - 1) * $per_page;

// Query
$query = "SELECT m.*, g.genre_name, y.year_name
          FROM movie_table m
          LEFT JOIN genre g ON m.genre_id = g.genre_id
          LEFT JOIN year y ON m.year_id = y.year_id
          ORDER BY m.movie_id DESC
          LIMIT {$offset}, {$per_page}";

$result = $database->query($query);

// Output HTML
if($database->num_rows($result) > 0) {
    while($row = $database->fetch_array($result)) {
        ?>
        <div class="col-md-3 grid_2">
            <div class="grid_1">
                <a href="single.php?movie_id=<?php echo $row['movie_id']; ?>">
                    <img src="assets/images/movie_poster/<?php echo $row['poster']; ?>"
                         alt="<?php echo $row['title']; ?>"
                         class="img-responsive">
                    <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                </a>
                <span class="m_4">
                    <?php echo $row['genre_name']; ?> | <?php echo $row['year_name']; ?>
                </span>
            </div>
        </div>
        <?php
    }
} else {
    echo '<div class="col-md-12"><p>No movies found.</p></div>';
}
?>
```

---

## Best Practices

1. **Always sanitize user input**

   ```php
   $search = mysqli_real_escape_string($conn, $_POST['search']);
   ```

2. **Use prepared statements for security**

   ```php
   $stmt = $conn->prepare("SELECT * FROM movies WHERE id = ?");
   $stmt->bind_param("i", $movie_id);
   $stmt->execute();
   ```

3. **Return appropriate HTTP headers**

   ```php
   header('Content-Type: application/json');
   header('HTTP/1.1 200 OK');
   ```

4. **Handle errors gracefully**

   ```php
   try {
       // Code
   } catch(Exception $e) {
       echo json_encode(['error' => $e->getMessage()]);
   }
   ```

5. **Validate all inputs**
   ```php
   if(empty($_POST['movie_id']) || !is_numeric($_POST['movie_id'])) {
       die("Invalid movie ID");
   }
   ```

---

## Testing API Endpoints

### Using cURL

```bash
# GET request
curl http://localhost:9001/ajax/loadAllMovies.php

# POST request
curl -X POST http://localhost:9001/ajax/search_result.php \
     -d "search=batman"

# With headers
curl -X POST http://localhost:9001/ajax/loadMoviesByGenre.php \
     -H "Content-Type: application/x-www-form-urlencoded" \
     -d "genre_id=5"
```

### Using Browser DevTools

1. Open browser DevTools (F12)
2. Go to Network tab
3. Trigger AJAX request
4. View request/response details

### Using Postman

1. Import endpoint
2. Set method (GET/POST)
3. Add parameters
4. Send request
5. View response

---

For more information, see [Developer Guide](DEVELOPER_GUIDE.md) and [Database Schema](DATABASE_SCHEMA.md).
