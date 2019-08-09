<!DOCTYPE html>
<html lang="en">
<head>
  <!-- meta -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title>Login</title>
  <!-- vendor css -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
  <link rel="stylesheet" href="<?=base_url()?>temp/public/plugins/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?=base_url()?>temp/public/plugins/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?=base_url()?>temp/public/plugins/animate/animate.min.css">
  <!-- theme css -->
  <link rel="stylesheet" href="<?=base_url()?>temp/public/css/theme.css">
  <link rel="stylesheet" href="<?=base_url()?>temp/public/css/custom.css">
</head>
<body class="fixed-header" style="background-image:linear-gradient(to bottom, #02c1ff,#02c1ff, #03ffd9)">
  <!-- header -->
  <header id="header">
    <div class="container">
      <div class="navbar-backdrop">
        <div class="navbar">
          <div class="navbar-left">

            <h3 class="logo">Login</h3>
            <!-- <a href="index.html" class="logo"><img src="<?=base_url()?>temp/public/img/logo.png" alt="Gameforest - Game Theme HTML"></a> -->

          </div>
        </div>
      </div>

    </div>
  </header>

  <!-- /header -->

  <!-- main -->
  <section class="hero hero-profile" style="background-image: url('<?=base_url()?>temp/public/header-menu.png');min-height:250px;">
    <img class="img-header" src="<?=base_url()?>temp/public/img-header.png" alt="">
    <h5 class="logo-menu"><?=profile('nama_bengkel')?></h5>
  </section>


  <section class="m-t-20">
    <div class="container">
      <div class="col-lg-8 mx-auto">
        <div class="row">


              <div class="col-lg-12">
                <form id="form" action="<?=site_url("public/login/action")?>" autocomplete="off">
                  <p class="text-center text-white"> Silahkan Masukkan No.Registrasi Untuk Mengakses Aplikasi</p>

                  <div class="form-group">
                    <select class="form-control" name="j_login" id="j_login">
                      <option value="akun">Account</option>
                      <option value="perjalanan"> Perjalanan</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <input type="text" class="form-control" id="no_registrasi" name="no_registrasi" placeholder="Masukkan No.Registrasi">
                  </div>

                  <button type="submit" id="submit" class="btn btn-success btn-sm btn-flat btn-block"><i class="fa fa-lock"></i> Login</button>

                </form>

                <div id="alert"></div>
              </div>

              <div class="col-lg-12 m-t-30">
                <p class="text-center text-white"> <a href="<?=site_url('public/login/lupa_no_registrasi')?>" id="lupa">Lupa No.registrasi?</a></p>
              </div>

              <div class="col-lg-12 m-t-30">
                <p class="text-center text-white">
                  <i class="fa fa-phone"></i> <?=profile('telepon')?> <br>
                  <i class="fa fa-envelope"></i> <?=profile('email')?> <br>
                  <i class="fa fa-map"></i> <?=profile('alamat')?>

                </p>
              </div>

        </div>
      </div>
    </div>
  </section>
  <!-- /main -->


  <div class="modal" id="ModalGue" tabindex="-1" role="dialog"  aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
            <h4 class="modal-title" id="ModalHeader"></h4>
					</div>
					<div class="modal-body" id="ModalContent"></div>
				</div>
			</div>
		</div>

  <!-- vendor js -->
  <script src="<?=base_url()?>temp/public/plugins/jquery/jquery-3.2.1.min.js"></script>
  <script src="<?=base_url()?>temp/public/plugins/popper/popper.min.js"></script>
  <script src="<?=base_url()?>temp/public/plugins/bootstrap/js/bootstrap.min.js"></script>

  <!-- plugins js -->
  <script src="<?=base_url()?>temp/public/plugins/sticky/jquery.sticky.js"></script>


  <!-- theme js -->
  <script src="<?=base_url()?>temp/public/js/theme.min.js"></script>


  <script type="text/javascript">
  $(document).on('click', '#lupa', function(e){
      e.preventDefault();
      $('.modal-dialog').removeClass('modal-md');
      $('.modal-dialog').removeClass('modal-sm');
      $('.modal-dialog').addClass('modal-lg');
      $('#ModalHeader').html('Lupa No.Registrasi?');
      $('#ModalContent').load($(this).attr('href'));
      $('#ModalGue').modal('show');
    });


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
                  $('#alert').hide().fadeIn().html('<div class="alert alert-danger m-t-20">'+
                                      '<span class="fa fa-info-circle"></span> '+
                                      json.alert+
                                      '<div>');
                    $('.form-group').removeClass('.has-error')
                                    .removeClass('.has-success');
                    $('.text-danger').remove();
                    $('#no_registrasi').val('');
                    // $('#no_registrasi').focus();
                     $('.text-danger').animate({ scrollTop: 0 }, 'slow');
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
