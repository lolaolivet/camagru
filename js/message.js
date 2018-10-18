
function closeMessage(e) {
    var parent = e.parentElement;
    var grandParent = parent.parentElement;
    var errorType = grandParent.parentElement.className;
    var httpRequest = new XMLHttpRequest();

    grandParent.parentElement.style.visibility = "hidden";
    grandParent.parentElement.style.height = "0";
    grandParent.parentElement.style.margin = "0";
    grandParent.parentElement.style.padding = "0";
        
    httpRequest.open('POST', '/camagru/controllers/controllerConnexion.php');
    httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    httpRequest.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
        }
    };
    httpRequest.send(''+errorType+'=null');
    
}
