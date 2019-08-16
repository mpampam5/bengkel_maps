
  <!-- /header -->

  <!-- main -->
  <div >

    <section class="hero hero-profile" style="background-image: url('<?=base_url()?>temp/public/header-menu.png');min-height:250px;">
      <img class="img-header" src="<?=base_url()?>temp/public/img-header.png" alt="">
      <h5 class="logo-menu"><?=profile('nama_bengkel')?></h5>
    </section>


    <section class="m-t-20">
      <div class="container">
        <div id="pemberitahuan"></div>
        <div id="pemb2"></div>


        <div class="clearfix"></div>

        <div class="col-lg-8 mx-auto">
          <div class="row">




                <!-- <div class="col-6">
                  <div id="box-menu">
                    <a href="<?=site_url('maps')?>">
                    <img src="<?=base_url()?>temp/public/icon/menu-route.png" alt="">
                    <p class="text-menu">Mulai Perjalanan</p>
                    </a>
                  </div>
                </div> -->

                <div class="col-6">
                  <div id="box-menu">
                    <div id="pmb_jadwal"></div>
                    <a href="<?=site_url('jadwal_service')?>">
                    <img src="<?=base_url()?>temp/public/icon/time-card.png" alt="">
                    <p class="text-menu">Jadwal Service</p>
                    </a>
                  </div>
                </div>

                <div class="col-6">
                  <div id="box-menu">
                    <a href="<?=site_url('service')?>">
                    <img src="<?=base_url()?>temp/public/icon/menu-car-service.png" alt="">
                    <p class="text-menu">Perbaikan & Perawatan</p>
                    </a>
                  </div>
                </div>

                <div class="col-6">
                  <div id="box-menu">
                    <a href="<?=site_url('history')?>">
                    <img src="<?=base_url()?>temp/public/icon/route.png" alt="">
                    <p class="text-menu">History Perjalanan</p>
                    </a>
                  </div>
                </div>

                <div class="col-6">
                  <div id="box-menu">
                    <div id="pmb"></div>
                    <a href="<?=site_url('notifikasi')?>">
                    <img src="<?=base_url()?>temp/public/icon/menu-bell.png" alt="">
                    <p class="text-menu">Notifikasi</p>
                    </a>
                  </div>
                </div>

                <div class="col-6">
                  <div id="box-menu">
                    <a href="<?=site_url('update')?>">
                    <img src="<?=base_url()?>temp/public/icon/menu-kilometer.png" alt="">
                    <p class="text-menu">Update Kilometer</p>
                    </a>
                  </div>
                </div>

                <div class="col-6">
                  <div id="box-menu">
                    <a href="<?=site_url('profile')?>">
                    <img src="<?=base_url()?>temp/public/icon/menu-info.png" alt="">
                    <p class="text-menu">Profile</p>
                    </a>
                  </div>
                </div>

                <div class="col-6">
                  <div id="box-menu">
                    <a href="<?=site_url('tentang')?>">
                    <img src="<?=base_url()?>temp/public/icon/menu-info2.png" alt="">
                    <p class="text-menu">Informasi Bengkel</p>
                    </a>
                  </div>
                </div>

                <div class="col-6">
                  <div id="box-menu">
                    <a href="<?=site_url('public/login/logout')?>">
                    <img src="<?=base_url()?>temp/public/icon/logout.png" alt="">
                    <p class="text-menu">Logout</p>
                    </a>
                  </div>
                </div>

          </div>
        </div>
      </div>
    </section>
    <!-- /main -->

  </div>


<script type="text/javascript">
   $(document).ready(function(){
     $.ajax({
       url: "<?=base_url()?>public/home/json_pemberitahuan/<?=$this->session->userdata('id_trans_kendaraan')?>"
     }).done(function(json){
       if (json.success==true) {
          $("#pmb").hide().fadeIn(500).html('<span class="text-alert">'+json.jml+'</span>');
       }
     })



     $.ajax({
       url: "<?=base_url()?>public/home/json_jadwal/<?=$this->session->userdata('id_trans_kendaraan')?>"
     }).done(function(json){
       if (json.success==true) {
          $("#pmb_jadwal").hide().fadeIn(500).html('<span class="text-alert">'+json.jml+'</span>');
       }
     })

     $.ajax({
       url: "<?=base_url()?>public/home/cek_service"
     }).done(function(jsons){
       if (jsons.success==true) {
          $("#pemb2").hide().fadeIn(500).html(`<div class="col-lg-8 mx-auto">
                                              <div class="row">
                                                  <div id="box-alert" class="no-bordered">
                                                      <table class="table">
                                                        <tr>
                                                          <td class="img-alert"><img src="<?=base_url()?>temp/public/icon/statistics.png" alt=""></td>
                                                          <td class="text-alert">Saat ini anda berada pada tahap `+jsons.nama_service+`. Dengan status `+jsons.status+`</td>
                                                        </tr>
                                                      </table>
                                                  </div>

                                              </div>
                                            </div>`);
       }
     })

   });
</script>
