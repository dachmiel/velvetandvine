<div class="promo-banner">
  <div class="container position-relative">
    <p class="text-center mb-0">FREE SHIPPING US ORDERS $100+</p>

    <div class="social-icons position-absolute start-0 top-50 translate-middle-y">
      <a href="https://www.instagram.com" class="social-icon" target="_blank" rel="noopener noreferrer">
        <i class="fab fa-instagram"></i>
      </a>
      <a href="https://www.facebook.com" class="social-icon" target="_blank" rel="noopener noreferrer">
        <i class="fab fa-facebook"></i>
      </a>
      <a href="https://twitter.com" class="social-icon" target="_blank" rel="noopener noreferrer">
        <i class="fab fa-twitter"></i>
      </a>
    </div>
  </div>
</div>

<div class="header-custom">
  <div class="container position-relative">
    <div class="d-flex align-items-center justify-content-between">

      <!-- Left: Search Bar -->
      <div class="search-bar d-flex align-items-center">
        <form class="search-form" onsubmit="return handleSearch(event)">
          <i class="fas fa-search search-icon"></i>
          <input type="search"
            id="searchInput"
            class="form-control"
            placeholder="Search">
        </form>
      </div>

      <!-- Center: Logo (Absolutely Centered) -->
      <div class="logo-container position-absolute top-50 start-50 translate-middle">
        <a class="navbar-brand" href="/velvetandvine">
          <img src="/velvetandvine/public/images/logo.png"
            alt="Velvet&Vine Logo"
            style="max-width: 180px; height: auto;" />
        </a>
      </div>

      <!-- Right: Dynamic Content -->
      <div class="auth-buttons d-flex align-items-center">
        <?php

        if (isset($_SESSION["userid"]) && $_SESSION["user_type"] == "Admin") {
        ?>
          <ul class="navbar-nav d-flex flex-row align-items-center gap-2">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle text-black" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Admin
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="/velvetandvine/account/profile">Profile</a></li>
                <li><a class="dropdown-item" href="/velvetandvine/admin/manageinventory">Manage Inventory</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="/velvetandvine/account/logout">Logout</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="auth-link" href="/velvetandvine/cart/viewcart">Cart
                <i class="fas fa-shopping-bag me-1"></i>
              </a>
            </li>
          </ul>
        <?php
        } else if (isset($_SESSION["userid"]) && $_SESSION["user_type"] == "Customer") {
        ?>
          <ul class="navbar-nav d-flex flex-row align-items-center gap-2">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle text-black" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Settings
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="/velvetandvine/account/profile">Profile</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="/velvetandvine/account/logout">Logout</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="auth-link" href="/velvetandvine/cart/viewcart">Cart
                <i class="fas fa-shopping-bag me-1"></i>
              </a>
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
              <a class="auth-link me-3" href="/velvetandvine/account/login">Login</a>
            </li>
            <li class="nav-item">
              <a class="auth-link" href="/velvetandvine/cart/viewcart">Cart
                <i class="fas fa-shopping-bag me-1"></i>
              </a>
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
  .promo-banner {
    background-color: #333;
    padding: 8px 0;
    color: white;
    font-size: 0.7rem;
    font-weight: 500;
  }

  .social-icons {
    display: flex;
    gap: 15px;
    margin-left: -2rem;
    /* Positive margin to adjust from the left edge */
  }

  .social-icon {
    color: white;
    font-size: 14px;
    transition: opacity 0.2s;
  }

  .social-icon:hover {
    opacity: 0.8;
    color: white;
  }

  .search-icon {
    position: absolute;
    left: 25px;
    /* Adjust as needed */
    top: 50%;
    transform: translateY(-50%);
    color: #333;
    font-size: 1rem;
    z-index: 10;
  }

  .search-form .form-control {
    text-indent: 20px;
    /* Adjust this value to move the text rightward */
    border-radius: 10px;
  }

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

  .nav-item .dropdown-menu {
    z-index: 1070;

  }
</style>

<script>
  function handleSearch(event) {
    event.preventDefault();

    const searchTerm = document.getElementById('searchInput').value.toLowerCase().trim();
    const categoryMap = {
      'new arrival': 'new',
      'new arrivals': 'new',

      // Tops
      'top': 'tops',
      'tops': 'tops',
      'shirt': 'tops',
      'shirts': 'tops',
      'blouse': 'tops',
      'blouses': 'tops',

      // Dresses
      'dress': 'dresses',
      'dresses': 'dresses',

      // Bottoms
      'bottom': 'bottoms',
      'bottoms': 'bottoms',
      'pant': 'bottoms',
      'pants': 'bottoms',
      'skirt': 'bottoms',
      'skirts': 'bottoms',
      'short': 'bottoms',
      'shorts': 'bottoms',

      // Denim
      'denim': 'denims',
      'jean': 'denims',
      'jeans': 'denims',

      // Accessories
      'accessory': 'accessories',
      'accessories': 'accessories',
      'jewelry': 'accessories',
      'necklace': 'accessories',
      'necklaces': 'accessories',
      'bracelet': 'accessories',
      'bracelets': 'accessories',
      'earring': 'accessories',
      'earrings': 'accessories',

      // Jackets
      'jacket': 'jackets',
      'jackets': 'jackets',
      'coat': 'jackets',
      'coats': 'jackets',
      'outerwear': 'jackets',

      // Sale
      'sale': 'sale',
      'discount': 'sale',
      'clearance': 'sale'
    };


    if (categoryMap[searchTerm]) {
      window.location.href = `/velvetandvine/catalog/${categoryMap[searchTerm]}`;
    } else {
      // Optional: Show an error message or suggestion
      alert('Please search for a valid category: new, tops, dresses, bottoms, denim, accessories, jackets, or sale');
    }

    return false;
  }
</script>
