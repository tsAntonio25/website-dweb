<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - The Garage</title>
    <link rel="stylesheet" href="\css\styles.css">
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
                    <i class = "fas fa-user-circle"></i>
                </div>
                <form>
                    <label for = "email"> Email </label>
                    <input type = "email" id = "email" name = "email" required>
                    
                    <label for = "password"> Password </label>
                    <input type = "password" id = "password" name = "password" required>
                    
                    <a href = "#" class = "alt-login"> Sign in instead...</a>

                    <button type = "submit"> LOG IN </button>
                </form>

                <p><em>Sign in instead...</em></p>
            </div>
        </div>
    </main>

 
    <footer>
        <?php include 'footer.php' ?>
    </footer>
</body>
</html>