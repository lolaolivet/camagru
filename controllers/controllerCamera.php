<?php
include("../models/modelCamera.php");
session_start();

$img = (isset($_POST['snap'])) ? htmlentities($_POST['snap']) : NULL; 

if (isset($img)) {
    $login = $_SESSION['loggued_on_user'];
    $id = getId($login);
//    saveSnap($login, $img, $id);
//    var_dump($id);
//    var_dump($img);
}

?>