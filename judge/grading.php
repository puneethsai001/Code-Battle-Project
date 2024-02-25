<?php
    declare(strict_types=1);
    require_once '../includes/dbh.inc.php';
    require_once '../includes/config_session.inc.php';
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

        #heading{
            margin-top: 0rem ;
            font-size: xx-large;
            color: #ffffff;
            /* background-color: #F73634; */
            padding: 2rem 2rem 2rem 2rem;
            text-align: center;
            
        }
       
        .form-container h1{
            color: #ffffff;
            font-size: x-large;
            max-width: 500px;
            min-width: 300px;
            text-align: center;
            background-color: #F73634;
            margin-top: 3rem;
            padding: 1rem;
            border-radius: 1rem;
        }

        form {
            background-color: #ffffff;
            width: 50vh;
            max-width: 500px;
            min-width: 300px;
            margin: 1em auto;
            border-radius: 25px;
            padding: 3rem;
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
            background-color: #000000;
            border: 1px;
            border-radius: 25px;
            color: #ffffff;
            font-size: 1rem;
            padding: 0.5rem;
            width: 25%;
            margin-top:1rem;  
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

        footer {
            background-color: #000000;
            color: #ffffff; 
            padding: 5px;
            text-align: center;
            /* position: sticky; */
            /* top: 100%; */
            position: fixed; 
            bottom: 0;
            width: 100%; 
        }

        .single-container{
            display: inline-block;
            padding: 1rem 1rem;
            vertical-align: middle;
        }

        .double-container{
            text-align: center;
        }
        

    </style>


</head>
<body>  
    <h1 id="heading">TEAM NAME</h1>
    

   <?php 
    $_SESSION['T_id'] = $_GET['T_id'];
    $query1 = "SELECT CR_id,CRName,H_id FROM criteria_data WHERE H_id=:H_id;";
    $stmt1 = $pdo->prepare($query1);
    $stmt1->bindParam(":H_id",$_SESSION['H_id']);
    $stmt1->execute();
    $result=$stmt1->fetchAll();
    $_SESSION['scores']=$result;
    foreach($result as $row){
     ?>
        <div class = "form-container">
            <form action="insert.scores.php" method="POST">
                <br>
                <div class="Criteria-Container">
                    <label><?php echo $row['CRName'] ?></label>
                    <input id="CWeight" name="<?php echo $row['CRName'].'mark' ?>" type="number" required/> 
                </div>
                <hr>
    <?php }?>

                <h1>total: 0</h1>
                <div class="button-container">
                <button id="redirectButton">Submit</button>
                </div>
            </form>
        </div>
    

    </div>
    
    <footer>
        
        <p>Code Battle &copy; 2024. All rights reserved. Made in U.A.E</p>
        <p>Contact us at: info@codebattle.com</p>
        
    </footer>
</body>
</html>