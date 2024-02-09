<?php
require_once "../includes/config_session.inc.php";

function logout(){
    session_start();
    session_unset();
    session_destroy();
    header("Location: ../index.php");
    die();
}

function open_create_hackathon(){
    if($_SESSION['H_created']!=1){
        header("Location: Createhackathon/Hcreate.html");
        die();
    }
    if($_SESSION['H_judges_added']!=1){
        header("Location: Createhackathon/AddJudge.html");
        die();
    }
    if($_SESSION['H_criteria_added']!=1){
        header("Location: Createhackathon/AddCriteria.html");
        die();
    }
}



if ($_SESSION["user_isadmin"]==1){
    echo $_SESSION["user_isadmin"];

    if (isset($_POST['logout'])){     
        logout();
    }
    if (isset($_POST['create_hackathon'])){  
        open_create_hackathon();
    }
}