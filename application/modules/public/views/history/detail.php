<style media="screen">
  #maps{
    width:100%;
    height: 700px;
  }



  .apk{
    position: fixed;
    bottom: 0;
    width:100%;
    background: #02c1ff;
    padding: 20px;
    text-align: center;
    color:#fff;
  }
  .apk a{
    margin-top: 20px;
  }


</style>

<section class="m-t-0 p-t-0">
  <div id="maps"></div>

  <div class="apk">
    <table class="table table-bordered">
      <tr>
        <th>waktu perjalanan </th>
        <td><?=date('d/m/Y h:i',strtotime($date_start))?></td>
      </tr>
      <tr>
        <th>Jarak Tempuh</th>
        <td><?=$nilaiJarak?> Km</td>
      </tr>

      <tr>
        <th>Estimasi Waktu Tempuh</th>
        <td><?=selisih_waktu($date_start,$date_end)?></td>
      </tr>
    </table>

    <a href="javascript:history.back()" class="btn btn-sm btn-success text-center"> Kembali </a>
  </div>



  </section>


  <script src="https://maps.googleapis.com/maps/api/js?v=3.31&key=AIzaSyDMDVKjRep_9KhuXib8nA2iGgUONvsribE&libraries=places"></script>
  <script type="text/javascript" src="<?=base_url()?>/temp/backend/markerwithlabel_packed.js"></script>
 <script type="text/javascript" src="<?=base_url()?>/temp/backend/custom-map.js"></script>
  <script>


  function initMap() {
    var pointA = new google.maps.LatLng(<?=$kordinat_start?>),
        pointB = new google.maps.LatLng(<?=$kordinat_end?>),

      myOptions = {
        zoom: 12,
        center: pointA,
        disableDefaultUI: false,
        //scrollwheel: false,
        styles: mapStyles,
        scaleControl: false,
        // fullscreenControl: false,
        streetViewControl:false,
        mapTypeControl:false
      },
      map = new google.maps.Map(document.getElementById('maps'), myOptions),
      // Instantiate a directions service.
      directionsService = new google.maps.DirectionsService,
      directionsDisplay = new google.maps.DirectionsRenderer({
        map: map,
        suppressMarkers: true
      });
    // get route from A to B
    calculateAndDisplayRoute(directionsService, directionsDisplay, pointA, pointB);


  }





  function calculateAndDisplayRoute(directionsService, directionsDisplay, pointA, pointB) {
    <?php if ($trs->num_rows()>0) { ?>
    var waypts = [];

    var trs = [<?php foreach ($trs->result() as $rows) {
                echo "'".$rows->kordinat."',";
              }?>];

      for (var i = 0; i < trs.length; i++) {
        waypts.push({
              location: trs[i],
              stopover: true
            });
      }
    <?php  } ?>


    directionsService.route({
      origin: pointA,
      destination: pointB,
      <?php if ($trs->num_rows()>0) { ?>
        waypoints: waypts,
        optimizeWaypoints: true,
        <?php  } ?>
      travelMode:  google.maps.TravelMode.DRIVING
    }, function(response, status) {
      if (status == google.maps.DirectionsStatus.OK) {
        directionsDisplay.setDirections(response);
      } else {
        window.alert('Directions request failed due to ' + status);
      }
    });
  }

  initMap();
</script>
