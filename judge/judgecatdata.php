<?php
    declare(strict_types=1);
    require_once '../includes/dbh.inc.php';
    require_once '../includes/config_session.inc.php';

    $query1 = "SELECT H_id, J_id FROM judges_category WHERE username=:username;";
    $stmt = $pdo->prepare($query1);
    $username = $_SESSION['user_username'];
    $stmt->bindParam(":username", $username);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $H_id = $row['H_id'];
    $J_id = $row['J_id'];

    $_SESSION['H_id'] = $H_id;
    $_SESSION['J_id'] = $J_id;
   

    // echo $H_id;
    $query2="SELECT * FROM `judges_category` where H_id=:H_id AND username=:username group by C_id;";
    $stmt=$pdo->prepare($query2);
    $stmt->bindParam(":H_id",$H_id);
    $stmt->bindParam(":username",$username);
   
    $stmt->execute();
    $result=$stmt->fetchAll();
    

