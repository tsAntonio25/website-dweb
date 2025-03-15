<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - The Garage</title>
    <link rel="stylesheet" href="\css\styles.css">
</head>
<body>
    <header>
        <?php include 'nav.php'; ?>
    </header>

    <section class = "signup_1-section">
        <h1>Sign Up</h1>

        <form action="/action_page.php">
            <label for="fname">First Name</label><br>
            <input type="text" id="fname" name="fname" value="fname"><br>

            <label for="lname">Last Name</label><br>
            <input type="text" id="lname" name="lname" value="lname"><br>

            <label for="mi">Middle Name</label><br>
            <input type="text" id="mi" name="mi" value="mi"><br>

            <label for="suffix">Suffix</label><br>
            <input type="text" id="suffix" name="suffix" value="suffix"><br>

            <label for="hlzs">House, Lot, Zone, Street</label><br>
            <input type="text" id="hlzs" name="hlzs" value="hlzs"><br>

            <label for="barangay">Barangay</label><br>
            <input type="text" id="barangay" name="barangay" value="barangay"><br>

            <label for="city">City</label><br>
            <input type="text" id="city" name="city" value="city"><br>

            <label for="province">Province</label><br>
            <input type="text" id="province" name="province" value="province"><br>

            <label for="zip">Zip Code</label><br>
            <input type="text" id="zip" name="zip" value="zip"><br>
            
            <button type="submit" class="submit-btn">Create Account</button>
            <!-- di ako sure dito -->
        </form> 

    </section>

    <footer>
        <?php include 'footer.php' ?>
    </footer>
</body>
</html>