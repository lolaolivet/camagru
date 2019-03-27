<?php
include("../models/modelActivation.php");
if (!isset($_SESSION)) {
  session_start();
}

function verifKey($login, $key) {
    $data = getKey($login);
    foreach ($data as $e) {
        if ($e['key'] === $key)
            return 1;
        else
            return 0;
    }
}

function verifActivation($login) {
    $data = getActivation($login);
    foreach ($data as $e) {
        if ($e['validation'] == 1)
            return 0;
        else
            return 1;
    }
}

function getId($login) {
    $data = getIdUser($login);
    foreach ($data as $e) {
        $id_user = $e['id_users'];
    }
    if ($id_user != 0) {
        return $id_user;
    }
    else
        return 0;
}

?>
