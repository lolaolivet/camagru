<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/gallery.css">
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <script type="text/javascript" src="js/gallery.js"></script>
        <script type="text/javascript" src="js/message.js"></script>
        <script type="text/javascript" src="js/likes.js"></script>
        <title>Camagruuu</title>
    </head>
    <body>
      <h1>Welcome !</h1>
      <a class="link" href="config/setup.php">Create/Reset database</a>
      <?php
        include('config/database.php');

        try {
          $sql =  new PDO($DB_LINK, $DB_USER, $DB_PASSWORD);
          $sql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          echo '<a class="link" href="views/index.php">Back home</a>';
        }
        catch(PDOException $e) {
          $sql = null;
        }
        $sql = null;
      ?>
    </body>
    <footer>
        <p>©Lola Olivet - lolivet@student.42.fr</p>
    </footer>
