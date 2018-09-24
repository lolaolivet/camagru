<?php

session_start();
session_destroy();
$_SESSION['connected'] = "";
$_SESSION['error'] = "";
$_SESSION['message'] = "";
header('Location: ../index.php');

 ?>
