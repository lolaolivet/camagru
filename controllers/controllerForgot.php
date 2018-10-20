<?php
include('../models/modelForgot.php');
session_start();

function sendEmailPasswd($email, $login, $key) {
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
                <a href='http://localhost:8080/camagru/views/new.php?login=".urlencode($login)."&key=".urlencode($key)."'>Reset password</a>
            </div>
        </body>
    </html>";
    $send = mail($dest, "Camagru Forgotten password", $message, $headers);
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

function verifPassword($password) {
    if (strlen($password) < 8) {
        return 0;
    }
    else if (!(preg_match('/[0-9]/', $password))) {
        return 0;
    }
    else
        return 1;
}

if ($_POST['send'] === "Send") {
    $email = $_POST['email'];
    $data = getMail($email);
    foreach ($data as $e) {
        $user_login = $e['login'];
        $user_key = $e['key'];
        $user_email = $e['email'];
    }
    if ($user_email === $email) {
        sendEmailPasswd($user_email, $user_login, $user_key);
        $_SESSION['success'] = "email";
        header('Location: ../views/connexion.php');
    } else {
        $_SESSION['error'] = "noEmail";
        header('Location: ../views/connexion.php');
    }
}


if ($_POST['validate'] === "Validate") {
    $password = $_POST['password'];
    if ($ret = verifPassword($password)) {
        $password_hash = hash('sha512', $password);
        updatePassword($password_hash, $_SESSION['login']);
        header('Location: ../views/connexion.php');
    }
    else {
        $_SESSION['error'] = "pass";
        header('Location: ../views/new.php?login='.$_SESSION['login'].'&key='.$_SESSION['key']);
    }
}


?>