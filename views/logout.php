<?php

session_start();
session_destroy();
$_SESSION['connected'] = "";
$_SESSION['error'] = "";
header('Location: ../index.php');

 ?>
