<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Transactions</title>
    <?php 
        include 'connectivity.php';

        $query = "SELECT t.transactionID, t.userID, t.carID, td.pickupDate, td.returnDate, cc.cardNumber
                  FROM transactiondetails t
                  LEFT JOIN transactiondates td ON t.transactionID = td.transactionID
                  LEFT JOIN creditcard cc ON t.userID = cc.userID
                  ";

        $result = $con->query($query);
    ?>
    </style>
</head>
<body>
    <header>
        <?php include 'admin_nav.php'; ?>
    </header>
    
    <main class="admin-container">
        <h2 class="title">Transactions</h2>
        <a href="create.php?type=transaction" class="action add">Add New Transaction</a>
        <hr class="sep">
        <table>
            <tr>
                <th>Transaction ID</th>
                <th>User ID</th>
                <th>Car ID</th>
                <th>Pickup Date</th>
                <th>Return Date</th>
                <th>Payment (Card Number)</th>
                <th colspan="3">Actions</th>
            </tr>

            <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()){
                        echo "<tr>
                                <td>{$row['transactionID']}</td>
                                <td>{$row['userID']}</td>
                                <td>{$row['carID']}</td>
                                <td>{$row['pickupDate']}</td>
                                <td>{$row['returnDate']}</td>
                                <td>" . substr($row['cardNumber'], -4) . "</td> <!-- Show last 4 digits for security -->
                                <td><a href='read.php?type=transaction&id=" . $row['TransactionID'] . "' class='action view'>View</a></td>
                                <td><a href='update.php?type=transaction&id=" . $row['TransactionID'] . "' class='action edit'>Edit</a></td>
                                <td><a href='delete.php?type=transaction&id=" . $row['TransactionID'] . "' class='action delete'>Delete</a></td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>No transactions found.</td></tr>";
                }
            ?>
        </table>

        <a class="arrowBtn" href="#top">↑</a>

</body>
</html>
