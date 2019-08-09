
<div class="row">
<div class="col-md-12 d-flex align-items-stretch grid-margin">
  <div class="row flex-grow">
    <div class="col-12">
      <div class="card">
        <div class="card-body" style="max-width:1050px;padding:10px;">
        <div class="row" style="border-bottom:1px solid #d4d2d2;margin-bottom:30px;padding-bottom:10px">
          <div class="col-12">
            <div class="pull-left">
              <h4><?=$layout_title?></h4>
            </div>
            <!-- <div class="pull-right">
              <a href='<?=site_url(config_item("cpanel")."notifikasi_cs/tambah")?>' id='tambah' class='btn btn-success btn-xs pull-right'><i class="fa fa-plus"></i> Tambah</a>
            </div> -->
          </div>
        </div>

      <div id='alert'></div>
        <table class="table table-bordered" id="mytable">
            <thead>
                <tr>
                    <th></th>
                    <th width="80px">No</th>
                    <th>#</th>
                    <th>Dikirim</th>
								    <th>No.Registrasi</th>
                    <th>Nama</th>
								    <!-- <th>Notifikasi</th> -->
								    <th width="200px">Action</th>
                </tr>
            </thead>

        </table>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
        <script type="text/javascript">
            $(document).ready(function() {
                var t = $("#mytable").dataTable({
                    initComplete: function() {
                        var api = this.api();
                        $('#mytable_filter input')
                                .off('.DT')
                                .on('keyup.DT', function(e) {
                                    if (e.keyCode == 13) {
                                        api.search(this.value).draw();
                            }
                        });
                    },
                    oLanguage: {
                        sProcessing: "loading..."
                    },
                    processing: true,
                    serverSide: true,
                    ajax: {"url": '<?=base_url(config_item("cpanel")."notifikasi_cs/json")?>', "type": "POST"},
                    columns: [
                        {
                            "data": "id_notif",
                            "orderable": false,
                            "visible":false
                        },
                        {"data": "id_trans_kendaraan",
                        "visible":false
                        },
                        {"data": "status",
                        render:function(data){
                          if (data=="belum") {
                            return '<i class="fa fa-star text-warning"></i>';
                          }else {
                            return '<i class="fa fa-star-o"></i>';
                          }
                        }
                        },
                        {"data": "waktu"},
                        {"data": "no_registrasi",
                        render:function(data,type,row,meta)
                        {
                          return '<a class="text-success" href="<?=base_url()?>backend/customer/detail/'+row.id_trans_kendaraan+'"><i class="fa fa-link"></i> '+data+'</a>'
                        }
                        },
                        {"data": "nama_pemilik"},
                        // {"data": "notifikasi",
                        // render:function(data)
                        // {
                        //   return '<span style="text-overflow:clip;white-space: nowrap; width: 150px;overflow: hidden; ">'+data+'</span>';
                        // }
                        // },
                        {
                            "data" : "action",
                            "orderable": false,
                            "className" : "text-center"
                        }
                    ],
                    order: [[0, 'desc']]
                });
            });

            $(document).on('click', '#hapus', function(e){
             e.preventDefault();
             var Link = $(this).attr('href');
             $('.modal-dialog').removeClass('modal-lg');
             $('.modal-dialog').addClass('modal-sm');
             $('#ModalHeader').html('Konfirmasi');
             $('#ModalContent').html('Apakah anda yakin ingin Menghapus?');
             $('#ModalFooter').html("<button type='button' class='btn btn-default' data-dismiss='modal'>Batal</button> <button type='button' class='btn btn-primary' id='ya-hapus'  data-url='"+Link+"'>Ya, saya yakin</button>");
             $('#ModalGue').modal('show');
           });

           $(document).on('click', '#ya-hapus', function(e){
             e.preventDefault();

             $.ajax({
               url: $(this).data('url'),
               type: "POST",
               cache: false,
               dataType:'json',
               success: function(data){
                 $('.alert-success').remove();
                 $("#ModalGue").modal('hide');
                 $('#alert').append('<div id="alert" class="alert alert-success">'+
                                   data.alert+
                                   '<div>');
                  $('#mytable').DataTable().ajax.reload();
                 $('.alert-success').delay(500).show(10, function(){
                   $('.alert-success').delay(5000).hide(10, function(){
                     $('.alert-success').remove();

                   });
                 })
               }
             });
           });

           // MODAL TAMBAH
           // $(document).on('click', '#tambah', function(e){
           //     e.preventDefault();
           //     $('.modal-dialog').removeClass('modal-lg');
           //     $('.modal-dialog').removeClass('modal-sm');
           //     $('.modal-dialog').addClass('modal-md');
           //     $('#ModalHeader').html('');
           //     $('#ModalContent').load($(this).attr('href'));
           //     $('#ModalGue').modal('show');
           //   });
           //
           //   MODAL EDIT
           //   $(document).on('click', '#edit', function(e){
           //       e.preventDefault();
           //       $('.modal-dialog').removeClass('modal-lg');
           //       $('.modal-dialog').removeClass('modal-sm');
           //       $('.modal-dialog').addClass('modal-md');
           //       $('#ModalHeader').html('');
           //       $('#ModalContent').load($(this).attr('href'));
           //       $('#ModalGue').modal('show');
           //     });
           //
           //   MODAL DETAIL
           //   $(document).on('click', '#detail', function(e){
           //       e.preventDefault();
           //       $('.modal-dialog').removeClass('modal-lg');
           //       $('.modal-dialog').removeClass('modal-sm');
           //       $('.modal-dialog').addClass('modal-md');
           //       $('#ModalHeader').html('');
           //       $('#ModalContent').load($(this).attr('href'));
           //       $('#ModalGue').modal('show');
           //     });

        </script>
