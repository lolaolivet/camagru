<?php
include("../models/modelIndex.php");
session_start();


if ($_POST['send'] === "Send" ) {
  if ($_POST['message'] != "") {
    $id_photo = $_POST['id'];
    $id_user = $_SESSION['id_user'];
    $txt = $_POST['message'];
    sendMessage($id_user, $id_photo, $txt);
    $_SESSION['message'] = "send";
    header('Location: ../index.php');
  } else {
    $_SESSION['message'] = "error";
    header('Location: ../index.php');
  }
}
 ?>
