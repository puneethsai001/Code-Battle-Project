<?php

declare(strict_types=1);

//pdo is db objec
function get_userdata(object $pdo,string $username){
        $query="SELECT* from login_data where username= :username;";
        $stmt=$pdo->prepare($query);
        $stmt->bindParam(":username",$username);
        $stmt->execute();

        //grabbing one data 
        $result=$stmt->fetch(PDO::FETCH_ASSOC);
        return $result;

        //if there is a row it returns an array result if no value it returns 0 false
}

