<?php

declare(strict_types=1);
require_once '../../includes/dbh.inc.php';

//pdo is db objec

if ($_SERVER["REQUEST_METHOD"]=="POST"){
    $judgescount=$_POST["judgescount"];
    echo $judgescount;

    for($i=0;$i<$judgescount;$i++){
        $JName[$i]=$_POST["JName_".($i+1)];
        echo $JName[0];

    }
}
    // $HName=$_POST["HName"];
    // $HDate=$_POST["HDate"];
    // $HTime=$_POST["HTime"];
    // $MaxP=$_POST["MaxP"];
    // $Category=$_POST["Category"];

    // $query="INSERT INTO hackathon_data(HName,HDate,HTime,MaxP,Category) VALUES (:HName,:HDate,:HTime,:MaxP,:Category);";
    // $stmt=$pdo->prepare($query);
    // $stmt->bindParam(":HName",$HName);
    // $stmt->bindParam(":HDate",$HDate);
    // $stmt->bindParam(":HTime",$HTime);
    // $stmt->bindParam(":MaxP",$MaxP);
    // $stmt->bindParam(":Category",$Category);
    
    // $stmt->execute();
    // header("Location: ../AddJudge.html");
