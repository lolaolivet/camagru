<html>
<head>
  <link rel="stylesheet" type="text/css" href="../css/main.css">
  <script type="text/javascript" src="../js/camera.js">

  </script>
</head>
<body>
  <div id="container">
    <video autoplay="true" id="videoElement">
    </video>
    <button type="button" name="snap" id="snap" onclick="snapshot(this)">Smile!</button>
    <canvas id="canvas" width="500" height="375"></canvas>
    <input type="submit" name="snap" value="Save" id="save" onclick="saveSnap(this)">
    <img src="">
</div>
</body>
</html>
