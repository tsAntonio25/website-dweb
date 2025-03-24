<?php
session_start();
include 'admin/connectivity.php';

    $featuredCarsQuery = "SELECT CarID, Model, image FROM car ORDER BY CarID ASC LIMIT 3";

    /* pag andito na availability sa crd check query*/
    // $featuredCarsQuery = "SELECT c.CarID, c.Model, crd.Availability AS name, c.Image
    //                         FROM car c
    //                         JOIN carrentaldetail crd ON c.CarID = crd.CarID
    //                         ORDER BY c.CarID ASC 
    //                         LIMIT 3
    //                     ";

    $featuredCarsResult = $con->query($featuredCarsQuery);
    $featuredCars = [];
    
while ($row = $featuredCarsResult->fetch_assoc()) {
    $featuredCars[] = $row;
}

if (isset($_SESSION['userID'])) {
    $userID = $_SESSION['userID'];

    $recentRentalsQuery = " SELECT c.CarID, c.Model AS name, c.Image, crd.Availability
                            FROM car c
                            JOIN transactiondetails t ON c.CarID = t.CarID
                            LEFT JOIN carrentaldetail crd ON c.CarID = crd.CarID
                            ORDER BY t.TransactionID DESC
                            LIMIT 3
                        ";

    $recentRentalsResult = $con->query($recentRentalsQuery);
    $recentRentals = [];

    while ($row = $recentRentalsResult->fetch_assoc()) {
        $recentRentals[] = $row;
    }
} else {
    $recentRentals = [];
}
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
        <div class="cars">
            <?php if (count($recentRentals) > 0) : ?>
                <?php foreach ($recentRentals as $car) : ?>
                    <a href="rent1.php?carID=<?= $car['CarID']; ?>" class="car-box-link">
                        <div class="car-box">
                            <div class="car-image">
                                <img src="assets/carImages/<?= htmlspecialchars($car['Image']); ?>" alt="<?= htmlspecialchars($car['name']); ?>">
                            </div>
                            <ul class="car-details">
                                <li><p><?= htmlspecialchars($car['name']); ?></p></li>
                                <li><p class="availability"><?= htmlspecialchars($car['Availability']); ?></p></li>
                            </ul>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php else : ?>
                <h4>No recent rented cars available.</h4>
            <?php endif; ?>
        </div>
    </section>

    <section class="featured-cars">
        <h2>Featured Cars</h2>
        <div class="cars">
            <?php if (count($featuredCars) > 0) : ?>
                <?php foreach ($featuredCars as $car) : ?>
                    <a href="rent1.php?carID=<?= $car['CarID']; ?>" class="car-box-link">
                        <div class="car-box">
                            <div class="car-image">
                                <img src="assets/carImages/<?= $car['Image']; ?>" alt="<?= $car['Model']; ?>">
                            </div>
                            <ul class="car-details">
                                <li><p><?= htmlspecialchars($car['Model']); ?></p></li>
                                <!-- availability dito-->
                            </ul>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php else : ?>
                <h4>No featured cars available.</h4>
            <?php endif; ?>
        </div>
    </section>
    <footer>
        <?php include 'footer.php' ?>
    </footer>

    <script src="js/slides.js"></script>
</body>



</html>