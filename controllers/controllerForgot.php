<?php
include('../models/modelForgot.php');
session_start();

function sendEmailPasswd($email) {
    $dest = $email;
    
    $headers = 'From: Camagru <olivetlola43@gmail.com>'. '\r\n';
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
                <a href='http://localhost:8080/camagru/views/new.php?login=".urlencode($login)."&key=".urlencode($key)."'>Confirmed your account !</a>
            </div>
        </body>
    </html>";
    $send = mail($dest, "Camagru New Password", $message, $headers);
}

function verifMail($email) {
    $data = getMail($email);
    foreach ($data as $e) {
        $ret = $e['result'];
    }
    return $ret;
}

function verifGet($login, $key) {
    $data = getLoginKey($login);    
    foreach ($data as $e) {
        $dataKey = $e['key'];
    }
    if ($dataKey === $key)
        return 1;
    else
        return 0;
    
}

if ($_POST['send'] === "Send") {
    $email = $_POST['email'];
    if ($ret = verifMail($email)) {
        sendEmailPasswd($email);
    } else {
        echo 'NUL';
        $_SESSION['error'] = "noPasswd";
        header('Location: ../views/forgot.php');
    }
}

?>