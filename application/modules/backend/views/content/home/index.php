<div class="row">
<div class="col-md-12 d-flex align-items-stretch grid-margin">
  <div class="row flex-grow">
    <div class="col-12">
      <div class="card">
        <div class="card-body" style="max-width:1050px;">
          <canvas id="myChart" width="100" height="40"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.3.0/Chart.bundle.js"></script>
<script>
            var ctx = document.getElementById("myChart");
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ["januari", "Februari", "Maret", "April", "Mei", "Juni","Juli","Agustus","Sebtember","Oktober","November","Desember"],
                    datasets: [{
                            label: 'GRAFIK PERBAIKAN DAN PERAWATAN KENDARAAN TAHUN <?=date('Y')?>',
                            data: [
                                    <?php
                                          echo home_grafik($date=date('Y')."-01").",";
                                          echo home_grafik($date=date('Y')."-02").",";
                                          echo home_grafik($date=date('Y')."-03").",";
                                          echo home_grafik($date=date('Y')."-04").",";
                                          echo home_grafik($date=date('Y')."-05").",";
                                          echo home_grafik($date=date('Y')."-06").",";
                                          echo home_grafik($date=date('Y')."-07").",";
                                          echo home_grafik($date=date('Y')."-08").",";
                                          echo home_grafik($date=date('Y')."-09").",";
                                          echo home_grafik($date=date('Y')."-10").",";
                                          echo home_grafik($date=date('Y')."-11").",";
                                          echo home_grafik($date=date('Y')."-12");
                                     ?>
                            ],
                            backgroundColor: [
                                'rgba(0, 184, 209, 0.97)',
                                'rgba(0, 184, 209, 0.97)',
                                'rgba(0, 184, 209, 0.97)',
                                'rgba(0, 184, 209, 0.97)',
                                'rgba(0, 184, 209, 0.97)',
                                'rgba(0, 184, 209, 0.97)',
                                'rgba(0, 184, 209, 0.97)',
                                'rgba(0, 184, 209, 0.97)',
                                'rgba(0, 184, 209, 0.97)',
                                'rgba(0, 184, 209, 0.97)',
                                'rgba(0, 184, 209, 0.97)',
                                'rgba(0, 184, 209, 0.97)'
                            ]
                        }]
                },
                options: {
                    scales: {
                        yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                    }
                }
            });
        </script>
