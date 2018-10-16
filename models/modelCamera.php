<?php
include("../config/database.php");
include("connect.php");

function getSnaps($login) {
    $db = dbConnect();
    $stmt = $db->prepare('SELECT photos.img, photos.users_id, photos.id_photos FROM photos 
        INNER JOIN users ON photos.users_id = users.id_users 
        WHERE photos.published = 0
        AND users.login = :login');
    $stmt->bindParam(':login', $login_user);
    $login_user = $login;
    $stmt->execute();
    return $stmt;
}

function getId($login) {
    $db = dbConnect();
    $stmt = $db->prepare('SELECT users.id_users FROM users 
        WHERE users.login = :login');
    $stmt->bindParam(':login', $user_login);
    $user_login = $login;
    $stmt->execute();
    foreach ($stmt as $e) {
        $id = $e['id_users'];
    }
    return $id;
}

function saveSnap($login, $img, $id) {
    $db = dbConnect();
    $stmt = $db->prepare('INSERT INTO photos (date, img, published, users_id)
    VALUES (:date, :img, :published, :users_id)');
    $date = date("Y-m-d H:i:s");
    $stmt->bindParam(':date', $date_photo);
    $date_photo = $date;
    $stmt->bindParam(':img', $snap);
    $snap = $img;
    $stmt->bindParam(':published', $published);
    $published = 0;
    $stmt->bindParam(':users_id', $users_id);
    $users_id = $id;
    $stmt->execute();
}

function shareSnap($id_photo) {
    $db = dbConnect();
    $stmt = $db->prepare('UPDATE photos SET photos.published = 1
        WHERE photos.id_photos = :id_photo');
    $stmt->bindParam(':id_photo', $id);
    $id = $id_photo;
    $stmt->execute();
}

function deleteSnap($id_photo) {
    $db = dbConnect();
    $stmt = $db->prepare('DELETE FROM photos 
        WHERE photos.id_photos = :id_photo');
    $stmt->bindParam(':id_photo', $id);
    $id = $id_photo;
    $stmt->execute();
}
?>