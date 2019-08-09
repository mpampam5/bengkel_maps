
<div class="row">
<div class="col-md-12 d-flex align-items-stretch grid-margin">
  <div class="row flex-grow">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h4>Detail <?=$layout_title?></h4>
          <div class="row">
            <div class="col-md-12">
              <table class="table table-bordered">
            	    <tr><th>Nama Service</th><td><?php echo $nama_service; ?></td></tr>
            	    <tr><th>Jarak Tempuh</th><td><?php echo $jarak_tempuh; ?> Km</td></tr>
            	    <tr><th>Waktu</th><td><?php echo $waktu; ?> Bulan</td></tr>
            	</table>
            </div>

            <div class="col-md-12" style="margin-top:20px;">
              <div class="panel panel-info">
                <div class="panel-heading">
                  <h3 class="panel-title">Jenis Perbaikan</h3>
                </div>
                <div class="panel-body">
                  <div class="row">
                    <?php foreach ($trans_service as $j_perbaikan): ?>
                    <div class="col-sm-2" style="margin:10px;">
                      <p><i class="fa fa-cog"></i> <?=$j_perbaikan->jenis_perbaikan;?></p>
                    </div>
                    <?php endforeach; ?>
                  </div>

                </div>
              </div>
            </div>

          </div>
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
