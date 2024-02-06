<?php

declare(strict_types=1);



function check_login_errors(){
    if(isset($_SESSION["errors_login"])){
        $errors=$_SESSION["errors_login"];

        echo "<br>";

        foreach($errors as $error){
            echo '<h2 style="color: red;">';
                echo $error;
            '</h2>';
        }

        unset($_SESSION["errors_login"]);

    }
    else if(isset($_GET["login"])&&$_GET["login"]==="success"){
        header("Location: Admin.html");
        echo '<h2 style="color: green;">Login success</h2>';
    }
}
function output_username(){
    if(isset($_SESSION["user_id"])){
        $r=session_id();
        echo "session id = ".$r."<br>";
        echo "you are logged in as ".$_SESSION["user_username"]."  ".$_SESSION["user_id"];
    }
    else{
        // echo "you are not logged in";
    }
}