<?php
session_start();

include("../models/modelCamera.php");

$img = (isset($_POST['snap'])) ? ($_POST['snap']) : NULL;


function displaySnap($login) {
    $data = getSnaps($login);
    return $data;
}

if (isset($img)) {
    $login = $_SESSION['loggued_on_user'];
    $id = getId($login);
    $img_cleaned = urldecode($img);
    $img_cleaned = preg_replace('/\s+/', '+', $img);
    saveSnap($login, $img_cleaned, $id);
}

if (isset($_POST['id_share'])) {
    $id_photo = $_POST['id_share'];
    shareSnap($id_photo);
}

if (isset($_POST['id_delete'])) {
    $id_photo = $_POST['id_delete'];
    deleteSnapDB($id_photo);
}

?>
