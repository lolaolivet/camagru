<?php
if (!isset($_SESSION)) {
  session_start();
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
        <link rel="stylesheet" type="text/css" href="../css/connexion.css">
        <link rel="stylesheet" type="text/css" href="../css/main.css">
        <script type="text/javascript" src="../js/message.js"></script>
        <title>Camagruuu</title>
    </head>
    <?php
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
    <body>
        <header>
        <div class="title">
            <a href="index.php"><h1>Camagru</h1></a>
        </div>
        <div class="galleryMenu">
            <a href="index.php"><p>Gallery</p></a>
        </div>
        <div class="connect">
            <a href="connexion.php"><p>Connexion</p></a>
        </div>
        </header>
        <div class="container">
          <div class="connexion">
              <p>New password</p>
              <form method="post" action="../controllers/controllerForgot.php">
                  <div class="formul">
                      <label for="email">Email:</label><input type="email" name="email">
                  </div>
                  <div class="validate">
                      <input class="validate" type="submit" value="Send" name="send">
                  </div>
                  <input type="hidden" name="token" value="<?php echo $token ?>">
              </form>
          </div>
        </div>
    </body>
    <footer>
        <p>©Lola Olivet - lolivet@student.42.fr</p>
    </footer>
</html>
