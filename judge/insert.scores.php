<?php
    declare(strict_types=1);
    require_once '../includes/dbh.inc.php';
    require_once '../includes/config_session.inc.php';

    // $T_id=12;
    $result=$_SESSION['scores'];   
    foreach($result as $row){
        $Name=$row['CRName']."mark";
        $score=$_POST[$Name];
        $CR_id=$row['CR_id'];
        $query1="INSERT INTO scores (H_id,J_id,CR_id,T_id,Score) VALUES(:H_id,:J_id,:CR_id,:T_id,:Score);";
        $stmt1=$pdo->prepare($query1);
        $stmt1->bindParam(":H_id",$_SESSION['H_id']);
        $stmt1->bindParam(":J_id",$_SESSION['J_id']);
        $stmt1->bindParam(":CR_id",$CR_id);
        $stmt1->bindParam(":T_id",$_SESSION['T_id']);
        $stmt1->bindParam(":Score",$score);
        $stmt1->execute();
        header("Location: judgescatdata.php");
        exit(); 

    }