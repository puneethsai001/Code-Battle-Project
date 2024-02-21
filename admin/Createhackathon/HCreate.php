<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_isadmin'])) {
    header("Location: ../../index.php");
    exit();
}
if(isset($_SESSION['H_created'])){
  header("Location: AddJudge.php");
  die();
}
// if(!isset($_SESSION['H_created'])){
//   header("Location: ../admin.php");
//   die();
// }
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
      color: black;
      font-family: Tahoma;
      font-size: 16px;
    }
    
    h1, #instruction{
      margin: 1em auto;
      text-align: center;
      color: white;	
    }

    h1{
      margin-bottom: 0;
    }

    #instruction{
      font-size: large;
      padding-top: 1em;
    }
    
    form {
      width: 60vw;
      max-width: 500px;
      min-width: 300px;
      margin: 1rem auto;
      background-color: white;	
      border-radius: 25px;
      padding: 0 3rem 3rem 3rem ;
    }
    
    input,
    select {
      display: block;
      margin: 10px 0 0 0;
      width: 100%;
      min-height: 2em;
    }
    
    input{
      background-color: white;
      border: 0.5px solid black;
      /* box-shadow: 0 4px 4px rgba(0,0,0,0.1); */
      color: #272727;
      border-radius: 25px ;
    }

    .team-type{
      display: flex;
      align-items: center;
      margin-top: 1em;
    }

    input[type="time"], input[type="date"] {
      display: inline;
      width:25%;
      padding-left: 2rem;
      margin:1rem;
    }
    input[type="checkbox"]{
      display: flex;
      width: 10%;
    }
    ::placeholder{
      color: #272727;
    }
    
    button {
      background-color: black;
      border: 1px;
      border-radius: 25px;
      color: #ffffff;
      font-size: 1rem;
      padding: 0.5rem;
      width: 100%;
      margin-top: 2rem;
    }

    button:hover{
        background-color: #F73634;
        color: white;
    }
    
    footer {
      background-color: #000000;
      color: #ffffff; 
      padding: 5px;
      text-align: center;
      position: sticky;
      top: 100%;
    }

    #MaxP{
      margin-top: 2em;
      display: none;
    }
    h2{
      padding-top: 80px;
    }

  </style>

  </head>
  <body>
    <h1>Hackathon <font color = "#F73634">Details</font></h1>
    <h2 id = "instruction">Please fill out the required information</h2>

    <form action="accept_hackathon_data.php" method="POST">
      <br>
      <input id="HName" name="HName" type="text"  placeholder=" Name of the Hackathon" required/>
      <label for="HDate">Date: <input id="HDate" name="HDate" type="date" min="2024-03-01"  required/></label>
      <label for="HTime">Time: <input id="HTime" name="HTime" type="time" required /></label>

      <p>Category:</p>
      <div class="Category" style="display: flex; align-items: center;">

      <label for="jr-cadet" >Jr Cadet</label>
        <input type="checkbox" id="jr-cadet" name="Category[]" value="Jr_Cadet">
        
        <label for="jr-captain" style="margin-left: 2em;">Jr Captain</label>
        <input type="checkbox" id="jr-captain" name="Category[]" value="Jr_Captain">
       
        <label for="jr-colonel" style="margin-left: 2em;">Jr Colonel</label>
        <input type="checkbox" id="jr-colonel" name="Category[]" value="Jr_Colonel">

      </div>

      <p>Team Type:</p>

      <div class = "team-type">

        <label>Team Based</label>
        <input type="radio" name="team-type" value="team" required onclick="team()">
    
        <label>Individual Based</label>
        <input type="radio" name="team-type" value="individual" required onclick="individual()">

      </div>

      <div id = "max-players">
        <input id="MaxP" type="number" name="MaxP" max="5" placeholder=" Maximum participants per team" />
      </div>

      <button type="submit">Next</button>
    </form>

    <script>

      function team(){
          var container = document.getElementById("MaxP");
          container.style.display = 'flex';
          container.required = true;
      }

      function individual(){
          var container = document.getElementById("MaxP");
          container.style.display = 'none';
          container.required = false;
      }

    </script>

  </body>

  <footer>

    <p>Code Battle &copy; 2024. All rights reserved. Made in U.A.E</p>
    <p>Contact us at: info@codebattle.com</p>

  </footer>

</html>