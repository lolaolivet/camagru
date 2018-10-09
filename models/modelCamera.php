<?php
include("../config/database.php");
include("connect.php");

function getSnaps($login) {
    $db = dbConnect();
    $stmt = $db->prepare('SELECT photos.img FROM photos 
        INNER JOIN users ON photos.users_id = users.id_users 
        WHERE photos.published = 0
        AND users.login = :login');
    $stmt->bindParam(':login', $login_user);
    $login_user = $login;
    $stmt->execute();
    return $stmt;
}

function saveSnap($login, $img) {
    $db = dbConnect();
    $stmt = $db->prepare('INSERT INTO photos (date, img, published, users_id)
    VALUES (:date, :img, :published, :users_id)');
}

?>