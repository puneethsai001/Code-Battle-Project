<?php 
 declare(strict_types=1);
 require_once '../includes/dbh.inc.php';
 require_once '../includes/config_session.inc.php';


$query2="SELECT * from team_data where  H_id=:H_id AND C_id=(SELECT C_id from category where Cname=:Cname) ";
$stmt2=$pdo->prepare($query2);

if(isset($_POST['Jr_Cadet'])){
    $_SESSION['CName']=$_POST['Jr_Cadet'];
   $stmt2->bindParam(":Cname",$_POST['Jr_Cadet']);
//    echo $_SESSION['H_id'];
   $stmt2->bindParam(":H_id",$_SESSION['H_id']);
   $stmt2->execute();
   $result=$stmt2->fetchAll();
}
if(isset($_POST['Jr_Colonel'])){
    $_SESSION['CName']=$_POST['Jr_Colonel'];
    $stmt2->bindParam(":Cname",$_POST['Jr_Colonel']);
    $stmt2->bindParam(":H_id",$_SESSION['H_id']);
    $stmt2->execute();
    $result=$stmt2->fetchAll();
 }
 if(isset($_POST['Jr_Captain'])){
    $_SESSION['CName']=$_POST['Jr_Captain'];
    $stmt2->bindParam(":Cname",$_POST['Jr_Captain']);
    $stmt2->bindParam(":H_id",$_SESSION['H_id']);
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
            <th>School</th>
            <th>Scores</th>
            
            
        </tr>
        <?php
        foreach($result as $row){ ?>
            <tr>
                    <td><?php echo $row['T_id'] ?></td>
                    <td><?php echo $row['TName'] ?></td>
                    <td><?php echo $row['TSchool'] ?></td>
                    <td><?php echo $row['TScore'] ?></td>

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
