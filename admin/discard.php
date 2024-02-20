<?php

declare(strict_types=1);
require_once "../includes/dbh.inc.php";
require_once "../includes/config_session.inc.php";

function discarding(PDO $pdo){
    $query3 = "DELETE FROM hackathon_data 
           WHERE H_id NOT IN (SELECT H_id FROM judges_data) 
           AND H_id NOT IN (SELECT H_id FROM criteria_data)";
    $stmt3 = $pdo->prepare($query3);
    $stmt3->execute();
    unset($_SESSION['H_created']);
    unset($_SESSION['H_judges_added']);
    unset($_SESSION['H_criteria_added']);
    header("Location: admin.php");
}
discarding($pdo);