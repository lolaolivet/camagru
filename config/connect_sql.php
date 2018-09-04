<?php
include('database.php');
function db_connect() {
  try {
    $connect = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
  } catch(PDOException $e) {
    echo "Connection failed : " . $e->getMessage();
  }
    return ($connect);
}
