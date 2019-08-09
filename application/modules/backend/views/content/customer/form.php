

<div class="row">
<div class="col-md-12 d-flex align-items-stretch grid-margin">
  <div class="row flex-grow">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h4><?=ucfirst($button).' Data '.$layout_title?></h4>
          <hr>
      <div id="pesan"></div>
      <form action="<?=$aksi?>" id="form" autocomplete="off">

        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Data Customer</h3>
          </div>
          <div class="panel-body">

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                   <label for="varchar">Nama</label>
                   <input type="text" class="form-control" name="nama_pemilik" id="nama_pemilik" placeholder="Nama" value="<?php echo $nama_pemilik; ?>" />
               </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="enum">Jenis Kelamin</label>
                  <select class="form-control" name="jk_pemilik" id="jk_pemilik">
                    <?php if ($button=="tambah"): ?>
                      <option value="">-- pilih --</option>
                    <?php endif; ?>
                       <option <?=($jk_pemilik=="pria")?"selected":""?> value="pria">Pria</option>
                       <option <?=($jk_pemilik=="wanita")?"selected":""?> value="wanita">Wanita</option>
                  </select>
               </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                   <label for="varchar">Email</label>
                   <input type="text" class="form-control" name="email_pemilik" id="email_pemilik" placeholder="Email" value="<?php echo $email_pemilik; ?>" />
               </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                   <label for="varchar">Telepon</label>
                   <input type="text" class="form-control" name="telepon_pemilik" id="telepon_pemilik" placeholder="Telepon" value="<?php echo $telepon_pemilik; ?>" />
               </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="">Foto&nbsp;
                  <?php if ($button=="edit"): ?>
                    <?php if ($userfile!=""): ?>
                      (<a id="img_view" href="<?=base_url()?>file/uploads/member/<?=$userfile?>" alt="<?=$userfile?>"><?=$userfile?></a>)
                    <?php endif; ?>
                  <?php endif; ?>

                  </label>
                  <input type="file" class="form-control" name="userfile" accept="image/*">
                  <input type="hidden" name="userfile" value="<?php echo $userfile; ?>">
                    <div id="userfile"></div>
                </div>
              </div>

            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                   <label for="alamat_pemilik">Alamat</label>
                   <textarea class="form-control" rows="3" name="alamat_pemilik" id="alamat_pemilik" placeholder="Alamat"><?php echo $alamat_pemilik; ?></textarea>
               </div>
              </div>
            </div>

          </div>
        </div>

        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"> Data Kendaraan</h3>
          </div>
          <div class="panel-body">

            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label for="">No. Kendaraan</label>
                  <input type="text" class="form-control" id="no_kendaraan" name="no_kendaraan" placeholder="No.Kendaraan" value="<?php echo $no_kendaraan; ?>">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Merek</label>
                  <input type="text" class="form-control" id="merek_kendaraan" name="merek_kendaraan" placeholder="Merek Kendaraan" value="<?php echo $merek_kendaraan; ?>">
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <label for="">Transmisi</label>
                  <select class="form-control" name="transmisi_kendaraan" id="transmisi_kendaraan">
                    <?php if ($button=="tambah"): ?>
                      <option value="">-- pilih --</option>
                    <?php endif; ?>
                    <option <?=($transmisi_kendaraan=="manual")?"selected":""?> value="manual">Manual</option>
                    <option <?=($transmisi_kendaraan=="automatic")?"selected":""?> value="automatic">Automatic</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-2">
                <div class="form-group">
                  <label for="">Kapasitas Mesin (CC)</label>
                  <input type="text" class="form-control" id="cc_kendaraan" name="cc_kendaraan" placeholder="Kapasitas Mesin (CC)" value="<?php echo $cc_kendaraan; ?>">
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <label for="">Warna</label>
                  <input type="text" class="form-control" id="warna_kendaraan" name="warna_kendaraan" placeholder="Warna" value="<?php echo $warna_kendaraan; ?>">
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group">
                  <label for="">Tahun Pembuatan</label>
                  <input type="text" class="form-control" id="tahun_pembuatan" name="tahun_pembuatan" placeholder="Tahun Pembuatan" value="<?php echo $tahun_pembuatan; ?>">
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group">
                  <label for="">Waktu Pembelian</label>
                  <input type="date" date-format="yyyy-mm-dd" class="form-control date" id="waktu_pembelian date" name="waktu_pembelian" placeholder="Waktu Pembelian" value="<?php echo $waktu_pembelian; ?>">
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <label for="">Kilometer Sekarang (Km)</label>
                  <input type="text" class="form-control" id="kilometer" name="kilometer" value="<?=$kilometer?>" placeholder="xx">
                </div>
              </div>
            </div>

          </div>
        </div>

        <?php if ($button=="edit"): ?>
          <input type="hidden" name="id_pemilik" value="<?=$id_pemilik?>">
          <input type="hidden" name="id_kendaraan" value="<?=$id_kendaraan?>">
        <?php endif; ?>

            <!-- MODAL ClOSE -->
            <!-- <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" aria-label="Close">tutup</button> -->
              <a href="javascript:history.go(-1)" class="btn btn-sm btn-secondary"> batal</a>



              <button type="submit" class="btn btn-success btn-sm " name="submit" id="submit"><?=$button?></button>


      </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>



<script type="text/javascript">
$('#date').datepicker({
    format: "dd-mm-yyyy"
});

$(function() {
    $('#no_kendaraan').keyup(function() {
        this.value = this.value.toUpperCase();
    });
});

  $("#form").submit(function(e){
    e.preventDefault();
    var me = $(this);
    $("#submit").prop('disabled',true);

    $.ajax({
          url             : me.attr('action'),
          type            : 'post',
          data            :  new FormData(this),
          contentType     : false,
          cache           : false,
          dataType        : 'JSON',
          processData     :false,
          success:function(json){
            if (json.success==true) {
              $('#pesan').append('<div class="alert alert-success">'+
                                  '<span class="fa fa-envelope-o"></span> '+
                                  json.alert+
                                  '<div>');
                $('.form-group').removeClass('.has-error')
                                .removeClass('.has-success');
                $('.text-danger').remove();
                 $('body,html').animate({ scrollTop: 0 }, 'slow');
                $('.alert-success').delay(500).show(10, function(){
                  $('.alert-success').delay(5000).hide(10, function(){
                    $('.alert-success').remove();
                    window.location.href="<?=site_url(config_item("cpanel").'customer')?>";
                  });
                })
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
