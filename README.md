# PHP Movies Database 🎬

> **University Project** - Originally developed in 2014 as a university project, enhanced in 2026 with modern features.

A complete full-featured movies catalog web application built with PHP and MySQL. This application allows users to browse movies, view trailers, search for content, and comment on movies. It includes a comprehensive admin panel for managing movies, actors, genres, trailers, and user comments.

## 📋 Table of Contents

- [Features](#features)
- [Recent Enhancements](#recent-enhancements)
- [Technology Stack](#technology-stack)
- [Quick Start](#quick-start)
- [External API Integration](#external-api-integration)
- [Project Structure](#project-structure)
- [Documentation](#documentation)
- [Demo](#demo)
- [Contributing](#contributing)
- [License](#license)

## ✨ Features

### User Features

- **Browse Movies**: View featured and latest uploaded movies with pagination
- **Search Functionality**: Real-time AJAX-based movie search with debouncing
- **Movie Details**: View comprehensive movie information including:
  - Plot synopsis
  - Cast and actors
  - Genre, year, and country
  - Movie trailers
  - User comments with validation
- **Trailers Gallery**: Browse and watch movie trailers
- **Actor Profiles**: View actor details and their filmography
- **Filter Options**: Browse movies by genre, year, or country
- **User Comments**: Submit and view comments on movies with proper validation
- **Responsive Design**: Modern mobile-first interface using Bootstrap 5
- **Modern UI**: Netflix-inspired design with smooth animations and hover effects
- **Loading States**: Visual feedback with loading spinners and toast notifications

### Admin Features

- **Dashboard**: AdminLTE-based modern admin interface
- **Movie Management**: Add, edit, delete movies with poster uploads
- **External API Integration**: Fetch movie details from OMDb API using IMDb ID or search by title
- **Manual Entry**: Ability to add movies manually without using the API
- **Trailer Management**: Add and manage movie trailers
- **Actor Management**: Manage actor database
- **User Management**: Add and manage admin users
- **Comment Moderation**: View and manage user comments
- **Metadata Management**: Manage genres, years, and countries
- **AJAX Operations**: Dynamic content loading without page refresh

## 🚀 Recent Enhancements

### Security Improvements ✅

- **SQL Injection Protection**: All user inputs are properly escaped using `escape_value()`
- **Input Validation**: Comprehensive server-side validation for all forms
- **Email Validation**: Using `filter_var()` for proper email format checking
- **XSS Protection**: Output sanitization with `htmlspecialchars()`
- **Environment Configuration**: Support for `.env` files to manage credentials securely
- **Error Display Control**: Environment-based error reporting (hidden in production)

### UI/UX Enhancements ✅

- **Bootstrap 5 Upgrade**: Migrated from Bootstrap 3 to Bootstrap 5.3.2
- **Modern Design System**: Complete CSS variable system with Netflix-inspired color palette
- **Hero Slider**: Dynamic hero section with featured movies and gradient overlays
- **Modern Movie Cards**: Interactive cards with hover effects, rating badges, and smooth animations
- **Enhanced Navigation**: Fixed navbar with glass-morphism effect and active page highlighting
- **Font Awesome 6**: Updated icon library with 2000+ new icons
- **Inter Font**: Modern, clean typography replacing Roboto Condensed
- **Responsive Grid**: Mobile-first responsive layout with smooth transitions
- **Loading Components**: Spinner overlays and toast notification system

### User Experience Improvements ✅

- **Toast Notifications**: Modern toast system for success/error messages (4 types: success, error, info, warning)
- **Loading Spinners**: Auto-displaying loading overlay during AJAX requests
- **Smooth Animations**: CSS transitions and transforms for card interactions
- **Lazy Loading**: IntersectionObserver for efficient image loading
- **Debounced Search**: 300ms debouncing to prevent excessive API calls
- **Better Error Handling**: User-friendly error messages instead of generic alerts
- **Hover Effects**: Movie cards with scale, lift, and overlay effects
- **Statistics Dashboard**: Display total movies and actors count with modern cards

## 🚀 Technology Stack

- **Backend**: PHP 8.0
- **Database**: MySQL/MariaDB
- **Frontend**:
  - HTML5, CSS3, JavaScript (ES6+)
  - Bootstrap 5.3.2 (Frontend)
  - AdminLTE 3.x (Admin Panel)
  - jQuery & AJAX
  - Font Awesome 6.5.1
  - Inter Font Family
- **Containerization**: Docker & Docker Compose
- **Web Server**: Apache
- **External APIs**:
  - OMDb API for movie data fetching
- **Additional Libraries**:
  - Magnific Popup (Image/Video Lightbox)
  - FlexiSlider (Image Slider)
  - DataTables (Admin Tables)
  - CKEditor (Rich Text Editor)
  - jQuery Validation

## 🏃 Quick Start

### Prerequisites

- Docker and Docker Compose installed
- OR Apache/Nginx with PHP 8.0+ and MySQL

### Using Docker (Recommended)

1. **Clone the repository**

   ```bash
   git clone https://github.com/mnaimfaizy/php-movies-db.git
   cd php-movies-db
   ```

2. **Start the containers**

   ```bash
   docker compose up --build -d
   ```

3. **Import the database**
   - Access the application at `http://localhost:9001`
   - Import the SQL file from `admin/sql/php_movies_db.sql`
   - Use phpMyAdmin at `http://localhost:8080` or import via command line:

   ```bash
   docker exec -i php_movies_db mysql -uadmin -pKabul@123 php_movies_db < admin/sql/php_movies_db.sql
   ```

4. **Access the application**
   - **Frontend**: http://localhost:9001
   - **Admin Panel**: http://localhost:9001/admin
   - **Database**: localhost:33067

### Default Credentials

```
Database:
- Host: localhost (or php_movies_db for container)
- Port: 33067 (external) / 3306 (internal)
- Database: php_movies_db
- Username: admin
- Password: Kabul@123
```

> ⚠️ **Security Note**: Change default credentials before deploying to production!

### Optional: Environment Variables

Create a `.env` file in the root directory to configure environment-specific settings:

```env
DB_HOST=php_movies_db
DB_USERNAME=admin
DB_PASSWORD=Kabul@123
DB_DATABASE=php_movies_db
DB_PORT=3306
APP_ENV=production
APP_DEBUG=false
```

## 🔌 External API Integration

This application integrates with the **OMDb API** (Open Movie Database) to fetch comprehensive movie information automatically.

### Features

- **Auto-Fetch Movie Data**: Enter an IMDb ID and automatically retrieve:
  - Movie title, year, genre, country
  - Plot synopsis
  - Poster image
  - Ratings (IMDb, Rotten Tomatoes, Metacritic)
  - Director, writer, actors
  - Runtime, release date
  
- **Search by Title**: Search for movies by title and select from results

- **Manual Entry**: All fields can be manually entered/edited if you prefer not to use the API or if the API doesn't have the movie

### How to Use

1. **In Admin Panel** → Go to "Add Movie"
2. **Option 1 - Fetch by IMDb ID**:
   - Enter IMDb ID (e.g., `tt0111161` for The Shawshank Redemption)
   - Click "Fetch Details" button
   - Movie data will auto-populate
   
3. **Option 2 - Search by Title**:
   - Enter movie title in search field
   - Click "Search" button
   - Select the correct movie from search results
   - Movie data will auto-populate

4. **Option 3 - Manual Entry**:
   - Fill in all fields manually without using the API
   - Upload poster image
   - Save the movie

### API Configuration

The OMDb API key is currently hardcoded in:
- `admin/add_movie.php` (Line 60, 264)
- `admin/view_details.php` (Line 31)

**API Endpoint**: `http://omdbapi.com/?apikey=2db3e567`

> **Note**: The current API key is for development purposes. For production, obtain your own free API key from [OMDb API](http://www.omdbapi.com/apikey.aspx) and update the files accordingly.

## 📁 Project Structure

```
php-movies-db/
├── admin/                      # Admin panel
│   ├── assets/                 # AdminLTE assets (CSS, JS, plugins)
│   ├── includes/               # Admin PHP includes
│   ├── operation/              # Backend operations
│   ├── sql/                    # Database files
│   └── *.php                   # Admin pages
├── ajax/                       # AJAX endpoints for frontend
├── assets/                     # Frontend assets
│   ├── css/                    # Stylesheets
│   │   ├── modern-ui.css       # Modern UI design system (NEW)
│   │   ├── style.css           # Main styles
│   │   └── ...
│   ├── js/                     # JavaScript files
│   │   ├── modern-ui.js        # Modern UI functionality (NEW)
│   │   └── ...
│   ├── images/                 # Images and movie posters
│   ├── font-awesome/           # Icon library
│   └── favicon/                # Favicon files
├── includes/                   # Frontend PHP includes
│   ├── loading_toast.inc.php   # Loading spinner & toast system (NEW)
│   ├── header.inc.php          # Enhanced with Bootstrap 5 (UPDATED)
│   ├── footer.inc.php          # Enhanced with modern scripts (UPDATED)
│   └── ...
├── docker-compose.yml          # Docker composition
├── Dockerfile                  # Docker image definition
└── *.php                       # Main application pages
```

## 📚 Documentation

For detailed documentation, please refer to:

- **[Developer Guide](DEVELOPER_GUIDE.md)** - Setup, development workflow, and coding standards
- **[API Documentation](API_DOCUMENTATION.md)** - Backend structure and AJAX endpoints
- **[Database Schema](DATABASE_SCHEMA.md)** - Database structure and relationships

## 🌐 Demo

You can see a live demo of the application at: [https://php-movies-db.mnfprofile.com](https://php-movies-db.mnfprofile.com)

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request. For major changes:

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📄 License

This project is licensed under the terms included in the [LICENSE](LICENSE) file.

## 👨‍💻 Author

Created with ❤️ by Mohammad Naim Faizy

- Website: [https://mnfprofile.com](https://mnfprofile.com)
- GitHub: [@mnaimfaizy](https://github.com/mnaimfaizy)

---

## 🎨 Design Philosophy

The 2026 enhancements focused on creating a modern, Netflix-inspired interface while maintaining the core functionality:

- **Color Scheme**: Netflix red (#e50914) with dark backgrounds for a cinematic feel
- **Typography**: Inter font family for clean, modern readability
- **Animations**: Smooth transitions (0.3s) for professional feel
- **Mobile-First**: Responsive design ensuring great experience on all devices
- **User Feedback**: Loading states and toast notifications keep users informed

---

**Note**: This is an educational project. Make sure to follow security best practices if deploying to production, including:
- Changing default database credentials
- Obtaining your own OMDb API key
- Enabling HTTPS
- Setting up proper error logging
- Implementing rate limiting
- Regular security updates
