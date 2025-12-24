<style>
  /* Navbar Custom Style */
  .navbar-custom {
    background: rgba(10, 10, 10, 0.7);
    /* สีดำโปร่งแสง */
    backdrop-filter: blur(15px);
    /* เบลอฉากหลัง */
    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    padding: 15px 0;
  }

  .navbar-brand {
    font-family: 'Prompt', sans-serif;
    font-weight: 700;
    letter-spacing: 1px;
    color: #fff !important;
    font-size: 1.5rem;
  }

  .nav-link {
    font-family: 'Prompt', sans-serif;
    color: #888 !important;
    font-size: 0.95rem;
    margin: 0 10px;
    transition: all 0.3s;
    position: relative;
  }

  .nav-link:hover,
  .nav-link.active {
    color: #fff !important;
    text-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
  }

  /* เส้นใต้เล็กๆ เวลา Hover */
  .nav-link::after {
    content: '';
    position: absolute;
    width: 0;
    height: 2px;
    background: #fff;
    bottom: 0;
    left: 50%;
    transition: all 0.3s;
    transform: translateX(-50%);
  }

  .nav-link:hover::after,
  .nav-link.active::after {
    width: 100%;
  }

  .btn-logout {
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: #ccc;
    border-radius: 20px;
    padding: 5px 20px;
    font-size: 0.9rem;
    transition: all 0.3s;
    text-decoration: none;
  }

  .btn-logout:hover {
    background: rgba(255, 255, 255, 0.1);
    color: #fff;
    border-color: #fff;
  }
</style>

<nav class="navbar navbar-expand-lg fixed-top navbar-custom">
  <div class="container">

    <a class="navbar-brand" href="blog.php">
      BLOG
    </a>

    <button class="navbar-toggler shadow-none border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup">
      <i class="bi bi-list text-white fs-2"></i>
    </button>

    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav ms-auto align-items-center">

        <?php $current_page = basename($_SERVER['PHP_SELF']); ?>

        <a class="nav-link <?php echo ($current_page == 'blog.php') ? 'active' : ''; ?>" href="blog.php">
          Home
        </a>

        <a class="nav-link <?php echo ($current_page == 'manager.php') ? 'active' : ''; ?>" href="manager.php">
          Manager
        </a>
        <a class="btn text-white bg-white bg-opacity-10 border border-white border-opacity-25 rounded-pill px-4 ms-lg-3 mt-3 mt-lg-0 d-inline-flex align-items-center gap-2"
          href="../logout.php">
          <i class="bi bi-box-arrow-right"></i> Logout
        </a>

      </div>
    </div>

  </div>
</nav>

<div style="height: 80px;"></div>