<?php
include("../config/database.php");
include("connect.php");

function getLogin($login) {
  $db = dbConnect();
  $stmt = $db->prepare('SELECT users.login, users.password FROM users
    WHERE users.login = :login');
  $stmt->bindParam(':login', $login_user);
  $login_user = $login;
  $stmt->execute();
  return $stmt;
}

function createUser($email, $login, $password) {
  $db = dbConnect();
  $stmt = $db->prepare('INSERT INTO users (email, login, password, notif, validation)
    VALUES (:email, :login, :password, :notif, :validation)');
  $stmt->bindParam(':email', $email_user);
  $email_user = $email;
  $stmt->bindParam(':login', $login_user);
  $login_user = $login;
  $stmt->bindParam(':password', $password_user);
  $password_user = $password;
  $stmt->bindParam(':notif', $notif_user);
  $notif_user = 0;
  $stmt->bindParam(':validation', $validation_user);
  $validation_user = 0;
  $stmt->execute();
  var_dump($stmt);
  return $stmt;
}

function verifEmail($email) {
  $db = dbConnect();
  $stmt = $db->prepare('SELECT COUNT(users.id_users) AS "total" FROM users
    WHERE users.email = :email');
  $stmt->bindParam(':email', $user_email);
  $user_email = $email;
  $stmt->execute();
  return $stmt;
}

function verifLogin($login) {
  $db = dbConnect();
  $stmt = $db->prepare('SELECT COUNT(users.id_users) AS "total" FROM users
    WHERE users.login = :login');
  $stmt->bindParam(':login', $user_login);
  $user_login = $login;
  $stmt->execute();
  return $stmt;
}

?>
