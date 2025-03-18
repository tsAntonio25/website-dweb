<?php
// Simulated car data (In real-world use, fetch from a database)
$carTypes = [
    "Sedan" => [
        ["image" => "sedan1.jpg", "name" => "Toyota Camry", "availability" => "Available"],
        ["image" => "sedan2.jpg", "name" => "Honda Accord", "availability" => "Rented"],
        ["image" => "sedan3.jpg", "name" => "Nissan Altima", "availability" => "Available"],
        ["image" => "sedan4.jpg", "name" => "scroll testing", "availability" => "Available"]
    ],
    "AUV" => [
        ["image" => "auv1.jpg", "name" => "Toyota Innova", "availability" => "Available"],
        ["image" => "auv2.jpg", "name" => "Mitsubishi Xpander", "availability" => "Rented"],
        ["image" => "auv3.jpg", "name" => "Suzuki Ertiga", "availability" => "Available"]
    ],
    "SUV" => [
        ["image" => "suv1.jpg", "name" => "Ford Explorer", "availability" => "Available"],
        ["image" => "suv2.jpg", "name" => "Toyota RAV4", "availability" => "Rented"],
        ["image" => "suv3.jpg", "name" => "Honda CR-V", "availability" => "Available"]
    ],
    "Van" => [
        ["image" => "van1.jpg", "name" => "Toyota Hiace", "availability" => "Available"],
        ["image" => "van2.jpg", "name" => "Nissan Urvan", "availability" => "Rented"],
        ["image" => "van3.jpg", "name" => "Hyundai Staria", "availability" => "Available"]
    ]
];
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
                                <!-- change into assets/cartype-car php echo pag andyan na assets-->
                                <img src="assets/background.jpg" alt="<?php echo $car['name']; ?>">
                                <h3><?php echo $car['name']; ?></h3>
                                <p><?php echo $car['availability']; ?></p>
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
