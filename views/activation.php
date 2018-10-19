<?php
include("../controllers/controllerActivation.php");

session_start();

$login = $_GET['login'];
$key = $_GET['key'];


if (isset($login) && isset($key)) {
    if ($ret = verifActivation($login)) {        
        if ($ret = verifKey($login, $key)) {
            header('Location: ../index.php');
        } else {
            header('HTTP/1.0 404 Not Found');
        }
    } else {
        header('HTTP/1.0 404 Not Found');
    }

} else {
    deleteUser($login);
    echo '
    <html>
        <p>Something wrong happend.. Please create again your account.<a href="connexion.php">Connexion</a></p>';
}

?>