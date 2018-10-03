<?php
include("../config/database.php");
include("connect.php");

function getLogin($login) {
  $db = dbConnect();
  $stmt = $db->prepare('SELECT users.id_users, users.login, users.password FROM users
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
  $users_id = $db->lastInsertId();
  $key = $login . $email . date('mY');
  $key = md5($key);
//  $data = createConfirm($users_id, $key, $email);
//    var_dump($data);
  return $stmt;
}

function createConfirm($users_id, $key, $email) {
    $db = dbConnect();
    $stmt = $db->prepare('INSERT INTO confirm (users_id, key, email)
        VALUES (:users_id, :key, :email)');
    $stmt->bindParam(':users_id', $id_user);
    $id_user = $users_id;
    $stmt->bindParam(':key', $key_user);
    $key_user = $key;
    $stmt->bindParam(':email', $email_user);
    $email_user = $email;
    $stmt->execute();
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
