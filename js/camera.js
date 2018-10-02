window.addEventListener('load', function(e) {
    
    if (navigator.mediaDevices.getUserMedia) {
        navigator.mediaDevices.getUserMedia({video: true})
            .then(function(stream) {
            var video = document.querySelector("#videoElement");
            video.srcObject = stream;
        }).catch(function(error) {
            console.log(error.name + ":" + error.message);
        });
    }

    var x = 0;
    var y = 0;
    var smile = false;
    var divFilter = document.getElementById('filters');
    var filter = "";
    var imgs = divFilter.getElementsByTagName('img');
    var video = document.querySelector('video');
    var canvas = document.querySelector('canvas');
    var context = canvas.getContext('2d');
    var div = document.getElementById("mini-galery");
    var videoElement = document.querySelector("#videoElement");
    var snap = document.getElementById('snap');
    var save = document.getElementById('save');
    var img = new Image();
    
    
//    var fileInput = document.querySelector('#uploadFile');
//    var allowedTypes = ['png', 'jpg', 'jpeg', 'gif'];
//    
//    fileInput.addEventListener('change', function() {
//        var files = this.files;
//        var filesLen = files.length;
//        var imgType;
//        
//        for (var i = 0; i < filesLen; i++) {
//            imgType = files[i].name.split('.');
//            imgType = imgType[imgType.length -1];
//            
//            if (allowedTypes.indexOf(imgType) != -1) {
//                var reader = new FileReader();
//                reader.addEventListener('load', function() {
//                    imgElement.src = this.result;
//                    console.log(imgElement);
//
//                    context.drawImage(imgElement, 0, 0, 500, 375);
//                });
//                reader.readAsDataURL(files[i]);
//                file = true;
//            }
//        }
//    });

    divFilter.onclick = function (e) {
        filter = e.path[0];
        if (filter.id === "filter") {
            x = 0;
            y = 0;
            console.log(filter);
            for (var i = 0; i < imgs.length; i++) {
                imgs[i].setAttribute("selected", "false");
                imgs[i].style.border = "1px solid #fff";
            }
            filter.setAttribute("selected", "true");
            filter.style.border = "1px solid #000";
            if (filter && filter != "") {
                addFilter(filter, x, y);
            }
        }
    }

    document.addEventListener('keydown', (event) => {
        console.log(filter);
        const keyName = event.key;
        if (keyName === "ArrowUp")
            y -= 5;
        if (keyName === "ArrowDown")
            y += 5;
        if (keyName === "ArrowRight")
            x += 5;
        if (keyName === "ArrowLeft")
            x -= 5;

        addFilter(filter, x, y);
    });

    snap.onclick = function (e) {
        snapshot(filter, x, y);
    }

    save.onclick = function (e) {
        saveSnap(filter, x, y, smile);
    }

    function snapshot(filter, x, y) {
        console.log(filter);
        if (filter && filter.getAttribute('selected') === "true") {
            canvas.width = "500";
            canvas.height = "375";
            context.drawImage(video, 0, 0, 500, 375);
            context.drawImage(filter, x, y, 500, 375);
            videoElement.src = canvas.toDataURL('image/webp');
            smile = true;
        }
    }

    function saveSnap(filter, x, y, smile) {
        var fragment = document.createDocumentFragment();
        var balise = document.createElement("img");

        if (filter && filter.getAttribute('selected') === "true" && smile === true) {
            balise.src = videoElement.src;
            context.clearRect(0, 0, 500, 375);
            fragment.appendChild(balise);
            div.appendChild(fragment);
            filter.setAttribute("selected", "false");
            filter.style.border = "1px solid #fff";
        }
        console.log(filter);
        smile = false;
        filter = "";
    }

    function addFilter(filter, x, y) {
        if (filter && filter.getAttribute('selected') === "true") {
            canvas.width = "500";
            canvas.height = "375";
            img.src = filter.src;
            context.drawImage(img, x, y, 500, 375);
        }
        smile = false;
    }

});