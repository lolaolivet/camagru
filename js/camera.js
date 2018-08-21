if (navigator.mediaDevices.getUserMedia) {
    navigator.mediaDevices.getUserMedia({video: true})
  .then(function(stream) {
    var video = document.querySelector("#videoElement");
    video.srcObject = stream;
  })
  .catch(function(error) {
    console.log(error.name + ":" + error.message);
  });
}

function snapshot(e) {
  var canvas = document.getElementById("canvas");
  var context = canvas.getContext("2d");
  var video = document.querySelector("#videoElement");

  context.drawImage(video, 0, 0, 500, 375);
  console.log(context);
}

function saveSnap(e) {
  var canvas = document.getElementById("canvas");
  console.log(canvas);
}
