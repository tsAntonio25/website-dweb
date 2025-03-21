<?php include 'session.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Garage</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <?php include 'nav.php'; ?>
    </header>

    <section class = "hero">
        <div class = "hero-content">
            <div class = "hero-image"></div>
            <h1 class = "tagline">Tagline</h1>
            <a href = "carlisting.php"><button class = "btn">Explore Cars</button></a>
            
        </div>
    </section>

    <section class = "featured">
        <div class = "featured-content">
            <div class = "featured-image"></div>
            <div class = "featured-text">
                <h2>FEATURED HEADING</h2>
                <p class="firstp">Why Rent with The Garage? </p>
                <p>Quality Cars, Affordable Rates, and Hassle-Free Experience!</p>
                <a href = "carlisting.php"><button class = "btn">See More...</button></a>
            </div>
        </div>
    </section>

    <section class="cta">
        <h2>Looking for the perfect ride?</h2>
        <a href = "signup.php"><button class = "btn">SIGN UP</button></a>
        <p>or</p>
        <a href = "login.php"><button class = "btn-secondary">LOG IN</button></a>
    </section>
 
    <footer>
        <?php include 'footer.php' ?>
    </footer>
</body>
</html>
