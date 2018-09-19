<?php
include("../controllers/controllerCamera.php");
session_start();
var_dump($_SESSION['loggued_on_user']);
var_dump($_SESSION['message']);
if (!(isset($_SESSION['loggued_on_user']))) {
  header('Location: connexion.php');
}
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
      <meta charset="utf-8">
      <title>Camagruuu</title>
      <link rel="stylesheet" type="text/css" href="../css/camera.css">
      <link rel="stylesheet" type="text/css" href="../css/main.css">
      <script type="text/javascript" src="../js/camera.js"></script>
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
        if (isset($_SESSION) && isset($_SESSION['loggued_on_user']))
            echo '<div class="connect">
                      <a href="logout.php"><p>Déconnexion</p></a>
                  </div>';
        ?>
    </header>
    <?php
      if ($_SESSION['message'] === "connected") {
        echo '<div class="message">
                <div class="text">
                  Welcome <span class="rose">'. $_SESSION['loggued_on_user'] .'</span>
                </div>
              </div>';
      }
    ?>
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
