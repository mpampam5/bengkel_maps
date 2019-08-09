
<div class="row">
<div class="col-md-12 d-flex align-items-stretch grid-margin">
  <div class="row flex-grow">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h4>Detail <?=$layout_title?></h4>
          <hr>


  <div class="panel panel-info">
    <div class="panel-heading">
      <h3 class="panel-title">Data Customer</h3>
    </div>
    <div class="panel-body">
      <table class="table table-bordered">
        <tr>
          <th>No.registrasi</th>
          <td><a href="<?=site_url("backend/customer/detail/$id_trans_kendaraan")?>" class="text-success"><i class="fa fa-link"></i> <?=$no_registrasi?></a></td>
        </tr>

        <tr>
          <th>Nama</th>
          <td><?=$nama_pemilik?></td>
        </tr>
      </table>
    </div>
  </div>

  <div class="panel panel-info">
    <div class="panel-heading">
      <h3 class="panel-title">Data Service</h3>
    </div>
    <div class="panel-body">
      <table class="table table-bordered">
        <tr>
          <th>Waktu Service</th>
          <td><?=date('d/m/Y',strtotime($waktu_service))?></td>
        </tr>
        <tr>
          <th>Tahap Service</th>
          <td><?=$nama_service?></td>
        </tr>

        <tr>
          <th>Jarak Tempuh</th>
          <td><?=$jarak_tempuh?> Kilometer</td>
        </tr>

        <tr>
          <th>Waktu Tempuh</th>
          <td><?=$waktu_tempuh?> Bulan</td>
        </tr>

        <tr>
          <th>Jenis Perbaikan</th>
          <td>
            <div class="row">
              <?php $query = $this->model->join_trans_service($id_service); ?>
              <?php foreach ($query as $row): ?>
                <div class="col-md-4">
                  <div class="form-group">
                    <div class="form-radio form-radio-flat">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input"  disabled <?=(cek_trans_service($id_trans_cs_service,$row->id_trans_service)==true)?"checked":""?>> <?=$row->jenis_perbaikan?>
                        <i class="input-helper"></i>
                      </label>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </td>
        </tr>

        <tr>
          <th>Keterangan</th>
          <td><p style="text-align:justify"><?=$keterangan?></p></td>
        </tr>
      </table>
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
