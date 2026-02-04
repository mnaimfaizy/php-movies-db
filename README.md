# PHP Movies Database 🎬

> **University Project** - Originally developed in 2014 as a university project.

A complete full-featured movies catalog web application built with PHP and MySQL. This application allows users to browse movies, view trailers, search for content, and comment on movies. It includes a comprehensive admin panel for managing movies, actors, genres, trailers, and user comments.

## 📋 Table of Contents

- [Features](#features)
- [Technology Stack](#technology-stack)
- [Quick Start](#quick-start)
- [Project Structure](#project-structure)
- [Documentation](#documentation)
- [Screenshots](#screenshots)
- [Demo](#demo)
- [Contributing](#contributing)
- [License](#license)

## ✨ Features

### User Features

- **Browse Movies**: View featured and latest uploaded movies with pagination
- **Search Functionality**: Real-time AJAX-based movie search
- **Movie Details**: View comprehensive movie information including:
  - Plot synopsis
  - Cast and actors
  - Genre, year, and country
  - Movie trailers
  - User comments
- **Trailers Gallery**: Browse and watch movie trailers
- **Actor Profiles**: View actor details and their filmography
- **Filter Options**: Browse movies by genre, year, or country
- **User Comments**: Submit and view comments on movies
- **Responsive Design**: Mobile-friendly interface using Bootstrap

### Admin Features

- **Dashboard**: AdminLTE-based modern admin interface
- **Movie Management**: Add, edit, delete movies with poster uploads
- **Trailer Management**: Add and manage movie trailers
- **Actor Management**: Manage actor database
- **User Management**: Add and manage admin users
- **Comment Moderation**: View and manage user comments
- **Metadata Management**: Manage genres, years, and countries
- **AJAX Operations**: Dynamic content loading without page refresh

## 🚀 Technology Stack

- **Backend**: PHP 8.0
- **Database**: MySQL/MariaDB
- **Frontend**:
  - HTML5, CSS3, JavaScript
  - Bootstrap (Frontend)
  - AdminLTE (Admin Panel)
  - jQuery & AJAX
- **Containerization**: Docker & Docker Compose
- **Web Server**: Apache
- **Additional Libraries**:
  - Font Awesome (Icons)
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
   git clone https://github.com/yourusername/php-movies-db.git
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
│   ├── js/                     # JavaScript files
│   ├── images/                 # Images and movie posters
│   ├── font-awesome/           # Icon library
│   └── favicon/                # Favicon files
├── includes/                   # Frontend PHP includes
├── docker-compose.yml          # Docker composition
├── Dockerfile                  # Docker image definition
└── *.php                       # Main application pages
```

## 📚 Documentation

For detailed documentation, please refer to:

- **[Developer Guide](DEVELOPER_GUIDE.md)** - Setup, development workflow, and coding standards
- **[API Documentation](API_DOCUMENTATION.md)** - Backend structure and AJAX endpoints
- **[Database Schema](DATABASE_SCHEMA.md)** - Database structure and relationships
- **[Deployment Guide](DEPLOYMENT.md)** - Production deployment instructions

## 🖼️ Screenshots

_Add your application screenshots here_

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

Created with ❤️ by the PHP Movies DB team

---

**Note**: This is an educational project. Make sure to follow security best practices if deploying to production.
