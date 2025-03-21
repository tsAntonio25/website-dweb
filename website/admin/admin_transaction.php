<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Transactions</title>
    <?php 
        include 'connectivity.php';

        $query = "SELECT * FROM transaction";
        $result = $con->query($query);
    ?>
    <style>
        body {
            background-color: #302C2C;
            color: #fff;
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #3C3C3C;
            color: #fff;
        }
        th, td {
            padding: 10px;
            border: 1px solid #707070;
            text-align: center;
        }
        th {
            background-color: #707070;
        }
        .arrowBtn {
            position: fixed;
            bottom: 20px;
            right: 30px;
            background-color: #D9D9D9;
            color: #302C2C;
            padding: 10px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <header>
        <?php include 'admin_nav.php'; ?>
    </header>
    
    <main class="admin-container">
        <h2 class="title">Transactions</h2>
        <hr class="sep">
        <table>
            <tr>
                <th>Transaction ID</th>
                <th>User ID</th>
                <th>Car ID</th>
                <th>Rental Price</th>
                <th>Additional Price</th>
                <th>Total Amount</th>
                <th>Payment Method</th>
                <th>Pickup Date</th>
                <th>Return Date</th>
            </tr>

            <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()){
                        echo "<tr>
                                <td>{$row['transactionID']}</td>
                                <td>{$row['userID']}</td>
                                <td>{$row['carID']}</td>
                                <td>{$row['rentalPrice']}</td>
                                <td>{$row['additionalPrice']}</td>
                                <td>{$row['totalAmount']}</td>
                                <td>{$row['paymentMethod']}</td>
                                <td>{$row['pickUpDate']}</td>
                                <td>{$row['returnDate']}</td>
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
