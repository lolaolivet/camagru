window.addEventListener('load', function(e) {
    
    var media = false;
    
    if (navigator.mediaDevices.getUserMedia) {
        navigator.mediaDevices.getUserMedia({video: true})
            .then(function(stream) {
            var video = document.querySelector("#videoElement");
            video.srcObject = stream;
            media = true;
        }).catch(function(error) {
            console.log(error.name + ":" + error.message);
            media = false;
        });
    }

    var x = 0;
    var y = 0;
    var smile = false;
    var file = false;
    var divFilter = document.getElementById('filters');
    var filter = "";
    var imgs = divFilter.getElementsByTagName('img');
    var video = document.querySelector('video');
    var canvas = document.querySelector('canvas');
    var context = canvas.getContext('2d');
    var miniGalery = document.getElementsByClassName("row");
    var videoElement = document.querySelector("#videoElement");
    var snap = document.getElementById('snap');
    var save = document.getElementById('save');
    var imgElement = document.querySelector('#imgElement');
    var img = new Image();
    
    canvas.width = "500";
    canvas.height = "375";
    
    var fileInput = document.querySelector('#uploadFile');
    var allowedTypes = ['png', 'jpg', 'jpeg', 'gif'];
    
    fileInput.addEventListener('change', function() {
        var files = this.files;
        var filesLen = files.length;
        var imgType;
        
        for (var i = 0; i < filesLen; i++) {
            imgType = files[i].name.split('.');
            imgType = imgType[imgType.length -1];
            
            if (allowedTypes.indexOf(imgType) != -1) {
                var reader = new FileReader();
                reader.addEventListener('load', function() {
                imgElement.style.visibility = "visible";
                    imgElement.src = this.result;
                    imgElement.onload = function () {
                        context.clearRect(0, 0, 500, 375);
                        context.drawImage(imgElement, 0, 0, 500, 375);
                        video.style.visibility = "hidden";
                        file = true;
                    }
                });
                reader.readAsDataURL(files[i]);
            }
        }
    });

    divFilter.onclick = function (e) {
        filter = e.path[0];
        if (filter.id === "filter" && (file === true || media === true)) {
            x = 0;
            y = 0;
            for (var i = 0; i < imgs.length; i++) {
                imgs[i].setAttribute("selected", "false");
                imgs[i].style.border = "1px solid transparent";
            }
            filter.setAttribute("selected", "true");
            filter.style.border = "1px solid #d2d2d2";
            if (filter && filter != "") {
                addFilter(filter, x, y);
            }
        }
    }

    document.addEventListener('keydown', (event) => {
        const keyName = event.key;
        context.clearRect(0, 0, 500, 375);
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
    
    function makeRequest(img) {
        var httpRequest = new XMLHttpRequest();
        httpRequest.open('POST', '/camagru/controllers/controllerCamera.php');
        httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        
        httpRequest.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
            }
        };
        httpRequest.send('snap=' + img);
    }
    
    function snapshot(filter, x, y) {
        var fragment = document.createDocumentFragment();
        var li = document.createElement('li');
        var balise = document.createElement("img");
        if (filter && filter.getAttribute('selected') === "true" && (file === true || media === true)){
            if (file === true) {
                context.drawImage(imgElement, 0, 0, 500, 375);
                context.drawImage(filter, x, y, 500, 375);
                imgElement.src = canvas.toDataURL();
                balise.src = imgElement.src;
            } else if (media === true) {
                context.drawImage(video, 0, 0, 500, 375);
                context.drawImage(filter, x, y, 500, 375);
                videoElement.src = canvas.toDataURL();
                balise.src = videoElement.src;
            }
            balise.onload = function () {
                makeRequest(balise.src);
            }
            fragment.appendChild(li);
            var ul = miniGalery[0].getElementsByTagName('ul');
            li.appendChild(balise);
            ul[0].appendChild(fragment);
            context.clearRect(0, 0, 500, 375);
            imgElement.removeAttribute('src');
            imgElement.style.visibility = "hidden";
            video.style.visibility = "visible";
            filter.setAttribute("selected", "false");
            filter.style.border = "1px solid transparent";
            smile = true;
        }
        file = false;
    }

    function addFilter(filter, x, y) {
        if (filter && filter.getAttribute('selected') === "true" && (file === true || media === true)) {
            context.clearRect(0, 0, 500, 375);
            img.src = filter.src;
            context.drawImage(img, x, y, 500, 375);
        }
        if (!(imgElement.getAttribute('src')))
            file = false;
        smile = false;
    }

});