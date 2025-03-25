<?php
    session_start();
    include 'admin/connectivity.php';

    if (!isset($_SESSION['userID'])) {
        echo "<script> alert('You must be logged in to view this page.');</script>";
        exit;
    }

    $userID = $_SESSION['userID'];

    $query = "SELECT FirstName, LastName, MiddleInitial, Address, Barangay, City, Province, ZipCode 
                FROM userinfo 
                WHERE UserID = ?
            ";

    //prepared statements for security
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $userID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        echo "<h2>User not found.</h2>";
        exit;
    }


    $historyQuery = "SELECT td.TransactionID, c.brand, c.model, td.RentalPrice, td.AdditionalPrice, td.TotalAmount, td.PaymentMethod 
                     FROM transactiondetails td 
                     JOIN car c ON td.CarID = c.carID 
                     WHERE td.UserID = ?
                    ";

    //prepared statements for security
    $historyStmt = $con->prepare($historyQuery);
    $historyStmt->bind_param("i", $userID);
    $historyStmt->execute();
    $historyResult = $historyStmt->get_result();
?>

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
                <h2><?= htmlspecialchars($user['LastName'] . ', ' . $user['FirstName'] . ' ' . htmlspecialchars($user['MiddleInitial'])); ?></h2>
                <p><?= htmlspecialchars($user['Barangay'] . ', ' . $user['City'] . ', ' . $user['Province'] . ', ' . $user['ZipCode']); ?></p>
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
            <?php if ($historyResult->num_rows > 0):
                while ($history = $historyResult->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($history['brand'] . ' ' . $history['model']); ?></td>
                <td><?= htmlspecialchars(number_format($history['RentalPrice'], 2)); ?></td>
                <td><?= htmlspecialchars(number_format($history['TotalAmount'], 2)); ?></td>
                <td><?= htmlspecialchars($history['PaymentMethod']); ?></td>
            </tr>
    <?php endwhile; ?>
<?php else: ?>
    <tr>
        <td colspan="4">No rentals found.</td> 
    </tr>
<?php endif; ?>
                
        </table>
    </section>
 
    <footer>
        <?php include 'footer.php' ?>
    </footer>
</body>
</html>
