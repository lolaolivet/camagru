<?php

include("connect.php");

function getPictures($offset, $per_page) {
    $db = dbConnect();
    $req = $db->query('SELECT id_photos, date, img, users_id
        FROM photos
        WHERE published = 1
        ORDER BY photos.id_photos ASC LIMIT '.$offset.', '.$per_page);
    return $req;
}

function getComments($id) {
  $db = dbConnect();
  $stmt = $db->prepare('SELECT comments.text, comments.date, users.login
    FROM `comments`
    INNER JOIN photo_has_comments ON comments.id_comments = photo_has_comments.comments_id
    INNER JOIN user_has_comments ON comments.id_comments = user_has_comments.comments_id
    INNER JOIN users ON user_has_comments.users_id = users.id_users
    WHERE photo_has_comments.photos_id = :id_photo
    ORDER BY comments.date');
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

function linkUser($id_user, $id_comment) {

  $db = dbConnect();
  $stmt = $db->prepare('INSERT INTO user_has_comments (users_id, comments_id)
    VALUES (:user, :comment)');
  $stmt->bindParam(':user', $user);
  $user = $id_user;
  $stmt->bindParam(':comment', $comment);
  $comment = $id_comment;
  $stmt->execute();
}


function linkPhoto($id_photo, $id_comment) {
  $db = dbConnect();
  $stmt = $db->prepare('INSERT INTO photo_has_comments (photos_id, comments_id)
    VALUES (:photo, :comment)');
  $stmt->bindParam(':photo', $id_photo);
  $stmt->bindParam(':comment', $id_comment);
  $stmt->execute();
}

function sendMessage($id_user, $id_photo, $txt) {
  $db = dbConnect();
  date_default_timezone_set("Europe/Paris");
  $date = date("Y-m-d H:i:s");
  $stmt = $db->prepare('INSERT INTO comments (text, date)
    VALUES (:txt, :d)');
  $stmt->bindParam(':txt', $text);
  $text = $txt;
  $stmt->bindParam(':d', $d);
  $d = $date;
  $stmt->execute();
  $id_comment = $db->lastInsertId();
  linkUser($id_user, $id_comment);
  linkPhoto($id_photo, $id_comment);
}

function getUserPhoto($id_photo) {
    $db = dbConnect();
    $stmt = $db->prepare('SELECT users.notif, users.email FROM photos
    INNER JOIN users ON photos.users_id = users.id_users
    WHERE photos.id_photos = :id_photo');
    $stmt->bindParam(':id_photo', $photo);
    $photo = $id_photo;
    $stmt->execute();
    return $stmt;
}

function getUserLike($id_photo, $id_user) {
    $db = dbConnect();
    $stmt = $db->prepare('SELECT COUNT(id_likes) AS "result"
        FROM likes
        WHERE photos_id = :id_photo AND users_id = :id_user');
    $stmt->bindParam(':id_photo', $photo_id);
    $photo_id = $id_photo;
    $stmt->bindParam(':id_user', $user_id);
    $user_id = $id_user;
    $stmt->execute();
    return $stmt;
}

function deleteLike($id_photo, $id_user) {
    $db = dbConnect();
    $stmt = $db->prepare('DELETE FROM likes
        WHERE likes.photos_id = :id_photo AND likes.users_id = :id_user');
    $stmt->bindParam(':id_photo', $photo_id);
    $photo_id = $id_photo;
    $stmt->bindParam(':id_user', $user_id);
    $user_id = $id_user;
    $stmt->execute();
}

function createLike($id_photo, $id_user) {
    $db = dbConnect();
    $stmt = $db->prepare('INSERT INTO likes (photos_id, users_id)
        VALUES (:id_photo, :id_user)');
    $stmt->bindParam(':id_photo', $photo_id);
    $photo_id = $id_photo;
    $stmt->bindParam(':id_user', $user_id);
    $user_id = $id_user;
    $stmt->execute();
}

function countPictures() {
    $db = dbConnect();
    $req = $db->query('SELECT COUNT(photos.id_photos) AS "result"
        FROM photos
        WHERE photos.published = 1;');
    return $req;
}

?>
