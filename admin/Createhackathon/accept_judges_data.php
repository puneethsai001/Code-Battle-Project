<?php

declare(strict_types=1);
require_once '../../includes/dbh.inc.php';
require_once '../../includes/config_session.inc.php';
// require_once 'accept_hackathon_data.php';

//pdo is db object

    if ($_SERVER["REQUEST_METHOD"]=="POST"){
        
        $_SESSION['judgescount']=$_POST["judgescount"];


        for($i=0;$i<$_SESSION['judgescount'];$i++){
            $_SESSION['JName_$i']=$_POST["JName_".($i+1)];
            $_SESSION['JEmail_$i']=$_POST["JEmail_".($i+1)];
            $_SESSION['JUsername_$i']=$_POST["JUsername_".($i+1)];
            $password = $_POST["JPass_" . ($i + 1)];

            $options = [
                'cost' => 12
            ];

            $hashedPwd=password_hash('password',PASSWORD_BCRYPT,$options);
            $_SESSION['JPass_$i']=$hashedPwd;

        }

        header("Location: AddCriteria.html");
    }
