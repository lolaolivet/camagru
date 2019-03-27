<?php
include("../models/modelProfile.php");
if (!isset($_SESSION)) {
  session_start();
}

function verifData($id, $login, $email) {
  $res = 0;
  $ret_data = verifUser($id);
  foreach ($ret_data as $e) {
    if ($e['login'] == $login && $e['email'] == $email && $e['id_users'] == $id) {
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

function spaceLogin($login) {
    if (preg_match('/\s/', $login) != 0) {
        return 0;
    } else if (preg_match('/[\W+]/', $login) != 0){
        return 0;
    } else {
      return 1;
    }
}

if (isset($_POST) && isset($_POST['modified']) && $_POST['modified'] === "Modified"
  && isset($_POST['token']) && isset($_SESSION['token'])) {
    if (isset($_POST['login']) && $_POST['login'] != "" && isset($_POST['email']) && $_POST['email'] != ""
    && isset($_SESSION) && isset($_SESSION['loggued_on_user']) && $_SESSION['loggued_on_user'] != "") {
      $login = htmlspecialchars($_POST['login']);
      $email = htmlspecialchars($_POST['email']);
      $password = htmlspecialchars($_POST['password']);
      $last_login = $_SESSION['loggued_on_user'];
      $key = $_POST['token'];
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
      if ($ret = spaceLogin($login)) {
        $notif = $_POST['notif'];
        $id = $_SESSION['id_user'];
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
          if ($data = verifData($id, $login, $email) && $key == $_SESSION['token'] && isset($_SESSION)
              && isset($_SESSION['loggued_on_user']) && $_SESSION['loggued_on_user'] != "") {
            updateUser($login, $email, $password, $notif, $last_login);
            $_SESSION['success'] = "updated";
            $_SESSION['loggued_on_user'] = $login;
             header('Location: ../views/profile.php');
          } else {
            $_SESSION['error'] = "error";
            header('Location: ../views/profile.php');
          }
        } else {
          $_SESSION['error'] = "email";
          header('Location: ../views/profile.php');
        }
      } else {
        $_SESSION['error'] = "login";
        header('Location: ../views/profile.php');
      }
    } else {
      header('Location: ../views/profile.php');
    }
}

?>
