<nav class="navbar navbar-expand-lg" style="background-color: #333; padding: 1rem;">
        <div class="container">

          <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link" href="/velvetandvine/index.php">New!</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="/velvetandvine/index.php">Tops</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="/velvetandvine/index.php">Dresses</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="/velvetandvine/index.php">Bottoms</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="/velvetandvine/index.php">Denim</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="/velvetandvine/index.php">Accessories</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="/velvetandvine/index.php">Jackets</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="/velvetandvine/index.php">Sale</a>
              </li>
            </ul>

            <?php
            if ($authenticated) {

            ?>

            <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Admin
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="/profile.php">Profile</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="/logout.php">Logout</a></li>
                </ul>
              </li>
            </ul>

            <?php
            } else {
            ?>

            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="btn btn-outline-light me-2" href="/register.php">Register</a>
              </li>
              <li class="nav-item">
                <a class="btn btn-light" href="/login.php">Login</a>
              </li>
            </ul>

            <?php
            }
            ?>
          </div>
        </div>
      </nav>
