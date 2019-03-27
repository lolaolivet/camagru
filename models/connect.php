<?php

function dbConnect() {
    try
    {
        $db = new PDO('mysql:dbname=db_camagru;host=localhost', 'root', 'miaou123');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    }
    catch(PDOException $e)
    {
      echo 'Erreur: '.$e->getMessage();
    }
}

 ?>
