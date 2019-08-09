<style media="screen">
  #maps{
    width:100%;
    height: 700px;
  }
</style>

<section class="m-t-0 p-t-0 p-b-100 m-b-100">
    <div class="container p-b-100 m-b-100">
      <div class="row">
        <div class="col-lg-12 mx-auto">
          <div class="forum-post">
            <div class="forum-body">
              <div class="form-group">
                <div class="col-sm-12">

                  <input id="dest" style="width: 500px;" type="text" />
                     <button id="cari" type="button">Cari Rute</button>
                  <div id="maps"></div>


                  <hr>
                  <div style="font-size:14px;text-align:center;font-weight:bold;">
                    <p>Selamat Menikmati Perjalanan.</p>
                    <a href="<?=site_url('home')?>" class="btn btn-info btn-sm"> <i class="fa fa-home"></i> Kembali ke menu utama</a>
                  </div>
                </div>
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
  function initMap() {
    var pointA = new google.maps.LatLng(-5.1759367,119.4312152),
        pointB = new google.maps.LatLng(-5.1635895,119.4153388),

      myOptions = {
        zoom: 15,
        center: pointA,
        disableDefaultUI: false,
        //scrollwheel: false,
        styles: mapStyles,
        // scaleControl: false,
        // fullscreenControl: false,
        streetViewControl:false,
        mapTypeControl:false
      },
      map = new google.maps.Map(document.getElementById('maps'), myOptions),
      // Instantiate a directions service.
      directionsService = new google.maps.DirectionsService,
      directionsDisplay = new google.maps.DirectionsRenderer({
        map: map
      }),
      markerA = new google.maps.Marker({
        position: pointA,
        map: map
      }),

      markerB = new google.maps.Marker({
        position: pointB,
        map: map
      });

    // get route from A to B
    calculateAndDisplayRoute(directionsService, directionsDisplay, pointA, pointB);

  }



  function calculateAndDisplayRoute(directionsService, directionsDisplay, pointA, pointB) {
    directionsService.route({
      origin: pointA,
      destination: pointB,
      travelMode: google.maps.TravelMode.WALKING
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
