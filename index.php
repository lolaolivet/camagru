<?php
    include("models/modelIndex.php");
    include("controllers/controllerIndex.php");
    session_start();
?>

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
        <header>
            <div class="title">
                <a href="sindex.php"><h1>Camagru</h1></a>
            </div>
            <div class="gallery">
                <a href="index.php"><p>Gallery</p></a>
            </div>
            <?php
            if ($_SESSION['loggued_on_user'] != "") {
                echo '<div class="smile">
                        <a href="views/camera.php"><p>Smile!</p></a>
                      </div>
                      <div class="profile">
                        <a href="views/profile.php"><p>'. $_SESSION['loggued_on_user'] .'</p></a>
                      </div>
                      <div class="connect">
                        <a href="views/logout.php"><p>Logout</p></a>
                      </div>';
            } else {
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
        <div class="gallery">
            <?php
                    $per_page = 5;
                    if (isset($_GET['page'])) {
                        $page = $_GET['page'] - 1;
                        $offset = $page * $per_page;
                    } else {
                        $page = 0;
                        $offset = 0;
                    }
                    $total = countPictures();
                    foreach ($total as $e) {
                        $total_images = $e['result'];
                    }
                    if ($total_images > $per_page) {
                        $pages_total = ceil($total_images / $per_page);
                        $page_up = $page + 2;
                        $page_down = $page;
                        $display = '';
                    } else {
                        $pages = 1;
                        $pages_total = 1;
                        $display = 'class="display-none"';
                    }
                    echo '<p '.$display.'>Page ';
                    echo $page + 1 .' of '.$pages_total.'</p>';
                    $i = 1;
                    echo '<div id="pageNav"' .$display. '>';
                    
                    if ($page) {
                        echo '<a href="index.php"><button><<</button></a>';
                        echo '<a href="index.php?page='.$page_down.'"><button><</button></a>';
                    }
                    
                    for ($i = 1; $i < $pages_total; $i++) {
                        if ($i == $page + 1) {
                            echo '<a href="index.php?page='.$i.'"><button class="active">'.$i.'</button></a>';
                        }
                        if (($page + 1) != $pages_total) {
                            echo '<a href="index.php?page='.$page_up.'"><button>></button></a>';
                            echo '<a href="index.php?page='.$pages_total.'"><button>>></button></a>';
                        }
                    }
                    echo '</div>
                            <div class="row">
                            <ul>';
                    $result = getPictures($offset, $per_page);
                    while ($row = $result->fetch(PDO::FETCH_BOTH)) {
                        echo '<li>
                        <a onclick="open_img(this)">
                            <img src="'. $row["img"] .'" class="big" id="'. $row["id_photos"] .'">
                        </a>
                        <a class="close" onclick="close_img(this)">
                            <img src="img/close.png">
                        </a>
                        <div id="expand" class="port">
                            <div class="row">';
                            $likes = getLikes($row["id_photos"]);
                            foreach ($likes as $l) {
                              echo '<div class="likes">';
                                if ($dislike = getLikeUser($row['id_photos'], $_SESSION['id_user'])) {
                                    echo '<img src="img/like.png" onClick="dislike(this, '.$row['id_photos'].','. $_SESSION['id_user'].')">';
                                } else {
                                    echo '<img src="img/dislike.png" onClick="like(this, '.$row['id_photos'].','. $_SESSION['id_user'].')">';
                                }
                                echo $l["total"] .'</div>';
                            }
                        echo '<div class="description">';
                        $comments = getComments($row["id_photos"]);
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
                                    <input class="id" name="id" value="'. $row["id_photos"] .'">
                                    <input class="textComment" type="text" name="message">
                                    <input class="send" type="submit" value="Send" name="send">
                                  </form>
                                </div>';
                        }
                    echo '</div>
                        
                      </li>';
                    }

                ?>
                </ul>
            </div> <!-- Gallery -->
        </div>
    </body>
    <footer>
        <p>©Lola Olivet - lolivet@student.42.fr</p>
    </footer>
</html>
