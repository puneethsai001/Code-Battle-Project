<?php

declare(strict_types=1);
require_once '../../includes/dbh.inc.php';
require_once '../../includes/config_session.inc.php';

//pdo is db objec

if ($_SERVER["REQUEST_METHOD"]=="POST"){
    $HName=$_POST["HName"];
    $HDate=$_POST["HDate"];
    $HTime=$_POST["HTime"];
    $MaxP=$_POST["MaxP"];
    $Category=$_POST["Category"];
    
   
    $query="INSERT INTO hackathon_data(HName,HDate,HTime,MaxP,Category) VALUES (:HName,:HDate,:HTime,:MaxP,:Category);";
    $stmt=$pdo->prepare($query);
    $stmt->bindParam(":HName",$HName);
    $stmt->bindParam(":HDate",$HDate);
    $stmt->bindParam(":HTime",$HTime);
    $stmt->bindParam(":MaxP",$MaxP);
    $stmt->bindParam(":Category",$Category);
    
    $stmt->execute();
    $_SESSION['HName']=$HName;
    echo $_SESSION['HName'];
    header("Location: AddJudge.html");
}