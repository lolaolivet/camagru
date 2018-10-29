<?php
session_start();

include("../models/modelCamera.php");

$img = (isset($_POST['snap'])) ? ($_POST['snap']) : NULL;
$img2 = (isset($_POST['filtre'])) ? ($_POST['filtre']) : NULL;
$x = (isset($_POST['x'])) ? ($_POST['x']) : NULL;
$y = (isset($_POST['y'])) ? ($_POST['y']) : NULL;
$width = (isset($_POST['width'])) ? ($_POST['width']) : NULL;
$height = (isset($_POST['height'])) ? ($_POST['height']) : NULL;


function displaySnap($login) {
    $data = getSnaps($login);
    return $data;
}

function mergePhoto($img, $img2, $x, $y, $width, $height) {
  file_put_contents('image.png', base64_decode($img));
  copy($img2, 'filtre.png');
  $dest_image = imagecreatetruecolor($width, $height);
  imagesavealpha($dest_image, true);
  $dest = imagecreatefrompng('image.png');
  $src = imagecreatefrompng('filtre.png');
}

if (isset($img) && isset($img2) && isset($x) && isset($y)) {
    $str = "data:image/png;base64,";
    $login = $_SESSION['loggued_on_user'];
    $id = getId($login);
    $img_cleaned = urldecode($img);
    $img_cleaned = preg_replace('/\s+/', '+', $img);
    $data = str_replace($str, '', $img_cleaned);
    mergePhoto($data, $img2, $x, $y, $width, $height);
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
