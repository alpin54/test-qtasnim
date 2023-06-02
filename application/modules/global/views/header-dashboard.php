<!DOCTYPE html>
<html>
<head>
  <? include 'head.php'; ?>

  <!-- style-->
  <link href="<?= ASSETS_CSS; ?>rwd-table.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= ASSETS_CSS; ?>bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= ASSETS_CSS; ?>icons.css" rel="stylesheet" type="text/css" />
  <link href="<?= ASSETS_CSS; ?>dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= ASSETS_CSS; ?>responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= ASSETS_CSS; ?>buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= ASSETS_CSS; ?>bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= ASSETS_CSS; ?>daterangepicker.css" rel="stylesheet" type="text/css" />
  <link href="<?= ASSETS_CSS; ?>select2.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= ASSETS_CSS; ?>sweetalert2.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= ASSETS_CSS; ?>style.css" rel="stylesheet" type="text/css" />
  <link href="<?= ASSETS_CSS; ?>custom.css" rel="stylesheet" type="text/css" />

  <!-- js modernizr -->
  <script src="<?= ASSETS_JS; ?>vendors/modernizr.min.js"></script>

</head>
<body class="fixed-left">

  <!-- Navigation Bar-->
  <header id="topnav">
    <div class="topbar-main">
      <div class="container-fluid">

        <!-- Logo container-->
        <div class="logo">
          <!-- Text Logo -->
          <a href="<?= base_url(); ?>" class="logo">
            <span class="logo-small"><i class="mdi mdi-radar"></i></span>
            <span class="logo-large"><i class="mdi mdi-radar"></i> Developer Test PT. Qtasnim Digital Teknologi</span>
          </a>
        </div>
        <!-- End Logo container-->
        <div class="menu-extras topbar-custom">
          <ul class="list-unstyled topbar-right-menu float-right mb-0">
            <li class="menu-item">
              <!-- Mobile menu toggle-->
              <a class="navbar-toggle nav-link">
                <div class="lines">
                  <span></span>
                  <span></span>
                  <span></span>
                </div>
              </a>
              <!-- End mobile menu toggle-->
            </li>
          </ul>
        </div>
        <div class="clearfix"></div>
      </div> <!-- end container -->
    </div>
    <!-- end topbar-main -->
    <div class="navbar-custom">
      <div class="container-fluid">
        <div id="navigation" class="active">
          <!-- Navigation Menu-->
          <ul class="navigation-menu">
            <li class="has-submenu <?= ($navigation_menu == 'dashboard'? 'active' : ''); ?>">
              <a href="<?= base_url(); ?>"><i class="mdi mdi-view-dashboard"></i> <span> Beranda </span> </a>
            </li>
            <li class="has-submenu <?= ($navigation_menu == 'product'? 'active' : ''); ?>">
              <a href="<?= base_url('product'); ?>"><i class="mdi mdi-briefcase-outline"></i> <span> Produk </span> </a>
            </li>
            <li class="has-submenu <?= ($navigation_menu == 'sale'? 'active' : ''); ?>">
              <a href="<?= base_url('sale'); ?>"><i class="mdi mdi-cart"></i> <span> Penjualan </span> </a>
            </li>
          </ul>
          <!-- End navigation menu -->
        </div> <!-- end #navigation -->
      </div> <!-- end container -->
    </div>
  </header>
  <!-- End Navigation Bar-->
  <!-- Begin page -->
  <div id="wrapper">
    <!-- ============================================================== -->
    <!-- Start Content here -->
    <!-- ============================================================== -->
      <div class="container-fluid">
