<nav class="navbar navbar-expand-lg" style="background-color: #333; padding: 1rem;">
  <div class="container">

    <div class="collapse navbar-collapse" id="navbarSupportedContent">

      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="/velvetandvine/catalog/new">New!</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="/velvetandvine/catalog/tops">Tops</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="/velvetandvine/catalog/dresses">Dresses</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="/velvetandvine/catalog/bottoms">Bottoms</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="/velvetandvine/catalog/denim">Denim</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="/velvetandvine/catalog/accessories">Accessories</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="/velvetandvine/catalog/jackets">Jackets</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="/velvetandvine/catalog/sale">Sale</a>
        </li>
      </ul>

      <?php
      if ($authenticated) {

      ?>

        <ul class="navbar-nav">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Admin
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="/profile.php">Profile</a></li>
              <li><a class="dropdown-item" href="/velvetandvine/admin/ManageInventory">Manage Inventory</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="/velvetandvine/views/account/logout.php">Logout</a></li>
            </ul>
          </li>
        </ul>

      <?php
      } else {
      ?>

        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="btn btn-outline-light me-2" href="/velvetandvine/account/register">Register</a>
          </li>
          <li class="nav-item">
            <a class="btn btn-light" href="/velvetandvine/account/login">Login</a>
          </li>
        </ul>

      <?php
      }
      ?>
    </div>
  </div>
</nav>
