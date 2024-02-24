<?php
    declare(strict_types=1);
    require_once '../includes/dbh.inc.php';
    require_once '../includes/config_session.inc.php';


    //show category cards
    $query1 = "SELECT H_id, J_id FROM judges_category WHERE username=:username;";
    $stmt1 = $pdo->prepare($query1);
    $username = $_SESSION['user_username'];
    $stmt1->bindParam(":username", $username);
    $stmt1->execute();

    $row = $stmt1->fetch(PDO::FETCH_ASSOC);
    $H_id = $row['H_id'];
    $J_id = $row['J_id'];

    $_SESSION['H_id'] = $H_id;
    $_SESSION['J_id'] = $J_id;
   

    // echo $H_id;
    $query2="SELECT * FROM `judges_category` where H_id=:H_id AND username=:username group by C_id;";
    $stmt2=$pdo->prepare($query2);
    $stmt2->bindParam(":H_id",$H_id);
    $stmt2->bindParam(":username",$username);
   
    $stmt2->execute();
    $result2=$stmt2->fetchAll();
    
    //to show teams of category
    $query3="SELECT T_id, TName, SUM(Score) as score
    FROM scores 
    WHERE C_id = :C_id AND J_id =:J_id AND H_id=:H_id
    GROUP BY T_id, TName;";
    $stmt3=$pdo->prepare($query3);
    
    if(isset($_POST['Jr_Cadet'])){
        $_SESSION['CName']=$_POST['Jr_Cadet'];
        $val=1;
        $stmt3->bindParam(":C_id",$val);
        $stmt3->bindParam(":J_id",$_SESSION['J_id']);
        $stmt3->bindParam(":H_id",$_SESSION['H_id']);
       $stmt3->execute();
       $result3=$stmt3->fetchAll(PDO::FETCH_ASSOC);
       
    }
    if(isset($_POST['Jr_Colonel'])){
        $_SESSION['CName']=$_POST['Jr_Colonel'];
        $val=2;
        $stmt3->bindParam(":C_id",$val);
        $stmt3->bindParam(":J_id",$_SESSION['J_id']);
        $stmt3->bindParam(":H_id",$_SESSION['H_id']);
        $stmt3->execute();
        $result3=$stmt3->fetchAll(PDO::FETCH_ASSOC);
     }
     if(isset($_POST['Jr_Captain'])){
        $_SESSION['CName']=$_POST['Jr_Captain'];
        $val=3;
        $stmt3->bindParam(":C_id",$val);
        $stmt3->bindParam(":J_id",$_SESSION['J_id']);
        $stmt3->bindParam(":H_id",$_SESSION['H_id']);
        $stmt3->execute();
        $result3=$stmt3->fetchAll(PDO::FETCH_ASSOC);
        
    }
    