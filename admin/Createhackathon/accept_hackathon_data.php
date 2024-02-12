<?php

declare(strict_types=1);
require_once '../../includes/dbh.inc.php';
require_once '../../includes/config_session.inc.php';

//pdo is db objec

    if ($_SERVER["REQUEST_METHOD"]=="POST"){
            $_SESSION['HName']=$_POST["HName"];
            $_SESSION['HDate']=$_POST["HDate"];
            $_SESSION['HTime']=$_POST["HTime"];
            $_SESSION['MaxP']=$_POST["MaxP"];
            $_SESSION['Category']=$_POST["Category"];
            $_SESSION['H_created']=1;
            header("Location: AddJudge.php");
        }
