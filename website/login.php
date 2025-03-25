<?php session_start();

// get error msg (if meron)
$error = $_SESSION['error'] ?? '';
unset($_SESSION['error']);?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In - The Garage</title>
    <link rel="stylesheet" href="\css\styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
    <header>
        <?php include 'nav.php'; ?>
    </header>

    <main class="login-main">
        <h1>Log In</h1>
        <div class = "login-container">
            <div class = "login-box">
                <div class = "avatar">
                    <i onclick="checkprofile()" class="fa fa-user-circle-o"></i>
                </div>
                <form class="login-form" action="admin/logincheck.php" method="post">
                    <label for = "email"> Email </label>
                    <input type = "email" id = "email" name = "email" required>
                    
                    <label for = "password"> Password </label>
                    <input type = "password" id = "password" name = "password" required>
                    
                    <a href = "signup.php" class = "alt-login"> Sign in instead...</a>
                    
                    <?php if (!empty($error)): ?> <!-- aayusin  -->
                        <span class="error" style="color:red;"><?= htmlspecialchars($error) ?></span>
                    <?php endif; ?>

                    <input name="login" type="submit" value="Log In" class="submit">
                    </form>

            </div>
        </div>
    </main>

 
    <footer>
        <?php include 'footer.php' ?>
    </footer>
</body>
</html>