<?php
    declare(strict_types=1);
    require_once '../includes/dbh.inc.php';
    require_once '../includes/config_session.inc.php';

    // $T_id=12;
    $result=$_SESSION['scores'];  
    // var_dump ($result); 
    // echo "<br>";
    foreach($result as $row){
        // echo "<br>";
        // var_dump($row);
        $Name=$row['CRName']."mark";
        $score=$_POST[$Name];
        // echo "<br>";
        // var_dump ($score); 

        $CR_id=$row['CR_id'];
        // echo "<br>";
        // var_dump ($CR_id); 
        // $query1="INSERT INTO scores (H_id,J_id,CR_id,T_id,Score) VALUES(:H_id,:J_id,:CR_id,:T_id,:Score);";
        // $stmt1=$pdo->prepare($query1);
        // $stmt1->bindParam(":H_id",$_SESSION['H_id']);
        // $stmt1->bindParam(":J_id",$_SESSION['J_id']);
        // $stmt1->bindParam(":CR_id",$CR_id);
        // $stmt1->bindParam(":T_id",$_SESSION['T_id']);
        // $stmt1->bindParam(":Score",$score);
        // $stmt1->execute();
        

        $query2="UPDATE scores set Score=:Score where T_id=:T_id and J_id=:J_id and CR_id=:CR_id";
        $stmt2=$pdo->prepare($query2);
        $stmt2->bindParam(":T_id",$_SESSION['T_id']);
        // echo $_SESSION['T_id'];
        $stmt2->bindParam(":J_id",$_SESSION['J_id']);
        // echo $_SESSION['J_id'];
         $stmt2->bindParam(":CR_id",$CR_id);
        //  echo $CR_id;
        $stmt2->bindParam(":Score",$score);
        $stmt2->execute();
    }
    unset($_SESSION['scores']);
    header("Location: judge.php");
    exit(); 