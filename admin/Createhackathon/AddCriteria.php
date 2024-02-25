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
            background-color: #272727;
            color: black;
            font-family: Tahoma;
            font-size: 16px;
        }

        #instruction{
            font-size: large;
            text-align: center;
            font-weight: bold;
            color: white;
        }

        h1{
            margin-top: 1em auto;
            margin-bottom: 2em;
            text-align: center;
        }

        form {
            background-color: #ffffff;
            width: 60vw;
            max-width: 500px;
            min-width: 300px;
            margin: 1rem auto;
            border-radius: 25px;
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

        button {
            background-color: #272727;
            border: 1px;
            border-radius: 25px;
            color: #ffffff;
            font-size: 1rem;
            padding: 0.5rem;
            width: 25%;
            margin-top: 2rem;
        }

        button:hover{
            background-color: #F73634;
        }
        .discard-button{
            background-color: #F73634;
            border: 1px;
            border-radius: 25px;
            color: #ffffff;
            width: 25%;
            font-weight: bold;
            margin-top: 0em;
        }

        .button-container{
            text-align: center;
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

    <script>

        function clicked(){
            document.getElementById("")
        }

    </script>

</head>
<body>
    <?php
        echo '<h1>Add Criteria for  <font color = "#F73634"> Hackathon '.$_SESSION["HName"].'</font></h1>';
    ?>
    
    <p id = "instruction">Please fill out the required information</p>

    <form action="accept_criteria_data.php" method="POST">
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

        <div class="button-container">
        <button id="redirectButton">Submit</button>
        <button name = "discard" formaction="../discard.php">Discard </button>
        </div>
    </form>
</body>

<footer>

    <p>Code Battle &copy; 2024. All rights reserved. Made in U.A.E</p>
    <p>Contact us at: info@codebattle.com</p>

</footer>
</html>