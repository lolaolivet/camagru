<?php
    include("models/modelIndex.php");
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/gallery.css">
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <script type="text/javascript" src="js/gallery.js"></script>
        <title>Camagruuu</title>
    </head>
    <body>
        <header>
            <div class="title">
                <h1>Camagru</h1>
            </div>
            <div class="connect">
                <a href="views/connexion.php"><p>Connexion</p></a>
            </div>
        </header>
        <div id="top"></div>
        <div class="gallery">
            <div class="row">
                <ul>

                <?php
                    $photos = getPictures();
                    // var_dump($photos);
                    foreach ($photos as $e) {
                        // var_dump($e);
                        echo '<li>
                        <a onclick="open_img(this)">
                            <img src="'. $e["img"] .'">
                        </a>
                        <a class="close" onclick="close_img(this)">
                            <img src="http://pluspng.com/img-png/red-cross-png-red-cross-png-file-2000.png">
                        </a>
                        <div id="expand" class="port">
                            <div class="row">';
                            $likes = getLikes($e["id_photos"]);
                            foreach ($likes as $l) {
                              echo '<div class="likes"><p>'. $l["total"] .' likes</p></div>';
                            }
                        echo '<div class="description">';
                        $comments = getComments($e["id_photos"]);
                        foreach ($comments as $c) {
                          echo '<div class="comment">
                                  <div class="login"><p>'. $c["login"] .'</b></div>
                                  <div class="txt"><p>'. $c["text"] .'</p></div>
                                  <div class="date"><p>'. $c["date"] .'</p></div>
                              </div>';
                        }
                    echo '</div>
                        </div>
                      </li>';
                    }
                ?>
                </ul>
            </div> <!-- / row -->
        </div>
        <!-- Item 01 -->

    </body>
</html>
