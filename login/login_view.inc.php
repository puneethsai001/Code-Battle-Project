<?php

declare(strict_types=1);



function check_login_errors(){
    if(isset($_SESSION["errors_login"])){
        $errors=$_SESSION["errors_login"];

        echo "<br>";

        foreach($errors as $error){
            echo '<h2 style="color: #F73634;">';
                echo $error;
            '</h2>';
        }

        unset($_SESSION["errors_login"]);

    }
    else if(isset($_GET["login"])&&$_GET["login"]==="success"){
        header("Location: admin/Admin.php");
        die();
    }
}
function output_success_login(){
    if(isset($_SESSION["user_id"])){
        
        echo "you are logged in as ".$_SESSION["user_username"];
    }
    else{
        // echo "you are not logged in";
    }
}