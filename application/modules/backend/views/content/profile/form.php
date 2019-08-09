
<style media="screen">
#maps {
  height: 300px;
  width: 100%;
}
</style>
<div class="row">
<div class="col-md-12 d-flex align-items-stretch grid-margin">
  <div class="row flex-grow">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h4><?=ucfirst($button).' '.$layout_title?></h4>
          <hr>
      <div id="pesan"></div>
      <form action="<?=$aksi?>" id="form">

						 <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                   <label for="varchar">Nama Bengkel</label>
                   <input type="text" class="form-control" name="nama_bengkel" id="nama_bengkel" placeholder="Nama Bengkel" value="<?php echo $nama_bengkel; ?>" />
               </div>

                <div class="form-group">
                   <label for="varchar">Email</label>
                   <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" />
               </div>

                <div class="form-group">
                   <label for="varchar">Telepon</label>
                   <input type="text" class="form-control" name="telepon" id="telepon" placeholder="Telepon" value="<?php echo $telepon; ?>" />
               </div>

                <div class="form-group">
                   <label for="alamat">Alamat</label>
                   <textarea class="form-control" rows="3" name="alamat" id="alamat" placeholder="Alamat"><?php echo $alamat; ?></textarea>
               </div>
              </div>

                <div class="col-md-7">
                  <div class="form-group">
                    <label for="">Cari Alamat</label>
                    <input type="text" class="form-control address-map" id="address-map" placeholder="Cari Alamat">
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for=""></label>
                    <a class="btn btn-info form-control geo-location text-white"><i class="fa fa-map-marker"></i> dapatkan Lokasi Saat ini</a>
                  </div>
                </div>

                <div class="col-md-12">
                  <label style="font-size: 13px"><b>Kordinat</b></label>
                  <div id="maps"></div>
                  <div class="form-group">
                    <input type="hidden" class="form-control" name="kordinat" id="kordinat" placeholder="Kordinat" value="<?=$kordinat?>"/>
                  </div>
                </div>





             </div>

            <!-- MODAL ClOSE -->
            <!-- <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" aria-label="Close">tutup</button> -->
              <a href="javascript:history.go(-1)" class="btn btn-sm btn-secondary"> batal</a>



              <button type="submit" class="btn btn-success btn-sm " name="submit" id="submit"><?=$button?></button>


      </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://maps.googleapis.com/maps/api/js?v=3.31&key=AIzaSyDMDVKjRep_9KhuXib8nA2iGgUONvsribE&libraries=places"></script>
  <script type="text/javascript" src="<?=base_url()?>/temp/backend/markerwithlabel_packed.js"></script>
  <script type="text/javascript" src="<?=base_url()?>/temp/backend/custom-map.js"></script>
  <script>

    <?php
      $kord = explode(',', $kordinat);
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
            draggable: true,
        });
        $('#maps').removeClass('fade-map');
        google.maps.event.addListener(marker, "mouseup", function (event) {
            // alert(this.position.lat() +" "+ this.position.lng());
            $('#kordinat').val(this.position.lat() +","+ this.position.lng());
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
            $('#kordinat').val(marker.getPosition().lat()+','+marker.getPosition().lng());
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
        $('#kordinat').val(position.coords.latitude+','+position.coords.longitude);
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

<script type="text/javascript">
  $("#form").submit(function(e){
    e.preventDefault();
    var me = $(this);
    $("#submit").prop('disabled',true);

    $.ajax({
          url             : me.attr('action'),
          type            : 'post',
          data            :  new FormData(this),
          contentType     : false,
          cache           : false,
          dataType        : 'JSON',
          processData     :false,
          success:function(json){
            if (json.success==true) {
              $('#pesan').append('<div class="alert alert-success">'+
                                  '<span class="fa fa-envelope-o"></span> '+
                                  json.alert+
                                  '<div>');
                $('.form-group').removeClass('.has-error')
                                .removeClass('.has-success');
                $('.text-danger').remove();
                 $('body,html').animate({ scrollTop: 0 }, 'slow');
                $('.alert-success').delay(500).show(10, function(){
                  $('.alert-success').delay(5000).hide(10, function(){
                    $('.alert-success').remove();
                    window.location.href="<?=site_url(config_item("cpanel").'profile')?>";
                  });
                })
            }else {
              $.each(json.alert, function(key, value) {
                var element = $('#' + key);
                $('#submit').prop('disabled',false);
                $(element)
                .closest('.form-group')
                .find('.text-danger').remove();
                $(element).after(value);
              });
            }
          }
    });
  });
  </script>
