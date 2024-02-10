<?php

declare(strict_types=1);
require_once '../../includes/dbh.inc.php';
require_once "../../includes/config_session.inc.php";

//pdo is db objec
if ($_SERVER["REQUEST_METHOD"]=="POST"){

    
    $_SESSION['CName1']=$_POST["CName1"];
    $_SESSION['CWeight1']=$_POST["CWeight1"];
    $_SESSION['CName2']=$_POST["CName2"];
    $_SESSION['CWeight2']=$_POST["CWeight2"];
    $_SESSION['CName3']=$_POST["CName3"];
    $_SESSION['CWeight3']=$_POST["CWeight3"];
    
    
    header("Location: completed.php");
}
