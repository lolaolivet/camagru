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
    var img = document.querySelector("#videoElement");
    context.drawImage(video, 0, 0, 500, 375);
    img.src = canvas.toDataURL('image/webp');
//    canvas.style.width = "500px";
//    canvas.style.height = "375px";
}

function saveSnap(e) {
  var canvas = document.getElementById("canvas");
  var context = canvas.getContext("2d");
  var img = document.querySelector("#videoElement");
  var element = document.getElementById("mini-galery");
  var fragment = document.createDocumentFragment();
  var balise = document.createElement("img");
  balise.src = img.src;
  context.clearRect(0, 0, 500, 375);
  fragment.appendChild(balise);
  element.appendChild(fragment);
//    canvas.style.width = "0";
//    canvas.style.height = "0";
}

function addFilter(e) {
    var parent = e.parentElement;
    var images = parent.getElementsByClassName("check");
    console.log(images);
    
    if (images.empty) {
            e.classList.add("check");
        }
    else {
            images.forEach.classList.remove("check");
    }
}

