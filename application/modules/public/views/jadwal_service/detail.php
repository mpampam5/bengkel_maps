<section class="m-t-0 p-t-0 p-b-100 m-b-100">
    <div class="container p-b-100 m-b-100">
      <div class="row">
        <div class="col-lg-12 mx-auto">
          <div class="forum-post">
            <div class="forum-body">
              <div class="form-group">
                <div class="col-sm-12">
                  <p>Jadwal : <?=date('d/m/y h:i',strtotime($waktu))?></p>
                  <p style="text-align:justify"><?=$keterangan?></p>
                  <div style="font-size:12px;">
                    <span ><i class="fa fa-user"></i> admin</span>
                  </div>
                  <hr>
                </div>

                <div class="col-sm-12">
                  <div class="alert alert-info" style="font-size:12px!important;">Info Lebih lanjut hubungi:
                    <ul>
                      <li><i class="fa fa-phone"></i> <?=profile('telepon')?></li>
                      <li><i class="fa fa-envelope"></i> <?=profile('email')?></li>
                    </ul>
                  </div>
                </div>

            </div>
            </div>
          </div>


        </div>
      </div>
    </div>
  </section>
