<section class="m-t-0 p-t-0">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 mx-auto">
          <div class="forum-post">
            <div class="forum-body">
                <table class="table table-bordered">
                  <tr>
                    <th>Status</th>
                    <td class="text-success"> <i class="fa fa-check"></i> sudah</td>
                  </tr>
                  <tr>
                    <th>Waktu Service</th>
                    <td><?=date('d/m/Y h:i',strtotime($waktu_service))?></td>
                  </tr>

                  <tr>
                    <th>Tahap Service</th>
                    <td><?=$nama_service?></td>
                  </tr>

                  <tr>
                    <th>Jarak Tempuh</th>
                    <td><?=$jarak_tempuh?> Km</td>
                  </tr>

                  <tr>
                    <th>Waktu Tempuh</th>
                    <td><?=$waktu_tempuh?> Bulan</td>
                  </tr>



                </table>


                <div class="m-t-30"></div>
                <h5>Jenis Perbaikan:</h5>
                <table class="table table-bordered">
                  <?php $query = $this->model->join_trans_service($id_service); ?>
                  <?php foreach ($query as $row): ?>
                    <tr>
                      <td><i class="fa fa-cog"></i> <?=$row->jenis_perbaikan?></td>
                      <?php if (cek_trans_service($id_trans_cs_service,$row->id_trans_service)==true): ?>
                          <td class="text-center"><i class="fa fa-check text-success"></i></td>
                        <?php else: ?>
                          <td class="text-center"><i class="fa fa-close text-danger"></i></td>
                      <?php endif; ?>
                    </tr>
                  <?php endforeach; ?>
                </table>

                  <h5 class="m-t-20">Keterangan: </h5>
                  <p style="text-align:justify"><?=($keterangan=="")?"-":"$keterangan"?></p>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
