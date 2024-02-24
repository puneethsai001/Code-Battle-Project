<?php 
 declare(strict_types=1);
 require_once '../includes/dbh.inc.php';
 require_once '../includes/config_session.inc.php';


$query2="SELECT T_id,SUM(Score) as score,TName from scores where C_id=:C_id and J_id=:J_id";
$stmt2=$pdo->prepare($query2);

if(isset($_POST['Jr_Cadet'])){
    $_SESSION['CName']=$_POST['Jr_Cadet'];
    $val=1;
    $stmt2->bindParam(":C_id",$val);
    $stmt2->bindParam(":J_id",$_SESSION['J_id']);
   $stmt2->execute();
   $result=$stmt2->fetchAll();
}
if(isset($_POST['Jr_Colonel'])){
    $_SESSION['CName']=$_POST['Jr_Colonel'];
    $val=2;
    $stmt2->bindParam(":C_id",$val);
    $stmt2->bindParam(":J_id",$_SESSION['J_id']);
    $stmt2->execute();
    $result=$stmt2->fetchAll();
 }
 if(isset($_POST['Jr_Captain'])){
    $_SESSION['CName']=$_POST['Jr_Captain'];
    $val=3;
    $stmt2->bindParam(":C_id",$val);
    $stmt2->bindParam(":J_id",$_SESSION['J_id']);
    $stmt2->execute();
    $result=$stmt2->fetchAll();
 }
if($result){
?>
<html>
    <head>
        <style>
            body{
            font-family: 'Arial', sans-serif;
            color: #F73634;
            margin: 0;
            padding: 0;
            background-color: #272727;
            min-height: 100vh;
        }
        h2{
            text-align: center;
            color: #ffffff;
            margin-top: 100px;
        }

            table {
            text-align: center;
            width: 50%;
            border-collapse: collapse;
            background-color: #F73634;
            margin-left: auto;
            margin-right: auto;
            border-radius: 18px;
        }

        th{
            border-radius: 18px;
            color: white;
            background-color: #F73634;
            font-size: medium;
            padding: 8px;
        } 
        
        
        td {
            /* border-radius: 18px; */
            background-color: white;
            color: black;
            font-size: medium;
            padding: 8px;
            
        }
        </style>
    </head>
    <?php echo '<h2>Teams under '.$_SESSION['CName'].'</h2>'; ?>
<table>
       <tr>
            <th>Team ID</th>
            <th>Team Name</th>
            
            <th>Scores</th>
            
            
        </tr>
        <?php
        foreach($result as $row){ ?>
            <tr>
                    <td><?php echo $row['T_id'] ?></td>
                    <td><?php echo $row['TName'] ?></td>
                    <td><?php echo $row['score'] ?></td>

            </tr>
         <?php  }   ?>
</table>



    <?php } else{ ?>
    <table>
       <tr>
            <td><h1 style="color: #F73634;">No Teams</h1></td>
        </tr> 
    </table>
    <?php } ?>
</html>
