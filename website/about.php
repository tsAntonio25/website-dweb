<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - The Garage</title>
    <link rel="stylesheet" href="css\styles.css">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/logo.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/logo.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/logo.png">
</head>
<body>
    <header>
        <?php include 'nav.php'; ?>
    </header>

    <section class = "about-section">
        <h1>About</h1>
        <p class="aboutp">At <strong>The Garage</strong>, we provide reliable and affordable rental vehicles, including sedans, SUVs, AUVs, and vans. Our goal is to offer hassle-free rental services with flexible booking options and excellent customer support.</p>

        <div class="info-box">
            <h2>Mission</h2>
            <p>Our mission is to provide affordable, well-maintained rental vehicles and excellent customer service, ensuring a seamless and comfortable journey for all travelers.</p>
        </div>

        <div class="info-box">
            <h2>Vision</h2>
            <p>We aim to be a leading car rental provider known for reliability, affordability, and outstanding customer care, making transportation more accessible for everyone.</p>
        </div>

        <h2 class = "team-heading"> Meet Our Team </h2>
        <div class = "team-container">
            <div class = "team-member">
                <img src = "assets/team-member1.jpg" class = "team-img"/>
                <p>Chief Executive Officer</p>
            </div>
            <div class = "team-member">
                <img src = "assets/team-member2.jpg" class = "team-img"/>
                <p>Chief Operating Officer</p>
            </div>
            <div class = "team-member">
                <img src = "assets/team-member3.jpg" class = "team-img"/>
                <p>Chief Financial Officer</p>
            </div>
            <div class = "team-member">
                <img src = "assets/team-member4.jpg" class = "team-img"/>
                <p>Chief Information Officer</p>
                </div>
        </div>
    </section>

    <footer>
        <?php include 'footer.php' ?>
    </footer>
</body>
</html>
