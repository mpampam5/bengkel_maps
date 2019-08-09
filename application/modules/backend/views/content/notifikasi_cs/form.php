

<div class="row">

      <div class="col-lg-12">
        <div id="pesan"></div>
      </div>

      <div class="col-lg-12">
        <form action="<?=$aksi?>" id="form">


  						 <div class="form-group">
                  <!-- <label for="notifikasi">Notifikasi</label> -->
                  <textarea class="form-control" rows="8" name="notifikasi" id="notifikasi" placeholder="Masukkan isi pesan"><?php echo $notifikasi; ?></textarea>
              </div>


              <!-- MODAL ClOSE -->
              <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" aria-label="Close">Tutup</button>
                <!-- <a href="javascript:history.go(-1)" class="btn btn-sm btn-secondary"> batal</a> -->



                <button type="submit" class="btn btn-success btn-sm " name="submit" id="submit"><i class="fa fa-send"></i> <?=($button=="tambah")?"Kirim Notifikasi":"$button"?></button>


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
