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
?>
