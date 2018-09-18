<?php

include("../models/modelConnexion.php");

function auth($login, $password) {
  $password_hash = hash('sha512', $password);
  $data = getLogin($login);
  foreach ($data as $e) {
    if ($e['password'] === $password_hash && $e['login'] === $login) {
      return $e;
    }
    else {
      echo 'NULL';
      return NULL;
    }
  }
}

if ($_POST['connexion'] === "Connect") {
  $login = $_POST['login'];
  $password = $_POST['password'];
  if (isset($login) && isset($password)) {
      if ($data = auth($login, $password)) {
        $_SESSION['loggued_on_user'] = $login;
        header('Location: ../views/camera.php');
      }
      else {
        header('Location: ../views/connexion.php');
      }
  } else {
    echo 'NULL';
    $_SESSION['loggued_on_user'] = "";
    header('Location: ../views/connexion.php');
  }
}

 ?>
