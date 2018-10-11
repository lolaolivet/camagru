<?php
include("../controllers/controllerActivation.php");
//include("../models/modelActivation.php");

session_start();

$login = $_GET['login'];
$key = $_GET['key'];

if (isset($login) && isset($key)) {
    if ($ret = verifActivation($login)) {
        if ($ret = verifKey($login, $key)) {
            var_dump($ret);
            activateUser($login);
            $_SESSION['loggued_on_user'] = $login;
            header('Location: camera.php');
        } else {
            header('HTTP/1.0 404 Not Found');
        }
    } else {
        header('HTTP/1.0 404 Not Found');
    }

} else {
    deleteUser($login);
    echo '<p>Something wrong happend.. Please create again your account.<a href="connexion.php">Connexion</a></p>';
}

?>