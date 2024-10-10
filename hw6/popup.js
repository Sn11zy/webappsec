setInterval(mv,1000)

function mv() {
  var coord = Math.floor(Math.random()*100)
  window.moveTo(coord,coord)
}

function clicked() {
  navigator.clipboard.readText().then((info) => document.getElementById('division').innerHTML = info);
}
