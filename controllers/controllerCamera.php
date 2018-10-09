<?php
include("../models/modelCamera.php");
session_start();

$img = (isset($_POST['snap'])) ? $_POST['snap'] : NULL;

var_dump($img);

 ?>
