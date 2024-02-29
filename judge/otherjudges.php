<?php
declare(strict_types=1);
require_once '../includes/dbh.inc.php';
require_once '../includes/config_session.inc.php';

// if teams exist
$query1="SELECT * from scores where H_id=:H_id;";
$stmt1=$pdo->prepare($query1);
$stmt1->bindParam("H_id",$_SESSION['H_id']);
$stmt1->execute();
$result1=$stmt1->fetchAll();
if(!($result1)){
    echo "<h1>No Team have been Graded Yet.</h1>";
    die();
}

//fetching categories allowed(categories)
$q1="SELECT Jr_Cadet,Jr_Captain,Jr_Colonel from hackathon_data where H_id=:H_id;";
$s1=$pdo->prepare($q1);
$s1->bindParam("H_id",$_SESSION['H_id']);
$s1->execute();
//found
$category=$s1->fetch(PDO::FETCH_ASSOC);

//fetching teams(card)
$q2="SELECT * from team_data where H_id=:H_id and T_id IN (SELECT T_id FROM scores WHERE H_id=:H_id and C_id IN ( SELECT C_id FROM category WHERE CName =:CName))";
$s2=$pdo->prepare($q2);
$s2->bindParam(":H_id",$_SESSION['H_id']);


//fetching judges from the score table that have graded, joining to find their names(rows)
$q4="SELECT DISTINCT scores.J_id, judges_data.JName 
FROM scores 
LEFT JOIN judges_data ON scores.J_id = judges_data.J_id 
WHERE scores.H_id = :H_id AND scores.T_id = :T_id;
";
$s4=$pdo->prepare($q4);
$s4->bindParam(":H_id",$_SESSION['H_id']);

//fetching criterias allowed (columns)
$q5="SELECT * FROM criteria_data WHERE H_id=:H_id";
$s5=$pdo->prepare($q5);
$s5->bindParam(":H_id",$_SESSION['H_id']);
$s5->execute();
//found
$criterias=$s5->fetchAll(PDO::FETCH_ASSOC);

//finding score for a team by all judges
$q6="SELECT Score from scores where H_id=:H_id and T_id=:T_id and J_id=:J_id and CR_id In (SELECT CR_id FROM criteria_data WHERE CRName =:CRName)";
$s6=$pdo->prepare($q6);
$s6->bindParam(":H_id",$_SESSION['H_id']);

//calculating sum of different criterias
$q7="Select SUM(Score) from scores where H_id=:H_id and T_id=:T_id and CR_id In (SELECT CR_id FROM criteria_data WHERE CRName =:CRName)";
$s7=$pdo->prepare($q7);
$s7->bindParam(":H_id",$_SESSION['H_id']);


//initializing 
$team_sum=0;


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Code Battle - Create</title>

    <style>
        body {
            width: 100%;
            height: 100vh;
            margin: 0;
            background-color: #272727;
            color: white;
            font-family: Tahoma;
            font-size: 16px;
        }

        h1{
            text-align: center;
            font-size: xx-large;
            margin-top: 2rem;
            padding: 0.5rem 0 0.5rem 2rem;
        }
        .TeamCard{
            margin-top:2.5rem;
            border-radius: 18px;
            background-color: #F73634;
            text-align: center;
            position: relative;
            padding-top: 1rem;
            width: 20%;
            margin-left:3rem;
            height: 70%;
            text-align: center;
            
            
        }
       

        .MainContainer {
            margin-top:1rem;
            display: flex;
            justify-content: center;
            text-align: center;
            margin: 1em auto;
            background-color: white; 
            border-radius: 25px;
            
            font-weight: bold;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
            height: 40%;
            
        }

        table {
            margin-top:2.5rem;
            font-family: arial, sans-serif;
            color: #000000;
            text-align: center;
            width:100%;
            font-size: large;
            font-weight: 100;
            border-collapse:collapse;
            border-radius: 18px;
            height: 70%

        }
        
        /* #Total{
            font-size: x-large;
            font-weight: bold ;
        } */
        th:first-of-type {
            border-top-left-radius: 18px;
        }
        th:last-of-type {
           
            border-top-right-radius: 18px;
        }

        th {
            
            border: 1px solid black;
            font-size: large;
            color: white;
            background-color: #F73634;
            padding: 8px;
            height: 20%;
            
            
        }
        td{
            font-weight: bold ;
           
            border: 1px solid black;
        }
        /* tr:last-of-type td:first-of-type {
        border-bottom-left-radius: 10px;
        }
        tr:last-of-type td:last-of-type {
        border-bottom-right-radius: 10px;
        } */

        .JudgeInfo{
            width: calc(60%); /* adjust width to fill remaining space */
            margin-left: 20px;
            margin-right: 3rem;

        }

        footer {
            background-color: #000000;
            color: #ffffff; 
            padding: 5px;
            text-align: center;
            position: sticky;
            top: 100%;
        }
    </style>

</head>
<body>
<?php foreach($category as $key=>$value){
    if($value==1){
        //searching for teams with that category
        $s2->bindParam(":CName",$key);
        $s2->execute();
        $teams=$s2->fetchAll(PDO::FETCH_ASSOC);
        
        ?>
            
            
        <H1><?php echo $key?></H1>
        <?php foreach($teams as $team){?>
            <div class="MainContainer">
                <div class="TeamCard">
                    <!-- //displaying team details -->
                    <h1><?php echo $team['TName']?></h1>
                    <H1><?php echo $team['TSchool']?></H1>
                    <h1><?php echo $team['T_id']?></h1>
                    <?php

                    $s4->bindParam(":T_id",$team['T_id']);
                    $s4->execute();
                    //judges found
                    $judges=$s4->fetchAll(PDO::FETCH_ASSOC);

                    $s6->bindParam(":T_id",$team['T_id']);
                    $s7->bindParam(":T_id",$team['T_id']);?>
                </div>
                    
                <div class="JudgeInfo">      
                    <table>
                        <tr>
                            //start of row 1
                            <th>Judge</th>
                            <?php 
                            foreach($criterias as $criteria){?>
                            <!-- //printing criteria columns -->
                                <th><?php echo $criteria['CRName']." (Weight: ".$criteria['CRWeight'].")";?></th>
                            <?php } ?>

                            <th>Total</th>
                            //end of row 1
                        </tr>
                        <?php foreach($judges as $judge){
                            $s6->bindParam(":J_id",$judge['J_id']);?>
                            <tr>
                                <td><?php echo $judge['JName']?></td>
                                <?php foreach($criterias as $criteria){
                                    $s6->bindParam(":CRName",$criteria['CRName']);
                                    $s6->execute();
                                    //scores found
                                    $scores=$s6->fetchColumn();
                                
                                    if(empty($scores)){
                                        $scores=0;
                                    }

                                    //calculating the total for a team by adding all scores

                                    $team_sum=$team_sum+$scores;?>
                                    <td><?php echo $scores?></td>
                                <?php } ?>
                                <td><?php echo $team_sum;$team_sum=0;?></td>
                            </tr>
                        <?php  } ?>
                        <!-- //last row -->
                        <tr>
                            <td>Total</td>
                            <?php foreach($criterias as $criteria){
                                $s7->bindParam(":CRName",$criteria['CRName']);
                                $s7->execute();
                                //criteria_sum found
                                $criteria_sum=$s7->fetchColumn();?>
                                <td><?php echo $criteria_sum;?></td>
                            <?php } ?>
                            <td></td>
                        </tr>
                    </table>
                </div>
            </div>
        <?php }}}?>
    <footer>
        <p>Code Battle &copy; 2024. All rights reserved. Made in U.A.E</p>
        <p>Contact us at: info@codebattle.com</p>
    </footer>
</body>
</html>
