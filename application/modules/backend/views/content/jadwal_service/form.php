

<div class="row">

      <div class="col-lg-12">
        <div id="pesan"></div>
      </div>

      <div class="col-lg-12">
      <form action="<?=$aksi?>" id="form">

						 <div class="form-group">
                <input type="hidden" class="form-control" name="id_trans_kendaraan" id="id_trans_kendaraan" placeholder="Id Trans Kendaraan" value="<?php echo $id_trans_kendaraan; ?>" />
            </div>

						 <div class="form-group">
                <label>Tanggal</label>
                <input type="date" class="form-control" name="tanggal" id="tanggal" placeholder="Tanggal" value="<?php echo $tanggal; ?>" />
            </div>

            <div class="form-group">
               <label>Jam</label>
               <input type="time" class="form-control" name="jam" id="jam" placeholder="Jam" value="<?php echo $jam; ?>" />
           </div>

						 <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <textarea class="form-control" rows="3" name="keterangan" id="keterangan" placeholder="Keterangan"><?php echo $keterangan; ?></textarea>
            </div>

            <!-- MODAL ClOSE -->
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" aria-label="Close">tutup</button>
              <!-- <a href="javascript:history.go(-1)" class="btn btn-sm btn-secondary"> batal</a> -->



              <button type="submit" class="btn btn-success btn-sm " name="submit" id="submit"><?=$button?></button>


      </form>
</div>

  </div>



<script type="text/javascript">
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
                    $("#ModalGue").modal('hide');
                    $('#mytable').DataTable().ajax.reload();
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
