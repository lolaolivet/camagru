<?php
include("../models/modelProfile.php");
if (!isset($_SESSION)) {
  session_start();
}
if (!(isset($_SESSION['loggued_on_user']))) {
  header('Location: connexion.php');
}
$token = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
if (isset($_SESSION) && isset($token)) {
  $_SESSION['token'] = $token;
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../css/profile.css">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <script type="text/javascript" src="../js/message.js"></script>
    <title>Camagruuu</title>
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
            <a href="profile.php"><p>
                <?php if (isset($_SESSION) && isset($_SESSION['loggued_on_user']) && $_SESSION['loggued_on_user'] !== "") {
                  echo $_SESSION['loggued_on_user'];
                }?></p></a>
        </div>
        <div class="connect">
            <a href="logout.php"><p>Logout</p></a>
        </div>
    </header>
    <?php
      if (isset($_SESSION) && isset($_SESSION['success']) && $_SESSION['success'] === "updated") {
        echo '<div class="success">
                <div class="text">
                  <div class="closeMessage">
                    <a onclick="closeMessage(this)"><img src="../img/close.png"></a>
                  </div>
                  Your profile has been updated successfully !
                </div>
              </div>';
      }
      if (isset($_SESSION) && isset($_SESSION['error']) && $_SESSION['error'] === "error") {
        echo '<div class="error">
                <div class="text">
                  <div class="closeMessage">
                    <a onclick="closeMessage(this)"><img src="../img/close.png"></a>
                  </div>
                  The email or login must be already used..
                </div>
              </div>';
      }
      if (isset($_SESSION) && isset($_SESSION['error']) && $_SESSION['error'] === "password") {
        echo '<div class="error">
                <div class="text">
                  <div class="closeMessage">
                    <a onclick="closeMessage(this)"><img src="../img/close.png"></a>
                  </div>
                    Password must have 8 or more characters and contain at least on number.
                </div>
              </div>';
      }
      if (isset($_SESSION) && isset($_SESSION['error']) && $_SESSION['error'] === "login") {
        echo '<div class="error">
                <div class="text">
                  <div class="closeMessage">
                    <a onclick="closeMessage(this)"><img src="../img/close.png"></a>
                  </div>
                    Spaces and special chars are not allowed in login..
                </div>
              </div>';
      }
      if (isset($_SESSION) && isset($_SESSION['error']) && $_SESSION['error'] === "email") {
      echo '<div class="error">
              <div class="text">
                <div class="closeMessage">
                  <a onclick="closeMessage(this)"><img src="../img/close.png"</a>
                </div>
                  Not a valid email..
              </div>
            </div>';
        }
    ?>
    <div class="container">
      <div class="modification">
        <form method="post" action="../controllers/controllerProfile.php">
          <?php
          if (isset($_SESSION) && isset($_SESSION['loggued_on_user']) && $_SESSION['loggued_on_user'] != "") {
            $info = getUser($_SESSION['loggued_on_user']);
          } else {
            $info = NULL;
          }
          if ($info !== NULL) {
            foreach ($info as $e) {
              echo '<div class="formul">
                      <label for="login">Login:</label><input type="text" name="login" value="'. $e['login'] .'">
                    </div>
                    <div class="formul">
                      <label for="email">Email:</label><input type="email" name="email" value="'. $e['email'] .'">
                    </div>
                    <div class="formul">
                      <label for="password">New password:</label><input type="password" name="password">
                    </div>';
                    if ($e['notif'] === "0") {
                      echo '<div class="radio">
                              <p>Notifications:</p>
                              <label for="yes">Yes</label><input type="radio" name="notif" value="1" id="yes">
                              <label for="no">No</label><input type="radio" name="notif" value="0" id="no" checked>
                            </div>';
                    } else {
                      echo '<div class="radio">
                              <p>Notifications:</p>
                              <label for="yes">Yes</label><input type="radio" name="notif" value="1" id="yes" checked>
                              <label for="no">No</label><input type="radio" name="notif" value="0" id="no">
                            </div>';
                    }
                    echo '<div class="validate">
                            <input class="validate" type="submit" value="Modified" name="modified">
                          </div>';
            }
          } else {
            header('Location: index.php');
          }
          ?>
          <input type="hidden" name="token" value="<?php echo $token ?>">
        </form>
      </div>

    </div>
  </body>
    <footer>
        <p>©Lola Olivet - lolivet@student.42.fr</p>
    </footer>
  </html>
