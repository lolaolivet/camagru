<?php

session_start();
session_destroy();
$_SESSION['message'] = "";
header('Location: ../index.php');

 ?>
