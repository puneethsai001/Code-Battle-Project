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

        $query2="SELECT(H_id) from hackathon_data where HName=:HName;";
        $stmt=$pdo->prepare($query2);
        $_SESSION['HName']=$HName;
        $stmt->bindParam(":HName",$HName);
        $stmt->execute();

        $H_id = $stmt->fetchColumn();

        $_SESSION['HName']=$HName;
        $_SESSION['H_id']=$H_id;
        $_SESSION['H_created']=1;



        // echo $_SESSION['H_id'];
        header("Location: AddJudge.html");
        
    }