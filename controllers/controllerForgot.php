<?php
include('../models/modelForgot.php');
if (!isset($_SESSION)) {
  session_start();
}

if (isset($_GET) && isset($_GET['login'])) {
  $_SESSION['login'] = $_GET['login'];
}
if (isset($_GET) && isset($_GET['key'])) {
  $_SESSION['key'] = $_GET['key'];
}

function sendEmailPasswd($email, $login, $key) {
    $root = $_SERVER['REQUEST_URI'];
    $dirs = explode('/', $root);
    $dest = $email;
    $headers = 'From: Camagru <olivetlola43@gmail.com>'. "\r\n";
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
                <a href='http://localhost:8080/".$dirs[1]."/views/new.php?login=".urlencode($login)."&key=".urlencode($key)."'>Reset password</a>
            </div>
        </body>
    </html>";
    $send = mail($dest, "Camagru Forgotten password", $message, $headers);
}

function verifGet($login, $key) {
    $data = getLoginKey($login);
    foreach ($data as $e) {
        $dataKey = $e['key'];
    }
    if ($dataKey == $key)
        return 1;
    else
        return 0;
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

function verifValidation($login) {
  $data = getValidation($login);
  foreach ($data as $e) {
    $ret = $e['validation'];
  }
  if ($ret == 1) {
    return 1;
  }
  else {
    return 0;
  }
}

if (isset($_POST) && isset($_POST['send']) && $_POST['send'] === "Send"
  && isset($_POST['token']) && isset($_SESSION) && isset($_SESSION['token'])) {
    $email = $_POST['email'];
    $key = $_POST['token'];
    $data = getMail($email);
    foreach ($data as $e) {
        $user_login = $e['login'];
        $user_email = $e['email'];
    }
    if (isset($user_email) && $user_email === $email && $key == $_SESSION['token']) {
      if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        if ($ret = verifValidation($user_login)) {
          changeKey($user_login, $key);
          sendEmailPasswd($user_email, $user_login, $key);
          $_SESSION['success'] = "email";
          header('Location: ../views/connexion.php');
        } else {
          $_SESSION['error'] = "validation";
          header('Location: ../views/connexion.php');
        }
      } else {
        $_SESSION['error'] = "email";
        header('Location: ../views/forgot.php');
      }
    } else {
        $_SESSION['error'] = "noEmail";
        header('Location: ../views/connexion.php');
    }
}


if (isset($_POST) && isset($_POST['validate']) && $_POST['validate'] === "Validate") {
    $password = htmlspecialchars($_POST['password']);
    $passwd = htmlspecialchars($_POST['passwd']);
    if ($password === $passwd) {
      if ($ret = verifPassword($password)) {
          $password_hash = hash('sha512', $password);
          updatePassword($password_hash, $_SESSION['login']);
          header('Location: ../views/connexion.php');
      }
      else {
          $_SESSION['error'] = "pass";
          header('Location: ../views/new.php?login='.$_SESSION['login'].'&key='.$_SESSION['key']);
      }
    } else {
        $_SESSION['error'] = 'confirm';
        header('Location: ../views/new.php?login='.$_SESSION['login'].'&key='.$_SESSION['key']);
    }
}


?>
