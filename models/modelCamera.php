<?php
include("connect.php");

function getSnaps($login) {
    $db = dbConnect();
    $stmt = $db->prepare('SELECT photos.img, photos.users_id, photos.id_photos, photos.published
        FROM photos
        INNER JOIN users ON photos.users_id = users.id_users
        WHERE users.login = :login
        ORDER BY photos.date ASC');
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
    $stmt = $db->prepare('INSERT INTO photos (`date`, img, published, users_id)
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

function foundLikes($id_photo) {
  $db = dbConnect();
  $stmt = $db->prepare('SELECT likes.photos_id FROM likes
    WHERE likes.photos_id = :id');
  $stmt->bindParam(':id', $id);
  $id = $id_photo;
  $stmt->execute();
  return $stmt;
}

function foundComments($id_photo) {
  $db = dbConnect();
  $stmt = $db->prepare('SELECT comments_id FROM photo_has_comments
    WHERE photos_id = :id');
  $stmt->bindParam(':id', $id);
  $id = $id_photo;
  $stmt->execute();
  return $stmt;
}

function deleteLikes($id_photo) {
  $db = dbConnect();
  $stmt = $db->prepare('DELETE FROM likes
    WHERE likes.photos_id = :id');
  $stmt->bindParam(':id', $id);
  $id = $id_photo;
  $stmt->execute();
}

function deleteComments($id_comment) {
  $db = dbConnect();
  $stmt = $db->prepare('DELETE FROM comments
    WHERE id_comments = :id');
  $stmt->bindParam(':id', $id);
  $id = $id_comment;
  $stmt->execute();
}

function deleteUhc($id_comment) {
  $db = dbConnect();
  $stmt = $db->prepare('DELETE FROM user_has_comments
    WHERE comments_id = :id');
  $stmt->bindParam(':id', $id);
  $id = $id_comment;
  $stmt->execute();
  deleteComments($id_comment);
}

function deletePhc($id_comment) {
  $db = dbConnect();
  $stmt = $db->prepare('DELETE FROM photo_has_comments
    WHERE comments_id = :id');
  $stmt->bindParam(':id', $id);
  $id = $id_comment;
  $stmt->execute();
  deleteUhc($id_comment);
}

function deleteSnapDB($id_photo) {
    $db = dbConnect();
    $stmt = $db->prepare('DELETE FROM photos
        WHERE photos.id_photos = :id_photo');
    $stmt->bindParam(':id_photo', $id);
    $id = $id_photo;
    $data = foundLikes($id_photo);
    foreach($data as $e) {
      deleteLikes($e['photos_id']);
    }
    $data = foundComments($id_photo);
    foreach ($data as $e) {
      deletePhc($e['comments_id']);
    }
    $stmt->execute();
}

?>
