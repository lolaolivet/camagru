function shareSnap(id_photo) {
        var httpRequest = new XMLHttpRequest();
        httpRequest.open('POST', '/camagru/controllers/controllerCamera.php');
        httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        
        httpRequest.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                location.reload();
            }
        };
        httpRequest.send('id_share='+ id_photo);
}

function deleteSnap(id_photo) {
        var httpRequest = new XMLHttpRequest();
        httpRequest.open('POST', '/camagru/controllers/controllerCamera.php');
        httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        
        httpRequest.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                location.reload();
            }
        };
        httpRequest.send('id_delete='+ id_photo);
}