<?php
include("../models/modelActivation.php");
session_start();

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
        if ($e['activation'] == 1)
            return 0;
        else
            return 1;
    }
}

?>