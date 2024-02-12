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
            color: white;
            font-family: Tahoma;
            font-size: 16px;
        }

        #instruction{
            font-size: large;
            text-align: center;
        }

        h1{
            margin-top: 1em auto;
            text-align: center;
        }

        form {
            background-color: #F73634;
            width: 60vw;
            max-width: 500px;
            min-width: 300px;
            margin: 1rem auto;
            border-radius: 25px;
            padding: 0 3rem 3rem 3rem ;
        }
        
        input{
            display: block;
            margin: 10px 0 0 0;
            width: 100%;
            min-height: 2em;
            background-color: #ffffff;
            border: 1px;
            color: #272727;
            border-radius: 25px ;
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

</head>
<body>
    <?php
        echo '<h1>Add Criteria for  <font color = "#F73634"> Hackathon '.$_SESSION["HName"].'</font></h1>';
    ?>
    
    <div class="button-container">
        <button type="submit" class = "discard-button" name = "discard">Discard Hackathon</button>
    </div>
    <p id = "instruction">Please fill out the required information</p>

    <form action="accept_Criteria_data.php" method="POST">
        <br>
        <h2>Critria Details</h2>
        <br>
        <input id="CName1" name="CName1" type="text"  placeholder=" Criteria 1" required/>
        <input id="CWeight1" name="CWeight1" type="number"  placeholder=" Weight of Criteria 1" required/> 
        <br><hr><br> 
        <input id="CName2" name="CName2" type="text"  placeholder=" Criteria 2" required/>
        <input id="CWeight2" name="CWeight2" type="number"  placeholder=" Weight of Criteria 2" required/> 
        <br><hr><br> 
        <input id="CName3" name="CName3" type="text"  placeholder=" Criteria 3" required/>
        <input id="CWeight3" name="CWeight3" type="number"  placeholder=" Weight of Criteria 3" required/>
        <br>
        <button id="redirectButton">Submit</button>
    </form>
</body>

<footer>

    <p>Code Battle &copy; 2024. All rights reserved. Made in U.A.E</p>
    <p>Contact us at: info@codebattle.com</p>

</footer>
</html>