<?php
    session_start();
    include 'admin/connectivity.php';

    if (!isset($_SESSION['userID'])) {
        echo "<script> alert('You must be logged in to view this page.');
                window.location.href='login.php';</script>";
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


    $historyQuery = "SELECT td.TransactionID, c.brand, c.model, td.TotalAmount, tdates.PickupDate, tdates.ReturnDate
                        FROM transactiondetails td 
                        JOIN car c ON td.CarID = c.carID
                        JOIN transactiondates tdates ON td.TransactionID = tdates.TransactionID
                        WHERE td.UserID = ?
                        ORDER BY td.TransactionID DESC
                        LIMIT 3
                    ";

    //prepared statements for security
    $historyStmt = $con->prepare($historyQuery);
    $historyStmt->bind_param("i", $userID);
    $historyStmt->execute();
    $historyResult = $historyStmt->get_result();

    $returnQuery = "SELECT c.CarID, c.brand, c.model, tdates.ReturnDate, td.TransactionID
                        FROM transactiondetails td
                        JOIN car c ON td.CarID = c.CarID
                        JOIN transactiondates tdates ON td.TransactionID = tdates.TransactionID
                        JOIN carrentaldetail cr ON c.CarID = cr.CarID
                        WHERE td.UserID = ? 
                        AND cr.Availability = 'Rented'
                        AND td.TransactionID IN (
                            SELECT MAX(td_inner.TransactionID)
                            FROM transactiondetails td_inner
                            WHERE td_inner.UserID = td.UserID
                            GROUP BY td_inner.CarID
                        )
                        ORDER BY tdates.ReturnDate ASC
                    ";

    $returnStmt = $con->prepare($returnQuery);
    $returnStmt->bind_param("i", $userID);
    $returnStmt->execute();
    $returnResult = $returnStmt->get_result();

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['transactionID'])) {
        $transactionID = $_POST['transactionID'];
    
        $updateQuery = "UPDATE carrentaldetail 
                        SET Availability = 'Available' 
                        WHERE CarID = (SELECT CarID FROM transactiondetails WHERE TransactionID = ?)";
        
        $updateStmt = $con->prepare($updateQuery);
        $updateStmt->bind_param("i", $transactionID);
        
        if ($updateStmt->execute()) {
            echo "<script>alert('Car returned successfully.'); window.location.href='myprofile.php';</script>";
        } else {
            echo "<script>alert('Error returning car. Please try again.'); window.location.href='myprofile.php';</script>";
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editProfile'])) {
        $updates = [];
        foreach ($_POST as $key => $value) {
            if (in_array($key, ['FirstName', 'LastName', 'MiddleInitial', 'Address', 'Barangay', 'City', 'Province', 'ZipCode'])) {
                $updates[] = "$key = '" . $con->real_escape_string($value) . "'";
            }
        }
    
        if (!empty($updates)) {
            $update_query = "UPDATE userinfo SET " . implode(", ", $updates) . " WHERE UserID = ?";
            $update_stmt = $con->prepare($update_query);
            $update_stmt->bind_param("i", $userID);
            
            if ($update_stmt->execute()) {
                echo "<script>alert('Profile updated successfully!'); window.location.href='myprofile.php';</script>";
                exit;
            } else {
                echo "<h2>Error updating profile: " . $con->error . "</h2>";
                exit;
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - The Garage</title>
    <link rel="stylesheet" href="\css\styles.css">
    <link rel="stylesheet" href="css\styles.css">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/logo.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/logo.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/logo.png">
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
                <button id="editProfileButton" class="btn-secondary edit">Edit Profile</button>
            </div>
        </div>
    </section>

    <div class="edit-section" id="editProfileSection">
        <h2>Edit Profile</h2>
        <form method="POST">
            <label for="FirstName">First Name:</label>
            <input type="text" name="FirstName" value="<?= htmlspecialchars($user['FirstName']); ?>" required>
            <br>
            <label for="LastName">Last Name:</label>
            <input type="text" name="LastName" value="<?= htmlspecialchars($user['LastName']); ?>" required>
            <br>
            <label for="MiddleInitial">Middle Initial:</label>
            <input type="text" name="MiddleInitial" value="<?= htmlspecialchars($user['MiddleInitial']); ?>">
            <br>
            <label for="Address">Address:</label>
            <input type="text" name="Address" value="<?= htmlspecialchars($user['Address']); ?>" required>
            <br>
            <label for="Barangay">Barangay:</label>
            <input type="text" name="Barangay" value="<?= htmlspecialchars($user['Barangay']); ?>" required>
            <br>
            <label for="City">City:</label>
            <input type="text" name="City" value="<?= htmlspecialchars($user['City']); ?>" required>
            <br>
            <label for="Province">Province:</label>
            <input type="text" name="Province" value="<?= htmlspecialchars($user['Province']); ?>" required>
            <br>
            <label for="ZipCode">Zip Code:</label>
            <input type="text" name="ZipCode" value="<?= htmlspecialchars($user['ZipCode']); ?>" required>
            <br>
            <button type="submit" name="editProfile" class="action save">Save Changes</button>
        </form>
    </div>

    <section class = "history-section">
        <h1>History</h1>
        <table>
            <tr>
                <th>Car Name & Model</th>
                <th>Total Price</th>
                <th>Pickup Date</th>
                <th>Return Date</th>
            </tr>
            <?php if ($historyResult->num_rows > 0):
                while ($history = $historyResult->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($history['brand'] . ' ' . $history['model']); ?></td>
                <td><?= htmlspecialchars(number_format($history['TotalAmount'], 2)); ?></td>
                <td><?= htmlspecialchars($history['PickupDate']); ?></td>
                <td><?= htmlspecialchars($history['ReturnDate']); ?></td>
            </tr>
            <?php endwhile; ?>
            <?php else: ?>
            <tr>
                <td colspan="4">No rentals found.</td> 
            </tr>
            <?php endif; ?>         
        </table>
    </section>

    <section class = "history-section">
        <h1>Return Rented Car</h1>
        <table>
            <tr>
                <th>Car Name & Model</th>
                <th>Return Date</th>
                <th>Action</th>
            </tr>
            <?php if ($returnResult->num_rows > 0):
                while ($return = $returnResult->fetch_assoc()):
                    $returnDate = new DateTime($return['ReturnDate']);
                    $currentDate = new DateTime();
                    $isOverdue = $returnDate < $currentDate;
                ?>
                    <tr>
                        <td><?= htmlspecialchars($return['brand'] . ' ' . $return['model']); ?></td>
                        <td><?= htmlspecialchars($return['ReturnDate']); ?></td>
                        <td class="button-cell">
                            <?php if ($isOverdue): ?>
                                <p class="unavailable">This car should have been returned by <?= htmlspecialchars($return['ReturnDate']); ?></p>
                            <?php endif; ?>
                            <form action="" method="POST">
                                <input type="hidden" name="transactionID" value="<?= htmlspecialchars($return['TransactionID']); ?>">
                                <input type="submit" value="Return Car" class="btn">
                             </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">No rented cars found.</td> 
                </tr>
            <?php endif; ?>         
        </table>
    </section>
 
    <footer>
        <?php include 'footer.php' ?>
    </footer>
    <script src="js/redirectLogin.js"></script>
</body>
</html>
