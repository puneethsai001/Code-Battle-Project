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
      color: #f5f6f7;
      font-family: Tahoma;
      font-size: 16px;
    }
    
    h1, #instruction{
      margin: 1em auto;
      text-align: center;
      color: white;	
    }

    #instruction{
      font-size: large;
    }
    
    form {
      width: 60vw;
      max-width: 500px;
      min-width: 300px;
      margin: 1rem auto;
      background-color: #F73634;	
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
      border: 1px solid #0a0a23;
      color: #272727;
      border-radius: 25px ;
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
      background-color: #272727;
      border: 1px;
      border-radius: 25px;
      color: #ffffff;
      font-size: 1rem;
      padding: 0.5rem;
      width: 100%;
      margin-top: 2rem;
    }

    button:hover{
        background-color: #ffffff;
        color: #272727;
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

  <script>
    function redirect()
    {
      var url = "AddJudge.html";
      window.location(url);
    }

  </script>

  </head>
  <body>

    <h1>Create a <font color = "#F73634">Hackathon</font></h1>
    <p id = "instruction">Please fill out the required information</p>

    <form action="accept_hackathon_data.php" method="POST">
      <br>
      <h2>Hackathon Details</h2>
      <input id="HName" name="HName" type="text"  placeholder=" Name of the Hackathon" required/>
      <label for="HDate">Date: <input id="HDate" name="HDate" type="date" min="2024-03-01"  required/></label>
      <label for="HTime">Time: <input id="HTime" name="HTime" type="time" required /></label>

      <input id="MaxP" type="number" name="MaxP" max="5" placeholder=" Maximum Players per Team" required/>
      <br>
      <p>Category:</p>
      <div class="Category" style="display: flex; align-items: center;">


        <label for="jr-cadet" style="margin-left: 8px;">Jr Cadet</label>
        <input type="checkbox" id="jr-cadet" name="Category" value="jr-cadet">
    
        
        <label for="jr-captain" style="margin-left: 8px;">Jr Captain</label>
        <input type="checkbox" id="jr-captain" name="Category" value="jr-captain">
    
        <label for="jr-colonel" style="margin-left: 8px;">Jr Colonel</label>
        <input type="checkbox" id="jr-colonel" name="Category" value="jr-colonel">

      </div>

      <button type="submit">Next</button>
    </form>

  </body>

  <footer>

    <p>Code Battle &copy; 2024. All rights reserved. Made in U.A.E</p>
    <p>Contact us at: info@codebattle.com</p>

  </footer>

</html>