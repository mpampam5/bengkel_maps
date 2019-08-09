<section class="m-t-0 p-t-0">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 mx-auto">
          <div class="forum-post">
            <div class="forum-body">
              <h5>Tahap Service</h5>
              <table class="table table-bordered">
                <?php foreach ($query->result() as $row): ?>
                  <?php if (cek_service($this->session->userdata('id_trans_kendaraan'),$row->id_service)==true): ?>
                      <tr>
                        <td class="text-success"><a href="<?=site_url("service/detail/$row->id_service/1")?>"> <i class="fa fa-cogs"></i> <?=$row->nama_service?> <i class="fa fa-check"></i></a></td>
                      </tr>
                    <?php else: ?>
                      <tr>
                        <td class="text-danger"><a href="<?=site_url("service/detail/$row->id_service/0")?>"> <i class="fa fa-cogs"></i> <?=$row->nama_service?> <i class="fa fa-close"></i></a></td>
                      </tr>
                  <?php endif; ?>

                <?php endforeach; ?>
              </table>

              <div class="alert alert-info m-t-10">
                  <p class="text-center">
                    <b><i class="fa fa-info-circle"></i> Info</b> <br>
                    Text <i class="text-success">hijau</i> menandakan telah melakukan perbaikan & perawatan berdasarkan tahap service.
                  </p>
              </div>

            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
