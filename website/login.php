<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - The Garage</title>
    <link rel="stylesheet" href="\css\styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
    <header>
        <?php include 'nav.php'; ?>
    </header>

    <main>
        <h1>Log In</h1>
        <div class = "login-container">
            <div class = "login-box">
                <div class = "avatar">
                    <i onclick="checkprofile()" class="fa fa-user-circle-o"></i>
                </div>
                <form class="login-form">
                    <label for = "email"> Email </label>
                    <input type = "email" id = "email" name = "email" required>
                    
                    <label for = "password"> Password </label>
                    <input type = "password" id = "password" name = "password" required>
                    
                    <a href = "signup1.php" class = "alt-login"> Sign in instead...</a>

                    <input type="submit" value="Log In" class="submit">
                    </form>

            </div>
        </div>
    </main>

 
    <footer>
        <?php include 'footer.php' ?>
    </footer>
</body>
</html>