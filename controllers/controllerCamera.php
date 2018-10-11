<?php
include("../models/modelCamera.php");
session_start();

$img = (isset($_POST['snap'])) ? ($_POST['snap']) : NULL; 


if (isset($img)) {
    $login = $_SESSION['loggued_on_user'];
    $id = getId($login);
    $img_cleaned = preg_replace('/\s+/', '+', $img);
//    $decode_img = json_decode($img);
    var_dump($img_cleaned);
//    saveSnap($login, $img_cleaned, $id);
//    var_dump($decode_img->snap);
}
?>