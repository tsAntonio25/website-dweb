<?php
    session_start();
    include 'admin/connectivity.php';


    $featuredCarsQuery = "SELECT c.CarID, c.Model, c.Image, crd.Availability
                            FROM car c
                            JOIN carrentaldetail crd ON c.CarID = crd.CarID
                            ORDER BY c.CarID ASC 
                            LIMIT 3
                        ";


    //prepared statements for security
    $stmt = $con->prepare($featuredCarsQuery);
    $stmt->execute();
    $featuredCarsResult = $stmt->get_result();
    
    $featuredCars = [];
    while ($row = $featuredCarsResult->fetch_assoc()) {
        $featuredCars[] = [
            "carID" => $row['CarID'],
            "image" => htmlspecialchars($row['Image']),
            "name" => htmlspecialchars($row['Model']),
            "availability" => strtolower($row['Availability']) === 'available' ? 'Available' : 'Unavailable'
        ];        
}

    if (isset($_SESSION['userID'])) {
        $userID = $_SESSION['userID'];

            $recentRentalsQuery = "SELECT c.CarID, c.Model, c.Image, crd.Availability
                                    FROM car c
                                    JOIN transactiondetails t ON c.CarID = t.CarID
                                    LEFT JOIN carrentaldetail crd ON c.CarID = crd.CarID
                                    WHERE t.UserID = ? 
                                    ORDER BY t.TransactionID DESC
                                    LIMIT 3
                                ";

        //prepared statements for security
        $stmt = $con->prepare($recentRentalsQuery);
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $recentRentalsResult = $stmt->get_result();
        
        $recentRentals = [];
        while ($row = $recentRentalsResult->fetch_assoc()) {
            $recentRentals[] = [
                "carID" => $row['CarID'],
                "image" => htmlspecialchars($row['Image']),
                "name" => htmlspecialchars($row['Model']),
                "availability" => strtolower($row['Availability']) === 'available' ? 'Available' : 'Unavailable'
            ];
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
    <title>The Garage</title>
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
                <img src="assets/cover3.jpg">
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
                    <a href="rent1.php?carID=<?= $car['carID']; ?>" class="car-box-link">
                        <div class="car-box">
                        <a href="rent1.php?carID=<?= $car['carID']; ?>" class="car-box-link">
                            <div class="car-box">
                                <div class="car-image">
                                    <img src="assets/carImages/<?= $car['image']; ?>" alt="<?= $car['name']; ?>">
                                </div>
                                <ul class="car-details">
                                    <li><p><?= htmlspecialchars($car['name']); ?></p></li>
                                    <p><?= htmlspecialchars($car['availability']); ?></p>
                                </ul>
                            </div>
                        </a>
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
                    <a href="rent1.php?carID=<?= $car['carID']; ?>" class="car-box-link">
                        <div class="car-box">
                            <div class="car-image">
                                <img src="assets/carImages/<?= $car['image']; ?>" alt="<?= $car['name']; ?>">
                            </div>
                            <ul class="car-details">
                                <li><p><?= htmlspecialchars($car['name']); ?></p></li>
                                <p><?= htmlspecialchars($car['availability']); ?></p>
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