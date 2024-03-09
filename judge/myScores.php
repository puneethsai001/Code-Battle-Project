<?php
declare(strict_types=1);

require_once '../includes/dbh.inc.php';
require_once '../includes/config_session.inc.php';

// if teams exist
$query1 = "SELECT * FROM scores WHERE H_id=:H_id;";
$stmt1 = $pdo->prepare($query1);
$stmt1->bindParam(":H_id", $_SESSION['H_id']);
$stmt1->execute();
$result1 = $stmt1->fetchAll();
if (!($result1)) {
    echo "<h1>No Team have been Graded Yet.</h1>";
    die();
}


$query2 = "SELECT * FROM `judges_category` WHERE H_id=:H_id AND J_id=:J_id GROUP BY C_id;";
$stmt2 = $pdo->prepare($query2);
$stmt2->bindParam(":H_id", $_SESSION['H_id']);
$stmt2->bindParam(":J_id", $_SESSION['J_id']);
$stmt2->execute();
$categories = $stmt2->fetchAll(PDO::FETCH_ASSOC);


// fetching teams(card)
$q2 = "SELECT * FROM team_data WHERE H_id=:H_id AND T_id IN (SELECT T_id FROM scores WHERE H_id=:H_id AND J_id=:J_id and  C_id IN ( SELECT C_id FROM category WHERE CName =:CName))";
$s2 = $pdo->prepare($q2);
$s2->bindParam(":H_id", $_SESSION['H_id']);
$s2->bindParam(":J_id", $_SESSION['J_id']);

// fetching judges from the score table that have graded, joining to find their names(rows)
$q4 = "SELECT DISTINCT scores.J_id, judges_data.JName 
FROM scores 
LEFT JOIN judges_data ON scores.J_id = judges_data.J_id 
WHERE scores.H_id = :H_id AND scores.T_id = :T_id AND scores.J_id = :J_id;";
$s4 = $pdo->prepare($q4);
$s4->bindParam(":H_id", $_SESSION['H_id']);
$s4->bindParam(":J_id", $_SESSION['J_id']);

// fetching criterias allowed (columns)
$q5 = "SELECT * FROM criteria_data WHERE H_id=:H_id";
$s5 = $pdo->prepare($q5);
$s5->bindParam(":H_id", $_SESSION['H_id']);
$s5->execute();
// found
$criterias = $s5->fetchAll(PDO::FETCH_ASSOC);

// finding score for a team by the current judge
$q6 = "SELECT Score FROM scores WHERE H_id=:H_id AND T_id=:T_id AND J_id=:J_id AND CR_id IN (SELECT CR_id FROM criteria_data WHERE CRName =:CRName)";
$s6 = $pdo->prepare($q6);
$s6->bindParam(":H_id", $_SESSION['H_id']);
$s6->bindParam(":J_id", $_SESSION['J_id']);

// calculating sum of different criterias
$q7 = "SELECT SUM(Score) FROM scores WHERE H_id=:H_id AND T_id=:T_id AND CR_id IN (SELECT CR_id FROM criteria_data WHERE CRName =:CRName)";
$s7 = $pdo->prepare($q7);
$s7->bindParam(":H_id", $_SESSION['H_id']);

// initializing 
$team_sum = 0;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Code Battle - Other Scores</title>

    <style>
        body {
            width: 100%;
            height: 100vh;
            margin: 0;
            background-color: #E3E3E3;
            background-image: url(../Images/grids.jpeg);
            background-size: cover;
            color: black;
            font-family: Tahoma;
            font-size: 16px;
        }

        h1{
            text-align: center;
            font-size: xx-large;
            margin-top: 2rem;
            padding: 0.5rem 0 0.5rem 2rem;
        }
        
        .MainContainer {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            padding: 20px;
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
        
        .TeamCard {
            margin: 20px;
            padding: 20px;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            max-width: 250px;
            width: calc(50% - 40px); 
            display: none;
        }

        .TeamCard:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.2);
        }

        .TeamCard h1 {
            font-size: 16px;
            margin-bottom: 10px;
            color: #333;
            text-align: left;
        }

        .TeamCard p {
            font-size: 16px;
            margin-bottom: 10px;
            color: #666;
        }

        .JudgeInfo {
            margin-top: 20px;
            width: calc(50% - 40px); /* Adjust the width */
            overflow-x: auto;
        }

        table {
            width: 60%;
            border-collapse: collapse;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #f73634;
            color: white;
        }

        td {
            background-color: #fff;
            color: #333;
        }

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


        
    <div>
    <?php
    foreach ($categories as $category) {
       
        //searching for teams with that category
        $s2->bindParam(":CName", $category['CName']);

        $s2->execute();
        $teams=$s2->fetchAll(PDO::FETCH_ASSOC);
        
        if (!empty($teams)){?>
            <h1><?php  echo $category['CName']?></h1>
            <div class="MainContainer">
                <table>
                    <tr>
                        <th>Team Name</th> <!-- Added team name header -->
                        <?php foreach($criterias as $criteria):?>
                            <!-- //printing criteria columns -->
                            <th><?php echo $criteria['CRName']." (Weight: ".$criteria['CRWeight'].")";?></th>
                        <?php endforeach; ?>
                        <th>Total</th>
                    </tr>
                <?php }?>
                <?php foreach($teams as $team){?>
                    <tr>
                        <td><?php echo $team['TName']; ?></td> <!-- Team name cell -->
                        <?php
                        $s4->bindParam(":T_id",$team['T_id']);
                        $s4->execute();
                        //judges found
                        $judges=$s4->fetchAll(PDO::FETCH_ASSOC);

                        $s6->bindParam(":T_id",$team['T_id']);
                        $s7->bindParam(":T_id",$team['T_id']);
                        ?>
                        <?php foreach($judges as $judge):?>
                            <?php foreach($criterias as $criteria):?>
                                <?php 
                                $s6->bindParam(":CRName", $criteria['CRName']);
                                $s6->execute();
                                //scores found
                                $scores = $s6->fetchColumn();
                                
                                if(empty($scores)){
                                    $scores = 0;
                                }

                                //calculating the total for a team by adding all scores
                                $team_sum = $team_sum + $scores;
                                ?>
                                <td><?php echo $scores; ?></td>
                            <?php endforeach; ?>
                            <td><?php echo $team_sum; $team_sum = 0; ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php }?>
            </table>
        </div>
    <?php }?>

        </div>
        
        
        
    <footer>
    <p>Code Battle &copy; 2024. All rights reserved. Made with ❤️ in U.A.E</p>
    </footer>

    <script>

        function load(){
            const preloader = document.querySelector('.preloader');
            preloader.style.display = 'none';
        }

        window.addEventListener('load', load);
        
</script>
</body>
</html>
