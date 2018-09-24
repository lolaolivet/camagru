function addFilter(e) {
    var canvas = document.getElementById("canvasVideo");
    var context = canvas.getContext("2d");
    var img = new Image();
    var parent = e.parentElement;
    var src = parent.getElementsByTagName("img")[0].src;
    canvas.width = 500;
    canvas.height = 375;
    canvas.style.zIndex = "100";
    img.src = src;
    console.log(img);
    context.drawImage(img, 0, 0, 500, 375);
}