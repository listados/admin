<!DOCTYPE html>
<html>
  <head>
    <style>
       #map {
        height: 400px;
        width: 100%;
       }
    </style>
  </head>
  <body>
    <h3>My Google Maps Demo</h3>
    @php
      $lat = $_GET['lat'];
      $log = $_GET['lon'];
    @endphp
    <div id="map"></div>
                <script>
                  var latMap = parseInt('{{ $lat }}');
                  var lonMap = parseInt('{{ $log }}');
                function initMap() {
                  var uluru = {lat: latMap, lng: lonMap};
                  var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 15,
                    center: uluru
                  });
                  var marker = new google.maps.Marker({
                    position: uluru,
                    map: map
                  });
                }
              </script>
                <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA2eKWrAM32OnL3WqpW2IOU9Sz9lPOBW58&callback=initMap"></script>
               </div>
  </body>
</html>