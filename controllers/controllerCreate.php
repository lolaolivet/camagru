<?php
include("../models/modelConnexion.php");
session_start();

function verifUser($email, $login) {
  $res = 0;
  $ret_email = verifEmail($email);
  foreach ($ret_email as $e) {
    if ($e['total'] !== "0")
      $res += 1;
  }
  $ret_login = verifLogin($login);
  foreach ($ret_login as $e) {
    if ($e['total'] !== "0")
      $res += 1;
  }
  if ($res != 0)
    return (0);
  else
    return (1);
}

if(isset($_POST) && isset($_POST['email']) && isset($_POST['login']) && isset($_POST['password'])) {
  $password = hash('sha512', $_POST['password']);
  if ($data = verifUser($_POST['email'], $_POST['login'])) {
    createUser($_POST['email'], $_POST['login'], $password);
    header('Location: ../index.php');
  } else {
    header('Location: ../views/connexion.php');
  }
}

 ?>
