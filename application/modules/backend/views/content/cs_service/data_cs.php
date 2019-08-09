<style media="screen">
.dataTables_filter {
display: none;
}
</style>

<div class="row">
<div class="col-md-12 d-flex align-items-stretch grid-margin">
  <div class="row flex-grow">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
        <div class="row" style="border-bottom:1px solid #d4d2d2;margin-bottom:30px;padding-bottom:10px">
          <div class="col-12">
            <div class="pull-left">
              <h4><?=$layout_title?></h4>
            </div>
          </div>
        </div>
      <div class="form-group">
        <input type="text" class="form-control" id="search_cs" placeholder="Cari No.registrasi/Nama">
      </div>
      <table class="table table-bordered" id="mytable" style="width:100%;font-size:13px;">
          <thead>
              <tr>
                  <th width="80px">No</th>
                  <th>No.Registrasi</th>
                  <th>Nama</th>
                  <th width="200px">Action</th>
              </tr>
          </thead>
      </table>
      <a href="javascript:history.go(-1)" class="btn btn-sm btn-secondary"> Kembali</a>
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
                        $('#search_cs')
                                .off('.DT')
                                .on('keyup.DT', function(e) {
                                        api.search(this.value).draw();
                        });
                    },
                    bInfo : false,
                    lengthChange: false,
                    oLanguage: {
                        sProcessing: "loading...",
                        sZeroRecords: "<p class='text-center'><i> DATA TIDAK DITEMUKAN</i></p>"
                    },
                    processing: true,
                    serverSide: true,
                    ajax: {"url": '<?=base_url(config_item("cpanel")."customer/json")?>', "type": "POST"},
                    columns: [
                        {
                            "data": "id_trans_kendaraan",
                            "orderable": false,
                            "visible":false
                        },
                        {"data":"no_registrasi"},
                        {"data":"nama_pemilik"},
                        {
                            "data" : "action",
                            "orderable": false,
                            "className" : "text-center",
                            render:function(data,type,row)
                            {
                              // var str ='<button  class="btn btn-sm btn-success btn-block" id="pilih" data-url="'+row.id_trans_kendaraan+'*'+row.no_registrasi+'">Pilih</button>';
                              var str='<a href="<?=base_url()?>backend/cs_service/tambah/'+row.id_trans_kendaraan+'.html" class="btn btn-sm btn-success"> Pilih</a>';
                              return str;
                            }
                        }
                    ],
                    order: [[0, 'desc']],
                });
            });

            // $(document).on('click', '#pilih', function(e){
            //   var str = $(this).data('url');
            //   var strs = str.split("*");
            //   $("#id_trans_kendaraan").val(strs[0]);
            //   $("#no_registrasi").val(strs[1]);
            //   $.ajax({
            //     url             : "<?=base_url()?>backend/trans_cs_service/get_data_cs/"+strs[0],
            //     type            : 'post',
            //     contentType     : false,
            //     cache           : false,
            //     dataType        : 'JSON',
            //     processData     :false,
            //     success:function(json){
            //       if (json.success==true) {
            //         $("#detail_cs").hide().fadeIn(500).html('<h1>'+json.data+'</h1>');
            //       }
            //     }
            //   })
            //   $("#ModalGue").modal('hide');
            // });

        </script>
