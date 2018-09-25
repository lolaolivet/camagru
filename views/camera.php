<?php
include("../controllers/controllerCamera.php");
session_start();
var_dump($_SESSION['loggued_on_user']);
if (!(isset($_SESSION['loggued_on_user']))) {
  header('Location: connexion.php');
}
$_SESSION['error'] = "";
$_SESSION['message'] = "";
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
      <meta charset="utf-8">
      <title>Camagruuu</title>
      <link rel="stylesheet" type="text/css" href="../css/camera.css">
      <link rel="stylesheet" type="text/css" href="../css/main.css">
      <script type="text/javascript" src="../js/camera.js"></script>
<!--      <script type="text/javascript" src="../js/filters.js"></script>-->
      <script type="text/javascript" src="../js/message.js"></script>
</head>
<body>
     <header>
        <div class="title">
            <a href="../index.php"><h1>Camagru</h1></a>
        </div>
        <div class="gallery">
            <a href="../index.php"><p>Gallery</p></a>
        </div>
        <div class="profile">
          <a href="profile.php"><?php echo '<p>'.$_SESSION['loggued_on_user'].'</p>' ?></a>
        </div>
        <?php
        if ($_SESSION['loggued_on_user'] != "")
            echo '<div class="connect">
                      <a href="logout.php"><p>Déconnexion</p></a>
                  </div>';
        ?>
    </header>
    <?php
      if ($_SESSION['connected'] === "connected") {
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
            <canvas id="canvas"></canvas>
            <input type="submit" name="Smile!" id="snap" onclick="snapshot(this)">
            <input type="submit" name="snap" value="Save" id="save" onclick="saveSnap(this)">
              <canvas id="result"></canvas>
          </div>
          <div id="filters">
              <img src="../img/rainbow.png" id="rainbow" onclick="addFilter(this)">
              <img src="../img/sun.png" id="sun" onclick="addFilter(this)">
              <img src="../img/stars.png" id="stars" onclick="addFilter(this)">
          </div>
        <div id="mini-galery">
            <!-- Saved pictures -->
        </div>
    </div>

</body>
</html>
