<?php
include("../config/database.php");
include("connect.php");

function getLogin($login) {
    $db = dbConnect();
    $stmt = $db->prepare('SELECT users.id_users, users.login, users.password, users.key FROM users
    WHERE users.login = :login');
    $stmt->bindParam(':login', $login_user);
    $login_user = $login;
    $stmt->execute();
    return $stmt;
}

function createUser($email, $login, $password) {
    $db = dbConnect();
    $key = $login . $email . date('mY');
    $key = md5($key);
    $stmt = $db->prepare('INSERT INTO users (email, login, password, `key`)
    VALUES (:email, :login, :password, :key)');
    $stmt->bindParam(':email', $email_user);
    $email_user = $email;
    $stmt->bindParam(':login', $login_user);
    $login_user = $login;
    $stmt->bindParam(':password', $password_user);
    $password_user = $password;
    $stmt->bindParam(':key', $key_user);
    $key_user = $key;
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
