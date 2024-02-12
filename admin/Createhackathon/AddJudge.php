<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_isadmin'])) {
    header("Location: ../../index.php");
    exit();
}
if($_SESSION['H_judges_added']==1){
  header("Location: AddCriteria.php");
  die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code Battle - Add Judge</title>

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

        input,
        select {
            display: block;
            margin: 10px 0 0 0;
            width: 100%;
            min-height: 2em;
        }

        input{
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

        select{
            width: 25%;
            font-size: medium;
            background-color: #F73634;
            color: white;
            padding: 7px;
            border-radius: 25px;
            margin-left: auto;
            margin-right: auto;
        }

        #text-field-container{
            width: 60vw;
            max-width: 500px;
            min-width: 300px;
            margin: 1rem auto;
            border-radius: 25px;
            padding: 0 3rem 3rem 3rem ;
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

        @media screen and (max-width: 700px) {

            select{
                width: 25%;
                font-size: 15px;
                padding: 3px;
            }

            h1{
                font-size: x-large;
            }

            #instruction{
                font-size: medium;
            }

            #formid{
                font-size: small;
                width: 30vw;
            }

            h2{
                font-size: medium;   
            }

            footer{
                font-size: small;
            }
        }
    </style>

    <script>
        function generateTextFields() {
            var selectedValue = document.getElementById("judgescount").value;

            var container = document.getElementById("text-field-container");

            container.innerHTML = "";
            var judgeName, judgeEmail, judgeUsername, judgePass;
            var nameLabel, emailLabel, userLabel, passLabel, temp;
            var heading;

            document.getElementById("text-field-container").style.backgroundColor = "#F73634";

            container.appendChild(document.createElement("br")); 

            for (var i = 0; i < selectedValue; i++) {

                judgeName = document.createElement("input");
                judgeName.required=true;
                judgeName.type = "text";
                judgeName.placeholder = " Name";
                judgeName.id = "JName_"+(i+1)
                judgeName.name = "JName_"+(i+1)
                container.appendChild(judgeName);

                heading = document.createElement("h2");
                temp = document.createTextNode("Judge "+(i+1)+" Details");
                heading.appendChild(temp);
                document.getElementById("text-field-container").insertBefore(heading,document.getElementById("JName_"+(i+1)));

                container.appendChild(document.createElement("br")); 

                judgeEmail = document.createElement("input");
                judgeEmail.required=true;
                judgeEmail.type = "email";
                judgeEmail.placeholder = " Email";
                judgeEmail.id = "JEmail_"+(i+1)
                judgeEmail.name = "JEmail_"+(i+1)
                container.appendChild(judgeEmail);

                container.appendChild(document.createElement("br")); 

                judgeUsername = document.createElement("input");
                judgeUsername.required=true;
                judgeUsername.type = "text";
                judgeUsername.placeholder = " Username"
                judgeUsername.id = "JUsername_"+(i+1)
                judgeUsername.name = "JUsername_"+(i+1)
                container.appendChild(judgeUsername);

                container.appendChild(document.createElement("br")); 

                judgePass = document.createElement("input");
                judgePass.required=true;
                judgePass.type = "text";
                judgePass.placeholder = " Password";
                judgePass.id = "JPass_"+(i+1)
                judgePass.name = "JPass_"+(i+1)
                container.appendChild(judgePass);

                container.appendChild(document.createElement("br")); 
                container.appendChild(document.createElement("hr")); 
            }

            var x = document.createElement("button");
            x.name = "nextButton";
            var t = document.createTextNode("Next");
            x.appendChild(t);
            document.getElementById("text-field-container").appendChild(x);

        }
    </script>
</head>
<body>
    
    <?php
        echo '<h1>Add Judges for  <font color = "#F73634"> Hackathon '.$_SESSION["HName"].'</font></h1>';
    ?>
    <form action="accept_judges_data.php" method="POST" id = "formid">
    <div class="button-container">
            <button type="submit" class = "discard-button" name = "discard">Discard Hackathon</button>
    </div>

        <div class = "select-container">
            <p for="judges" id = "instruction">Select the number of judges</p>
            <select name="judgescount" id="judgescount" onchange="generateTextFields()">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </div>

        <div id="text-field-container">
        </div>

    </form> 
    
</body>

<footer>
    <p>Code Battle &copy; 2024. All rights reserved. Made in U.A.E</p>
    <p>Contact us at: info@codebattle.com</p>
</footer>
</html>