<?php

function dbConnect() {
    try
    {
        $db = new PDO('mysql:dbname=db_camagru;host=localhost', 'root', 'miaou123');
        return $db;
    }
    catch(Exception $e)
    {
        die('Erreur connection: '.$e->getMessage());
    }
}

 ?>
