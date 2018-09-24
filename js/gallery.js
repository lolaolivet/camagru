function open_img(e) {
    var item = e.href;
    var split_e = item.split("#");
    var last = split_e[split_e.length - 1];
    var parent = e.parentElement;
    var port = parent.getElementsByClassName("port")[0];
    var cross = parent.getElementsByClassName("close")[0];
    var img = parent.getElementsByClassName("big")[0];

    if (parent.className != "open")
    {
        port.style.visibility = "visible";
        parent.className = "open";
        img.style.height = "auto";
        cross.getElementsByTagName("img")[0].style.visibility = "visible";
    }
}

function close_img(e) {
    var item = e.href;
    var split_e = item.split("#")
    var last = split_e[split_e.length - 1];
    var parent = e.parentElement;
    var port = parent.getElementsByClassName("port")[0];
    var cross = parent.getElementsByClassName("close")[0];
    var img = parent.getElementsByClassName("big")[0];
    
    port.style.visibility = "hidden";
    parent.className = "";
    img.style.height = "100%";
    cross.getElementsByTagName("img")[0].style.visibility = "hidden";
}
