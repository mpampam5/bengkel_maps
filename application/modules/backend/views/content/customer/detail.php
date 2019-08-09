
<div class="row">
<div class="col-md-12 d-flex align-items-stretch grid-margin">
  <div class="row flex-grow">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h4>Detail Data <?=$layout_title?></h4>

  <div class="panel panel-info">
    <div class="panel-heading">
      <h3 class="panel-title">Data Pemilik</h3>
    </div>
    <div class="panel-body">
      <div class="row">
        <div class="col-md-3">
          <?php if ($foto_pemilik==""){
            $img_pemilik = base_url()."temp/backend/images/img-not.png";
          }else {
            $img_pemilik =base_url()."file/uploads/member/$foto_pemilik";
          } ?>

          <div class="img-cover" style="background-image:url('<?=$img_pemilik?>')">
            <div class="img-cover-overlay">
              <a href="<?=$img_pemilik?>" id="img_view"><i class="fa fa-search-plus"></i></a>
            </div>
          </div>
        </div>

        <div class="col-md-9">
          <table class="table table-bordered">
              <tr><th>No.Registrasi</th><td><?php echo $no_registrasi; ?></td></tr>
              <tr><th>Tanggal Registrasi</th><td><?php echo date('d/m/Y',strtotime($tgl_registrasi)); ?></td></tr>
        	    <tr><th>Nama</th><td><?php echo $nama_pemilik; ?></td></tr>
              <tr><th>Jenis Kelamin</th><td><?php echo $jk_pemilik; ?></td></tr>
        	    <tr><th>Telepon</th><td><?php echo $telepon_pemilik; ?></td></tr>
        	    <tr><th>Email</th><td><?php echo $email_pemilik; ?></td></tr>
        	    <tr><th>Alamat</th><td><?php echo $alamat_pemilik; ?></td></tr>
        	    <!-- <tr><th>Foto Pemilik</th><td><?php echo $foto_pemilik; ?></td></tr> -->
        	</table>
        </div>
      </div>
    </div>
  </div>

  <div class="panel panel-info">
    <div class="panel-heading">
      <h3 class="panel-title">Data Kendaraan</h3>
    </div>
    <div class="panel-body">
      <table class="table table-bordered">
        <tr>
          <th>No.Kendaraan</th>
          <td><?=$no_kendaraan?></td>
        </tr>

        <tr>
          <th>Merek</th>
          <td><?=$merek_kendaraan?></td>
        </tr>

        <tr>
          <th>Transmisi</th>
          <td><?=$transmisi_kendaraan?></td>
        </tr>

        <tr>
          <th>Kapasitas Mesin (CC)</th>
          <td><?=$cc_kendaraan?></td>
        </tr>

        <tr>
          <th>Warna</th>
          <td><?=$warna_kendaraan?></td>
        </tr>

        <tr>
          <th>Tahun pembuatan</th>
          <td><?=$tahun_pembuatan?></td>
        </tr>

        <tr>
          <th>Waktu Pembelian</th>
          <td><?=date('d/m/Y',strtotime($waktu_pembelian))?></td>
        </tr>
      </table>
    </div>
  </div>

  <div class="panel panel-info">
    <div class="panel-heading">
      <h3 class="panel-title">Tahap Service</h3>
    </div>
    <div class="panel-body">
      <div class="row">
        <?php $service =  $this->db->query('SELECT id_service,nama_service FROM tb_service ORDER BY id_service ASC'); ?>
        <?php foreach ($service->result() as $srv): ?>
          <?php if (detail_cs_cek_service($id_trans_kendaraan,$srv->id_service)==true): ?>
            <div class="col-sm-3" style="margin-bottom:20px;">
              <a class="text-success" href="<?=site_url("backend/customer/detail_service/$id_trans_kendaraan/$srv->id_service")?>"><i class="fa fa-gears"></i> <?=$srv->nama_service?></a>
            </div>
            <?php else: ?>
              <div class="col-sm-3 text-danger" style="margin-bottom:20px;">
                <i class="fa fa-gears"></i> <?=$srv->nama_service?>
              </div>
          <?php endif; ?>
        <?php endforeach; ?>
      </div>
      <p class="text-center" style="font-size:9"><i class="text-success">hijau</i> menandakan telah melakukan tahap service,<i class="text-danger">merah</i> tidak melakukan tahap service</p>
    </div>
  </div>
    <!-- MODAL ClOSE -->
    <!-- <button type="button" class="btn btn-secondary btn-sm " data-dismiss="modal" aria-label="Close">tutup</button> -->
    <a href="javascript:history.go(-1)" class="btn btn-secondary btn-sm"> Kembali</a>
    </div>
  </div>
  </div>
  </div>
  </div>
  </div>
