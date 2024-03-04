<?php
    declare(strict_types=1);
    require_once '../includes/dbh.inc.php';
    require_once '../includes/config_session.inc.php';
    if ($_SESSION['user_isadmin']==0) {
    
    //setting session j and h ids
    $query1 = "SELECT H_id, J_id FROM judges_category WHERE username=:username;";
    $stmt1 = $pdo->prepare($query1);
    $username = $_SESSION['user_username'];
    $stmt1->bindParam(":username", $username);
    $stmt1->execute();
    $row = $stmt1->fetch(PDO::FETCH_ASSOC);
    $H_id = $row['H_id'];
    $J_id = $row['J_id'];

    $_SESSION['H_id'] = $H_id;
    $_SESSION['J_id'] = $J_id;
   

    //fetch categories judged by this judge
    $query2="SELECT * FROM `judges_category` where H_id=:H_id AND J_id=:J_id group by C_id;";
    $stmt2=$pdo->prepare($query2);
    $stmt2->bindParam(":H_id",$H_id);
    $stmt2->bindParam(":J_id",$J_id);
    $stmt2->execute();
    $result2=$stmt2->fetchAll();
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Code Battle - Judge</title>
<style>
    body {
      font-family: 'Arial', sans-serif;
      background-color: #E3E3E3;
      color: black;
      min-height: 100vh;
      margin: 0;
      padding: 0;
      background-image: url(../Images/grids.jpeg);
      background-size: cover;
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

    .card {
      display: flex;
      flex-direction: column;
      border-radius: 1rem;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.08);
      overflow: hidden;
      transition: transform 0.2s ease, box-shadow 0.2s ease;
      cursor: pointer;
      margin: 1rem;
      width: 300px; /* Adjust the width of the card */
      height: 450px; /* Adjust the height of the card */
      color:white;
    }

    .card:hover {
      transform: scale(1.15);
      box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2), 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .card-image {
      height: 200px; /* Adjust the height of the image */
      background-size: cover;
      border-top-left-radius: 1rem;
      border-top-right-radius: 1rem;
    }

    .cadet .card-image {
      background-color: #F73634;
    }

    .colonel .card-image {
      background-color: #5050E4;
    }

    .captain .card-image {
      background-color: #E95C59;
    }

    .card-text {
      padding: 1.5rem;
      text-align: center;
      flex-grow: 1;
    }

    .cadet .card-text {
      background-color: #45b6fe;
    }

    .colonel .card-text {
      background-color: #e95c59;
    }

    .captain .card-text {
      background-color: #3fbe7e;
    }
    .card-text {
      height: 450px;
    }
    .card-text h2 {
      margin: 0;
      font-size: 1.5rem;
    }

    .card-text p {
      margin: 0.5rem 0 0;
      font-size: 0.9rem;
      line-height: 1.4;
    }

    .all-cards {
      display: flex;
      justify-content: center;
      margin-top: 2rem;
    }

    .team-heading {
      text-align: center;
      //removed the margin top
      
    }

   footer {
        background-color: black;
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

  <script>
    //sending the category clicked name to teams page
    function divClick(card) {
      var categoryname = card.getAttribute('value');
      window.location.href = 'Team.php?categoryname=' + categoryname;  
    }
    window.onload = function() {
      //displaying category cards
      <?php foreach($result2 as $row){ ?>
        <?php if($row['CName'] == 'Jr_Cadet'){ ?>
          var cadetCard = document.getElementById("cadet-card");
          cadetCard.style.display = "block";
        <?php } ?>
        <?php if($row['CName'] == 'Jr_Colonel'){ ?>
          var colonelCard = document.getElementById("colonel-card");
          colonelCard.style.display = "block";
        <?php } ?>
        <?php if($row['CName'] == 'Jr_Captain'){ ?>
          var captainCard = document.getElementById("captain-card");
          captainCard.style.display = "block";
        <?php } ?>
      <?php } ?>
    }
  </script>
</head>
<body>
<div class="preloader">
  <div class="loader"></div>
  </div>
  <script>
  window.addEventListener('load', function(){
    const preloader = document.querySelector('.preloader');
    preloader.style.display = 'none';
  });
</script>
  <div class="button-container">
    <form action="judge.php" method="POST">
      <button type="submit" name="view-scoreboard">Home</button>
    </form>
    <form action="judge_functions.php" method="POST">
      <button type="submit" name="view-scoreboard">View Scoreboard</button>
    </form>
    <form action="otherjudges.php" method="POST">
      <button type="submit" name="update">Other Judges Score</button>
    </form>
    <form action="updatescores.php" method="POST">
      <button type="submit" name="update">Update Score</button>
    </form>
    <form action="judge_functions.php" method="POST">
      <button type="submit" name="logout">Log Out</button>
    </form>
  </div>

  <?php
  /* changed the font color */
    echo '<h1 class="welcome"><font color="black">Welcome</font> <font color="#F73634">'.$_SESSION["user_username"].',</font></h1>';
  ?> 

  <h1 class="team-heading">Select the category you wish to judge</h1>
  

  <div class="all-cards">
  <!-- <div class="card cadet" id="cadet-card" style="display: none;"> -->
    <div class="card cadet" id="cadet-card" style="display: none;" value="Jr_Cadet" onclick="divClick(this)">
        <div class="card-image" style="background-image: url('https://th.bing.com/th/id/R.79f52f73b10746ec95ae68cdba347949?rik=Fx%2fDGsQ5bIc3YQ&pid=ImgRaw&r=0');"></div>
        <div class="card-text">
          <h2>Jr Cadet</h2>
          <p>The Jr Cadet category in the hackathon is designed for young minds brimming with potential, specifically targeting students from Grades 1 to 4.</p>
        </div>
    </div>
    

    <div class="card colonel" id="colonel-card" style="display: none;" value="Jr_Colonel" onclick="divClick(this)">
        <div class="card-image" style="background-image: url('https://th.bing.com/th/id/R.79f52f73b10746ec95ae68cdba347949?rik=Fx%2fDGsQ5bIc3YQ&pid=ImgRaw&r=0');"></div>
        <div class="card-text">
          <h2>Jr Colonel</h2>
          <p>The Jr Colonel category in the hackathon welcomes high schoolers and young minds embarking on their undergraduate journeys, encompassing students from Grades 9-12 and first-year undergraduates.</p>
        </div>
    </div>

    <div class="card captain" id="captain-card" style="display: none;" value="Jr_Captain" onclick="divClick(this)">
        <div class="card-image" style="background-image: url('https://th.bing.com/th/id/R.79f52f73b10746ec95ae68cdba347949?rik=Fx%2fDGsQ5bIc3YQ&pid=ImgRaw&r=0');"></div>
        <div class="card-text">
          <h2>Jr Captain</h2>
          <p>The Jr Captain category in the hackathon sets sail for students in Grades 5-8, a period marked by burgeoning independence, intellectual curiosity, and a thirst for exploration.</p>
        </div>
    </div>

  </div>

 
  <footer>
    <p>Code Battle &copy; 2024. All rights reserved. Made in U.A.E</p>
  </footer>

</body>

</html>
<?php 
}else{
  header("Location: ../admin/admin.php");
} ?>