<?php
//PLACEHOLDER
// Simulated car data (In real-world use, fetch from a database)
$carTypes = [
    "SUVs" => [
        ["name" => "Toyota RAV4", "availability" => "Available"],
        ["name" => "Honda CR-V", "availability" => "Rented"],
        ["name" => "Ford Explorer", "availability" => "Available"]
    ],
    "Sedans" => [
        ["name" => "Toyota Camry", "availability" => "Available"],
        ["name" => "Honda Accord", "availability" => "Rented"],
        ["name" => "Nissan Altima", "availability" => "Available"]
    ],
    "Trucks" => [
        ["name" => "Ford F-150", "availability" => "Available"],
        ["name" => "Chevrolet Silverado", "availability" => "Rented"],
        ["name" => "Ram 1500", "availability" => "Available"]
    ],
    "Electric Cars" => [
        ["name" => "Tesla Model 3", "availability" => "Available"],
        ["name" => "Nissan Leaf", "availability" => "Rented"],
        ["name" => "Chevrolet Bolt", "availability" => "Available"]
    ]
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
    <main>
<!-- SEDAN -->
        <section class = "sedan">
            <h2>SEDAN</h2>
            <div class = "arrow" onclick = "prevSlide()">&#10094;</div>
            <div class = "sedan-container">

                <div class = "car-card">
                    <img src = "sedan1.jpg" alt = "Car Image">
                    <h3>Car Name</h3>
                    <p>Availability</p>
                </div>

                <div class = "car-card">
                    <img src = "sedan2.jpg" alt = "Car Image">
                    <h3>Car Name</h3>
                    <p>Availability</p>
                </div>

                <div class = "car-card">
                    <img src = "sedan3.jpg" alt = "Car Image">
                    <h3>Car Name</h3>
                    <p>Availability</p>
                </div>
            </div>

            <div class = "arrow" onclick = "nextSlide()">&#10095;</div>
        </section>

    <!-- AUV -->
        <section class = "auv">
            <h2>AUV</h2>
            <div class = "arrow" onclick = "prevSlide()">&#10094;</div>
            <div class = "auv-container">

                <div class = "car-card">
                    <img src = "auv1.jpg" alt = "Car Image">
                    <h3>Car Name</h3>
                    <p>Availability</p>
                </div>

                <div class = "car-card">
                    <img src = "auv2.jpg" alt = "Car Image">
                    <h3>Car Name</h3>
                    <p>Availability</p>
                </div>

                <div class = "car-card">
                    <img src = "auv3.jpg" alt = "Car Image">
                    <h3>Car Name</h3>
                    <p>Availability</p>
                </div>
            </div>

            <div class = "arrow" onclick = "nextSlide()">&#10095;</div>
        </section>

    <!-- SUV -->
        <section class = "suv">
            <h2>SUV</h2>
            <div class = "arrow" onclick = "prevSlide()">&#10094;</div>
            <div class = "suv-container">

                <div class = "car-card">
                    <img src = "suv1.jpg" alt = "Car Image">
                    <h3>Car Name</h3>
                    <p>Availability</p>
                </div>

                <div class = "car-card">
                    <img src = "suv2.jpg" alt = "Car Image">
                    <h3>Car Name</h3>
                    <p>Availability</p>
                </div>

                <div class = "car-card">
                    <img src = "suv3.jpg" alt = "Car Image">
                    <h3>Car Name</h3>
                    <p>Availability</p>
                </div>
            </div>

            <div class = "arrow" onclick = "nextSlide()">&#10095;</div>
        </section>

    <!-- VAN -->
        <section class = "van">
            <h2>VAN</h2>
            <div class = "arrow" onclick = "prevSlide()">&#10094;</div>
            <div class = "van-container">

                <div class = "car-card">
                    <img src = "van1.jpg" alt = "Car Image">
                    <h3>Car Name</h3>
                    <p>Availability</p>
                </div>

                <div class = "car-card">
                    <img src = "van2.jpg" alt = "Car Image">
                    <h3>Car Name</h3>
                    <p>Availability</p>
                </div>

                <div class = "car-card">
                    <img src = "van3.jpg" alt = "Car Image">
                    <h3>Car Name</h3>
                    <p>Availability</p>
                </div>
            </div>

            <div class = "arrow" onclick = "nextSlide()">&#10095;</div>
        </section>

    </main>

   

    <!-- footer -->
    <footer>
        <?php include 'footer.php' ?>
    </footer>
</body>



</html>