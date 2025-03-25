<?php
    include 'admin/connectivity.php';
    
    $query = "SELECT c.carID, c.brand, c.model, c.type, c.image, crd.availability 
              FROM car c
              LEFT JOIN carrentaldetail crd ON c.carID = crd.carID
              ORDER BY c.type
            ";
    
    //prepared statements for security
    $stmt = $con->prepare($query); 
    $stmt->execute();
    $result = $stmt->get_result();
        
    if (!$result) {
        echo "<script> alert('Error fetching car listings: ' . htmlspecialchars($con->error) . ')</script>";
        exit;
    }

    $carTypes = [];
    $cars = $result->fetch_all(MYSQLI_ASSOC);
    
    foreach ($cars as $row) {
        $carTypes[$row['type']][] = [
            "image" => htmlspecialchars($row['image']),
            "name" => htmlspecialchars("{$row['brand']} {$row['model']}"),
            "carID" => $row['carID'],
            "availability" => $row['availability'] === 'Available' ? 'Available' : 'Unavailable'
        ];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Listing - The Garage</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <?php include 'nav.php'; ?>
    </header>

    <main>
        <h1 class="car-listing-title">Car Listing</h1>

        <?php foreach ($carTypes as $type => $cars) : ?>
            <section class="car-section">
                <h2><?php echo $type; ?></h2>
                <div class="carousel">
                    <button class="arrow left" onclick="prevSlide('<?php echo strtolower($type); ?>')">&#10094;</button>
                    <div class="car-container" id="<?php echo strtolower($type); ?>">
                        <?php foreach ($cars as $car) : ?>
                            <a href="rent1.php?carID=<?= $car['carID']; ?>"class="car-card-link">
                                <div class="car-card">
                                    <img src="assets/carImages/<?= $car['image']; ?>" alt="<?= $car['name']; ?>" loading="lazy">
                                    <h3><?= $car['name']; ?></h3>
                                    <p><?= htmlspecialchars($car['availability']); ?></p>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                    <button class="arrow right" onclick="nextSlide('<?php echo strtolower($type); ?>')">&#10095;</button>
                </div>
            </section>
        <?php endforeach; ?>
    </main>

    <footer>
        <?php include 'footer.php'; ?>
    </footer>

    <script src="js/carousel.js"></script>
</body>
</html>
