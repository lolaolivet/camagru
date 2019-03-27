<?php
include("../models/modelConnexion.php");
if (!isset($_SESSION)) {
  session_start();
}

if (isset($_POST) && isset($_POST['error']) && $_POST['error'] === "null")
    $_SESSION['error'] = "";
if (isset($_POST) && isset($_POST['success']) && $_POST['success'] === "null")
    $_SESSION['success'] = "";


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
                <a href='http://localhost:8080/".$dirs[1]."/views/activation.php?login=".urlencode($login)."&key=".urlencode($key)."'>Confirmed your account !</a>
            </div>
        </body>
    </html>";
    $send = mail($dest, "Confirmation account Camagru", $message, $headers);
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
    if (preg_match('/\s/', $login || preg_match('/#$%^&*()+=-[]\'`;,./{}|:<>?~/'), $login)) {
        return 0;
    } else {
        return 1;
    }
}

function isValidate($login) {
  $data = getValidation($login);
  foreach ($data as $e) {
    $return = $e['validation'];
  }
  return $return;
}

if (isset($_POST) && isset($_POST['connexion']) && $_POST['connexion'] === "Connect"
  && isset($_SESSION['token']) && isset($_POST['token'])) {
  $login = htmlspecialchars($_POST['login']);
  $password = htmlspecialchars($_POST['password']);
  $key = $_POST['token'];
  if (isset($login) && isset($password) && $key == $_SESSION['token'] && isset($_SESSION)
      && isset($_SESSION)) {
      if ($data = auth($login, $password)) {
        if ($v = isValidate($login)) {
          $_SESSION['loggued_on_user'] = $login;
          $_SESSION['id_user'] = $data['id_users'];
          $_SESSION['success'] = "connected";
          header('Location: ../views/camera.php');
        } else {
          $_SESSION['error'] = "validation";
          header('Location: ../views/connexion.php');
        }
      } else {
        $_SESSION['loggued_on_user'] = "";
        $_SESSION['error'] = "wrong";
        header('Location: ../views/connexion.php');
      }
  } else {
    $_SESSION['loggued_on_user'] = "";
    $_SESSION['error'] = "wrong";
    header('Location: ../views/connexion.php');
  }
}

if (isset($_POST) && isset($_POST['register']) && $_POST['register'] === "Register"
  && isset($_POST['token']) && isset($_SESSION['token'])) {
    $email = htmlspecialchars($_POST['email']);
    $login = htmlspecialchars($_POST['login']);
    $password = htmlspecialchars($_POST['password']);
    $key = $_POST['token'];
    if (isset($email) && isset($login) && isset($password) && $key == $_SESSION['token']) {
      if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        if ($ret = verifPassword($password)) {
            if ($ret = spaceLogin($login)) {
                $password_hash = hash('sha512', $password);
                if ($data = verifUser($email, $login)) {
                    if ($data_user = createUser($email, $login, $password_hash, $key)) {
                        $user = getLogin($login);
                        foreach ($user as $e) {
                            $key = $e['key'];
                        }
                        sendEmailConf($email, $login, $key);
                    }
                    $_SESSION['success'] = "created";
                      header('Location: ../views/index.php');
                } else {
                  $_SESSION['error'] = "notCreated";
                  header('Location: ../views/connexion.php');
                }
            } else {
                $_SESSION['error'] = "login";
                header('Location: ../views/connexion.php');
            }
        } else {
            $_SESSION['error'] = "password";
            header('Location: ../views/connexion.php');
        }
      } else {
        $_SESSION['error'] = "email";
        header('Location: ../views/connexion.php');
      }
    }
}

 ?>
