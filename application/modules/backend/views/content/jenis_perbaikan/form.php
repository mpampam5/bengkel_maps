

<div class="col-md-12">
      <div id="pesan"></div>
      <form action="<?=$aksi?>" id="form">

						 <div class="form-group">
                <label for="varchar">Jenis Perbaikan</label>
                <input type="text" class="form-control" name="jenis_perbaikan" id="jenis_perbaikan" placeholder="Jenis Perbaikan" value="<?php echo $jenis_perbaikan; ?>" />
            </div>

            <!-- MODAL ClOSE -->
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" aria-label="Close">tutup</button>
              <!-- <a href="javascript:history.go(-1)" class="btn btn-sm btn-secondary"> batal</a> -->



              <button type="submit" class="btn btn-success btn-sm " name="submit" id="submit"><?=$button?></button>


      </form>

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
                    // window.location.href="<?=site_url(config_item("cpanel").'jenis_perbaikan')?>";
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
