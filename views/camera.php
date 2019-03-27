<?php
include("../controllers/controllerCamera.php");
if (!isset($_SESSION)) {
  session_start();
}
if (!isset($_SESSION) || !(isset($_SESSION['loggued_on_user']))) {
  header('Location: connexion.php');
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="utf-8">
      <title>Camagruuu</title>
      <link rel="stylesheet" type="text/css" href="../css/camera.css">
      <link rel="stylesheet" type="text/css" href="../css/main.css">
      <script type="text/javascript" src="../js/camera.js"></script>
      <script type="text/javascript" src="../js/message.js"></script>
      <script type="text/javascript" src="../js/handleSnap.js"></script>
</head>
<body>
     <header>
        <div class="title">
            <a href="index.php"><h1>Camagru</h1></a>
        </div>
        <div class="galleryMenu">
            <a href="index.php"><p>Gallery</p></a>
        </div>
        <div class="smile">
            <a href="camera.php"><p>Smile!</p></a>
        </div>
        <div class="profile">
          <a href="profile.php"><?php if (isset($_SESSION) && isset($_SESSION['loggued_on_user'])) {
            echo '<p>'.$_SESSION['loggued_on_user'].'</p>';
          } ?></a>
         </div>
        <div class="connect">
          <a href="logout.php"><p>Logout</p></a>
        </div>
    </header>
    <div id="error" class="error" style="display:none;">
    </div>
    <?php
      if (isset($_SESSION) && isset($_SESSION['success']) && $_SESSION['success'] === "connected") {
        echo '<div class="success">
                <div class="text">
                  <div class="closeMessage">
                    <a onclick="closeMessage(this)"><img src="../img/close.png"></a>
                  </div>
                  Welcome <span class="rose">'. $_SESSION['loggued_on_user'] .'</span>
                </div>
              </div>';
      }
    ?>

    <div id="container">
        <div class="video">
            <video autoplay="true" id="videoElement"></video>
            <img id="imgElement" style="visibility:hidden;">
            <canvas id="canvas"></canvas>
            <div class="inputs">
                <input type="submit" name="snap" value="Smile!" id="snap" disabled="disabled">
                <input type="file" name="uploadFile" id="uploadFile">
            </div>
            <div id="filters">
                <img src="../img/rainbow.png" id="filter">
                <img src="../img/sun.png" id="filter">
                <img src="../img/stars.png" id="filter">
                <img src="../img/hpGlasses.png" id="filter">
                <img src="../img/polaroid.png" id="filter">
            </div>
        </div>

        <div id="mini-galery">
            <div class="row">
                <ul>
                    <?php
                    if (isset($_SESSION) && isset($_SESSION['loggued_on_user'])) {
                      $data = displaySnap($_SESSION['loggued_on_user']);
                    } else {
                      $data = NULL;
                    }
                    if ($data != NULL) {
                      foreach ($data as $e) {
                          echo '<li>
                                  <img src="'. $e['img'] .'">
                                  <div class="overlay">
                                  ';
                          if ($e['published'] == 0) {
                              echo '<div class="icon"><img src="../img/share.png" onClick="shareSnap('.$e["id_photos"].')" class="action"></div>';
                          }
                          echo '<div class="icon"><a style="width:0;" href="'.$e['img'].'" download="my_picture.png"><img src="../img/download.png" class="action"></a></div>
                                <div class="icon"><img src="../img/delete.png" onClick="deleteSnap('.$e["id_photos"].')" class="action"></div></li>';
                      }
                    }
                    ?>

                </ul>
            </div>
        </div>
    </div>

</body>
<footer>
    <p>©Lola Olivet - lolivet@student.42.fr</p>
</footer>
</html>
