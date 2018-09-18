<?php

include("../config/database.php");
include("connect.php");

function getPictures() {
    $db = dbConnect();
    $req = $db->query('SELECT id_photos, date, img, users_id FROM photos');
    return $req;
}

function getComments($id) {
  $db = dbConnect();
  $stmt = $db->prepare('SELECT comments.text, comments.date, users.login
    FROM `comments`
    INNER JOIN photo_has_comments ON comments.id_comments = photo_has_comments.comments_id
    INNER JOIN user_has_comments ON comments.id_comments = user_has_comments.comments_id
    INNER JOIN users ON user_has_comments.users_id = users.id_users
    WHERE photo_has_comments.photos_id = :id_photo');
  $stmt->bindParam(':id_photo', $id_photo);
  $id_photo = $id;
  $stmt->execute();
  return $stmt;
}

function getLikes($id) {
  $db = dbConnect();
  $stmt = $db->prepare('SELECT COUNT(likes.photos_id) AS "total"
    FROM `likes` WHERE likes.photos_id = :id_photo');
  $stmt->bindParam(':id_photo', $id_photo);
  $id_photo = $id;
  $stmt->execute();
  return $stmt;
}

?>
