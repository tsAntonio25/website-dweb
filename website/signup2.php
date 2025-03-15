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

    <section class = "signup_2-section">
        <h1>Sign Up</h1>

        <form action="/action_page.php">
            <label for="email">E-mail</label><br>
            <input type="text" id="email" name="email" value="email"><br>

            <label for="password">Password</label><br>
            <input type="text" id="password" name="password" value="password"><br>

            <label for="confirm">Confirm Password</label><br>
            <input type="text" id="confirm" name="confirm" value="confirm"><br><br>
            
            <button class="back-button" onclick="history.back()">Back</button> 
            <!-- di ako sure dito -->
            <button type="submit" class="submit-btn">Create Account</button>
            <!-- di ako sure dito -->
             
        </form> 

    </section>

    <footer>
        <?php include 'footer.php' ?>
    </footer>
</body>
</html>
