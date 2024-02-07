<?php
    require_once "includes/config_session.inc.php";
    require_once "login/login_view.inc.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CodeBattle</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #ffffff;
            margin: 0;
            padding: 0;
            background-color: #272727;
        }

        .container {
            display: flex;
            align-items: stretch;
            height: 100vh;
        }

        .form-container {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: left;
            justify-content: center;
            padding: 20px;
            border-radius: 30px;
            flex-grow: 1;
            text-align: center;
            margin: 5%;
        }

        .form-container h1 {
            margin-bottom: 20px;
            font-size: 3rem;

        }

        .form-container p {
            margin-bottom: 20px; 
            font-size: 1rem; 
        }

        .form-group {
            margin-bottom: 1.5rem;
            width: 100%;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            text-align: left;
        }

        .form-group input {
            border: 1px solid #cccccc;
            border-radius: 35px;
            font-size: 1rem;
            padding: 10px;
            width: 100%;
            box-sizing: border-box;
        }

        .forgot-password {
            display: block;
            margin-top: 10px;
            color: #ccc;
            text-decoration: none;
            float: left;
            margin-bottom: 10px;
        }

        .forgot-password:hover {
            text-decoration: underline;
            color: #F73634;
        }

        hr {
            width: 100%;
            border: none;
            border-top: 1px solid #000000;
            margin: 20px 0;
        }

        button {
            background-color: #F73634;
            border: 1px solid #000000;
            border-radius: 25px;
            color: #ffffff;
            font-size: 1rem;
            padding: 0.5rem;
            width: 100%;
            max-width: none;
            margin-top: 2rem;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #000000;
            color: #ffffff;
        }

        .image-container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .image-container img {
            width: 90%;
            height: auto;
            border-radius: 20px;
        }

        @media screen and (max-width: 768px) {
            .form-container {
                padding: 10px;
            }

            .form-container h1 {
                font-size: 2rem;
            }

            .form-container p {
                font-size: 1rem;
            }

            .form-group {
                width: 100%;
            }

            button,
            .forgot-password,
            hr {
                width: 100%;
            }
        }

        @media screen and (max-width: 700px) {
            .image-container {
                display: none;
            }
            .container {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <?php
        if(!isset($_SESSION["user_id"])){ 
    ?>


    <div class="container">

        <div class="form-container">
            <h1>Welcome <font color = "#F73634">Back!</font></h1>
            <p>CodeBattle – where young minds transform ideas into digital masterpieces. <br>Join the journey and let your creativity unfold!</p>
            <form action="login/login.inc.php" method="POST">
                <h4>Please enter your login details to proceed.</h4>
                <div class="form-group">
                    <label for="username"></label>
                    <input type="text" id="username" name="username" placeholder="Username">
                </div>
                <div class="form-group">
                    <label for="password"></label>
                    <input type="password" id="password" name="pwd" placeholder="Password">
                </div>
                <a href="#" class="forgot-password" >Forgot your password?</a>
                <hr>
                <button type="submit">Log In</button>
            </form>
            <?php
            //in view
                check_login_errors();
            ?>
        </div>
        <div class="image-container">
            <img src="Images/Hackathon.png" alt="CodeBattle Image">
        </div>
        <?php
            } 
            else{ 
        ?>
        
            <H1 style="text-align:center">YOU ARE ALREADY LOGGED IN</H1>
            <form action="login/logout.inc.php" method="POST">
                <button type="submit">Log Out</button>
            </form>

        <?php
            }
        ?>
                    

    </div>
</body>
</html>