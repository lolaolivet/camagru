<?php
include("../models/modelIndex.php");
session_start();

function sendEmail($email) {
    $dest = $email;
    
    $headers = 'From: Camagru <olivetlola43@gmail.com>'. "\r\n";
    $headers .= 'To: '. $email.'\r\n';
    $headers .= "X-Mailer: PHP ".phpversion()."\n";
    $headers .= "X-Priority: 1 \n";
    $headers .= "Mime-Version: 1.0\n";
    $headers .= "Content-Transfer-Encoding: 8bit\n";
    $headers .= "Content-type: text/html; charset= utf-8\n";
    $headers .= "Date:" . date("D, d M Y h:s:i") . " +0200\n"; 
    $message = "
    <html>
        <body>
            <div align='center'>
                ". $_SESSION['loggued_on_user']." commented one of your picture !
            </div>
        </body>
    </html>";
    $send = mail($dest, "Camagru Notification", $message, $headers);
    var_dump($send);
}

function sendNotification($id_photo) {
    $data = getUserPhoto($id_photo);
    foreach ($data as $e) {
        if ($e['notif'] === '1') {
            sendEmail($e['email']);
        }
    }
}


if ($_POST['send'] === "Send" ) {
  if ($_POST['message'] != "") {
    $id_photo = $_POST['id'];
    $id_user = $_SESSION['id_user'];
    $txt = $_POST['message'];
    sendMessage($id_user, $id_photo, $txt);
    $_SESSION['message'] = "send";
    sendNotification($id_photo);
     header('Location: ../index.php');
  } else {
    $_SESSION['message'] = "error";
    header('Location: ../index.php');
  }
}
 ?>
