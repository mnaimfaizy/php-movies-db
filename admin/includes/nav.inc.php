  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <span style="width: 40px; height: 40px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 10px; display: inline-flex; align-items: center; justify-content: center; margin-right: 10px;">
        <i class="fas fa-film" style="color: #fff; font-size: 1.1rem;"></i>
      </span>
      <span class="brand-text font-weight-bold" style="font-size: 1.1rem;">MNF Movies</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
        <div class="image">
          <div style="width: 42px; height: 42px; background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
            <i class="fas fa-user" style="color: #fff;"></i>
          </div>
        </div>
        <div class="info">
          <a href="#" class="d-block" style="font-weight: 600;">Administrator</a>
          <small style="color: rgba(255,255,255,0.5);"><i class="fas fa-circle text-success" style="font-size: 0.5rem;"></i> Online</small>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-header" style="padding: 0.75rem 1rem; color: rgba(255,255,255,0.4); font-size: 0.7rem; text-transform: uppercase; letter-spacing: 1px;">Main Navigation</li>

          <li class="nav-item">
            <a href="index.php" class="nav-link <?php echo ($page_name == 'index.php') ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>

          <li class="nav-header" style="padding: 0.75rem 1rem; color: rgba(255,255,255,0.4); font-size: 0.7rem; text-transform: uppercase; letter-spacing: 1px; margin-top: 0.5rem;">Management</li>

          <li class="nav-item has-treeview <?php echo (in_array($page_name, ['add_user.php', 'users_list.php'])) ? 'menu-open' : ''; ?>">
            <a href="#" class="nav-link <?php echo (in_array($page_name, ['add_user.php', 'users_list.php'])) ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="add_user.php" class="nav-link <?php echo ($page_name == 'add_user.php') ? 'active' : ''; ?>">
                    <i class="fas fa-user-plus nav-icon"></i> 
                    <p>Add User</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="users_list.php" class="nav-link <?php echo ($page_name == 'users_list.php') ? 'active' : ''; ?>">
                  <i class="fas fa-list nav-icon"></i>
                  <p>User List</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview <?php echo (in_array($page_name, ['add_movie.php', 'movie_list.php', 'add_trailer.php', 'year_genre_country.php', 'view_details.php'])) ? 'menu-open' : ''; ?>">
            <a href="#" class="nav-link <?php echo (in_array($page_name, ['add_movie.php', 'movie_list.php', 'add_trailer.php', 'year_genre_country.php', 'view_details.php'])) ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-film"></i>
              <p>
                Movies
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="add_movie.php" class="nav-link <?php echo ($page_name == 'add_movie.php') ? 'active' : ''; ?>">
                  <i class="far fa-file-video nav-icon"></i>
                  <p>Add Movie</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="movie_list.php" class="nav-link <?php echo ($page_name == 'movie_list.php' || $page_name == 'view_details.php') ? 'active' : ''; ?>">
                  <i class="far fa-list-alt nav-icon"></i>
                  <p>Movie List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="add_trailer.php" class="nav-link <?php echo ($page_name == 'add_trailer.php') ? 'active' : ''; ?>">
                  <i class="fas fa-photo-video nav-icon"></i>
                  <p>Add Trailer</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="year_genre_country.php" class="nav-link <?php echo ($page_name == 'year_genre_country.php') ? 'active' : ''; ?>">
                  <i class="fas fa-tags nav-icon"></i>
                  <p>Categories</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="comment.php" class="nav-link <?php echo ($page_name == 'comment.php') ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-comments"></i>
              <p>Comments</p>
            </a>
          </li>

          <li class="nav-header" style="padding: 0.75rem 1rem; color: rgba(255,255,255,0.4); font-size: 0.7rem; text-transform: uppercase; letter-spacing: 1px; margin-top: 0.5rem;">Account</li>

          <li class="nav-item">
            <a href="/" class="nav-link" target="_blank">
                <i class="nav-icon fas fa-globe"></i>
              <p>View Website</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="login.php?logout=true" class="nav-link" style="color: rgba(235, 51, 73, 0.8);">
                <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>Logout</p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
