<nav class="navbar navbar-expand-lg" style="background-color: #333; padding: 1rem; position: sticky; top: 0;">
  <div class="container">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">

      <form class="form-inline my-2 my-lg-0 search-form">
        <div class="search-wrapper" style="position: relative; display: flex; align-items: center;">
          <!-- Input field with padding on the left to make room for the icon -->
          <input class="search-input form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"
            style="padding-left: 40px; width: 100%; padding-right: 30px;">
          <!-- Search icon inside the input -->
          <button class="search-button" type="submit"
            style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); background: transparent; border: none; padding: 0;">
            <img src="/velvetandvine/images/search-icon.png" alt="Search" style="width: 20px; height: 20px;">
          </button>
        </div>
      </form>

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
          <a class="nav-link" href="/velvetandvine/catalog/denims">Denims</a>
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
      // Check if $this is available and is an object
      if (isset($this) && is_object($this)) {
        if ($this->isAuthenticated() && $this->isAdmin()) {
      ?>
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Admin
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="/profile.php">Profile</a></li>
                <li><a class="dropdown-item" href="/velvetandvine/admin/manageinventory">Manage Inventory</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="/velvetandvine/views/account/logout.php">Logout</a></li>
              </ul>
            </li>
          </ul>
        <?php
        } elseif ($this->isAuthenticated() && !$this->isAdmin()) {
        ?>
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Settings
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="/profile.php">Profile</a></li>
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
      } else {
        // This section will be shown when $this is not available (e.g., 404 page)
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
