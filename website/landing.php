<?php
    session_start();
    if (!isset($_SESSION['loggedin'])) {
        $_SESSION['loggedin'] = false;
    }
 ?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Garage</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css\styles.css">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/logo.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/logo.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/logo.png">
</head>
<body>
    <header>
        <?php include 'nav.php'; ?>
    </header>

    <section class = "hero">
        <div class = "hero-content">
            <div class = "hero-image"></div>
            <h1 class = "tagline">Your Garage Away From Home</h1>
            <a href = "carlisting.php"><button class = "btn">Explore Cars</button></a>
            
        </div>
    </section>

    <section class = "featured">
        <div class = "featured-content">
            <div class = "featured-image">
                <img src = "assets/cover4.jpg">
            </div>
            <div class = "featured-text">
                <h2>Why Rent with The Garage?</h2>
                <p class="firstp">Quality Cars, Affordable Rates, and Hassle-Free Experience!</p>
                <p>Whether its a road trip, business trip, or just exploring the city, The Garage offers well-maintained vehicles to suit your needs. Experience the peace of mind that comes with choosing reliable and convenient car rentals at The Garage.</p>
                <a href = "carlisting.php"><button class = "btn">See More...</button></a>
            </div>
        </div>
    </section>

    <section class="cta">
        <div>
            <h2>Looking for the perfect ride?</h2>
            <a href = "signup.php"><button class = "btn">SIGN UP</button></a>
            <p>or</p>
            <?php
                if (!$_SESSION['loggedin'] || !isset($_SESSION['loggedin'])) {
                echo '<a href = "login.php"><button class = "btn-secondary ctabtn">LOG IN</button></a>';
                } else {
                echo '<a href = "home.php"><button class = "btn-secondary ctabtn">LOG IN</button></a>';
                }
            ?>
        </div>
    </section>
 
    <footer>
        <?php include 'footer.php' ?>
    </footer>
</body>
</html>
