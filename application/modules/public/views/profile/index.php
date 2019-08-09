<section class="m-t-0 p-t-0">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 mx-auto">
          <div class="forum-post">
            <div class="forum-body">
              <h5>Data Pemilik:</h5>
              <table class="table table-bordered" style="font-size:12px;">
                <tr>
                  <th>No.Registrasi</th>
                  <td class="text-success"><?=$row->no_registrasi;?></td>
                </tr>

                <tr>
                  <th>Nama</th>
                  <td><?=$row->nama_pemilik?></td>
                </tr>

                <tr>
                  <th>Telepon</th>
                  <td><?=$row->telepon_pemilik?></td>
                </tr>

                <tr>
                  <th>Email</th>
                  <td><?=$row->email_pemilik?></td>
                </tr>

                <tr>
                  <th>Jenis Kelamin</th>
                  <td><?=$row->jk_pemilik?></td>
                </tr>

                <tr>
                  <th>Alamat</th>
                  <td><?=$row->alamat_pemilik?></td>
                </tr>
              </table>

              <hr>

              <h5>Data Kendaraan :</h5>
              <table class="table table-bordered" style="font-size:12px;">
                <tr>
                  <th>No.Kendaraan</th>
                  <td class="text-success"><?=$row->no_kendaraan?></td>
                </tr>
                <tr>
                  <th>Merek</th>
                  <td><?=$row->merek_kendaraan?></td>
                </tr>
                <tr>
                  <th>Transmisi</th>
                  <td><?=$row->transmisi_kendaraan?></td>
                </tr>
                <tr>
                  <th>Kapasitas mesin(cc)</th>
                  <td><?=$row->cc_kendaraan?></td>
                </tr>
                <tr>
                  <th>Warna</th>
                  <td><?=$row->warna_kendaraan?></td>
                </tr>
                <tr>
                  <th>Tahun pembuatan</th>
                  <td><?=$row->tahun_pembuatan?></td>
                </tr>
                <tr>
                  <th>Waktu Pembelian</th>
                  <td><?=date('d/m/Y',strtotime($row->waktu_pembelian))?></td>
                </tr>

                <tr>
                  <th>Kilometer saat mendaftar</th>
                  <td><?=$row->kilometer?> Km</td>
                </tr>

                <tr>
                  <th>Kilometer Sekarang</th>
                  <td><?=$row->kilometer_skrg?> Km &nbsp;&nbsp;<a href="<?=site_url('update')?>" class="text-success"><i class="fa fa-link"></i> Update</a></td>
                </tr>

                <tr>
                  <th>Jarak Tempuh</th>
                  <td><?=$row->kilometer_skrg-$row->kilometer?> Km</td>
                </tr>

                <tr>
                  <th>Waktu Tempuh</th>
                  <td><?=selisih_bulan()?> Bulan</td>
                </tr>
              </table>

              <div class="alert alert-info m-t-20" style="font-size:12px;">
                <p style="text-align:center"><b><i class="fa fa-info"></i> informasi </b><br> Jika Data di atas terdapat kesalahan, silahkan hubungi admin.</p>
              </div>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
