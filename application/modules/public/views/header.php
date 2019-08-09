<!DOCTYPE html>
<html lang="en">
<head>
  <!-- meta -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title><?=$layout_title?></title>
  <!-- vendor css -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
  <link rel="stylesheet" href="<?=base_url()?>temp/public/plugins/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?=base_url()?>temp/public/plugins/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?=base_url()?>temp/public/plugins/animate/animate.min.css">
  <!-- theme css -->
  <link rel="stylesheet" href="<?=base_url()?>temp/public/css/theme.css">
  <link rel="stylesheet" href="<?=base_url()?>temp/public/css/custom.css">


    <!-- vendor js -->
    <script src="<?=base_url()?>temp/public/plugins/jquery/jquery-3.2.1.min.js"></script>
    <script src="<?=base_url()?>temp/public/plugins/popper/popper.min.js"></script>
    <script src="<?=base_url()?>temp/public/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- plugins js -->
    <script src="<?=base_url()?>temp/public/plugins/sticky/jquery.sticky.js"></script>



</head>
<body class="fixed-header" style="background-image:linear-gradient(to bottom, #02c1ff,#02c1ff, #52baff);background-repeat: no-repeat;background-size: auto;">
  <!-- header -->
  <header id="header">
    <div class="container">
      <div class="navbar-backdrop">
        <div class="navbar">
          <div class="navbar-left">

            <h3 class="logo"><?=$layout_title?></h3>

            <?php
              if ($layout_title=="Main Menu") {
                echo '';
              }elseif ($layout_title=="Detail Perjalanan") {
                echo '';
              }elseif ($layout_title=="Memulai Perjalanan") {
                echo '';
              }else {
                echo '<a class="navbar-back" href="javascript:history.back()"><i class="fa fa-arrow-left"></i></a>';
              }
             ?>
            <!-- <a href="index.html" class="logo"><img src="<?=base_url()?>temp/public/img/logo.png" alt="Gameforest - Game Theme HTML"></a> -->
            <nav class="nav">
              <ul>
                <?php if ($this->session->userdata('j_login')=="akun"): ?>
                  <li><a href="<?=site_url('home')?>">Main Menu</a></li>
                  <?php else: ?>
                    <li><a href="<?=site_url('home_maps')?>">Main Menu</a></li>
                <?php endif; ?>
                <li><a href="<?=site_url('tentang')?>">Informasi Bengkel</a></li>
                <li><a href="<?=site_url('public/login/logout')?>">Logout</a></li>
              </ul>
            </nav>
          </div>
          <?php
          if ($layout_title!="Memulai Perjalanan") {
            echo '<div class="navbar-right">
                    <a class="navbar-toggle"><i class="fa fa-ellipsis-v"></i></a>
                  </div>';
          }
           ?>


        </div>
      </div>

    </div>
  </header>
