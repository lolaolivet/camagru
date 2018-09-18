<?php

include("../config/database.php");

function getPictures() {
    $db = dbConnect();
    $req = $db->query('SELECT id, date, img, id_users FROM photos');
    var_dump($req);
    return $req;

}

function dbConnect() {
    try
    {
        $db = new PDO('mysql:host=localhost;dbname=db_camagru', 'root', 'root');
        return $db;
    }
    catch(Exception $e)
    {
        die('Erreur connection: '.$e->getMessage());
    }
}

?>