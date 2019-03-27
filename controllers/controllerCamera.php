<?php
include("../models/modelCamera.php");
if (!isset($_SESSION)) {
  session_start();
}

$img = (isset($_POST) && isset($_POST['snap']) && isset($_POST['snap'])) ? ($_POST['snap']) : NULL;
$img2 = (isset($_POST) && isset($_POST['filtre']) && isset($_POST['filtre'])) ? ($_POST['filtre']) : NULL;
$x = (isset($_POST) && isset($_POST['x']) && isset($_POST['x'])) ? ($_POST['x']) : NULL;
$y = (isset($_POST) && isset($_POST['y']) && isset($_POST['y'])) ? ($_POST['y']) : NULL;
$width = (isset($_POST) && isset($_POST['width']) && isset($_POST['width'])) ? ($_POST['width']) : NULL;
$height = (isset($_POST) && isset($_POST['height']) && isset($_POST['height'])) ? ($_POST['height']) : NULL;


function displaySnap($login) {
    $data = getSnaps($login);
    return $data;
}

function mergePhoto($img, $img2, $x, $y, $width, $height) {
  if(isset($_SESSION) && isset($_SESSION['loggued_on_user']) && $_SESSION['loggued_on_user'] != "") {
    $login = $_SESSION['loggued_on_user'];
    $id = getId($login);
    file_put_contents($login.'_img.png', base64_decode($img));
    copy($img2, $login.'_filtre.png');

    $dest_image = imagecreatetruecolor($width, $height);
    imagesavealpha($dest_image, true);
    $trans_background = imagecolorallocatealpha($dest_image, 0, 0, 0, 127);
    imagefill($dest_image, 0, 0, $trans_background);

    $dest = imagecreatefrompng($login.'_img.png');
    $src = imagecreatefrompng($login.'_filtre.png');
    imagecopy($dest_image, $dest, 0, 0, 0, 0, $width, $height);
    imagecopyresized($dest_image, $src, $x, $y, 0, 0, $width, $height, 500, 357);

    header('Content-Type: image/png');
    imagepng($dest_image, $login.'_final.png');
    $data = file_get_contents($login.'_final.png');
    $str = "data:image/png;base64,".base64_encode($data);
    saveSnap($login, $str, $id);

    imagedestroy($dest_image);
    imagedestroy($dest);
    imagedestroy($src);
    unlink($login.'_img.png');
    unlink($login.'_filtre.png');
    unlink($login.'_final.png');
  }
}

if (isset($img) && isset($img2) && isset($x) && isset($y)) {
    $str = "data:image/png;base64,";

    $img_cleaned = urldecode($img);
    $img_cleaned = preg_replace('/\s+/', '+', $img);
    $data = str_replace($str, '', $img_cleaned);
    mergePhoto($data, $img2, $x, $y, $width, $height);
}

if (isset($_POST) && isset($_POST['id_share'])) {
    $id_photo = $_POST['id_share'];
    shareSnap($id_photo);
}

if (isset($_POST) && isset($_POST['id_delete'])) {
    $id_photo = $_POST['id_delete'];
    deleteSnapDB($id_photo);
}

?>
