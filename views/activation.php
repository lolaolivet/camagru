<?php
include("../controllers/controllerActivation.php");

if (!isset($_SESSION)) {
  session_start();
}

if (isset($_GET) && isset($_GET['key']) && isset($_GET['login'])) {
  $login = $_GET['login'];
  $key = $_GET['key'];
} else {
  header('Location: connexion.php');
}

if (isset($login) && isset($key)) {
    if ($ret = verifActivation($login)) {
      echo $ret;
        if ($ret = verifKey($login, $key)) {
          activateUser($login);
          header('Location: ../views/index.php');
        } else {
          header('Location: ../views/connexion.php');
        }
    } else {
        header('Location: ../views/connexion.php');
    }
} else {
  if (isset($_GET) && isset($_GET['login'])) {
    deleteUser($login);
  }
    echo '
    <html>
    <head>
      <meta charset="utf-8">
      <link rel="stylesheet" type="text/css" href="../css/main.css">
      <title>Camagruuu</title>
    </head>
    <body>
        <p>Something wrong happend.. Please create again your account.<a href="connexion.php">Connexion</a></p>
    </body>
    </html>
        ';
}

?>
