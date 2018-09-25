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
    var video = document.querySelector("video");
    var img = document.querySelector("#videoElement");
    var f = document.getElementById("filters");
    var images = f.getElementsByTagName("img");
    var i = 0;

    
    while (i < images.length) {
        if (images[i].getAttribute("selected")) {

            console.log("coucou");
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
    var video = document.querySelector('video');
    var canvas = document.querySelector('canvas');
    var context = canvas.getContext('2d');
    var div = document.getElementById("mini-galery");
    var img = new Image();
    
//    canvas.setAttribute("id", "canvasVideo");
    canvas.width = "500";
    canvas.height = "375";
//    div.appendChild(canvas);

    for (var i = 0; i < images.length; i++) {
        images[i].setAttribute("selected", "false");
        images[i].style.border = "1px solid #fff";
    }

//    context.drawImage(video, 0, 0, 500, 375);
    img.src = e.src;
    context.drawImage(img, 0, 0, 500, 375);
    e.setAttribute("selected", "true");
    e.style.border = "1px solid #000";
}

