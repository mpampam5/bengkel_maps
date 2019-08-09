<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?=$layout_title?></title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?=base_url('temp/backend')?>/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="<?=base_url('temp/backend')?>/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="<?=base_url('temp/backend')?>/vendors/css/vendor.bundle.addons.css">
  <link rel="stylesheet" href="<?=base_url('temp/backend')?>/vendors/font-awesome/css/font-awesome.min.css">

  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?=base_url('temp/backend')?>/css/style.css">
  <!-- funcybox -->
	<link rel="stylesheet" type="text/css" href="<?=base_url('temp/backend')?>/vendors/funcybox/jquery.fancybox.css" media="screen" />
  <!-- endinject -->
  <link rel="shortcut icon" href="<?=base_url('temp/backend')?>/images/favicon.png" />

  <style media="screen">
  .preloader {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background-color: #00000094;
    }
    .preloader .loading {
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%,-50%);
    font: 14px arial;
    }
  </style>

  <!-- container-scroller -->
  <!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script> -->
  <!-- plugins:js -->
  <script src="<?=base_url('temp/backend')?>/vendors/js/vendor.bundle.base.js"></script>
  <script src="<?=base_url('temp/backend')?>/vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->

  <!-- funcybox -->
  <script type="text/javascript" src="<?=base_url('temp/backend')?>/vendors/funcybox/jquery.fancybox.js"></script>
	<script type="text/javascript" src="<?=base_url('temp/backend')?>/vendors/funcybox/jquery.fancybox.pack.js"></script>

  <script src="<?=base_url('temp/backend')?>/js/off-canvas.js"></script>
  <script src="<?=base_url('temp/backend')?>/js/misc.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <!-- End custom js for this page-->

  <script type="text/javascript">
  $(document).ready(function() {
    $(".preloader").fadeOut(500);
    $("#img_view").fancybox();
  });
  </script>
</head>

<body>
  <div class="container-scroller">
    <!-- partial:<?=base_url('temp/backend')?>/partials/_navbar.html -->
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo" href="<?=site_url('temp/backend/home')?>">
          <!-- <img src="<?=base_url('temp/backend')?>/images/logo.png" alt="logo" /> -->
          <h3 class="logos"><?=strtoupper(profile('nama_bengkel'))?></h3>
        </a>
        <a class="navbar-brand brand-logo-mini" href="<?=base_url('temp/backend')?>/index.html">
          <!-- <img src="<?=base_url('temp/backend')?>/images/logo-mini.png" alt="logo" /> -->
        </a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center">

        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown d-none d-xl-inline-block">
                      <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                        <span class="profile-text">Hello, <?=$this->session->userdata('nama')?></span>
                        <img class="img-xs rounded-circle" src="<?=base_url()?>temp/backend/images/img.png" alt="Profile image">
                      </a>
                      <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">

                        <a href="<?=base_url("backend/admin/reset_pwd/".$this->session->userdata('id_login'))?>" id="rst_pwd" class="dropdown-item mt-3">
                          <i class="fa fa-key"></i> Ganti Password
                        </a>

                        <a href="<?=base_url('backend/login/logout')?>" class="dropdown-item mt-3">
                          <i class="fa fa-sign-out"></i>Keluar
                        </a>
                      </div>
                    </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:<?=base_url('temp/backend')?>/partials/_sidebar.html -->

      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">

          <li class="nav-item">
            <a class="nav-link" href="<?=site_url('backend/home')?>">
              <i class="menu-icon mdi mdi-television"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>


          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#member" aria-expanded="false" aria-controls="member">
              <i class="menu-icon fa fa-id-card"></i>
              <span class="menu-title">Master Customer</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="member">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="<?=site_url('backend/customer')?>">Data Customer</a>
                </li>
              </ul>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="<?=site_url('backend/cs_service')?>">
              <i class="menu-icon fa fa-car"></i>
              <span class="menu-title">Perbaikan & Perwatan</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#service" aria-expanded="false" aria-controls="service">
              <i class="menu-icon fa fa-cogs"></i>
              <span class="menu-title">Master Service</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="service">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="<?=site_url('backend/jenis_perbaikan')?>">Jenis Perbaikan</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?=site_url('backend/service')?>">Data Service</a>
                </li>
              </ul>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="<?=site_url('backend/Jadwal_service')?>">
              <i class="menu-icon fa fa-clock-o"></i>
              <span class="menu-title">Jadwal Service</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="<?=site_url('backend/Notifikasi_cs')?>">
              <i class="menu-icon fa fa-bell"></i>
              <span class="menu-title">Notifikasi Customer</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="<?=site_url('backend/Profile')?>">
              <i class="menu-icon fa fa-cog"></i>
              <span class="menu-title">Pengaturan Profile</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="<?=site_url('backend/admin')?>">
              <i class="menu-icon fa fa-user"></i>
              <span class="menu-title">Admin</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="<?=site_url('backend/login/logout')?>">
              <i class="menu-icon fa fa-sign-out"></i>
              <span class="menu-title">Keluar</span>
            </a>
          </li>

        </ul>
      </nav>

            <!-- partial -->
            <div class="main-panel">
              <div class="content-wrapper">

                <div class="preloader">
                  <div class="loading">
                    <img src="<?=base_url()?>temp/ms.svg" width="80">
                    <p style="color:#fff;font-weight:bold;text-align:center">Loading</p>
                  </div>
                </div>
