<section class="m-t-0 p-t-0">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 mx-auto">
          <div class="forum-post">
            <div class="forum-body">
                <table class="table table-bordered">
                  <tr>
                    <th>Status</th>
                    <td class="text-danger"><i class="fa fa-close"></i> Belum</td>
                  </tr>

                  <tr>
                    <th>Tahap Service</th>
                    <td><?=$nama_service?></td>
                  </tr>
                </table>


                <div class="m-t-30"></div>
                <h5>Jenis Perbaikan:</h5>
                <table class="table table-bordered">
                  <?php $query = $this->model->join_trans_service($id_service); ?>
                  <?php foreach ($query as $row): ?>
                    <tr>
                      <td><i class="fa fa-cog"></i> <?=$row->jenis_perbaikan?></td>
                          <td class="text-center"><i class="fa fa-close text-danger"></i></td>
                    </tr>
                  <?php endforeach; ?>
                </table>

            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
