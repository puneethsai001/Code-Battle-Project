<?php

if ($_SERVER["REQUEST_METHOD"]=="POST"){
    $username=$_POST["username"];
    $pwd=$_POST["pwd"];
    
    try{
        require_once "dbh.inc.php";
        $query="INSERT INTO judge_login(J_username,J_password)VALUES(:username,:pwd);";
        $stmt =$pdo->prepare($query);
        $stmt->bindParam(":username",$username);
        $stmt->bindParam(":pwd",$pwd);
        $stmt->execute();

        $pdo=null;
        $stmt=null;

        header("Location: ../index.php");

        die();

    }catch(PDOException $e){

        die("QUERY FAILED: ".$e->getMessage());

    }
}
else{
    header("Location: ../index.php");
}