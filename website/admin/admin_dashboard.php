<?php 
include 'connectivity.php';

    $userCountQuery = "SELECT COUNT(*) AS total FROM user";
    $carCountQuery = "SELECT COUNT(*) AS total FROM car";
    $transactionCountQuery = "SELECT COUNT(*) AS total FROM transactiondetails";

    $userCount = $con->query($userCountQuery)->fetch_assoc()['total'];
    $carCount = $con->query($carCountQuery)->fetch_assoc()['total'];
    $transactionCount = $con->query($transactionCountQuery)->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Dashboard</title>
    <link rel="stylesheet" href="css\styles.css">
    <<link rel="apple-touch-icon" sizes="180x180" href="../assets/logo.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/logo.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/logo.png">
</head>
<body>
    <header>
        <?php include 'admin_nav.php'; ?>
    </header>
    
    <div class="admin-container">
        <h2 class="title">Admin Dashboard</h2>
        <hr class="sep">
        <div class="page-container">
            <div class="box">
                <a href="admin_user.php">
                    <h3>Users</h3>
                    <p><?php echo $userCount; ?> Users</p>
                </a>
            </div>
            <div class="box">
                <a href="admin_car.php">
                    <h3>Cars</h3>
                    <p><?php echo $carCount; ?> Cars</p>
                </a>
            </div>
            <div class="box">
                <a href="admin_transaction.php">
                    <h3>Transactions</h3>
                    <p><?php echo $transactionCount; ?> Transactions</p>
                </a>
            </div>
        </div>
        <div class="recent-section">

            <h3 class="sub-title">New Users</h3>
            <table>
                <tr><th>ID</th><th>Email</th></tr>
                <tbody id="recentUsers">
                    <?php 
                        $recentUsers = $con->query("SELECT userID, email FROM user ORDER BY userID DESC LIMIT 5");

                        if ($recentUsers->num_rows > 0) {

                            while ($row = $recentUsers->fetch_assoc()) {
                                echo "<tr><td>{$row['userID']}</td><td>{$row['email']}</td></tr>";
                            }
                        } else {
                            echo "<tr><td colspan='2'>No users found.</td></tr>";

                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    
</body>
</html>
