<?php
    declare(strict_types=1);
    require_once '../includes/dbh.inc.php';
    require_once '../includes/config_session.inc.php';
    $_SESSION['T_id'] = $_GET['T_id'];

    if(isset($_SESSION['update'])){
        
        $query1 = "DELETE from scores where J_id=:J_id and T_id=:T_id and H_id=:H_id;";
        $stmt1 = $pdo->prepare($query1);
        $stmt1->bindParam(":H_id",$_SESSION['H_id']);
        $stmt1->bindParam(":J_id",$_SESSION['J_id']);
        $stmt1->bindParam(":T_id",$_SESSION['T_id']);
        $stmt1->execute();
        ;
    }

        $query2 = "SELECT TName FROM team_data WHERE T_id=:T_id;";
        $stmt2 = $pdo->prepare($query2);
        $stmt2->bindParam(":T_id",$_SESSION['T_id']);
        $stmt2->execute();
        $TName=$stmt2->fetchColumn();
        $_SESSION['TName']=$TName;

        //display Criterias specific to that session hackathon
$query1 = "SELECT CR_id, CRName, CRWeight, H_id FROM criteria_data WHERE H_id=:H_id;";
        $stmt1 = $pdo->prepare($query1);
        $stmt1->bindParam(":H_id",$_SESSION['H_id']);
        $stmt1->execute();
        $criterias=$stmt1->fetchAll();
        $_SESSION['criterias']=$criterias;
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code Battle - Grade</title>

    <style>
        body {
            width: 100%;
            min-height: 100vh;
            margin: 0;
            background-color: #E3E3E3;
            background-image: url(../Images/grids.jpeg);
            background-size: cover;
            color: black;
            font-family: Tahoma;
            font-size: 16px;
        }

        #heading{
            margin-top: 0rem ;
            font-size: xx-large;
            color: black;
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
            border: 1px solid;
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
            margin: auto;
        }

        footer {
            background-color: #000000;
            color: #ffffff; 
            padding: 5px;
            text-align: center;
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
        
        .modal-background {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            position: absolute;
            font-weight: bold;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgb(255, 255, 255);
            padding: 20px;
            border-radius: 1rem;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
        }

        .modal-content p{
            margin-top: 1rem;
        }
        .modal-text {
            margin-bottom: 20px;
        }

        .modal-button {
        border: none;

        color: white;
        cursor: pointer;
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


</head>

<body>  
<div class="preloader">
  <div class="loader"></div>
</div>
    <h1 id="heading"><?php echo $_SESSION['TName'] ?></h1>
    


    
    <!--Modified by Harsh-->
    
    <?php foreach($criterias as $row): ?>
    <div class="form-container">
        <form id="myform" action="insert.scores.php" method="POST">
            <br>
            <div class="Criteria-Container">
                <label><?php echo $row['CRName'] ?> (Weight: <?php echo $row['CRWeight'] ?>)</label>
                <input id="CWeight" name="<?php echo $row['CRName'].'mark' ?>" type="number" required max="<?php echo $row['CRWeight'] ?>" /> 
            </div>
            <hr>
    <?php endforeach; ?>
    
       <!--Modified by Harsh-->

                <!--<h1>total: 0</h1>-->
                <div class="button-container"><button class="submit-button" onclick="validateMarks()">Submit</button></div>
<div id="modal" class="modal-background">
  <div class="modal-content">
    <p class="modal-text">Are you sure you want to submit?</p>
    <div class="button-container">
    <button class="modal-button" onclick="hideModal()">Cancel</button>
    <button class="modal-button" onclick="submitForm()">Submit</button>
    </div>
  </div>
</div>
            </form>
        </div>
        <script>
            document.getElementById("myform").addEventListener("submit", function(event) {
                event.preventDefault();
                showModal();
            });
            function showModal() {
            document.getElementById("modal").style.display = "flex";
            }

            function hideModal() {
            document.getElementById("modal").style.display = "none";
            }
            function submitForm() {
                document.getElementById("myform").submit();
                // alert("Updated Successfully")
            }
            
    function validateMarks() {
        var inputs = document.querySelectorAll('input[type="number"]');
        var valid = true;
        
        inputs.forEach(function(input) {
            var weight = parseInt(input.getAttribute('max'));
            var mark = parseInt(input.value);
            
            if (mark > weight) {
                valid = false;
                alert("Mark cannot be greater than weight for " + input.name);
                input.focus();
                return;
            }
        });
        
        if (valid) {
            showModal();
        } else {
            hideModal(); // Ensure modal is hidden if marks are not valid
        }
    }
</script>

            
        
        
    

    </div>
    
    <footer>
        
        <p>Code Battle &copy; 2024. All rights reserved. Made in U.A.E</p>
        
    </footer>
    <script>


  window.addEventListener('load', function(){
    const preloader = document.querySelector('.preloader');
    preloader.style.display = 'none';
  });
</script>
    
</body>
</html>