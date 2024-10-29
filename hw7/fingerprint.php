<body>
<?php
echo "<p><b>ip:</b> ".$_SERVER["REMOTE_ADDR"]."</p>";
echo "<p><b>user agent:</b> ".$_SERVER["HTTP_USER_AGENT"]."</p>"
  ?>
  <p> </p>
<b>user agent js:</b> <p id="useragent"></p>
<?php
  echo "<b>language pref http:</b> ".$_SERVER["HTTP_ACCEPT_LANGUAGE"];
?>
<b>language pref js:</b><p id="languagepref"></p>
<b>time zone:</b> <p id="timezone"></p>
<b>screen resolution:</b> <p id="screenrez"></p>
<b>OS left:</b><p id="osl"></p>
<b>OS right:</b> <p id="osr"></p>
<b>OS top:</b> <p id="ost"></p>
<b>Os bottom:</b><p id="osb"></p>
<b>Browser toolbar height:</b> <p id="browtool"></p>
<b>CPU cores:</b> <p id="cpu"></p>
<b>Device memory:</b> <p id="mem"></p>
<b>Battery status:</b> <p id="bat"></p>
<b>Type of network connection:</b> <p id="net"></p>
<b>GPU vendor:</b> <p id="gpuv"></p>
<b>GPU name:</b> <p id="gpun"></p>
<b>canvas hash:</b> <p id="hash"></p>
</body>
<script>
  document.getElementById("useragent").innerHTML = navigator.userAgent
  document.getElementById("languagepref").innerHTML = navigator.languages
  
  document.getElementById("timezone").innerHTML = new Date().getTimezoneOffset()
  document.getElementById("screenrez").innerHTML = screen.width + "x" + screen.height
  document.getElementById("osl").innerHTML = screen.availLeft
  document.getElementById("osr").innerHTML = screen.availWidth - screen.availLeft
  document.getElementById("ost").innerHTML = screen.availTop
  document.getElementById("osb").innerHTML = screen.availHeight - screen.availTop
  document.getElementById("browtool").innerHTML = window.outerHeight - window.innerHeight
  document.getElementById("cpu").innerHTML = navigator.hardwareConcurrency;
  document.getElementById("mem").innerHTML = navigator.deviceMemory;
  navigator.getBattery().then(function(battery) {document.getElementById("bat").innerHTML = battery.level});
  document.getElementById("net").innerHTML = navigator.connection.effectiveType;
  var canvas = document.createElement("canvas");
  var gl = canvas.getContext("webgl");
  document.getElementById("gpuv").innerHTML = gl.getParameter(gl.getExtension("WEBGL_debug_renderer_info").UNMASKED_VENDOR_WEBGL);
  document.getElementById("gpun").innerHTML = gl.getParameter(gl.getExtension("WEBGL_debug_renderer_info").UNMASKED_RENDERER_WEBGL);
  var canvas = document.createElement('canvas')
  canvas.width = 100
  canvas.height = 25
  var ctx = canvas.getContext('2d')
  var txt = "fingerprint testing";
  ctx.font = "14px 'Arial'";
  ctx.textBaseline = "alphabetic";
  ctx.fillStyle = "#f60";
  ctx.fillRect(125,1,62,20);
  // Some tricks for color mixing to increase the difference in rendering
  ctx.fillStyle = "#069";
  ctx.fillText(txt, 2, 15);
  ctx.fillStyle = "rgba(102, 204, 0, 0.7)";
  ctx.fillText(txt, 4, 17);
  var img = document.createElement('img')
  img.src = canvas.toDataURL()
  document.body.appendChild(img)
  var datas = ctx.getImageData(0,25,100,25)
  async function hash(data){
    const hashasbuffer = await crypto.subtle.digest("SHA-256", data.data)
    const uint8hash = new Uint8Array(hashasbuffer)
    const hashstring = Array.from(uint8hash).map((b) => b.toString(16).padStart(2,"0")).join("")
  }
  hash(datas).then((a) => {document.getElementById("hash").innerHTML = a})
</script>


