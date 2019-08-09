<style media="screen">
  #maps{
    width:100%;
    height: 700px;
  }

  #input-add{
    position: absolute;
    top:72px;
    left: 9px;
    width: 100%
  }

#geo{
  padding: 5px 13px 5px 13px;
  position: absolute;
  top:60px;
  right: 58px;
  background-color: #ffffff;
  box-shadow: rgba(0, 0, 0, 0.3) 0px 1px 4px -1px
}

#geo .geo-location{
  /* width: 100% */
  color: #6f6f6f;
  font-size: 20px;
}

#set-lokasi{
  position: fixed;
  bottom: 0;
  width:100%;
}

  @media (max-width: 767px) {
    #input-add{
      top:60px;
    }

  }

  @media (min-width: 767px) {
    #geo{
      top:72px;
    }
  }

</style>

<section class="m-t-0 p-t-0">
  <div id="maps"></div>

  <div class="col-8" id="input-add">
    <div class="form-group">
      <input type="text" onClick="this.select();" placeholder="Masukkan Alamat" class="form-control" id="address-map">
    </div>
  </div>

<div id="geo">
  <a class="geo-location"> <i class="fa fa-crosshairs"></i></a>
</div>

<a id="set-lokasi" class="btn btn-block btn-lg btn-flat btn-info text-white" onclick="getUrl()"> Mulai Perjalanan</a>

</section>

<input type="hidden" id="kordinat" value="<?=$lat1."/".$long1?>">

<script type="text/javascript">
  function getUrl()
  {
    window.location.href = "<?=base_url()?>maps/<?=$lat1."/".$long1?>/"+$("#kordinat").val();
  }
</script>

<script src="https://maps.googleapis.com/maps/api/js?v=3.31&key=AIzaSyDMDVKjRep_9KhuXib8nA2iGgUONvsribE&libraries=places"></script>
<script type="text/javascript" src="<?=base_url()?>/temp/backend/markerwithlabel_packed.js"></script>
<script type="text/javascript" src="<?=base_url()?>/temp/backend/custom-map.js"></script>
<script>


  var _latitude = <?=$lat1?>;
  var _longitude =<?=$long1?>;

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
          mapTypeControl:false,
          zoomControl:false
      };
      var mapElement = document.getElementById('maps');
      var map = new google.maps.Map(mapElement, mapOptions);
      var marker = new MarkerWithLabel({
          position: mapCenter,
          map: map,
          // icon: 'assets/img/marker.png',
          labelAnchor: new google.maps.Point(50, 0),
          draggable: true,
      });
      $('#maps').removeClass('fade-map');
      google.maps.event.addListener(marker, "mouseup", function (event) {
          // alert(this.position.lat() +" "+ this.position.lng());
          $('#kordinat').val(this.position.lat() +"/"+ this.position.lng());
      });

//      Autocomplete
      var input = /** @type {HTMLInputElement} */( document.getElementById('address-map') );
      var autocomplete = new google.maps.places.Autocomplete(input);
      autocomplete.bindTo('bounds', map);
      google.maps.event.addListener(autocomplete, 'place_changed', function() {
          var place = autocomplete.getPlace();
          if (!place.geometry) {
              return;
          }
          if (place.geometry.viewport) {
              map.fitBounds(place.geometry.viewport);
          } else {
              map.setCenter(place.geometry.location);
              map.setZoom(17);
          }
          marker.setPosition(place.geometry.location);
          marker.setVisible(true);
          // $('#latitude').val( marker.getPosition().lat() );
          // $('#longitude').val( marker.getPosition().lng() );
          $('#kordinat').val(marker.getPosition().lat()+'/'+marker.getPosition().lng());
          var address = '';
          if (place.address_components) {
              address = [
                  (place.address_components[0] && place.address_components[0].short_name || ''),
                  (place.address_components[1] && place.address_components[1].short_name || ''),
                  (place.address_components[2] && place.address_components[2].short_name || '')
              ].join(' ');
          }
      });

  }

  function successs(position) {
      initSubmitMap(position.coords.latitude, position.coords.longitude);
      $('#kordinat').val(position.coords.latitude+'/'+position.coords.longitude);
  }

  $('.geo-location').on("click", function() {
      if (navigator.geolocation) {
        $('#address-map').val("");
          $('#maps').addClass('fade-map');
          navigator.geolocation.getCurrentPosition(successs);
      } else {
          alert('Geo Location is not supported');
      }
  });



</script>
