<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - The Garage</title>
    <link rel="stylesheet" href="\css\styles.css">
</head>
<body>
    <header>
        <?php include 'nav.php'; ?>
    </header>

    <section class = "signup-section">
        <h1>Sign Up</h1>

        <form action="admin/operations/create.php" method="post">
            <div class="form-group">
                <h3>Personal Information</h3>
                <div class="row">
                    <div class="column1">
                            <label for="fname">First Name</label>
                            <input type="text" id="fname" name="fname"placeholder="Juan" required>
                    </div>
                    <div class="column2">
                        <label for="lname">Last Name</label>
                        <input type="text" id="lname" name="lname" placeholder="Dela Cruz" required>
                    </div>
                </div>

                    <div class="row">
                        <div class="column1">
                            <label for="mi">Middle Initial</label>
                            <input type="text" id="mi" name="mi" placeholder="C.">
                        </div>
                        <div class="column2">
                            <label for="suffix">Suffix</label>
                            <input type="text" id="suffix" name="suffix" placeholder="Jr.">
                        </div>
                    </div>

                <label for="hlzs">House, Lot, Zone, Street</label>
                <input type="text" id="hlzs" name="hlzs" placeholder="100, Lot 3, Zone 1, Street 4"><br>

                <div class="row">
                    <div class="column1">
                        <label for="barangay">Barangay</label>
                        <input type="text" id="barangay" name="barangay" placeholder="Barangay 123" required>
                    </div>
                    <div class="column2">
                        <label for="city">City</label>
                        <input type="text" id="city" name="city" placeholder="Manila" required>
                    </div>
                </div>

                <div class="row">
                    <div class="column1">
                        <label for="province">Province</label>
                        <input type="text" id="province" name="province" placeholder="Metro Manila" required>
                    </div>
                    <div class="column2">
                        <label for="zip">Zip Code</label>
                        <input type="text" id="zip" name="zip" placeholder="1000" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <h3 class="group2">Account Information</h3>

                <label for="email">E-mail</label>
                <input type="text" id="email" name="email" placeholder="juandelacruz@email.com"><br>

                <label for="password">Password</label>
                <input type="text" id="password" name="password" placeholder="Password"><br>

                <label for="confirm">Confirm Password</label>
                <input type="text" id="confirm" name="confirm" placeholder="Re-type Password"><br><br>

                <div class="submit-container">
                    <input type="submit" value="Sign Up" class="submit btn" name="sign_up">
                </div>
            </div>
            
                
            </form> 

    </section>

    <footer>
        <?php include 'footer.php' ?>
    </footer>
</body>
</html>