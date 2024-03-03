<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_isadmin'])) {
    header("Location: ../../index.php");
    exit();
}
if(isset($_SESSION['H_added_criteria'])){
    header("Location: admin.php");
    die();
  }
// if(!isset($_SESSION['H_criteria_added'])){
//     header("Location: ../admin.php");
//     die();
//   }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code Battle - Add Criteria</title>

    <style>
        body {
            width: 100%;
            min-height: 100vh;
            margin: 0;
            background-color: #E3E3E3;
            background-image: url(../../Images/grids.jpeg);
            background-repeat: no-repeat;
            background-size: cover;
            color: black;
            font-family: Tahoma;
            font-size: 16px;
        }

        #instruction{
            font-size: large;
            text-align: center;
            font-weight: bold;
            color: black;
        }

        h1{
            margin-top: 1em auto;
            margin-bottom: 2em;
            text-align: center;
        }

        #criteriaForm {
            background-color: #ffffff;
            width: 60vw;
            max-width: 500px;
            min-width: 300px;
            margin: 1rem auto;
            border-radius: 25px;
            border: 1px solid;
            padding: 0 3rem 3rem 3rem ;
        }
        
        .Criteria-Container {
            display: flex;

        }

        input[type="number"]{
            width: 30%;
            align-items: right;
            border-radius: 25px;
            border: 1px solid;
            margin-left: auto;
            text-align: center;
            /* display:none */
        }
        
        label{
            margin-top: 0.5em;
        }
        input[type="checkbox"]{
            width: 2em;
        }

        .mybox{
            height: 40%;
        }

        hr{
            margin: 2em;
        }
        
        input{
            min-height: 2em;
            background-color: #ffffff;
            border: 1px solid;
            color: #272727;
        }

        .button-container {
            text-align: center;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            background-color: #F73634;
            padding: 15px;
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

        button:hover{
            text-decoration: underline;
        }

        .action-button-container{
            margin-top: 2rem;
            text-align: center;
        }

        .action-button-container button{
            background-color: #272727;
        }

        .action-button-container button:hover{
            background-color: #F73634;
            text-decoration: none;
        }

        ::placeholder{
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

</head>
<body>
    <div class="button-container">
      <form action="../admin.php" method="POST">
          <button type="submit">Home</button>
      </form>
      <form action="../HDetail.php" method="POST">
          <button type="submit">View Hackathon</button>
      </form>
      <form action="../admin_functions.php" method="POST">
          <button type="submit" name="create_hackathon">Create Hackathon</button>
      </form>
      <form action="../admin_functions.php" method="POST">
          <button type="submit" name="logout">Log Out</button>
      </form>
    </div>
    <?php
        echo '<h1>Add Criteria for  <font color = "#F73634"> Hackathon '.$_SESSION["HName"].'</font></h1>';
    ?>
    
    <p id = "instruction">Please fill out the required information</p>

    <form action="accept_criteria_data.php" method="POST" id="criteriaForm">
        <br>
        <h1>Criteria <font color="#F73634">Details</font></h1>

        <div class="Criteria-Container" >
            <input type="checkbox" id = "C1Box" name="criteria[]" value="Presentation" onclick="clicked()">
            <label>Presentation</label>
            <!-- creates associative array -->
            <input id="CWeight1" name="weights[Presentation]" type="number"  placeholder=" Weight of Criteria 1" /> 
        </div>

        <hr>

        <div class="Criteria-Container">
            <input type="checkbox" id = "C2Box" name="criteria[]" value="Code" onclick="clicked()">
            <label>Code</label>
            <input id="CWeight2" name="weights[Code]" type="number"  placeholder=" Weight of Criteria 2" /> 
        </div>

        <hr>

        <div class="Criteria-Container">
            <input type="checkbox" id = "C3Box" name="criteria[]" value="UserInterface" onclick="clicked()">
            <label>User Interface</label>
            <input id="CWeight3" name="weights[UserInterface]" type="number"  placeholder=" Weight of Criteria 3" />
        </div>

        <hr>

        <div class="Criteria-Container">
            <input type="checkbox" id = "C4Box" name="criteria[]" value="Teamwork" onclick="clicked()">
            <label>Teamwork</label>
            <input id="CWeight4" name="weights[Teamwork]" type="number"  placeholder=" Weight of Criteria 4" />
        </div>

        <hr>

        <div class="Criteria-Container">
            <input type="checkbox" id = "C5Box" name="criteria[]" value="Creativity" onclick="clicked()">
            <label>Creativity</label>
            <input id="CWeight5" name="weights[Creativity]" type="number"  placeholder=" Weight of Criteria 5" />
        </div>

        <div class="action-button-container">
            <button id="redirectButton">Submit</button>
            <button name = "discard" formaction="../discard.php">Discard </button>
        </div>
    </form>
</body>

<footer>

    <p>Code Battle &copy; 2024. All rights reserved. Made in U.A.E</p>

</footer>
</html>