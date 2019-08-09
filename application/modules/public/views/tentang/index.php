<style media="screen">
  #maps{
    width: 100%;
    height:400px;
  }
</style>
<section class="m-t-0 p-t-0">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 mx-auto">
          <div class="forum-post">
            <div class="forum-body">
              <div id="maps"></div>
              <hr>
              <table>
                <tr>
                  <th style="padding:5px;"><i class="fa fa-phone"></i> </th>
                  <td style="padding:5px;"><?=profile('telepon')?></td>
                </tr>

                <tr>
                  <th style="padding:5px;"><i class="fa fa-envelope"></i></th>
                  <td style="padding:5px;"> <?=profile('email')?></td>
                </tr>

                <tr>
                  <th style="padding:5px;"><i class="fa fa-map"></i></th>
                  <td style="padding:5px;"> <?=profile('alamat')?></td>
                </tr>
              </table>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script src="https://maps.googleapis.com/maps/api/js?v=3.31&key=AIzaSyDMDVKjRep_9KhuXib8nA2iGgUONvsribE&libraries=places"></script>
  <script type="text/javascript" src="<?=base_url()?>/temp/backend/markerwithlabel_packed.js"></script>
  <script type="text/javascript" src="<?=base_url()?>/temp/backend/custom-map.js"></script>
  <script>

    <?php
      $kord = explode(',', profile('kordinat'));
     ?>
    var _latitude = <?=$kord[0]?>;
    var _longitude = <?=$kord[1]?>;

    google.maps.event.addDomListener(window, 'load', initSubmitMap(_latitude,_longitude));
    function initSubmitMap(_latitude,_longitude){
        var mapCenter = new google.maps.LatLng(_latitude,_longitude);
        var mapOptions = {
            zoom: 15,
            geolocationControl: true,
            center: mapCenter,
            disableDefaultUI: false,
            //scrollwheel: false,
            styles: mapStyles,
            // scaleControl: false,
            // fullscreenControl: false,
            streetViewControl:false,
            // mapTypeControl:false,
            // zoomControl:false
        };
        var mapElement = document.getElementById('maps');
        var map = new google.maps.Map(mapElement, mapOptions);
        var marker = new MarkerWithLabel({
            position: mapCenter,
            map: map,
            // icon: 'assets/img/marker.png',
            labelAnchor: new google.maps.Point(50, 0),
            draggable: false,
        });
        $('#maps').removeClass('fade-map');

    }





  </script>
