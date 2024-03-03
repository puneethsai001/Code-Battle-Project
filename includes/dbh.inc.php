<?php
$host='localhost';
$dbname='code-battle-db';
$dbusername = 'root';
$dbpassword = '';

$dsn="mysql:host=$host;dbname=$dbname";

try{
    $pdo=new PDO($dsn,$dbusername,$dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

}catch(PDOException $e){
    die( "CONEECTION FAILED: ".$e->getMessage());
    
}