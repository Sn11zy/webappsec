<!DOCTYPE html>

<head>
  
</head>
<body>
  <p id='tag'></p>
  <script>
    fetch("https://sn11zy.serv00.net/tagged.php").then(r=> r.headers.get('etag')).then(t => document.getElementById('tag').innerHTML = 'tracking tag is:'+t)
  </script>
</body>
