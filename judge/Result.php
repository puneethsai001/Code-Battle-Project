<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once '../includes/dbh.inc.php';
require_once '../includes/config_session.inc.php';
// Modified by harsh
    $query1 = "SELECT T_id, TName, ROUND(AVG(J_score)) as Total_Score
           FROM (SELECT T_id, TName, SUM(Score) as J_score 
                 FROM scores 
                 WHERE H_id=:H_id
                 GROUP BY T_id, J_id) as subquery 
           GROUP BY T_id
           ORDER BY Total_Score DESC";

    $stmt1=$pdo->prepare($query1);
    $stmt1->bindParam(":H_id",$_SESSION['H_id']);
    $stmt1->execute();
    $teams=$stmt1->fetchAll();

    $q5="SELECT * FROM criteria_data WHERE H_id=:H_id";
    $s5=$pdo->prepare($q5);
    $s5->bindParam(":H_id",$_SESSION['H_id']);
    $s5->execute();
    //found
    $criterias=$s5->fetchAll(PDO::FETCH_ASSOC);
    // var_dump($criterias);
// Modified by harsh
    $q7="Select ROUND(AVG(Score)) from scores where H_id=:H_id and T_id=:T_id and CR_id In (SELECT CR_id FROM criteria_data WHERE CRName =:CRName)";
$s7=$pdo->prepare($q7);
$s7->bindParam(":H_id",$_SESSION['H_id']);
    
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Code Battle - Scoreboard</title>
    <style>
        img{
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        body {
            min-height: 100vh;
            font-family: 'Arial', sans-serif;
            background-color: #E3E3E3;
            background-image: url(../Images/grids.jpeg);
            background-size: cover;
            color: #F73634;
            margin: 0;
            padding: 0;
        }

        image{
            align-content: center;
        }

        table {
            text-align: center;
            width: 50%;
            border-collapse: collapse;
            background-color: #F73634;
            margin-left: auto;
            margin-right: auto;
            border-radius: 18px;
            margin-bottom: 4rem;
        }

        th{
            border-radius: 18px;
            color: white;
            background-color: #F73634;
            font-size: medium;
            padding: 8px;
        }

        td{
            background-color: white;
            color: black;
            font-size: medium;
            padding: 8px;
        }

        footer {
            background-color: black;
            color: #ffffff; 
            padding: 8px;
            text-align: center;
            position: sticky;
            top: 100%;
        }

        h1{
            text-align: center;
        }
        .button-wrapper {
            margin: 1rem;
        }

        button {
            background-color: #F73634;
            border: none;
            color: #fff;
            cursor: pointer;
            font-size: large;
            padding: 5px 30px; 
            margin-left: 1em;
            border-radius: 18px;
            font-weight: bold;
        }

        .button-container {
            text-align: center;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            background-color: #F73634;
            padding: 15px;
        }

        button:hover {          
            text-decoration: underline;
        }

        .preloader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: #272727;
        color:#F73634;
        font-size: x-large;
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .loader {
        border: 8px solid #0000007c;
        border-top: 8px solid #F73634;
        border-radius: 50%;
        width: 60px;
        height: 60px;
        animation: spin 2s linear infinite;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    </style>
</head>
<body>
<div class="preloader">
  <div class="loader"></div>
</div>
    <div class="button-container">
        <!-- <form action="judge.php" method="POST"> -->
          <button name="view-scoreboard" onClick="window.location.href='judge.php';">Home</button>
        <!-- </form> -->
        <!-- <form action="judge_functions.php" method="POST"> -->
          <button name="view-scoreboard" onClick="window.location.href='Result.php';">View Scoreboard</button>
        <!-- </form> -->
        <!-- <form action="otherjudges.php" method="POST"> -->
          <button name="update" onClick="window.location.href='otherjudges.php';">Other Judges Score</button>
        <!-- </form> -->
        <!-- <form action="updatescores.php" > -->
          <button name="update" onClick="window.location.href='updatescores.php';">Update Score</button>
        <!-- </form> -->
        <form action="judge_functions.php" method="POST">
          <button type="submit" name="logout">Log Out</button>
        </form>
      </div>

    <h1><font color = "black">Final </font>Scoreboard</h1>
    <?php if($teams){?>
    <table>
       <tr>
           <th>Team ID</th>
           <th>Team Name</th>
           <?php foreach($criterias as $criteria){?> 
            <th><?php echo $criteria['CRName']?></th>
            <?php }?>
            <th>Scores</th>
        </tr>
        
        <?php foreach($teams as $team){?>
                <tr>
                    <td><?php echo $team['T_id'] ?></td>
                    <td><?php echo $team['TName'] ?></td>
                        <?php $s7->bindParam(":T_id",$team['T_id']);
                         foreach($criterias as $criteria){
                            $s7->bindParam(":CRName",$criteria['CRName']);
                            $s7->execute();
                            //criteria_sum found
                            $criteria_sum=$s7->fetchColumn();?>
                            <td><?php echo $criteria_sum;?></td>
                        <?php }?>
                        <td><?php echo $team['Total_Score'] ?></td>
                        
                </tr>
                <?php  }   ?>
            </table>


        <?php }else{ ?>
            
            
        
        <?php echo "<h1><font color=\"black\">No teams graded</font></h1>"; ?></td>
           

    <?php }?>
    <script>

        function load(){
            const preloader = document.querySelector('.preloader');
            preloader.style.display = 'none';
        }

        window.addEventListener('load', load);
        
</script>
</body>

<footer>
    <p>Code Battle &copy; 2024. All rights reserved. Made in U.A.E</p>
    <p>Contact us at: info@codebattle.com</p>
</footer>

</html>
