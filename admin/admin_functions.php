<?php
require_once "../includes/dbh.inc.php";


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_isadmin']) || !isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}
// else{
//     header("Location: admin.php");
// }

function logout(PDO $pdo) {
    require_once "discard.php";
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


if ($_SESSION["user_isadmin"]==1){
    if (isset($_POST['logout'])){     
        logout( $pdo);
    }
    // if (isset($_POST['create_hackathon'])){  
    //     open_create_hackathon();
    // }
}