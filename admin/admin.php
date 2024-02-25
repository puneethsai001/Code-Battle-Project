
<?php
    require_once '../includes/config_session.inc.php';
if ($_SESSION['user_isadmin']==1) {

require_once "../admin/admin_functions.php";


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code Battle - Admin</title>
    <style>
        header{
            display: inline-block;
            width: 100%;
        }
        h1{
            width: 50%;

        }
        .logout{
            text-align: right;
            width: 20%;
            margin-left: auto;
        }

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
            background-color: #F73634;
            margin-left: auto;
            margin-right: auto;
            border-radius: 18px;
        }

        th{
            border-radius: 18px;
            color: white;
            background-color: #F73634;
            font-size: medium;
            padding: 8px;
        } 
        
        
        td {
            /* border-radius: 18px; */
            background-color: white;
            color: black;
            font-size: medium;
            padding: 8px;
            
        }

        h2{
            text-align: center;
            color: #ffffff;
        }

        .button-container {
            text-align: center;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .button-wrapper {
            margin: 1rem;
        }

        button {
            background-color: #F73634;
            border: none;
            border-radius: 1rem;
            color: #fff;
            cursor: pointer;
            font-size: large;
            padding: 5px 15px;
            margin-left: 1em;
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
        echo '<h1>Welcome <font color="#FFFFFF">'.$_SESSION["user_username"].',</font></h1>';
        
    ?>
    <!-- <h1>Welcome <font color="#FFFFFF">Admin,</font></h1> -->
    
    <div class="button-container">
        <form action="" method="POST">
            <button type="button">View Hackathon</button> &nbsp; &nbsp;
        </form>
        <form action="" method="POST">
            <button type="button">Edit Hackathon</button> &nbsp; &nbsp;
        </form>
        <form action="admin_functions.php" method="POST">
            <button type="submit" name="create_hackathon">Create Hackathon</button>
        </form>
        <form action="admin_functions.php" method="POST">
            <button type="submit" name="logout">Log Out</button>
        </form>
    </div>
    <br><br>
    <h2>Hackathon Details</h2>
    <div id="table">
            <!-- <table>
                <tr>
                    <th>Hackathon ID</th>
                    <th>Hackathon Name</th>
                    <th>Date</th>
                    <th>Time</th>
                    
                </tr>
                
                <tr>
                        <td>HID</td>
                        <td>HName</td>
                        <td>HDate</td>
                        <td>HTime</td>
                        
                </tr>
                
            </table> -->
        <script>
            fetch('admin_n.php')
            .then(response => response.text())
            .then(data => {
                document.getElementById('table').innerHTML = data;
            })
            .catch(error => {
                console.error('Error fetching table', error);
            });
        </script>
    </div>
    
</body>
<footer>
    <p>Code Battle &copy; 2024. All rights reserved. Made in U.A.E</p>
    <p>Contact us at: info@codebattle.com</p>
</footer>
</html>
<?php }else{
    header("Location: ../judge/judge.php");
    die();
} ?>