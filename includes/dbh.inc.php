//first 

<?php
$dsn="mysql:host=localhost;dbname=login_data";
$dbusername = "root";
$dbpassword = "";
try{
    $pdo=new PDO($dsn,$dbusername,$dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

}catch(PDOException $e){
    echo "CONEECTION FAILED: ".$e->getMessage();
}