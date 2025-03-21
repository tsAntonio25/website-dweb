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
        <h1>My Profile</h1>

        <div class="gallery">
            <img src="assets/team-member.jpg" alt="Photo 1">
            <div class="gallery-details">
                <h2>Lname, Fname, M.I</h2>
                <p>name@gmail.com</p>
                <p>House, Lot, Zone, Street, Barangay, City, Province, Zip Code</p>
            </div>
        </div>
    </section>

    <section class = "history-section">
        <h1>History</h1>
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
