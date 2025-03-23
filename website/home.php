<?php
include 'admin/connectivity.php';

    $featuredCarsQuery = "SELECT carID, model AS name, image FROM car ORDER BY carID ASC LIMIT 3";
    $featuredCarsResult = $con->query($featuredCarsQuery);
    $featuredCars = [];
    
    while ($row = $featuredCarsResult->fetch_assoc()) {
        $featuredCars[] = $row;
    }


    // ganito ba? d ko maimagine wla p ksi table HAHAHAHA

    // $recentRentalsQuery = "
    //     SELECT c.carID, c.model AS name, 
    //     FROM car c
    //     LEFT JOIN transaction t ON c.carID = t.carID
    //     ORDER BY t.transactionID DESC 
    //     LIMIT 3
    // ";

    // $recentRentalsResult = $con->query($recentRentalsQuery);
    // $recentRentals = [];
    // while ($row = $recentRentalsResult->fetch_assoc()) {
    //     $recentRentals[] = $row;
    // }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental- The Garage</title>
    <link rel="stylesheet" href="css\styles.css">
</head>
<body>
    <header>
        <?php include 'nav.php'; ?>
    </header>
    <section class="home">
        <div class="slideshow-container">
            <div class="coverSlides fade">
                <img src="assets/cover1.jpg">
            </div>

            <div class="coverSlides fade">
                <img src="assets/cover2.jpg">
            </div>

            <div class="coverSlides fade">
                <img src="assets/background.jpg">
            </div>
        </div>
        <div class="home-content">
            <h1>Your Garage Away From Home</h1>
            <a href = "carlisting.php"><button class = "btn">Explore Cars</button></a>
            <div class="dots">
                <span class="dot"></span> 
                <span class="dot"></span> 
                <span class="dot"></span> 
            </div>
        </div>
    </section>

    <section class="recent-rentals">
        <h2>Recent Rentals</h2>
        <!-- <div class="cars">
            <?php //foreach ($recentRentals as $car) : ?>
                <div class="car-box">
                    <div class="car-image"></div>
                    <ul class="car-details">
                        <li><p><?= $car['name']; ?></p></li>
                        <li><p class="availability"><?= $car['availability']; ?></p></li>
                    </ul>
                </div>
            <?php //endforeach; ?>
        </div> -->
    </section>

    <section class="featured-cars">
    <h2>Featured Cars</h2>
    <div class="cars">
        <?php if (count($featuredCars) > 0) : ?>
            <?php foreach ($featuredCars as $car) : ?>
                <div class="car-box">
                    <div class="car-image">
                        <img src="assets/carImages/<?= $car['image']; ?>" alt="<?= $car['name']; ?>">
                    </div>
                    <ul class="car-details">
                        <li><p><?= htmlspecialchars($car['name']); ?></p></li>
                        <li><p class="availability">Available</p></li>
                    </ul>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p>No featured cars available.</p>
        <?php endif; ?>
    </div>
</section>



    <footer>
        <?php include 'footer.php' ?>
    </footer>

    <script src="js/slides.js"></script>
</body>



</html>