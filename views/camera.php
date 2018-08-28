<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
      <meta charset="utf-8">
      <title>Camagruuu</title>
      <link rel="stylesheet" type="text/css" href="../css/main.css">
      <link rel="stylesheet" type="text/css" href="../css/connexion.css">
      <script type="text/javascript" src="../js/camera.js"></script>
</head>
<body>
  <div id="container">
    <video autoplay="true" id="videoElement">
    </video>
    <button type="button" name="snap" id="snap" onclick="snapshot(this)">Smile!</button>
    <canvas id="canvas" width="500" height="375"></canvas>
    <input type="submit" name="snap" value="Save" id="save" onclick="saveSnap(this)">
</div>
<div id="mini-galery">
  <!-- Saved pictures -->
</div>
</body>
</html>
