<?php
// include("../models/modelConnexion.php");
session_start();
var_dump($_SESSION['loggued_on_user']);
$_SESSION['connected'] = "";
if ($_SESSION['created'] !== "notCreated")
  $_SESSION['created'] = "";

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../css/connexion.css">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <script type="text/javascript" src="../js/message.js"></script>
    <title>Camagruuu</title>
  </head>
  <body>
    <header>
        <div class="title">
            <a href="../index.php"><h1>Camagru</h1></a>
        </div>
        <div class="gallery">
            <a href="../index.php"><p>Gallery</p></a>
        </div>
        <?php
        if ($_SESSION['loggued_on_user'] != "")
            echo '<div class="profile">
                    <a href="profile.php"><p>'. $_SESSION['loggued_on_user'] .'</p></a>
                  </div>
                  <div class="connect">
                    <a href="logout.php"><p>Déconnexion</p></a>
                  </div>';
        ?>
    </header>
    <?php
      if ($_SESSION['error'] === "error") {
        echo '<div class="error">
                <div class="text">
                  <div class="close">
                    <a onclick="closeMessage(this)"><img src="http://www.acb-portesetfenetres.fr/wp-content/themes/html5blank/src/img/fermer.png"></a>
                  </div>
                    Password or login is wrong..
                </div>
              </div>';
      }
      if ($_SESSION['created'] === "notCreated") {
        echo '<div class="error">
                <div class="text">
                  <div class="close">
                    <a onclick="closeMessage(this)"><img src="http://www.acb-portesetfenetres.fr/wp-content/themes/html5blank/src/img/fermer.png"></a>
                  </div>
                    Email or login is already used..
                </div>
              </div>';
      }
    ?>
      <div class="container">
          <div class="connexion">
              <p>Connection</p>
              <form method="post" action="../controllers/controllerConnexion.php">
                  <div class="formul">
                      <label for="login">Login:</label><input type="text" name="login">
                  </div>
                  <div class="formul">
                      <label for="password">Password:</label><input type="password" name="password">
                  </div>
                  <div class="validate">
                      <input class="validate" type="submit" value="Connect" name="connexion">
                  </div>
              </form>
          </div>

           <div class="register">
              <form method="post" action="../controllers/controllerConnexion.php">
                  <p>Inscription</p>
                  <div class="formul">
                      <label for="email">Email:</label><input type="email" name="email">
                  </div>

                  <div class="formul">
                      <label for="login">Login:</label><input type="text" name="login">
                  </div>

                  <div class="formul">
                      <label for="password">Password:</label><input type="password" name="password">
                  </div>

                  <div class="validate" >
                      <input type="submit" value="Register" name="register">
                  </div>
              </form>
          </div>
      </div>
    </body>
</html>
