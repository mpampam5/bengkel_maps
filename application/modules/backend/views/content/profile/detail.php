
<div class="row">
<div class="col-md-12 d-flex align-items-stretch grid-margin">
  <div class="row flex-grow">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h4> <?=$layout_title?></h4>
          <table class="table table-bordered">
        	    <tr><th>Nama Bengkel</th><td><?php echo $nama_bengkel; ?></td></tr>
        	    <tr><th>Email</th><td><?php echo $email; ?></td></tr>
        	    <tr><th>Telepon</th><td><?php echo $telepon; ?></td></tr>
        	    <tr><th>Alamat</th><td><?php echo $alamat; ?></td></tr>
        	    <tr><th>Kordinat</th><td><?php echo $kordinat; ?></td></tr>
        	</table>
      <br>
      <!-- MODAL ClOSE -->
      <!-- <button type="button" class="btn btn-secondary btn-sm " data-dismiss="modal" aria-label="Close">tutup</button> -->
      <a href="<?=site_url("backend/profile/edit/$id_profile")?>" class="btn btn-info btn-sm"> Edit</a>
      </div>
    </div>
    </div>
    </div>
    </div>
  </div>
