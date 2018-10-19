<?php
include('../controllers/controllerForgot.php');
session_start();

$login = $_GET['login'];
$key = $_GET['key'];
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
            <?php
                if ($ret = verifGet($login, $key)) {
                    echo '<div class="connexion">
              <p>New password</p>
              <form method="post" action="../controllers/controllerForgot.php">
                  <div class="formul">
                      <label for="email">New password:</label><input type="password" name="password">
                  </div>
                  <div class="validate">
                      <input class="validate" type="submit" value="Validate" name="validate">
                  </div>
              </form>
          </div>';
                } else {
                    echo 'NON!';
                    
//                    header('Location: connexion.php');
                }
            ?>
          
        </div>
    </body>
</html>