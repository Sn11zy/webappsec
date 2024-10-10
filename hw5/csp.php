<?php
$nonce = bin2hex(random_bytes(32));
  header("Content-Security-policy: script-src 'nonce-".$nonce."';base-uri 'none';style-src 'self' 'nonce-".$nonce."'")
?>
<html>
  <head>
    <title>Powered by JavaScript</title>
    <link rel="stylesheet" href="/leaflet.css">
  </head>
  <body>
    <script nonce="<?php echo($nonce)?>">
        window.onload = function () {
          var loadTime = window.performance.timing.domContentLoadedEventEnd-window.performance.timing.navigationStart;
          console.log('Page load time is '+ loadTime);
        }
    </script>

<style nonce="<?php echo($nonce)?>">
    #map {width:600px;height:400px}
</style>
     <div id="map"></div>

    <a id="statistics" href="">Show statistics</a>

    <script nonce="<?php echo($nonce)?>" src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"></script>

    <script nonce="<?php echo($nonce)?>">
      var map = L.map('map').setView([58.38, 26.7211], 15);
      L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
         maxZoom: 18
      }).addTo(map);
      document.getElementById("statistics").addEventListener('click',alert)
    </script>

  </body>
</html>
