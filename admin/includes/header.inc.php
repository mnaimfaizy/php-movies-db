<?php date_default_timezone_set('Asia/Kabul'); ?>
<?php require_once("includes/initialize.php"); ?>
<?php if(!$session->is_logged_in()) { redirect_to("login.php");  } ?>
<?php $page_name = get_page_name(); ?>

<!DOCTYPE HTML>
<html><head>
<title>MNF Movies Website</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="MNF Movies, PHP Movies Database, Mohammad Naim Faizy" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link rel="apple-touch-icon" sizes="57x57" href="../favicon/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="../favicon/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="../favicon/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="../favicon/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="../favicon/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="../favicon/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="../favicon/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="../favicon/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="../favicon/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="../favicon/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="../favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="../favicon/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="../favicon/favicon-16x16.png">
<link rel="manifest" href="../favicon/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="../favicon/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">

<!-- Font Awesome Icons -->
<link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

<!-- DataTables -->
<link rel="stylesheet" href="assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

<!-- Google Fonts - Inter -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<!-- Theme style -->
<link rel="stylesheet" href="assets/css/adminlte.min.css">
<!-- Custom Modern Admin Styles -->
<link rel="stylesheet" href="assets/css/admin-modern.css">
 
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php" class="nav-link">
          <i class="fas fa-tachometer-alt mr-1"></i> Dashboard
        </a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/" class="nav-link" target="_blank">
          <i class="fas fa-external-link-alt mr-1"></i> View Site
        </a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3 d-none d-md-flex">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search movies..." aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Quick Add Dropdown -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" title="Quick Add">
          <i class="fas fa-plus-circle"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
          <span class="dropdown-header"><i class="fas fa-bolt mr-1"></i> Quick Actions</span>
          <div class="dropdown-divider"></div>
          <a href="add_movie.php" class="dropdown-item">
            <i class="fas fa-film mr-2 text-primary"></i> Add New Movie
          </a>
          <a href="add_trailer.php" class="dropdown-item">
            <i class="fas fa-video mr-2 text-success"></i> Add Trailer
          </a>
          <a href="add_user.php" class="dropdown-item">
            <i class="fas fa-user-plus mr-2 text-info"></i> Add User
          </a>
          <div class="dropdown-divider"></div>
          <a href="year_genre_country.php" class="dropdown-item">
            <i class="fas fa-tags mr-2 text-warning"></i> Manage Categories
          </a>
        </div>
      </li>
      
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" title="Notifications">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">!</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-header"><i class="fas fa-bell mr-1"></i> Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="comment.php" class="dropdown-item">
            <i class="fas fa-comments mr-2 text-primary"></i> View Comments
            <span class="float-right text-muted text-sm">Check</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="movie_list.php" class="dropdown-item">
            <i class="fas fa-film mr-2 text-success"></i> Manage Movies
            <span class="float-right text-muted text-sm">View</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">
            <i class="fas fa-cog mr-1"></i> Settings
          </a>
        </div>
      </li>
      
      <!-- User Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" title="Profile">
          <i class="fas fa-user-circle"></i>
          <span class="d-none d-md-inline ml-1">Admin</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
          <span class="dropdown-header"><i class="fas fa-user mr-1"></i> Account</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-user-cog mr-2"></i> Profile Settings
          </a>
          <a href="#" class="dropdown-item">
            <i class="fas fa-key mr-2"></i> Change Password
          </a>
          <div class="dropdown-divider"></div>
          <a href="login.php?logout=true" class="dropdown-item text-danger">
            <i class="fas fa-sign-out-alt mr-2"></i> Logout
          </a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->