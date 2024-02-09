<?php

declare(strict_types=1);
require_once '../../includes/dbh.inc.php';
require_once '../../includes/config_session.inc.php';
// require_once 'accept_hackathon_data.php';

//pdo is db object
if(!isset($_SESSION['H_judges_added'])){
    if ($_SERVER["REQUEST_METHOD"]=="POST"){
        
        $judgescount=$_POST["judgescount"];

        $query="INSERT INTO judges_data(JName,JEmail,JUsername,JPass,H_id) VALUES (:JName,:JEmail,:JUsername,:JPass,:H_id);";
        $stmt=$pdo->prepare($query);
        for($i=0;$i<$judgescount;$i++){
            $JName[$i]=$_POST["JName_".($i+1)];
            $JEmail[$i]=$_POST["JEmail_".($i+1)];
            $JUsername[$i]=$_POST["JUsername_".($i+1)];
            $JPass[$i]=$_POST["JPass_".($i+1)];
            
            $stmt->bindParam(":JName",$JName[$i]);
            $stmt->bindParam(":JEmail",$JEmail[$i]);
            $stmt->bindParam(":JUsername",$JUsername[$i]);

            $options = [
                'cost' => 12
            ];
            $hashedPwd=password_hash($JPass[$i],PASSWORD_BCRYPT,$options);
            $stmt->bindParam(":JPass",$hashedPwd);
            $stmt->bindParam(":H_id",$_SESSION['H_id']);
            $stmt->execute();
        }
        $_SESSION['H_judges_added']=1;
        // $ans=isset($_SESSION['HName']);
        // echo $ans;
        
        header("Location: AddCriteria.html");
    }
}
else{
    header("Location: AddCriteria.html");
}