<?php
include("connect_sql.php");
$sql = db_connect();
$tmp = '';
$file = file("db_camagru.sql");
foreach ($file as $line)
{
  if (substr($line, 0, 2) == '--' || $line == '')
      continue;
  $tmp .= $line;
  if (substr(trim($line), -1, 1) == ';')
  {
    mysqli_query($sql, $tmp) or print('Erreur en traitant la requete \'<strong>' . $tmp . '\': ' . mysqli_error($sql) . '<br /><br />');
    $tmp = '';
  }
}
echo "Tables imported successfully";
header('Location: ../views/home.php');
?>
