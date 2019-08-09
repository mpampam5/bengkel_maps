

<div class="row">
<div class="col-md-12 d-flex align-items-stretch grid-margin">
  <div class="row flex-grow">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h4><?=ucfirst($button).' '.$layout_title?></h4>
          <hr>
      <div id="pesan"></div>
      <form action="<?=$aksi?>" id="form">

						 <div class="row">
               <div class="col-md-12">
                 <div class="form-group">
                    <label for="varchar">Nama Service</label>
                    <input type="text" class="form-control" name="nama_service" id="nama_service" placeholder="Nama Service" value="<?php echo $nama_service; ?>" />
                </div>
               </div>

               <div class="col-md-3">
                 <div class="form-group">
                    <label for="int">Jarak Tempuh (Km)</label>
                    <input type="text" class="form-control" name="jarak_tempuh" id="jarak_tempuh" placeholder="xxxxx" value="<?php echo $jarak_tempuh; ?>" />
                </div>
               </div>

               <div class="col-md-3">
                 <div class="form-group">
                    <label for="int">Sampai Jarak Tempuh (Km)</label>
                    <input type="text" class="form-control" name="s_jarak_tempuh" id="s_jarak_tempuh" placeholder="xxxxx" value="<?php echo $s_jarak_tempuh; ?>" />
                </div>
               </div>

               <div class="col-md-3">
                 <div class="form-group">
                    <label for="int">Waktu (Bulan)</label>
                    <input type="text" class="form-control" name="waktu" id="waktu" placeholder="xx" value="<?php echo $waktu; ?>" />
                </div>
               </div>

               <div class="col-md-2">
                 <div class="form-group">
                    <label for="int">Sampai Waktu (Bulan)</label>
                    <input type="text" class="form-control" name="s_waktu" id="s_waktu" placeholder="xx" value="<?php echo $s_waktu; ?>" />
                </div>
               </div>
             </div>

             <div class="row">
               <div class="panel panel-info">
                 <div class="panel-heading">
                   <h3 class="panel-title">Pilih Jenis Perbaikan</h3>
                 </div>
                 <div class="panel-body">
                   <div class="row" id="jenis_perbaikan">
                     <?php $query = $this->db->get('tb_jenis_perbaikan'); ?>
                     <?php foreach ($query->result() as $row): ?>
                     <div class="col-md-3">
                       <div class="form-group">
                         <div class="col-sm-12">
                           <div class="form-check">
                             <label class="form-check-label">
                               <input class="form-check-input chk" name="perbaikan[]" id="perbaikan[]" <?=($button=="edit")?(cek_jenis_perbaikan($id_service,$row->id_jenis_perbaikan)==true)?"checked":"":""?> < value="<?=$row->id_jenis_perbaikan?>" type="checkbox"> <?=$row->jenis_perbaikan?>
                             </label>
                           </div>
                         </div>
                        </div>
                     </div>
                      <?php endforeach; ?>
                   </div>

                   <div class="form-group">
                     <input type="hidden" name="check" id="chkd">
                     <div id="check"></div>
                   </div>

                 </div>
               </div>
             </div>



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

<?php if ($button=="edit"): ?>
  <script type="text/javascript">
  $(document).ready(function(){
      var chkArray = [];
      $(".chk:checked").each(function() {
        chkArray.push($(this).val());
      });

      var selected;
         selected = chkArray.join(',') ;

      $('#chkd').val(selected);
  });

  </script>
<?php endif; ?>


<script type="text/javascript">


$('.chk').on('change',function(){
  	var chkArray = [];
  	$(".chk:checked").each(function() {
  		chkArray.push($(this).val());
  	});

  	var selected;
  	   selected = chkArray.join(',') ;

  	$('#chkd').val(selected);
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
              $('#pesan').append(json.alert);
                $('.form-group').removeClass('.has-error')
                                .removeClass('.has-success');
                $('.text-danger').remove();
                 $('body,html').animate({ scrollTop: 0 }, 'slow');
                $('.alert').delay(500).show(10, function(){
                  $('.alert').delay(5000).hide(10, function(){
                    $('.alert').remove();
                    window.location.href="<?=site_url(config_item("cpanel").'service')?>";
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
