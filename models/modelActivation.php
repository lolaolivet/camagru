<?php

include("../config/database.php");
include("connect.php");

function getKey($login) {
    $db = dbConnect();
    $stmt = $db->prepare('SELECT users.key FROM users WHERE users.login = :login');
    $stmt->bindParam(':login', $login_user);
    $login_user = $login;
    $stmt->execute();
    return $stmt;
}

function getActivation($login) {
    $db = dbConnect();
    $stmt = $db->prepare('SELECT users.validation FROM users WHERE users.login = :login');
    $stmt->bindParam(':login', $login_user);
    $login_user = $login;
    $stmt->execute();
    return $stmt;
}

function activateUser($login) {
    $db = dbConnect();
    $stmt = $db->prepare('UPDATE users SET users.validation = 1 WHERE users.login = :login');
    $stmt->bindParam(':login', $login_user);
    $login_user = $login;
    $stmt->execute();
}

function deleteUser($login) {
    $db = dbConnect();
    $stmt = $db->prepare('DELETE FROM users WHERE users.login = :login');
    $stmt->bindParam(':login', $login_user);
    $login_user = $login;
    $stmt->execute();
}

function getIdUser($login) {
    $db = dbConnect();
    $stmt = $db->prepare('SELECT users.id_users FROM users
        WHERE users.login = :login');
    $stmt->bindParam(':login', $login_user);
    $login_user = $login;
    $stmt->execute();
    return $stmt;
}

?>