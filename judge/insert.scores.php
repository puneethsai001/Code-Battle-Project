<?php
    declare(strict_types=1);
    require_once '../includes/dbh.inc.php';
    require_once '../includes/config_session.inc.php';
   
    $criterias=$_SESSION['criterias'];  
   
    foreach($criterias as $row){
        //making the input name attribute
        $Name=$row['CRName']."mark";
        // cheking what value is posted for it and storing it in score
        $score=$_POST[$Name];
        // storing each criteria's criteria id
        $CR_id=$row['CR_id'];

        // updating score
        $query2="UPDATE scores set Score=:Score where T_id=:T_id and J_id=:J_id and CR_id=:CR_id";
        $stmt2=$pdo->prepare($query2);
        $stmt2->bindParam(":T_id",$_SESSION['T_id']);
        $stmt2->bindParam(":J_id",$_SESSION['J_id']);
        $stmt2->bindParam(":CR_id",$CR_id);
        $stmt2->bindParam(":Score",$score);
        $stmt2->execute();
    }
    unset($_SESSION['criterias']);
    unset($_SESSION['T_id']);
    // unset($_SESSION['CName']);  header("Location: Team.php?categoryname=' +$_SESSION['CName']");
    // header("Location: Team.php?categoryname=" . urlencode($_SESSION['CName']));
    header("Location: judge.php");
    exit(); 