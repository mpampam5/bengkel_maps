<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>LOGIN - ADMIN</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?=base_url('temp/backend')?>/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="<?=base_url('temp/backend')?>/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="<?=base_url('temp/backend')?>/vendors/css/vendor.bundle.addons.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?=base_url('temp/backend')?>/css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="<?=base_url('temp/backend')?>/vendors/images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
      <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
        <div class="row w-100">
          <div class="col-lg-4 mx-auto">
            <div class="auto-form-wrapper">
              <h1 class="logo-login"><?=profile('nama_bengkel')?></h1>
              <hr>
              <div id="alert"></div>
              <form  id="form" action="<?=base_url('backend/login/action')?>">
                <div class="form-group">
                  <label class="label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="username">
                </div>
                <div class="form-group">
                  <label class="label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="*********">
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary submit-btn btn-block">Login</button>
                </div>
                <div class="form-group d-flex justify-content-between">
                  <!-- <a href="<?=site_url('reset-pwd')?>" class="text-small forgot-password text-black">Lupa Password?</a> -->
                </div>
              </form>
            </div>
            <p class="footer-text text-center">copyright © 2018 <?=profile('nama_bengkel')?> - <?=profile('alamat')?> - <?=profile('telepon')?> - LOGIN. All rights reserved.</p>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="<?=base_url('temp/backend')?>/vendors/js/vendor.bundle.base.js"></script>
  <script src="<?=base_url('temp/backend')?>/vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="<?=base_url('temp/backend')?>/js/off-canvas.js"></script>
  <script src="<?=base_url('temp/backend')?>/js/misc.js"></script>
  <!-- endinject -->


  <script type="text/javascript">



    $("#form").submit(function(e){
      e.preventDefault();
      var me = $(this);
      $("#submit").prop('disabled',true);

      $.ajax({
            url             : $(this).attr('action'),
            type            : 'post',
            data            :  new FormData(this),
            contentType     : false,
            cache           : false,
            dataType        : 'JSON',
            processData     :false,
            success:function(json){
              if (json.success==true) {
                if (json.status==true) {
                    window.location.href=json.url;
                }else {
                  $('#alert').hide().fadeIn().html('<div class="alert alert-danger">'+
                                      '<span class="fa fa-envelope-o"></span> '+
                                      json.alert+
                                      '<div>');
                    $('.form-group').removeClass('.has-error')
                                    .removeClass('.has-success');
                    $('.text-danger').remove();
                    $('#password').val('');
                    $('#password').focus();
                     $('body,html').animate({ scrollTop: 0 }, 'slow');
                    $('.alert').delay(500).show(10, function(){
                      $('.alert').delay(5000).hide(10, function(){
                        $('.alert').remove();
                        $('#submit').prop('disabled',false);
                      });
                    })
                }
              }else {
                $.each(json.alert, function(key, value) {
                  var element = $('#' + key);
                  $('#submit').prop('disabled',false);
                  $(element)
                  .closest('.form-group')
                  .find('.text-danger').remove();
                  $(element).after(value);
                });
              }
            }
      });
    });
    </script>

</body>

</html>
