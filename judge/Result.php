<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once '../includes/dbh.inc.php';
require_once '../includes/config_session.inc.php';

    $query1="SELECT T_id, TName, ROUND(AVG(J_score),0) as Total_Score
    FROM (SELECT T_id, TName, AVG(Score) as J_score from scores WHERE H_id=:H_id
    GROUP BY T_id,J_id) as subquery 
    GROUP BY T_id
    ORDER BY Total_Score DESC";

    $stmt1=$pdo->prepare($query1);
    $stmt1->bindParam(":H_id",$_SESSION['H_id']);
    $stmt1->execute();
    $result1=$stmt1->fetchAll();
    
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
            background-color: #272727;
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
            border-radius: 1rem;
            color: #fff;
            cursor: pointer;
            font-size: large;
            padding: 5px 15px;
            margin-left: 1em;
        }

        button:hover{
            background-color: #000000;
            color: #ffffff;
        }
        .button-container {
            text-align: center;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

    </style>
</head>
<body>
    <a href="index.html">
        <img src="../Images/Logo.png", height="100">
    </a>
    <h1>Final <font color = "white">Scoreboard</font></h1>



    <table>
       <tr>
            <th>Team ID</th>
            <th>Team Name</th>
            <th>Scores</th>
        </tr>
        <?php if($result1){
        foreach($result1 as $row){ ?>
                <tr>
                        <td><?php echo $row['T_id'] ?></td>
                        <td><?php echo $row['TName'] ?></td>
                        <td><?php echo $row['Total_Score'] ?></td>
                        
                </tr>
            <?php  }   ?>
            </table>


        <?php }else{ ?>
            <table>
            
        <tr>
        <td><h1 style="color: #F73634;">No teams graded</h1></td>    
        </tr> </table>

    <?php }?>
    <div class="button-container">
    <form action="judge_functions.php" method="POST">
        <button type="submit" name="logout">Log Out</button>
    </form>
</div>
</body>

<footer>
    <p>Code Battle &copy; 2024. All rights reserved. Made in U.A.E</p>
    <p>Contact us at: info@codebattle.com</p>
</footer>

</html>
