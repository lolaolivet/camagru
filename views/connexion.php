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
        <?php
        if (isset($_SESSION) && isset($_SESSION['loggued_on_user']) && $_SESSION['loggued_on_user'] != "")
            echo '<div class="smile">
                    <a href="camera.php"><p>Smile!</p></a>
                  </div>
                  <div class="profile">
                    <a href="profile.php"><p>'. $_SESSION['loggued_on_user'] .'</p></a>
                  </div>
                  <div class="connect">
                    <a href="logout.php"><p>Logout</p></a>
                  </div>';
        ?>
    </header>
    <?php
      if (isset($_SESSION) && isset($_SESSION['error']) && $_SESSION['error'] === "wrong") {
        echo '<div class="error">
                <div class="text">
                  <div class="closeMessage">
                    <a onclick="closeMessage(this)"><img src="../img/close.png"</a>
                  </div>
                    Password or login is wrong..
                </div>
              </div>';
      }
      if (isset($_SESSION) && isset($_SESSION['error']) && $_SESSION['error'] === "notCreated") {
        echo '<div class="error">
                <div class="text">
                  <div class="closeMessage">
                    <a onclick="closeMessage(this)"><img src="../img/close.png"></a>
                  </div>
                    Email or login is already used..
                </div>
              </div>';
      }
      if (isset($_SESSION) && isset($_SESSION['error']) && $_SESSION['error'] === "password") {
        echo '<div class="error">
                <div class="text">
                  <div class="closeMessage">
                    <a onclick="closeMessage(this)"><img src="../img/close.png"></a>
                  </div>
                    Password must have 8 or more characters and contain at least one number.
                </div>
              </div>';
      }
      if (isset($_SESSION) && isset($_SESSION['error']) && $_SESSION['error'] === "noEmail") {
        echo '<div class="error">
                <div class="text">
                  <div class="closeMessage">
                    <a onclick="closeMessage(this)"><img src="../img/close.png"</a>
                  </div>
                    The email is wrong..
                </div>
              </div>';
        }
        if (isset($_SESSION) && isset($_SESSION['error']) && $_SESSION['error'] === "login") {
        echo '<div class="error">
                <div class="text">
                  <div class="closeMessage">
                    <a onclick="closeMessage(this)"><img src="../img/close.png"</a>
                  </div>
                    Spaces and special chars are not allowed in the login..
                </div>
              </div>';
        }
        if (isset($_SESSION) && isset($_SESSION['error']) && $_SESSION['error'] === "validation") {
        echo '<div class="error">
                <div class="text">
                  <div class="closeMessage">
                    <a onclick="closeMessage(this)"><img src="../img/close.png"</a>
                  </div>
                    You have to validate your account first..
                </div>
              </div>';
        }
        if (isset($_SESSION) && isset($_SESSION['success']) && $_SESSION['success'] === "email") {
        echo '<div class="success">
                <div class="text">
                  <div class="closeMessage">
                    <a onclick="closeMessage(this)"><img src="../img/close.png"</a>
                  </div>
                    An email has been sent for your password !
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
          <div class="connexion">
              <p>Connection</p>
              <form method="post" action="../controllers/controllerConnexion.php">
                  <div class="formul">
                      <label for="login">Login:</label><input type="text" name="login" required>
                  </div>
                  <div class="formul">
                      <label for="password">Password:</label><input type="password" name="password" required>
                  </div>
                  <div>
                    <a class="forgot"href="forgot.php">Forgot password ?</a>
                  </div>
                  <div class="validate">
                      <input class="validate" type="submit" value="Connect" name="connexion">
                  </div>
                  <input type="hidden" name="token" value="<?php echo $token ?>">
              </form>
          </div>

           <div class="register">
              <form method="post" action="../controllers/controllerConnexion.php">
                  <p>Inscription</p>
                  <div class="formul">
                      <label for="email">Email:</label><input type="email" name="email" required>
                  </div>

                  <div class="formul">
                      <label for="login">Login:</label><input type="text" name="login" required>
                  </div>

                  <div class="formul">
                      <label for="password">Password:</label><input type="password" name="password" required>
                  </div>

                  <div class="validate" >
                      <input type="submit" value="Register" name="register">
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
