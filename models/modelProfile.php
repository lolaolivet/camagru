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

?>
