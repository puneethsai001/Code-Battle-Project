<?php
require_once "../includes/config_session.inc.php";
// require_once "../login/login.inc.php";
if ($_SESSION["user_isadmin"]==1){?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code Battle - Admin</title>
    <style>
        body{
            font-family: 'Arial', sans-serif;
            color: #F73634;
            margin: 0;
            padding: 0;
            background-color: #272727;
            min-height: 100vh;
        }

        table {
            text-align: center;
            width: 50%;
            border-collapse: collapse;
            background-color: white;
            margin-left: auto;
            margin-right: auto;
            border-radius: 18px;
        }

        th{
            color: white;
            background-color: #F73634;
            font-size: medium;
            padding: 8px;
        } 
        
        
        td {
            color: black;
            font-size: medium;
            padding: 8px;
        }

        h2{
            text-align: center;
            color: #ffffff;
        }


        th{
            color: #fff;
        }

        .button-container{
            text-align: center;
        }

        button{
            background-color: #F73634;
            border: none;
            border-radius: 1rem;
            color: #fff;
            cursor: pointer;
            display: inline;
            margin-top: 3rem;
            font-size: large;
            padding: 5px 15px;
        }

        button:hover{
            background-color: #000000;
            color: #ffffff;
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
        echo '<h1>Welcome <font color="#FFFFFF">'.$_SESSION["user_username"].'</font>,</h1>';
    ?>
    <h2>Hackathon Details</h2>
    <table>
        <tr>
            <th>Hackathon ID</th>
            <th>Hackathon Name</th>
            <th>Date</th>
        </tr>
        <tr>
            <td>1</td>
            <td>-</td>
            <td>-</td>
        </tr>
        <tr>
            <td>2</td>
            <td>-</td>
            <td>-</td>
        </tr>
        <tr>
            <td>3</td>
            <td>-</td>
            <td>-</td>
        </tr>
    </table>
    <div class="button-container">
        <button type="button">View Hackathon</button> &nbsp; &nbsp;
        <button type="button">Edit Hackathon</button> &nbsp; &nbsp;
        <!-- <button type="button">Create Hackathon</button> &nbsp; &nbsp; -->
        <form action="HCreate.html" method="POST">
            <button type="submit">Create Hackathon</button>
        </form>
        <form action="../login/logout.inc.php" method="POST">
            <button type="submit">Log Out</button>
        </form>
    </div>
</body>
<footer>
    <p>Code Battle &copy; 2024. All rights reserved. Made in U.A.E</p>
    <p>Contact us at: info@codebattle.com</p>
</footer>
</html>
<?php }?>