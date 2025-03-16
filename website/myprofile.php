<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - The Garage</title>
    <link rel="stylesheet" href="\css\styles.css">
</head>
<body>
    <header>
        <?php include 'nav.php'; ?>
    </header>

    <section class = "profile-section">
        <div class="gallery">
            <img src="photo1.jpg" alt="Photo 1">
        </div>

        <h2>Lname, Fname, M.I</h2>

        <p>name@gmail.com</p>

        <p>House, Lot, Zone, Street, Barangay, City, Province, Zip Code</p>
    </section>

    <section class = "history-section">
        <table>
            <tr>
                <th>Car Name & Model</th>
                <th>Pick up date</th>
                <th>Return Date</th>
                <th>Amount Paid</th>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </table>
    </section>
 
    <footer>
        <?php include 'footer.php' ?>
    </footer>
</body>
</html>
