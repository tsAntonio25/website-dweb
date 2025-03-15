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

    <div class="contact-container-whole">
        <div class="contact-details">

            <h2>Contact Details</h2>
            <p>Have questions or need help? Contact The Garage, your reliable car rental provider. We're here to help with reservations, queries, and more!</p>

            <div class="contact-container">
                <div class="contact-item">
                    <img src="assets/email.svg" alt="email icon">
                    <span><a href="mailto:thegarage@gmail.com">thegarage@gmail.com</a></span>
                </div>

                <div class="contact-item">
                    <img src="assets/phone.svg" alt="phone icon">
                    <span><a href="tel:+639123456789">0912 345 6789</a></span>
                </div>

                <div class="contact-item">
                    <img src="assets/fb.svg" alt="facebook icon"></a>
                    <span><a href="https://www.facebook.com/holyangel1933" target="_blank">thegarage</a></span>
                </div>

                <div class="contact-item">
                <img src="assets/ig.svg" alt="instagram icon">
                    <span><a href="https://www.instagram.com/holyangel1933/">@thegaragecars</a></span>
                </div>
            </div>
        </div>
        <div class="contact-form">
            <form action="/action_page.php">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" placeholder="name"><br>

                <label for="email">E-mail</label>
                <input type="text" id="email" name="email" placeholder="email"><br>

                <label for="message">Message</label>
                <textarea name="message" rows="6″ cols="20″>message</textarea><br><br>

                <input type="submit" value="Submit" class="submit">
            </form>
        </div>
    </div>
</section>

    

    <footer>
        <?php include 'footer.php' ?>
    </footer>
</body>
</html>