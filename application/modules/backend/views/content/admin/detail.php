
<div class="row">
<div class="col-md-12 d-flex align-items-stretch grid-margin">
  <div class="row flex-grow">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h4>Detail <?=$layout_title?></h4>
  <table class="table table-bordered">
	    <tr><th>Nama</th><td><?php echo $nama; ?></td></tr>
	    <tr><th>Telepon</th><td><?php echo $telepon; ?></td></tr>
	    <tr><th>Username</th><td><?php echo $username; ?></td></tr>
	    <tr><th>Ganti Password</th><td><a href="<?=site_url("backend/admin/reset_pwd/$id_login")?>" id="reset_pwd" class="btn btn-sm btn-info"> ganti password</a></td></tr>
	</table>
    <br>
    <!-- MODAL ClOSE -->
    <!-- <button type="button" class="btn btn-secondary btn-sm " data-dismiss="modal" aria-label="Close">tutup</button> -->
    <a href="javascript:history.go(-1)" class="btn btn-secondary btn-sm"> Kembali</a>
    </div>
  </div>
  </div>
  </div>
  </div>
  </div>


<script type="text/javascript">
$(document).on('click', '#reset_pwd', function(e){
    e.preventDefault();
    $('.modal-dialog').removeClass('modal-lg');
    $('.modal-dialog').removeClass('modal-sm');
    $('.modal-dialog').addClass('modal-md');
    $('#ModalHeader').html('Ganti Password');
    $('#ModalContent').load($(this).attr('href'));
    $('#ModalGue').modal('show');
  });
</script>
