<?php
session_start();
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
              </form>
          </div>
        </div>
    </body>
    <footer>
        <p>©Lola Olivet - lolivet@student.42.fr</p>
    </footer>
</html>