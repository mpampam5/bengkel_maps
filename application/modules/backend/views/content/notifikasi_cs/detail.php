
<div class="row">
<div class="col-md-12 d-flex align-items-stretch grid-margin">
  <div class="row flex-grow">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h4>Detail <?=$layout_title?></h4>
  <table class="table table-bordered">
	    <tr><th>Di kirim Ke</th>
        <td>
        <a href="<?=site_url("backend/customer/detail/$id_trans_kendaraan")?>" class="text-success"><i class="fa fa-link"></i> <?=$no_registrasi?></a> | <?=$nama?>
      </td>
    </tr>
	    <tr><th>Waktu</th><td><?php echo $waktu; ?></td></tr>
      <tr><th>Isi pesan</th><td><?php echo $notifikasi; ?></td></tr>
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
