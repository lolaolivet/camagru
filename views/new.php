<?php
include('../controllers/controllerForgot.php');
if (!isset($_SESSION)) {
  session_start();
}
if (!isset($GET) && !(isset($_GET['login'])) || !(isset($_GET['key']))) {
  header('Location: ../views/connexion.php');
}

if (isset($_SESSION) && isset($_SESSION['login'])) {
  $_SESSION['login'] = $_GET['login'];
}
if (isset($_SESSION) && isset($_SESSION['key'])) {
  $_SESSION['key'] = $_GET['key'];
}
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
            <a href="index.php"><h1>Camagru</h1></a>
        </div>
        </header>
        <?php
          if (isset($_SESSION) && isset($_SESSION['error']) && $_SESSION['error'] === "pass") {
            echo '<div class="error">
                    <div class="text">
                      <div class="closeMessage">
                        <a onclick="closeMessage(this)"><img src="../img/close.png"</a>
                      </div>
                        Password must have 8 or more characters and contain at least on number.
                    </div>
                  </div>';
          }
          if (isset($_SESSION) && isset($_SESSION['error']) && $_SESSION['error'] === "confirm") {
            echo '<div class="error">
                    <div class="text">
                      <div class="closeMessage">
                        <a onclick="closeMessage(this)"><img src="../img/close.png"</a>
                      </div>
                      The passwords are not the same..
                    </div>
                  </div>';
          }
        ?>
        <div class="container">
            <?php
            if (isset($GET) && isset($_GET['login']) && isset($_GET['key'])) {
              if ($ret = verifGet($_GET['login'], $_GET['key'])) {
                  echo '<div class="connexion">
            <p>New password</p>
            <form method="post" action="../controllers/controllerForgot.php">
                <div class="formul">
                    <label for="password">New password:</label><input type="password" name="password">
                </div>
                <div class="formul">
                    <label for="passwd">Confirm password:</label><input type="password" name="passwd">
                </div>
                <div class="validate">
                    <input class="validate" type="submit" value="Validate" name="validate">
                </div>
            </form>
        </div>';
              } else {
                  header('Location: connexion.php');
              }
            }
            ?>

        </div>
    </body>
    <footer>
        <p>©Lola Olivet - lolivet@student.42.fr</p>
    </footer>
</html>
