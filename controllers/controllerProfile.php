<?php
include("../models/modelProfile.php");
session_start();

function verifData($id, $login, $email) {
  $res = 0;
  $ret_data = verifUser($id);
  foreach ($ret_data as $e) {
    if ($e['login'] == $login || $e['email'] == $email) {
      $res += 1;
    }
  }
  if ($res != 0)
    return(0);
  else
    return (1);
}

function verifPassword($password) {
    if (strlen($password) < 8) {
        return 0;
    }
    else if (!(preg_match('/[0-9]/', $password))) {
        return 0;
    }
    else
        return 1;
}

if ($_POST['modified'] === "Modified") {
  $login = $_POST['login'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  if ($_POST['password'] !== "") {
      if ($ret = verifPassword($password)) {
          $password = hash('sha512', $_POST['password']);
      } else {
          $_SESSION['error'] = "password";
          header('Location: ../views/profile.php');
          exit;
      }
  } else {
    $password = "";
  }
  $notif = $_POST['notif'];
  $id = $_SESSION['id_user'];
  if ($data = verifData($id, $login, $email)) {
    updateUser($login, $email, $password, $notif);
    $_SESSION['success'] = "updated";
     header('Location: ../views/profile.php');
  } else {
    $_SESSION['error'] = "error";
    header('Location: ../views/profile.php');
  }
}

?>
