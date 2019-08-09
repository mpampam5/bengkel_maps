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
  padding-top: 20px;
  text-align: center;
}

.apk p{
  color: #fff;
  font-size: 11px;
  margin: 10px;
}



</style>

<section class="m-t-0 p-t-0">
  <div id="maps"></div>


  <div class="apk">
    <a href="<?=site_url("public/maps/batal/".$token)?>" class="btn btn-sm btn-default"> Batalkan</a>
    <a href="#"  id="done" class="btn btn-sm btn-success"> Perjalanan selesai</a>
    <p>Peringatan! Jangan tutup Aplikasi pada saat proses ini berjalan</p>
  </div>

</section>

<input type="hidden" id="kordinat" >



<script src="https://maps.googleapis.com/maps/api/js?v=3.31&key=AIzaSyDMDVKjRep_9KhuXib8nA2iGgUONvsribE&libraries=places"></script>
<script type="text/javascript" src="<?=base_url()?>/temp/backend/markerwithlabel_packed.js"></script>
<script type="text/javascript" src="<?=base_url()?>/temp/backend/custom-map.js"></script>
<script type="text/javascript">

    $(document).on('click','#done',function(e){
      e.preventDefault();
      if (navigator.geolocation) {
          $('#maps').addClass('fade-map');
          $("#done").prop('disabled',true)
                    .text('Memproses..');
            navigator.geolocation.getCurrentPosition(function(position){
              lokasii = position.coords.latitude+","+position.coords.longitude;
              $.ajax({
                url: "<?=base_url()?>public/maps/save_kordinat_end",
                type: 'post',
                data: {token:'<?=$token?>',kordinat:lokasii},
                dataType: 'JSON',
                success:function(jsons)
                {
                  if (jsons.successs==true) {
                    window.location.href = '<?=site_url("public/maps/detail/".$token)?>';
                  }else {
                    alert('gagal');
                  }
                }
              });
            });

      } else {
          alert('Geo Location is not supported');
      }
    });




  // function geoPosition(position)
  // {
  //   var token = <?=$token?>;
  //   var lokasii = position.coords.latitude+","+position.coords.longitude;
  //
  //   $.ajax({
  //     url: "<?=base_url()?>public/maps/save_kordinat_end",
  //     type: 'post',
  //     data: {token:token,kordinat:lokasii},
  //     dataType: 'JSON',
  //     success:function(jsons)
  //     {
  //       if (jso.successs==true) {
  //         return true;
  //       }else {
  //         alert('gagal');
  //       }
  //     }
  //   });
  //
  // }

</script>

<script>


  $(document).ready(function(){
    // geoLocation();

    window.setInterval(function(){
      geoLocation();
      var id_location = <?=$id_histry_location?>;
      var lokasi = $("#kordinat").val();
      $.ajax({
        url: "<?=base_url()?>public/maps/save_waypoints",
        type: 'post',
        data: {id_history:id_location,kordinat:lokasi},
        dataType: 'JSON',
        success:function(json)
        {
          if (json.success==false) {
            alert("error");
          }
        }

      });
    }, 20000);

    history.pushState(null, null, document.title);
      window.addEventListener('popstate', function (){
      history.pushState(null, null, document.title);
    });
  });


  var _lat = <?=$lat1?>;
  var _long = <?=$long1?>;
  google.maps.event.addDomListener(window, 'load',initSubmitMap(_lat,_long));

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
          fullscreenControl: false,
          streetViewControl:false,
          mapTypeControl:false,
          zoomControl:false
      };
      var mapElement = document.getElementById('maps');
      var map = new google.maps.Map(mapElement, mapOptions);
      var marker = new MarkerWithLabel({
          position: mapCenter,
          map: map,
          animation: google.maps.Animation.DROP,
          icon: '<?=base_url()?>temp/car.png',
          labelAnchor: new google.maps.Point(50, 0)
      });
  }

  function successs(position) {
      $('#kordinat').val(position.coords.latitude+','+position.coords.longitude);
      initSubmitMap(position.coords.latitude, position.coords.longitude);
  }

  // $('.geo-location').on("click", function() {
  //     if (navigator.geolocation) {
  //       $('#address-map').val("");
  //         $('#maps').addClass('fade-map');
  //         navigator.geolocation.getCurrentPosition(successs);
  //     } else {
  //         alert('Geo Location is not supported');
  //     }
  // });


  function geoLocation()
  {
    if (navigator.geolocation) {
        $('#maps').addClass('fade-map');
        navigator.geolocation.getCurrentPosition(successs);
    } else {
        alert('Geo Location is not supported');
    }
  }




</script>
