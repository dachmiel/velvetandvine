<div class="header-custom">
  <div class="container position-relative">
    <div class="d-flex align-items-center justify-content-between">

      <!-- Left: Search Bar -->
      <div class="search-bar d-flex align-items-center">
        <form class="search-form">
          <input type="search" class="form-control" placeholder="Search">
        </form>
      </div>

      <!-- Center: Logo (Absolutely Centered) -->
      <div class="logo-container position-absolute top-50 start-50 translate-middle">
        <a class="navbar-brand" href="/velvetandvine">
          <img src="/velvetandvine/images/logo.png"
            alt="Velvet&Vine Logo"
            style="max-width: 200px; height: auto;" />
        </a>
      </div>

      <!-- Right: Dynamic Content -->
      <div class="auth-buttons d-flex align-items-center">
        <?php
        if ($this->isAuthenticated() && $this->isAdmin()) {
        ?>
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle text-black" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
        } else if ($this->isAuthenticated() && !$this->isAdmin()) {
        ?>
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle text-black" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
          <ul class="navbar-nav d-flex flex-row gap-2">
            <li class="nav-item">
              <a class="auth-link me-3" href="/velvetandvine/account/register">Register</a>
            </li>
            <li class="nav-item">
              <a class="auth-link" href="/velvetandvine/account/login">Login</a>
            </li>
          </ul>
        <?php
        }
        ?>
      </div>

    </div>
  </div>
</div>

<style>
  .header-custom {
    background-color: #faf7f0;
    padding: 40px 0;
  }

  .header-custom .logo-container {
    flex-grow: 1;
    display: flex;
    justify-content: center;
  }

  .header-custom .search-bar,
  .header-custom .auth-buttons {
    flex-shrink: 0;
  }

  .search-form .form-control {
    border-radius: 20px;
    width: 250px;
    padding-left: 15px;
  }

  .auth-buttons .auth-link {
    color: black;
    text-decoration: none;
    font-weight: 500;
  }

  .auth-buttons .auth-link:hover {
    text-decoration: underline;
  }
</style>
