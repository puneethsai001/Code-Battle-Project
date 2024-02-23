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
      body{
          font-family: 'Arial', sans-serif;
          background-color: #272727;
          color: white;
          min-height: 100vh;
          margin: 0;
          padding: 0;
      }

      .card {
        display: grid;
        grid-template-columns: 300px;
        grid-template-rows: 210px 210px 80px;
        grid-template-areas: "image" "text" "stats";

        border-radius: 18px;
        box-shadow: 5px 5px 15px rgba(0,0,0,0.9);
        font-family: 'Arial', sans-serif;
        text-align: center;
        margin-left: 2em;
        margin-bottom: 2em;
        background-color: #F73634;
      }

      #colonel-card{
        display: none;
        background-color: rgb(80, 80, 228);
      }

      #captain-card{
        display: none;
        background-color: #e95c59;
      }

      #cadet-card{
        display: none;
        background-color: rgb(100, 181, 19);
      }

      .card-text {
        grid-area: text;
        margin: 25px;
      }
      
      .card-text p {
        font-size:15px;
        font-weight: 300;
      }
      .card-text h2 {
        margin-top:0px;
        font-size:28px;
      }

      #colonel-image, #captain-image, #cadet-image {
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
        background-size: cover;
        background-color: #aaaaaa;
      }

      .card:hover {
        transform: scale(1.15);
        box-shadow: 5px 5px 15px rgba(0,0,0,0.6);
        cursor: pointer;
      }

      .all-cards{
        display: flex;
        width: 70%;
        /* margin-left: auto; */
        margin-right: auto;
      }

      .team-heading{
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
  </head>
  <body>
    <?php
          echo '<h1><font color="#F73634">Welcome</font> <font color="#FFFFFF">'.$_SESSION["user_username"].',</font></h1>';
    ?>
    <h1 class = "team-heading">Select the category you wish to judge</h1>

    <div class = "all-cards">
        <div class="card" id="cadet-card" >
            <div class="card-text">
              <div id="cadet-image">
                <img src="../Images/error404.jpg" width="450" height="200">
              </div>
              <h2>Jr Cadet</h2>
              <p>
                The Jr Cadet category in the hackathon is designed 
                for young minds brimming with potential, specifically 
                targeting students from Grades 1 to 4.
              </p>
            </div>
        </div>
        <div class="card" id = "colonel-card">
          <div class="card-text">
            <div id="cadet-image">
              <img src="../Images/error404.jpg" width="450" height="200">
            </div>
            <h2>Jr Colonel</h2>
            <p>The Jr Colonel category in the hackathon welcomes high 
              schoolers and young minds embarking on their undergraduate 
              journeys, encompassing students from Grades 9-12 and first-year 
              undergraduates.
            </p>
          </div>
        </div>
        <div class="card" id = "captain-card">
          <div class="card-text">
            <div id="cadet-image">
              <img src="../Images/error404.jpg" width="450" height="200">
            </div>
            <h2>Jr Captain</h2>
            <p>The Jr Captain category in the hackathon sets sail for students in 
              Grades 5-8, a period marked by burgeoning independence, intellectual 
              curiosity, and a thirst for exploration.
            </p>
          </div>
        </div> 
    </div>

    <footer>

      <p>Code Battle &copy; 2024. All rights reserved. Made in U.A.E</p>
      <p>Contact us at: info@codebattle.com</p>

    </footer>

    <script>
        window.onload = function() {
      <?php 
          foreach($result as $row){   
      ?>
                  <?php 
                  if( $row['CName']=='Jr_Cadet'){
                  ?>
                  var cadetCard = document.getElementById("cadet-card");
                  cadetCard.style.display = "block";
                      
                  <?php 
                      }
                      if($row['CName']=='Jr_Colonel'){ 
                  ?>
                      var colonelCard = document.getElementById("colonel-card");
                      colonelCard.style.display = "block";
                  <?php 
                      } 
                      if(($row['CName']=='Jr_Captain')){ 
                  ?>
                      var captainCard = document.getElementById("captain-card");
                      captainCard.style.display = "block";
                  <?php 
                      }
                  ?>
          <?php } ?>
          }
    </script>

  </body>
</html>