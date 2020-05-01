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
                          <div class="d-sm-none d-lg-inline-block">Hi, <?= $_SESSION['username'] ?></div>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right mt-4">
                          <a href="<?= BASE_URL . 'Auth/logout' ?>" class="dropdown-item has-icon text-danger">
                              <i class="fas fa-sign-out-alt"></i> Logout
                          </a>
                      </div>
                  </li>
              </ul>
          </nav>
          <div class="main-sidebar sidebar-style-2">
              <aside id="sidebar-wrapper">
                  <div class="sidebar-brand">
                      <a href="index.html"><img alt="image" src="<?= BASE_THEME . '/img/logo.svg' ?>" class="mr-1" style="width: 15%"> &nbsp; <span class="headerlink" style="font-size: 20px">AHASS 669</span></a>
                  </div>
                  <div class="sidebar-brand sidebar-brand-sm">
                      <a href="index.html"><img alt="image" src="<?= BASE_THEME . '/img/logo.svg' ?>" class="mr-1" style="width: 50%"></a>
                  </div>
                  <ul class="sidebar-menu">
                      <li class="menu-header">Menu</li>
                      <li class="dropdown">
                          <a href="<?= BASE_URL . 'Order' ?>" class="nav-link"><i class="fas fa-list-ul"></i><span>Order</span></a>
                      </li>
                  </ul>
                  <ul class="sidebar-menu">
                      <li class="dropdown">
                          <a href="<?= BASE_URL . 'Riwayat' ?>" class="nav-link"><i class="fas fa-history"></i><span>Riwayat</span></a>
                      </li>
                  </ul>
                  <ul class="sidebar-menu">
                      <li class="dropdown">
                          <a href="<?= BASE_URL . 'Pengguna' ?>" class="nav-link"><i class="fas fa-users"></i><span>Pengguna</span></a>
                      </li>
                  </ul>
                  <ul class="sidebar-menu">
                      <li class="dropdown">
                          <a href="<?= BASE_URL . 'Laporan' ?>" class="nav-link"><i class="fas fa-file-alt"></i><span>Laporan Penjualan</span></a>
                      </li>
                  </ul>
              </aside>
          </div>