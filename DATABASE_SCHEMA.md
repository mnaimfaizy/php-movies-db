# Database Schema Documentation 🗄️

This document provides comprehensive documentation for the database structure of the PHP Movies Database application.

## Table of Contents

- [Overview](#overview)
- [Database Tables](#database-tables)
- [Entity Relationship Diagram](#entity-relationship-diagram)
- [Table Relationships](#table-relationships)
- [Field Descriptions](#field-descriptions)
- [Sample Queries](#sample-queries)
- [Indexes and Keys](#indexes-and-keys)

## Overview

**Database Name**: `php_movies_db`

**Database Engine**: MySQL/MariaDB

**Character Set**: UTF-8/Latin1

**Total Tables**: 10

### Database Configuration

From `admin/includes/configuration.php`:

```php
DB_SERVER: "php_movies_db" (or "localhost")
DB_USER: "admin"
DB_PASS: "Kabul@123"
DB_NAME: "php_movies_db"
```

## Database Tables

### 1. movie_table

**Purpose**: Stores main movie information

| Column         | Type         | Description               |
| -------------- | ------------ | ------------------------- |
| `movie_id`     | INT(20) PK   | Unique movie identifier   |
| `movie_title`  | VARCHAR(200) | Movie title               |
| `duration`     | VARCHAR(100) | Movie runtime             |
| `country_id`   | INT(11) FK   | Country reference         |
| `year_id`      | INT(11) FK   | Release year reference    |
| `release_date` | VARCHAR(50)  | Release date              |
| `director`     | VARCHAR(200) | Director name(s)          |
| `rating`       | FLOAT        | Movie rating (out of 10)  |
| `movie_desc`   | TEXT         | Movie plot/description    |
| `trailer`      | VARCHAR(300) | Trailer URL (YouTube)     |
| `imdb_link`    | VARCHAR(200) | IMDb link                 |
| `status`       | VARCHAR(30)  | Movie status              |
| `poster`       | VARCHAR(300) | Poster image filename     |
| `date_added`   | INT(50)      | Unix timestamp when added |

**Indexes**:

- PRIMARY KEY: `movie_id`

**Storage**: ~500+ movies (based on sample data)

---

### 2. actors_table

**Purpose**: Stores actor/actress information

| Column       | Type         | Description               |
| ------------ | ------------ | ------------------------- |
| `actor_id`   | INT(20) PK   | Unique actor identifier   |
| `actor_name` | VARCHAR(200) | Actor/actress name        |
| `date_added` | INT(100)     | Unix timestamp when added |

**Indexes**:

- PRIMARY KEY: `actor_id`

**Storage**: ~1500+ actors (based on sample data)

---

### 3. movie_actors_table

**Purpose**: Many-to-many relationship between movies and actors

| Column     | Type       | Description            |
| ---------- | ---------- | ---------------------- |
| `m_a_id`   | INT(20) PK | Unique relationship ID |
| `movie_id` | INT(20) FK | Movie reference        |
| `actor_id` | INT(20) FK | Actor reference        |

**Indexes**:

- PRIMARY KEY: `m_a_id`
- FOREIGN KEY: `movie_id` → `movie_table(movie_id)`
- FOREIGN KEY: `actor_id` → `actors_table(actor_id)`

**Purpose**: Links multiple actors to each movie

---

### 4. genre

**Purpose**: Stores movie genre categories

| Column     | Type         | Description             |
| ---------- | ------------ | ----------------------- |
| `genre_id` | INT(11) PK   | Unique genre identifier |
| `genre`    | VARCHAR(100) | Genre name              |

**Indexes**:

- PRIMARY KEY: `genre_id`

**Predefined Genres** (23 total):

- Action, Adventure, Animation, Biography
- Comedy, Crime, Documentary, Drama
- Family, Fantasy, Film-Noir, History
- Horror, Music, Musical, Mystery
- Romance, Sci-Fi, Sport, Thriller
- War, Western, Short

---

### 5. movie_genre_table

**Purpose**: Many-to-many relationship between movies and genres

| Column     | Type       | Description            |
| ---------- | ---------- | ---------------------- |
| `m_g_id`   | INT(20) PK | Unique relationship ID |
| `movie_id` | INT(20) FK | Movie reference        |
| `genre_id` | INT(11) FK | Genre reference        |

**Indexes**:

- PRIMARY KEY: `m_g_id`
- FOREIGN KEY: `movie_id` → `movie_table(movie_id)`
- FOREIGN KEY: `genre_id` → `genre(genre_id)`

**Purpose**: Links multiple genres to each movie

---

### 6. year

**Purpose**: Stores release years

| Column    | Type        | Description            |
| --------- | ----------- | ---------------------- |
| `year_id` | INT(11) PK  | Unique year identifier |
| `year`    | VARCHAR(10) | Year value             |

**Indexes**:

- PRIMARY KEY: `year_id`

**Range**: Typically 1900-present

---

### 7. country

**Purpose**: Stores country information

| Column       | Type         | Description               |
| ------------ | ------------ | ------------------------- |
| `country_id` | INT(11) PK   | Unique country identifier |
| `country`    | VARCHAR(100) | Country name              |

**Indexes**:

- PRIMARY KEY: `country_id`

**Storage**: ~240 countries

---

### 8. comments

**Purpose**: Stores user comments on movies

| Column       | Type         | Description               |
| ------------ | ------------ | ------------------------- |
| `comment_id` | INT(100) PK  | Unique comment identifier |
| `name`       | VARCHAR(100) | Commenter name            |
| `email`      | VARCHAR(200) | Commenter email           |
| `message`    | VARCHAR(500) | Comment text              |
| `date`       | INT(100)     | Unix timestamp            |
| `movie_id`   | INT(10) FK   | Movie reference           |

**Indexes**:

- PRIMARY KEY: `comment_id`
- FOREIGN KEY: `movie_id` → `movie_table(movie_id)`

---

### 9. user

**Purpose**: Stores admin user credentials

| Column       | Type         | Description            |
| ------------ | ------------ | ---------------------- |
| `user_id`    | INT(11) PK   | Unique user identifier |
| `username`   | VARCHAR(100) | Admin username         |
| `password`   | VARCHAR(255) | Hashed password        |
| `email`      | VARCHAR(200) | User email             |
| `date_added` | INT(50)      | Unix timestamp         |

**Indexes**:

- PRIMARY KEY: `user_id`
- UNIQUE: `username`

**Security**: Passwords should be hashed using PHP's `password_hash()`

---

### 10. movies (VIEW)

**Purpose**: Combined view of movie data with related information

**Note**: This is a VIEW, not a physical table. It combines data from:

- `movie_table`
- `genre`
- `movie_genre_table`
- `actors_table`
- `movie_actors_table`
- `year`
- `country`

---

## Entity Relationship Diagram

```
┌─────────────────┐         ┌──────────────────┐
│   movie_table   │         │  actors_table    │
├─────────────────┤         ├──────────────────┤
│ movie_id (PK)   │         │ actor_id (PK)    │
│ movie_title     │         │ actor_name       │
│ duration        │         │ date_added       │
│ country_id (FK) │         └──────────────────┘
│ year_id (FK)    │                 ▲
│ director        │                 │
│ rating          │                 │
│ poster          │                 │
└─────────────────┘                 │
         ▲                          │
         │                          │
         │         ┌────────────────┴──────────────┐
         │         │   movie_actors_table          │
         └─────────┤─────────────────────────────  │
                   │ m_a_id (PK)                   │
                   │ movie_id (FK)                 │
                   │ actor_id (FK)                 │
                   └───────────────────────────────┘

┌─────────────────┐
│     genre       │
├─────────────────┤
│ genre_id (PK)   │
│ genre           │
└─────────────────┘
         ▲
         │
         │         ┌────────────────────────────────┐
         │         │   movie_genre_table            │
         └─────────┤───────────────────────────────-│
                   │ m_g_id (PK)                    │
                   │ movie_id (FK)                  │
                   │ genre_id (FK)                  │
                   └────────────────────────────────┘

┌─────────────────┐         ┌──────────────────┐
│     country     │         │      year        │
├─────────────────┤         ├──────────────────┤
│ country_id (PK) │         │ year_id (PK)     │
│ country         │         │ year             │
└─────────────────┘         └──────────────────┘
         ▲                           ▲
         │                           │
         └───────────────┬───────────┘
                         │
                   (References from
                    movie_table)

┌─────────────────┐
│    comments     │
├─────────────────┤
│ comment_id (PK) │
│ name            │
│ email           │
│ message         │
│ movie_id (FK)   │──────► movie_table
└─────────────────┘
```

## Table Relationships

### One-to-Many Relationships

1. **country → movie_table**
   - One country can have many movies
   - Referenced by: `movie_table.country_id`

2. **year → movie_table**
   - One year can have many movies
   - Referenced by: `movie_table.year_id`

3. **movie_table → comments**
   - One movie can have many comments
   - Referenced by: `comments.movie_id`

### Many-to-Many Relationships

1. **movie_table ↔ actors_table**
   - Through: `movie_actors_table`
   - One movie can have many actors
   - One actor can be in many movies

2. **movie_table ↔ genre**
   - Through: `movie_genre_table`
   - One movie can have multiple genres
   - One genre can apply to many movies

## Field Descriptions

### Date Storage

All dates in the database are stored as **Unix timestamps** (integer):

```php
// Current timestamp
$timestamp = time();

// Convert to readable format
$date = date('Y-m-d H:i:s', $timestamp);

// Display format
$display = date('F d, Y', $timestamp);
```

### Rating System

- Type: FLOAT
- Range: 0.0 - 10.0
- Represents IMDb-style ratings

### Poster Images

- Stored in: `assets/images/movie_poster/`
- Field stores: Filename only (e.g., "movie_poster.jpg")
- Full path: `assets/images/movie_poster/{filename}`

### Trailer URLs

- Typically YouTube URLs
- Format: `https://www.youtube.com/watch?v=...`
- Can be embedded using iframe

## Sample Queries

### Get Movie with Full Details

```sql
SELECT
    m.movie_id,
    m.movie_title,
    m.duration,
    m.director,
    m.rating,
    m.movie_desc,
    y.year,
    c.country,
    GROUP_CONCAT(DISTINCT g.genre SEPARATOR ', ') AS genres,
    GROUP_CONCAT(DISTINCT a.actor_name SEPARATOR ', ') AS actors
FROM movie_table m
LEFT JOIN year y ON m.year_id = y.year_id
LEFT JOIN country c ON m.country_id = c.country_id
LEFT JOIN movie_genre_table mgt ON m.movie_id = mgt.movie_id
LEFT JOIN genre g ON mgt.genre_id = g.genre_id
LEFT JOIN movie_actors_table mat ON m.movie_id = mat.movie_id
LEFT JOIN actors_table a ON mat.actor_id = a.actor_id
WHERE m.movie_id = 1
GROUP BY m.movie_id;
```

### Get Movies by Genre

```sql
SELECT DISTINCT m.*
FROM movie_table m
JOIN movie_genre_table mgt ON m.movie_id = mgt.movie_id
JOIN genre g ON mgt.genre_id = g.genre_id
WHERE g.genre = 'Action'
ORDER BY m.rating DESC
LIMIT 10;
```

### Get Movies by Actor

```sql
SELECT m.movie_title, m.year_id, m.rating
FROM movie_table m
JOIN movie_actors_table mat ON m.movie_id = mat.movie_id
JOIN actors_table a ON mat.actor_id = a.actor_id
WHERE a.actor_name = 'Tom Hanks'
ORDER BY m.year_id DESC;
```

### Get Top Rated Movies

```sql
SELECT m.movie_title, m.rating, y.year
FROM movie_table m
JOIN year y ON m.year_id = y.year_id
ORDER BY m.rating DESC
LIMIT 10;
```

### Get Recent Comments

```sql
SELECT c.*, m.movie_title
FROM comments c
JOIN movie_table m ON c.movie_id = m.movie_id
ORDER BY c.date DESC
LIMIT 20;
```

### Search Movies

```sql
SELECT *
FROM movie_table
WHERE movie_title LIKE '%search_term%'
   OR movie_desc LIKE '%search_term%'
ORDER BY rating DESC;
```

### Get Movie Count by Genre

```sql
SELECT g.genre, COUNT(mgt.movie_id) as movie_count
FROM genre g
LEFT JOIN movie_genre_table mgt ON g.genre_id = mgt.genre_id
GROUP BY g.genre_id
ORDER BY movie_count DESC;
```

### Get Actor Filmography

```sql
SELECT
    a.actor_name,
    COUNT(mat.movie_id) as total_movies,
    GROUP_CONCAT(m.movie_title ORDER BY y.year DESC SEPARATOR ', ') as movies
FROM actors_table a
JOIN movie_actors_table mat ON a.actor_id = mat.actor_id
JOIN movie_table m ON mat.movie_id = m.movie_id
JOIN year y ON m.year_id = y.year_id
WHERE a.actor_id = 1
GROUP BY a.actor_id;
```

## Indexes and Keys

### Primary Keys

All tables have auto-incrementing primary keys:

```sql
-- Example
ALTER TABLE movie_table
ADD PRIMARY KEY (movie_id),
MODIFY movie_id INT(20) AUTO_INCREMENT;
```

### Foreign Key Constraints

```sql
-- movie_actors_table
ALTER TABLE movie_actors_table
ADD FOREIGN KEY (movie_id) REFERENCES movie_table(movie_id)
    ON DELETE CASCADE ON UPDATE CASCADE,
ADD FOREIGN KEY (actor_id) REFERENCES actors_table(actor_id)
    ON DELETE CASCADE ON UPDATE CASCADE;

-- movie_genre_table
ALTER TABLE movie_genre_table
ADD FOREIGN KEY (movie_id) REFERENCES movie_table(movie_id)
    ON DELETE CASCADE ON UPDATE CASCADE,
ADD FOREIGN KEY (genre_id) REFERENCES genre(genre_id)
    ON DELETE CASCADE ON UPDATE CASCADE;

-- comments
ALTER TABLE comments
ADD FOREIGN KEY (movie_id) REFERENCES movie_table(movie_id)
    ON DELETE CASCADE ON UPDATE CASCADE;
```

### Recommended Indexes for Performance

```sql
-- Index on movie_title for search
CREATE INDEX idx_movie_title ON movie_table(movie_title);

-- Index on actor_name for search
CREATE INDEX idx_actor_name ON actors_table(actor_name);

-- Index on rating for sorting
CREATE INDEX idx_rating ON movie_table(rating);

-- Composite index for common queries
CREATE INDEX idx_movie_year_country
ON movie_table(year_id, country_id);
```

## Database Maintenance

### Backup

```bash
# Full backup
mysqldump -u admin -p php_movies_db > backup.sql

# Structure only
mysqldump -u admin -p --no-data php_movies_db > structure.sql

# Data only
mysqldump -u admin -p --no-create-info php_movies_db > data.sql
```

### Restore

```bash
mysql -u admin -p php_movies_db < backup.sql
```

### Database Size

```sql
-- Check table sizes
SELECT
    table_name AS 'Table',
    ROUND(((data_length + index_length) / 1024 / 1024), 2) AS 'Size (MB)'
FROM information_schema.TABLES
WHERE table_schema = 'php_movies_db'
ORDER BY (data_length + index_length) DESC;
```

### Optimize Tables

```sql
OPTIMIZE TABLE movie_table;
OPTIMIZE TABLE actors_table;
OPTIMIZE TABLE movie_actors_table;
```

## Data Migration

### Adding New Fields

```sql
-- Add a new column
ALTER TABLE movie_table
ADD COLUMN budget VARCHAR(50) AFTER rating;

-- Modify existing column
ALTER TABLE movie_table
MODIFY COLUMN movie_desc LONGTEXT;
```

### Importing Sample Data

```bash
# From SQL file
mysql -u admin -p php_movies_db < admin/sql/php_movies_db.sql

# Using Docker
docker exec -i php_movies_db mysql -uadmin -pKabul@123 php_movies_db < admin/sql/php_movies_db.sql
```

## Best Practices

1. **Always use prepared statements** to prevent SQL injection
2. **Index frequently searched columns** (title, actor_name)
3. **Use JOINs efficiently** - don't fetch unnecessary data
4. **Limit results** when displaying lists
5. **Cache complex queries** when possible
6. **Regular backups** of the database
7. **Monitor query performance** using EXPLAIN
8. **Use transactions** for related inserts/updates

---

For more information, see:

- [Developer Guide](DEVELOPER_GUIDE.md)
- [API Documentation](API_DOCUMENTATION.md)
