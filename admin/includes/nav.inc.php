  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="assets/images/logo.png" alt="MNF Movies DB" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">&nbsp;</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="assets/images/mnf.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Naim Faizy</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item">
            <a href="/" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="add_user.php" class="nav-link">
                    <i class="fas fa-user-plus nav-icon"></i> 
                    <p>Add User</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-list nav-icon"></i>
                  <p>User List</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-film"></i>
              <p>
                Movies
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="add_movie.php" class="nav-link">
                  <i class="far fa-file-video nav-icon"></i>
                  <p>Add Movie</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="movie_list.php" class="nav-link">
                  <i class="far fa-list-alt nav-icon"></i>
                  <p>Movie List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="add_trailer.php" class="nav-link">
                  <i class="fas fa-photo-video nav-icon"></i>
                  <p>Add Trailer</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="year_genre_country.php" class="nav-link">
                  <i class="fas fa-plus-circle nav-icon"></i>
                  <p>+Year +Genre +Country</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="comment.php" class="nav-link">
                <i class="nav-icon fas fa-comments"></i>
              <p>
                Comments
              </p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
