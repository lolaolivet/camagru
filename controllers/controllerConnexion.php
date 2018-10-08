<?php

include("../models/modelConnexion.php");
session_start();

function auth($login, $password) {
  $password_hash = hash('sha512', $password);
  $data = getLogin($login);
  foreach ($data as $e) {
    if ($e['password'] === $password_hash && $e['login'] === $login)
      return $e;
    else
      return NULL;
  }
}

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

function sendEmailConf($email, $login, $key) {
    $dest = $email;
    $obj = "Activation account";
    
    $headers = 'From: Camagru <camagru@42project.com>' . "\r\n";
    $headers .= 'To: '. $email.'\r\n';
    $headers .= "X-Mailer: PHP ".phpversion()."\n";
    $headers .= "X-Priority: 1 \n";
    $headers .= "Mime-Version: 1.0\n";
    $headers .= "Content-Transfer-Encoding: 8bit\n";
    $headers .= "Content-type: text/html; charset= utf-8\n";
    $headers .= "Date:" . date("D, d M Y h:s:i") . " +0200\n"; 
    $message = "
    <html>
        <body>
            <div align='center'>
                <a href='http://localhost:8080/camagru/activation.php?login=".urlencode($login)."&key=".urlencode($key)."'>Account confirmed.</a>
    </html>";
    $send = mail($dest, "Confirmation account", $message, $headers, '-fcamagru@42project.fr');
    var_dump($send);
}

if ($_POST['connexion'] === "Connect") {
  $login = $_POST['login'];
  $password = $_POST['password'];
  if (isset($login) && isset($password)) {
      if ($data = auth($login, $password)) {
        $_SESSION['loggued_on_user'] = $login;
        $_SESSION['id_user'] = $data['id_users'];
        var_dump($_SESSION['loggued_on_user']);
        $_SESSION['connected'] = "connected";
        header('Location: ../views/camera.php');
      } else {
        $_SESSION['loggued_on_user'] = "";
        $_SESSION['error'] = "error";
        header('Location: ../views/connexion.php');
      }
  } else {
    $_SESSION['loggued_on_user'] = "";
    $_SESSION['error'] = "error";
    header('Location: ../views/connexion.php');
  }
}

if ($_POST['register'] === "Register") {
    $email = $_POST['email'];
    $login = $_POST['login'];
    $password = $_POST['password'];
    $key = "";
    if (isset($email) && isset($login) && isset($password)) {
        $password_hash = hash('sha512', $password);
        if ($data = verifUser($email, $login)) {
            if ($data_user = createUser($email, $login, $password_hash)) {
                $user = getLogin($login);
                foreach ($user as $e) {
                    $key = $e['key'];
                }
                sendEmailConf($email, $login, $key);
            }
            $_SESSION['created'] = "created";
        //      header('Location: ../index.php');
        } else {
          $_SESSION['created'] = "notCreated";
          header('Location: ../views/connexion.php');
        }
    }
}

 ?>
