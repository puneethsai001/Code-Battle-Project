<?php
    declare(strict_types=1);
    require_once '../includes/dbh.inc.php';
    require_once '../includes/config_session.inc.php';
    require_once 'judgecatdata.php'; 
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
      background-color: #272727;
      color: white;
      min-height: 100vh;
      margin: 0;
      padding: 0;
    }

    button {
      background-color: #F73634;
      border: none;
      border-radius: 1rem;
      color: #fff;
      cursor: pointer;
      font-size: small;
      padding: 1rem 2rem;
    }

    .button-container {
      text-align: center;
      margin-top: 2rem;
    }

    button:hover {          
      background-color: #000000;
      color: #ffffff;
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
      height: 400px; /* Adjust the height of the card */
    }

    .card:hover {
      transform: scale(1.15);
      box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2), 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .card > form {
      display: flex;
      flex-direction: column;
      height: 100%;
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
      background-color: rgb(80, 80, 228);
    }

    .colonel .card-text {
      background-color: #e95c59;
    }

    .captain .card-text {
      background-color: rgb(100, 181, 19);
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
    }

   footer {
        background-color: black;
        color: #ffffff; 
        padding: 5px;
        text-align: center;
        position: sticky;
        top: 100%;
    }
  </style>

  <script>
    function divClick(div) {
      var cardvalue = div.getAttribute('value');
      var form = div.querySelector('form');
      form.submit();
    }

    window.onload = function() {
      <?php foreach($result as $row){ ?>
        <?php if($row['CName'] == 'Jr_Cadet'){ ?>
          var cadetCard = document.getElementById("cadet-card");
          cadetCard.style.display = "block";
          cadetCard.addEventListener('click', function() {
            divClick(cadetCard)}
          );
        <?php } ?>
        <?php if($row['CName'] == 'Jr_Colonel'){ ?>
          var colonelCard = document.getElementById("colonel-card");
          colonelCard.style.display = "block";
          colonelCard.addEventListener('click', function() {
            divClick(colonelCard)}
          );
        <?php } ?>
        <?php if($row['CName'] == 'Jr_Captain'){ ?>
          var captainCard = document.getElementById("captain-card");
          captainCard.style.display = "block";
          captainCard.addEventListener('click', function() {
            divClick(captainCard)}
          );
        <?php } ?>
      <?php } ?>
    }
  </script>
</head>
<body>
  <?php
    echo '<h1><font color="#F73634">Welcome</font> <font color="#FFFFFF">'.$_SESSION["user_username"].',</font></h1>';
  ?>

  <h1 class="team-heading">Select the category you wish to judge</h1>

  <div class="all-cards">
    <div class="card cadet" id="cadet-card" style="display: none;">
      <form action="teams.php" method="POST">
        <input type="hidden" name="Jr_Cadet" value="Jr_Cadet">
        <div class="card-image" style="background-image: url('https://th.bing.com/th/id/R.79f52f73b10746ec95ae68cdba347949?rik=Fx%2fDGsQ5bIc3YQ&pid=ImgRaw&r=0');"></div>
        <div class="card-text">
          <h2>Jr Cadet</h2>
          <p>The Jr Cadet category in the hackathon is designed for young minds brimming with potential, specifically targeting students from Grades 1 to 4.</p>
        </div>
      </form>
    </div>

    <div class="card colonel" id="colonel-card" style="display: none;">
      <form action="teams.php" method="POST">
        <input type="hidden" name="Jr_Colonel" value="Jr_Colonel">
        <div class="card-image" style="background-image: url('https://th.bing.com/th/id/R.79f52f73b10746ec95ae68cdba347949?rik=Fx%2fDGsQ5bIc3YQ&pid=ImgRaw&r=0');"></div>
        <div class="card-text">
          <h2>Jr Colonel</h2>
          <p>The Jr Colonel category in the hackathon welcomes high schoolers and young minds embarking on their undergraduate journeys, encompassing students from Grades 9-12 and first-year undergraduates.</p>
        </div>
      </form>
    </div>

    <div class="card captain" id="captain-card" style="display: none;">
      <form action="teams.php" method="POST">
        <input type="hidden" name="Jr_Captain" value="Jr_Captain">
        <div class="card-image" style="background-image: url('https://th.bing.com/th/id/R.79f52f73b10746ec95ae68cdba347949?rik=Fx%2fDGsQ5bIc3YQ&pid=ImgRaw&r=0');"></div>
        <div class="card-text">
          <h2>Jr Captain</h2>
          <p>The Jr Captain category in the hackathon sets sail for students in Grades 5-8, a period marked by burgeoning independence, intellectual curiosity, and a thirst for exploration.</p>
        </div>
      </form>
    </div>
  </div>

  <div class="button-container">
    <button>View Scoreboard</button>
  </div>

  <footer>
    <p>Code Battle &copy; 2024. All rights reserved. Made in U.A.E</p>
  </footer>
</body>
</html>