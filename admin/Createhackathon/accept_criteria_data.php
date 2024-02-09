<?php

declare(strict_types=1);
require_once '../../includes/dbh.inc.php';
require_once "../../includes/config_session.inc.php";

//pdo is db objec

    if ($_SERVER["REQUEST_METHOD"]=="POST"){

        $query2="INSERT INTO criteria_data(CName1,CWeight1,CName2,CWeight2,CName3,CWeight3,H_id) VALUES (:CName1,:CWeight1,:CName2,:CWeight2,:CName3,:CWeight3,:H_id);";
        $stmt=$pdo->prepare($query2);
    
        $CName1=$_POST["CName1"];
        $CWeight1=$_POST["CWeight1"];
        $CName2=$_POST["CName2"];
        $CWeight2=$_POST["CWeight2"];
        $CName3=$_POST["CName3"];
        $CWeight3=$_POST["CWeight3"];
        
        
        $stmt->bindParam(":CName1",$CName1);
        $stmt->bindParam(":CWeight1",$CWeight1);
        $stmt->bindParam(":CName2",$CName2);
        $stmt->bindParam(":CWeight2",$CWeight2);
        $stmt->bindParam(":CName3",$CName3);
        $stmt->bindParam(":CWeight3",$CWeight3);
        $stmt->bindParam(":H_id",$_SESSION['H_id']);
        
        $stmt->execute();
        $_SESSION['H_criteria_added']=1;
        unset($_SESSION['HName']);
        unset($_SESSION['H_created']);
        unset($_SESSION['H_judges_added']);
        unset($_SESSION['H_criteria_added']);
        header("Location: ../admin.html");
    }
