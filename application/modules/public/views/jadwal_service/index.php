<link rel="stylesheet" href="<?=base_url()?>temp/public/plugins/datatables/dataTables.bootstrap4.min.css">
<script src="<?=base_url()?>temp/public/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>temp/public/plugins/datatables/dataTables.bootstrap4.min.js"></script>

<style media="screen">
#mytable  tr td { text-align: left!important; }
.dataTables_filter {
display: none;
}
.dataTables_processing {
  display: none!important;
}

#mytable thead {
  display:none;
}

#mytable tbody tr td{
  font-size: 13px;
  color:#000;
}

</style>
<section class="m-t-0 p-t-0 p-b-100 m-b-100">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 mx-auto">
          <div class="forum-post">
            <div class="forum-body" >
              <div class="form-group">
               <!-- <div class="input-group">
                <input type="text" id="cari" class="form-control"  placeholder="Masukkan Nik/Nama">
                <span class="input-group-addon" style="background:#27c0c9"><a  href="#" id="btn_cari" style="color:#fff" class="color-white"><i class="fa fa-search"></i> Cari</a></span>
                <span class="input-group-addon" style="background:#b54141"><a  href="#" id="reload" style="color:#fff" class="color-white"><i class="fa fa-refresh"></i> Reset</a></span>
              </div>
            </div> -->

              <table class="table table-striped no-footer" cellspacing="0" id="mytable" style="width:100%;">
                <thead>
                  <th>#</th>
                  <th width="50">#</th>
                  <th>~</th>
                </thead>
              </table>

            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script type="text/javascript">

  $(document).ready(function() {
      var t = $("#mytable").DataTable({
          oLanguage: {
              sProcessing: false
          },
          processing: true,
          serverSide: true,
          bInfo: false,
          lengthChange: false,
          ajax: {"url": '<?=base_url("public/jadwal_service/json")?>', "type": "POST"},
          columns: [
              {
                  "data": "id_jadwal",
                  "orderable": false,
                  "visible":false
              },
              {"data":"waktu",
              render:function(data,type,row,meta)
              {
                if (row.status=="belum") {
                  return '<b><a href="<?=base_url()?>jadwal_service/detail/'+row.id_jadwal+'" id="detail_notif">'+data+'</a></b>';
                }else {
                  return '<a href="<?=base_url()?>jadwal_service/detail/'+row.id_jadwal+'" id="detail_notif">'+data+'</a>';
                }

              }
            },
              {"data":"keterangan",
                render:function(data,type,row,meta)
                {
                  if (row.status=="belum") {
                    return '<b><a href="<?=base_url()?>jadwal_service/detail/'+row.id_jadwal+'">'+data.substr(0, 20)+'</a></b>';
                  }else {
                    return '<a href="<?=base_url()?>jadwal_service/detail/'+row.id_jadwal+'">'+data.substr(0, 20)+'</a>';
                  }
                }
              },
              {"data":"status","visible":false}
          ],
          order: [[0, 'desc']],
      });

  });

  // $(document).on('click', '#detail_notif', function(e){
  //     e.preventDefault();
  //     $('.modal-dialog').removeClass('modal-md');
  //     $('.modal-dialog').removeClass('modal-sm');
  //     $('.modal-dialog').addClass('modal-lg');
  //     $('#ModalHeader').html('Detail Notifikasi');
  //     $('#ModalContent').load($(this).attr('href'));
  //     $('#ModalGue').modal('show');
  //   });

  </script>
