<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CodeBattle</title>
    <link rel="stylesheet" href="indexStyle.css"> 
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h1>Welcome Back!</h1>
            <p>CodeBattle – where young minds transform ideas into digital masterpieces. <br>Join the journey and let your creativity unfold!</p>
            <form action="includes/formhandler.inc.php" method="POST">
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
        </div>
        <div class="image-container">
            <img src="Images/hackathonpic.jpeg" alt="CodeBattle Image">
        </div>
    </div>
</body>
</html>
