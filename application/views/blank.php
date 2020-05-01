<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Blank Page &mdash; Stisla</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?= BASE_THEME . '/modules/bootstrap/css/bootstrap.min' ?>.css">
  <link rel="stylesheet" href="<?= BASE_THEME . '/modules/fontawesome/css/all.min' ?>.css">

  <!-- CSS Libraries -->

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?= BASE_THEME . '/css/style' ?>.css">
  <link rel="stylesheet" href="<?= BASE_THEME . '/css/components' ?>.css">
  <!-- Start GA -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-94034622-3');
  </script>
  <!-- /END GA -->
</head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
          </ul>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
              <img alt="image" src="<?= BASE_THEME . '/img/avatar/avatar-1.png' ?>" class="rounded-circle mr-1">
              <div class="d-sm-none d-lg-inline-block">Hi, Ujang Maman</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-title">Logged in 5 min ago</div>
              <a href="features-profile.html" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profile
              </a>
              <a href="features-activities.html" class="dropdown-item has-icon">
                <i class="fas fa-bolt"></i> Activities
              </a>
              <a href="features-settings.html" class="dropdown-item has-icon">
                <i class="fas fa-cog"></i> Settings
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="index.html">Stisla</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="index-0.html">General Dashboard</a></li>
                <li><a class="nav-link" href="index.html">Ecommerce Dashboard</a></li>
              </ul>
            </li>
          </ul>
        </aside>
      </div>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Blank Page</h1>
          </div>

          <div class="section-body">
          </div>
        </section>
      </div>


      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; 2020 <div class="bullet"></div> Honda Putra Jaya Malang
        </div>
        <div class="footer-right">

        </div>
      </footer>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="<?= BASE_THEME . '/modules/jquery.min.js' ?>"></script>
  <script src="<?= BASE_THEME . '/modules/popper.js' ?>"></script>
  <script src="<?= BASE_THEME . '/modules/tooltip.js' ?>"></script>
  <script src="<?= BASE_THEME . '/modules/bootstrap/js/bootstrap.min.js' ?>"></script>
  <script src="<?= BASE_THEME . '/modules/nicescroll/jquery.nicescroll.min.js' ?>"></script>
  <script src="<?= BASE_THEME . '/modules/moment.min.js' ?>"></script>
  <script src="<?= BASE_THEME . '/js/stisla.js' ?>"></script>

  <!-- JS Libraies -->

  <!-- Page Specific JS File -->

  <!-- Template JS File -->
  <script src="<?= BASE_THEME . '/js/scripts.js' ?>"></script>
  <script src="<?= BASE_THEME . '/js/custom.js' ?>"></script>
</body>

</html>