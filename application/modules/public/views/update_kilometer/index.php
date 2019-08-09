<section class="m-t-0 p-b-100 m-b-100">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 mx-auto">
          <div class="forum-post">
            <div class="forum-body">
              <div id="pesan"></div>
              <form id="form" autocomplete="off" action="<?=site_url('public/update_km/action')?>">
                <div class="form-group">
                  <label for="">Masukkan Kilometer</label>
                  <input type="text" class="form-control" id="kilometer" name="kilometer" placeholder="xxxx">
                </div>

                <button type="submit" id="submit" name="submit" class="btn btn-sm btn-block btn-success"> Update Kilometer</button>
              </form>

              <div class="alert alert-info m-t-40 text-center"  style="font-size:12px;"> <i class="fa fa-info-circle"></i> Informasi!<br>
                Kilometer yang anda update harus di atas <b><?=get_cek_kilometer_cs('kilometer');?>KM</b> (kilometer pada saat anda mendaftar).
              </div>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

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
                       window.history.back();
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
