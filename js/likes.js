function dislike(e, id_photo, id_user) {
        var httpRequest = new XMLHttpRequest();
        httpRequest.open('POST', '/camagru/controllers/controllerIndex.php');
        httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        
        httpRequest.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                location.reload();
            }
        };
        httpRequest.send('id_photo='+ id_photo +'&id_user='+ id_user);
}

function like(e, id_photo, id_user) {
        var httpRequest = new XMLHttpRequest();
        httpRequest.open('POST', '/camagru/controllers/controllerIndex.php');
        httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        
        httpRequest.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                location.reload();
            }
        };
        httpRequest.send('id_photoL='+ id_photo +'&id_userL='+ id_user);
}