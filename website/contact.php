<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - The Garage</title>
    <link rel="stylesheet" href="css\styles.css"></head>
<body>
    <header>
        <?php include 'nav.php'; ?>
    </header>

<section class = "contact-section">
    <h1>Contact</h1>

    <div class="gallery">
        <img src="photo1.jpg" alt="Photo 1">
    </div>

        <h2>Contact Details</h2>
        <p>Have questions or need help? Contact The Garage, your reliable car rental provider. We're here to help with reservations, queries, and more!</p>

        <div class="contact-container">
            <div class="contact-item">
                <img src="" alt="">
                <span>thegarage@gmail.com</span>
            </div>

            <div class="contact-item">
                <img src="" alt="">
                <span>0912 345 6789</span>
            </div>

            <div class="contact-item">
                <img src="" alt="">
                <span>thegarage</span>
            </div>

            <div class="contact-item">
                <img src="" alt="">
                <span>@thegaragecars</span>
            </div>
        </div>
</section>

    <form action="/action_page.php">
        <label for="name">Name</label><br>
        <input type="text" id="name" name="name" value="name"><br>

        <label for="email">E-mail</label><br>
        <input type="text" id="email" name="email" value="email"><br>

        <label for="message">Message</label><br>
        <input type="text" id="message" name="message" value="message"><br><br>

        <input type="submit" value="Submit">
    </form>

    <footer>
        <?php include 'footer.php' ?>
    </footer>
</body>
</html>