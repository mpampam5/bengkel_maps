<link rel="stylesheet" href="<?=base_url('temp/backend')?>/vendors/datepicker/datepicker3.css">
<script src="<?=base_url('temp/backend')?>/vendors/datepicker/bootstrap-datepicker.js"></script>

<div class="row">
<div class="col-md-12 d-flex align-items-stretch grid-margin">
  <div class="row flex-grow">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h4><?=ucfirst($button).' '.$layout_title?></h4>
          <hr>
      <div id="pesan"></div>
      <form action="<?=$aksi?>" id="form" autocomplete="off">
      <div class="panel panel-default">
        <div class="panel-body">
          <table class="table table-bordered">
            <tr>
              <th>No.Registrasi</th>
              <th>Nama Pemilik</th>
              <th>No.kendaraan</th>
              <th>Merek Kendaraan</th>
              <th>Waktu Tempuh</th>
              <th>Jarak Tempuh</th>
            </tr>

            <tr>
              <td class="text-info"><?=$no_registrasi?></td>
              <td class="text-success"><?=$nama_pemilik?></td>
              <td class="text-info"><?=$no_kendaraan?></td>
              <td><?=$merek?></td>
              <td class="text-success"><?=$waktu_tempuh?> Bulan</td>
              <td class="text-success"><?=$jarak_tempuh?> Km</td>
            </tr>

            <tr>
              <td colspan="6">
                <?php if ($cek_service = $this->model->cek_service($jarak_tempuh,$waktu_tempuh)): ?>
                  <p  style="text-align: center;line-height: 18px;">
                  Saat ini customer sedang berada pada tahap <b class="text-success"><?=$cek_service->nama_service?></b>.<br>
                  dengan jarak tempuh <b class="text-success"><?=$cek_service->jarak_tempuh?> Km</b> dan kurang dari <b class="text-success"><?=$cek_service->s_jarak_tempuh?> Km</b><br>
                  atau waktu tempuh <b class="text-success"><?=$cek_service->waktu?> Bulan</b> dan kurang dari <b class="text-success"><?=$cek_service->s_waktu?> Bulan</b>.<br>
                  Silahkan centang jenis perbaikan sesuai tahap service yang anda pilih.
                  </p>
                  <hr>
                  <?=select_service($cek_service->id_service);?>

                  <div id="service_perbaikan" class="row">
                    <?=j_perbaikan_cs($cek_service->id_service)?>
                  </div>

                    <div class="form-group">
                      <div id="check"></div>
                    </div>

                  <?php else: ?>
                    error
                <?php endif; ?>
              </td>
            </tr>
          </table>
        </div>
      </div>





						 <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <textarea class="form-control" rows="4" name="keterangan" id="keterangan" placeholder="Keterangan"><?php echo $keterangan; ?></textarea>
            </div>

						 <div class="form-group">
                <label for="date">Waktu Service</label>
                <input type="date"  class="form-control" name="waktu_service" id="waktu_service" placeholder="Waktu Service" value="<?php echo $waktu_service; ?>" />
            </div>

            <div class="form-group">
              <input type="hidden" name="check" id="chkd">
              <input type="hidden" name="jarak_tempuh" id="jarak_tempuh" value="<?=$jarak_tempuh?>">
              <input type="hidden" name="waktu_tempuh" id="waktu_tempuh" value="<?=$waktu_tempuh?>">
            </div>

            <!-- MODAL ClOSE -->
            <!-- <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" aria-label="Close">tutup</button> -->
              <a href="javascript:history.go(-1)" class="btn btn-sm btn-secondary"> Kembali</a>



              <button type="submit" class="btn btn-success btn-sm " name="submit" id="submit"><?=$button?></button>


      </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


<script type="text/javascript">

      // $(document).ready(function(){
      //   var id_service = <?=$cek_service->id_service?>;
      //   $.ajax({
      //     url : "<?=base_url()?>backend/cs_service/service_perbaikan",
      //     method : "POST",
      //     data : {id: id_service},
      //     dataType : "json",
      //     success:function(json)
      //     {
      //       var html = '';
      //       var i;
      //       for (i=0; i<json.length; i++) {
      //           html+='<div class="col-sm-4">'+
      //                   '<div class="form-check">'+
      //                     '<input class="form-check-input chk" type="checkbox" value="'+json[i].id_trans_service+'" name="perbaikan[]" id="perbaikan[]">'+
      //                     '<label class="form-check-label">'+json[i].jenis_perbaikan+'</label>'+
      //                     '</div>'+
      //                    '</div>';
      //       }
      //
      //       $("#service_perbaikan").hide().fadeIn(500).html(html);
      //     }
      //   })
      // });

$(document).on('change', '.form-check-input', function(e){
    e.preventDefault();
      var chkArray = [];
      $(".form-check-input:checked").each(function() {
        chkArray.push($(this).val());
      });
      var selected;
         selected = chkArray.join(',') ;
      $('#chkd').val(selected);
  });



          //
          $("#id_service").change(function()
          {
            $('#chkd').val('');
            var id_service = $("#id_service option:selected").attr("value");
            $.ajax({
              url : "<?=base_url()?>backend/cs_service/service_perbaikan",
              method : "POST",
              data : {id: id_service},
              dataType : "json",
              success:function(json)
              {
                $("#service_perbaikan").hide().fadeIn(500).html(json.data);
                
              }
            })
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
                    window.location.href="<?=site_url(config_item("cpanel").'cs_service')?>";
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
