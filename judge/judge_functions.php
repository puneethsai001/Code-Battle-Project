<?php
require_once "../includes/dbh.inc.php";
require_once '../includes/config_session.inc.php';
function logout(PDO $pdo) {
    $_SESSION = array();
    session_unset();
    session_destroy();

    $past = time() - 3600;
    foreach ($_COOKIE as $key => $value) {
        setcookie($key, '', $past, '/');
    }   

    header("Location: ../index.php");
    exit(); 
}
if ($_SESSION["user_isadmin"]==0){
    if (isset($_POST['logout'])){     
        logout( $pdo);
    }
}

