<?php
    include 'admin/connectivity.php';
    
    $query = "SELECT c.carID, c.brand, c.model, c.type, c.image, crd.availability 
              FROM car c
              LEFT JOIN carrentaldetail crd ON c.carID = crd.carID
              ORDER BY c.type
            ";
    
    $result = $con->query($query);
    
    $carTypes = [];
    $cars = $result->fetch_all(MYSQLI_ASSOC);
    
    foreach ($cars as $row) {
        $carTypes[$row['type']][] = [
            "image" => $row['image'],
            "name" => "{$row['brand']} {$row['model']}",
            "availability" => $row['availability']
        ];
    }
    ?>
    

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
                            <div class="car-card">
                                <img src="assets/carImages/<?= $car['image']; ?>" alt="<?= $car['name']; ?>">
                                <h3><?= $car['name']; ?></h3>
                                <p><?= $car['availability']; ?></p>
                            </div>
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
