<?php

declare(strict_types=1);

function is_input_empty(string $username,string $pwd){
    if (empty($username)||empty($pwd)){
        return true;
    }
    else {
        return false;
    }
}

//pdo is db objec
function is_username_wrong($result){
    //if result is false
    if ($result==0){
        //username not found in db
        return true;
    }
    else{
        return false;
    }    
}

function is_password_wrong(string $pwd,string $storedPwd){
    //if passwords donot match 
   
    if (!password_verify($pwd,$storedPwd) ){
        //username not found in db
        return true;
    }
    else{
        return false;
    }    
}
