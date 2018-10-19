<?php
include("../config/database.php");
include("connect.php");

function getMail($email) {
    $db = dbConnect();
    $stmt = $db->prepare('SELECT COUNT(email) AS "result"
        FROM users WHERE users.email = :email');
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

?>