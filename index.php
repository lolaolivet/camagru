<?php
    include("models/modelIndex.php");
    include("controllers/controllerIndex.php");
    session_start();
    var_dump($_SESSION['loggued_on_user']);
    var_dump($_SESSION['id_user']);

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/gallery.css">
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <script type="text/javascript" src="js/gallery.js"></script>
        <script type="text/javascript" src="js/message.js"></script>
        <title>Camagruuu</title>
    </head>
    <body>
        <header>
            <div class="title">
                <h1>Camagru</h1>
            </div>
            <?php
            if ($_SESSION['loggued_on_user'] != "")
                echo '<div class="smile">
                        <a href="views/camera.php"><p>Smile!</p></a>
                      </div>
                      <div class="profile">
                        <a href="views/profile.php"><p>'. $_SESSION['loggued_on_user'] .'</p></a>
                      </div>
                      <div class="connect">
                        <a href="views/logout.php"><p>Déconnexion</p></a>
                      </div>';
            else
            {
                echo '<div class="connect">
                        <a href="views/connexion.php"><p>Connexion</p></a>
                      </div>';
            }
            ?>
        </header>
        <?php
          if ($_SESSION['success'] === "created") {
            echo '<div class="success">
                    <div class="text">
                      <div class="closeMessage">
                        <a onclick="closeMessage(this)"><img src="img/close.png"></a>
                      </div>
                      Your profile has been create successfully ! Confirmed with your email.
                    </div>
                  </div>';
          }
          if ($_SESSION['error'] === "error") {
            echo '<div class="error">
                    <div class="text">
                      <div class="closeMessage">
                        <a onclick="closeMessage(this)"><img src="img/close.png"></a>
                      </div>
                      Your comment was not send, an error occured..
                    </div>
                  </div>';
          }
          if ($_SESSION['success'] === "send") {
            echo '<div class="success">
                    <div class="text">
                      <div class="closeMessage">
                        <a onclick="closeMessage(this)"><img src="img/close.png"></a>
                      </div>
                      Your comment has been sent successfully !
                    </div>
                  </div>';
          }
        ?>
        <div id="top"></div>
        <div class="gallery">
            <div class="row">
                <ul>
                <?php
                    $photos = getPictures();
                    foreach ($photos as $e) {
                        echo '<li>
                        <a onclick="open_img(this)">
                            <img src="'. $e["img"] .'" class="big" id="'. $e["id_photos"] .'">
                        </a>
                        <a class="close" onclick="close_img(this)">
                            <img src="img/close.png">
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
                            $date = strtotime($c["date"]);
                          echo '<div class="comment">
                                  <div class="login"><p>'. $c["login"] .'</b></div>
                                  <div class="txt"><p>'. $c["text"] .'</p></div>
                                  <div class="date"><p>'. date("j M y H:i", $date) .'</p></div>
                              </div>';
                        }
                        if ($_SESSION['loggued_on_user'] != "") {
                          echo '<div class="message">
                                  <form method="post" action="controllers/controllerIndex.php">
                                    <input class="id" name="id" value="'. $e["id_photos"] .'">
                                    <input class="textComment" type="text" name="message">
                                    <input class="send" type="submit" value="Send" name="send">
                                  </form>
                                </div>';
                        }
                    echo '</div>
                        </div>
                      </li>';
                    }
                ?>
                </ul>
            </div>
        </div>

    </body>
</html>
