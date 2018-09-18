<?php
    include("models/model.php");
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
                    <a class="close" onclick="close_img(this)">
                        <img src="http://www.acb-portesetfenetres.fr/wp-content/themes/html5blank/src/img/fermer.png">
                    </a>
                <?php
                    $photos = getPictures();
                    // var_dump($photos);
                    foreach ($photos as $e) {
                        // var_dump($e);
                        echo '<li>
                        <a onclick="open_img(this)">
                            <img src="data:image/jpeg;base64,'. $e["img"] .'>
                        </a>
                            
                        <div id="expand" class="port">
                            <div class="row">
                                <div class="description">
                                    <h1>'. $e["date"] .'</h1>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus quis libero erat. Integer ac purus est. Proin erat mi, pulvinar ut magna eget, consectetur auctor turpis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus quis libero erat. Integer ac purus est. Proin erat mi, pulvinar ut magna eget, consectetur auctor turpis.</p>
                                </div>
                            </div>
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
