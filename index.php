<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="indexStyle.css">
</head>
    <body>
            <div class="container">
                <div class="form-container"> 
                    <h1>Welcome to CodeBattle</h1>
                    <form action="includes/formhandler.inc.php" method="POST">
                        <p>Please enter your Log in details to proceed.</p>
                        <label for="username"></label>
                        <input type="text" id="username" name="username" placeholder="Username" >
                        <label for="password"></label>
                        <input type="password" id="password" name="pwd" placeholder="Password" >
                        
                        <a href="/">forgot your password?</a>
                        <hr></hr>
                        <button type="submit">Log In</button>
                    </form>
                </div>
                <div class="image-container">
                        <img src="C:\Users\moham_jvk4ynn\Downloads\hackathonpic.jpeg" alt="Image">
                </div>
            </div>
    </body>
    <footer>
        <p>Code Battle &copy; 2024. All rights reserved. Made in U.A.E</p>
        <p>Contact us at: info@codebattle.com</p>
    </footer>
</html> 
