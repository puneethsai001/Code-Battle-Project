<?php
    require_once "login/login_functions.php";
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (isset($_SESSION['user_isadmin']) || isset($_SESSION['user_id'])) {
        header("Location: admin/admin.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code Battle - Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: black;
            margin: 0;
            padding: 0;
            background-color: #E3E3E3;
            background-image: url(Images/grids.jpeg);
            background-repeat: no-repeat;
            background-size: cover;
        }

        .container {
            display: flex;
            height: 100vh;
            width: 60vw;
            max-width: 500px;
            min-width: 300px;
            margin: 1rem auto;
            background-color: #272727;
            color: white;	
            border-radius: 25px;
            padding-left: 3rem;
            padding-right: 3rem;
            padding-bottom: 0%;
            padding-top: 0%;
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
            /* margin: 5%; */
        }

        .form-container p {
            font-size: 1rem; 
            text-align: center;
        }

        .form-group {
            margin-bottom: 1.5rem;
            width: 100%;
        }

        .form-group label {
            display: block;
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


        button {
            background-color: #F73634;
            border: none;
            border-radius: 25px;
            color: #ffffff;
            font-size: 1rem;
            padding: 0.5rem;
            width: 100%;
            margin-top: 2rem;
            margin-bottom: 0%;
        }

        button:hover {
            background-color: #000000;
            color: #ffffff;
        }

        img{
            height: 80%;
            margin-top: 0%;
        }

        hr{
            width: 100%;
        }

        footer {
            background-color: #000000;
            color: #ffffff; 
            padding: 5px;
            text-align: center;
            position: sticky;
            top: 100%;
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
    <div class="container">

        <div class="form-container">
            <!-- <h1>Welcome <font color = "#F73634">Back!</font></h1> -->
            <span>
                <img src="Images/Logo.png" alt="CodeBattle Image">
            </span>
            <p>CodeBattle – where young minds transform ideas into digital masterpieces. <br>Join the journey and let your creativity unfold!</p>
            <form action="login/login.inc.php" method="POST" class="myform">
                <h4>Please enter your login details to proceed.</h4>
                <div class="form-group">
                    <label for="username"></label>
                    <input type="text" id="username" name="username" placeholder="Username">
                </div>
                <div class="form-group">
                    <label for="password"></label>
                    <input type="password" id="password" name="pwd" placeholder="Password">
                </div>
                <hr>
                <button type="submit">Log In</button>
            </form>
            <?php
                check_login_errors();
            ?>
        </div>
            
    </div>
</body>

<footer>
    <p>Code Battle &copy; 2024. All rights reserved. Made in U.A.E</p>
</footer>

</html>