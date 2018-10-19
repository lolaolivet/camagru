<?php
include("../config/database.php");
include("connect.php");

function getUser($login) {
  $db = dbConnect();
  $stmt = $db->prepare('SELECT users.login, users.email, users.password, users.notif
    FROM users WHERE users.login = :login');
  $stmt->bindParam(':login', $login_user);
  $login_user = $login;
  $stmt->execute();
  return $stmt;
}

function verifUser($id) {
  $db = dbConnect();
  $stmt = $db->prepare('SELECT users.id_users, users.login, users.email FROM users
    WHERE users.id_users <> :id');
  $stmt->bindParam(':id', $user_id);
  $user_id = $id;
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

function updateUser($login, $email, $password, $notif) {
  $db = dbConnect();
  if ($password !== "") {
    $stmt = $db->prepare('UPDATE users
      SET login = :login, email = :email, password = :password, notif = :notif
      WHERE login = :login');
    $stmt->bindParam(':password', $user_password);
    $user_password = $password;
  } else {
    $stmt = $db->prepare('UPDATE users
      SET login = :login, email = :email, notif = :notif
      WHERE login = :login');
  }
  $stmt->bindParam(':login', $user_login);
  $user_login = $login;
  $stmt->bindParam(':email', $user_email);
  $user_email = $email;
  $stmt->bindParam(':notif', $user_notif);
  $user_notif = $notif;
  $stmt->execute();
}

?>
