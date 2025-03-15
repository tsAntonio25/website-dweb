    
<?php
// Simulating car listings (In production, fetch from a database)
$recentRentals = [
    ["name" => "Car Model 1", "availability" => "Available"],
    ["name" => "Car Model 2", "availability" => "Rented"],
    ["name" => "Car Model 3", "availability" => "Available"]
];

$featuredCars = [
    ["name" => "Car Model A", "availability" => "Available"],
    ["name" => "Car Model B", "availability" => "Rented"],
    ["name" => "Car Model C", "availability" => "Available"]
];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental</title>
    <link rel="stylesheet" href="css\styles.css">
</head>
<body>
    <header>
        <?php include 'nav.php'; ?>
    </header>
        <!-- main -->
    <!-- PLACEHOLDER -->
    <section class="hero">
        <div class="hero-content">
            <h1>Tagline</h1>
            <a href = "carlisting.php"><button class = "btn">Explore Cars</button></a>
            <div class="dots">
                ● ● ● ●
            </div>
        </div>
    </section>

    <section class="recent-rentals">
        <h2>Recent Rentals</h2>
        <div class="cars">
            <?php foreach ($recentRentals as $car) : ?>
                <div class="car-box">
                    <div class="car-image"></div>
                    <ul class="car-details">
                        <li><p><?= $car['name']; ?></p></li>
                        <li><p class="availability"><?= $car['availability']; ?></p></li>
                    </ul>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="featured-cars">
        <h2>Featured Cars</h2>
        <div class="cars">
            <?php foreach ($featuredCars as $car) : ?>
                <div class="car-box">
                    <div class="car-image"></div>
                    <ul class="car-details">
                        <li><p><?= $car['name'];?></p></li>
                        <li><p class="availability"><?= $car['availability']; ?></p></li>
                    </ul>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <footer>
        <?php include 'footer.php' ?>
    </footer>
</body>



</html>