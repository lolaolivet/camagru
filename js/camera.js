if (navigator.mediaDevices.getUserMedia) {
    navigator.mediaDevices.getUserMedia({video: true})
  .then(function(stream) {
        var canvas = document.getElementById("canvasVideo");
        var context = canvas.getContext("2d");
        var video = document.createElement("video");
        canvas.width = "500";
        canvas.height = "375";
        video.srcObject = stream;
//        video.srcObject = stream;
        video.setAttribute("autoplay", "true");
        context.drawImage(video, 0, 0, 500, 375);
        console.log(video.srcObject);
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
    var f = document.getElementById("filters");
    var images = f.getElementsByTagName("img");
    var i = 0;
    while (i < images.length) {
        if (images[i].getAttribute("selected")) {
            canvas.width = "500";
            canvas.height = "375";
            context.drawImage(video, 0, 0, 500, 375);
            img.src = canvas.toDataURL('image/webp');
            context.drawImage(images[i], 0, 0, 500, 375);
            break;
        }
        else {
            i++;
        }
    }
    if (i == images.length) {
        console.log("SELECT A FILTER");
    }
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
}

function addFilter(e) {
    var parent = e.parentElement;
    var images = parent.getElementsByTagName("img");
    var test = ['a','b','c'];

    for (var i = 0; i < images.length; i++) {
        images[i].setAttribute("selected", "false");
        images[i].style.border = "1px solid #fff";
    }
    e.setAttribute("selected", "true");
    e.style.border = "1px solid #000";
}

