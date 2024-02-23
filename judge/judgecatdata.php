<?php
    declare(strict_types=1);
    require_once '../includes/dbh.inc.php';
    require_once '../includes/config_session.inc.php';

    $query1="SELECT (H_id) from judges_category where username=:username;";
    $stmt=$pdo->prepare($query1);
    $username=$_SESSION['user_username'];
    $stmt->bindParam(":username",$username);
    $stmt->execute();
    $H_id = $stmt->fetchColumn();
    $_SESSION['H_id']=$H_id;
    // echo $H_id;
    $query2="SELECT * FROM `judges_category` where H_id=:H_id AND username=:username group by C_id;";
    $stmt=$pdo->prepare($query2);
    $stmt->bindParam(":H_id",$H_id);
    $stmt->bindParam(":username",$username);
   
    $stmt->execute();
    $result=$stmt->fetchAll();

