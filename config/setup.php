<?php
include("database.php");
$sql =  new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
$sql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$tmp = '';
$file = file("db_camagru.sql");
foreach ($file as $line)
{
  if (substr($line, 0, 2) == '--' || $line == '')
      continue;
  $tmp .= $line;
  if (substr(trim($line), -1, 1) == ';')
  {
      if ( $sql->exec($tmp) === false)
        die(print_r($sql->errorInfo(), true));
    $tmp = '';
  }
    header("Location: ../views/index.php");
}

$sql = null;

?>
