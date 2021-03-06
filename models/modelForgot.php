<?php
include("connect.php");

function getMail($email) {
    $db = dbConnect();
    $stmt = $db->prepare('SELECT users.login, users.key, users.email
        FROM users
        WHERE users.email = :email');
    $stmt->bindParam(':email', $user_email);
    $user_email = $email;
    $stmt->execute();
    return $stmt;
}

function getLoginKey($login) {
    $db = dbConnect();
    $stmt = $db->prepare('SELECT users.key FROM users
        WHERE users.login = :login');
    $stmt->bindParam(':login', $user_login);
    $user_login = $login;
    $stmt->execute();
    return $stmt;
}

function updatePassword($password, $login) {
    $db = dbConnect();
    $stmt = $db->prepare('UPDATE users
      SET password = :password
      WHERE login = :login');
    $stmt->bindParam(':password', $passwd);
    $passwd = $password;
    $stmt->bindParam(':login', $user_login);
    $user_login = $login;
    $stmt->execute();
}

function getValidation($login) {
  $db = dbConnect();
  $stmt = $db->prepare('SELECT users.validation FROM users
    WHERE users.login = :login');
  $stmt->bindParam(':login', $user_login);
  $user_login = $login;
  $stmt->execute();
  return $stmt;
}

function changeKey($login, $key) {
  $db = dbConnect();
  $stmt = $db->prepare('UPDATE users
    SET `key` = :key
    WHERE login = :login');
  $stmt->bindParam(':key', $user_key);
  $user_key = $key;
  $stmt->bindParam(':login', $user_login);
  $user_login = $login;
  $stmt->execute();
}

?>
