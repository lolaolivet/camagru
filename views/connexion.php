<?php
include("../models/modelConnexion.php");
session_start();
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../css/connexion.css">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
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
              <form method="post" action="../controllers/controllerCreate">
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
