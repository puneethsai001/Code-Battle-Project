<?php
    $_SESSION = array();
    session_unset();
    session_destroy();

    $past = time() - 3600;
    foreach ($_COOKIE as $key => $value) {
        setcookie($key, '', $past, '/');
    }

    header("Location: ../index.php");
    exit(); 

?>