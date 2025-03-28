<?php 
// session
session_start();

//admin create
include 'connectivity.php';

if (isset($_GET['type'])) {
    $type = $_GET['type'];

    switch ($type) {
        case 'car':
            $table1 = "car";
            $table2 = "carrentaldetail";
            $fields1 = ['Model', 'Brand', 'Color', 'Type', 'FuelType', 'Image', 'Description'];
            $fields2 = ['Availability', 'RentalPrice'];
            $redirect_page = "admin_car.php";
            break;
        case 'transaction':
            $table1 = "transactiondetails";
            $table2 = "transactiondates";
            $fields1 = ['UserID', 'CarID', 'RentalPrice', 'TotalAmount', 'PaymentMethod'];
            $fields2 = ['PickupDate', 'ReturnDate'];
            $redirect_page = "admin_transaction.php";
            break;
        case 'user':
            $table1 = "user";
            $table2 = "userinfo";
            $fields1 = ['Email', 'Password'];
            $fields2 = ['FirstName', 'LastName', 'MiddleInitial', 'Suffix', 'Address', 'Barangay', 'City', 'Province', 'ZipCode'];
            $optionalField = ['Suffix'];
            $redirect_page = "admin_user.php";
            break;
        default:
            echo "<h2>Invalid type specified.</h2>";
            exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $values1 = [];
        $values2 = [];

        foreach ($_POST as $key => $value) {
            if (in_array($key, $fields1)) {
                $values1[$key] = $con->real_escape_string($value);
            } elseif (in_array($key, $fields2)) {
                $values2[$key] = $con->real_escape_string($value);
            }
        }

        if (!empty($values1)) {
            $columns1 = implode(", ", array_keys($values1));
            $placeholders1 = implode("', '", array_values($values1));
            $query1 = "INSERT INTO $table1 ($columns1) VALUES ('$placeholders1')";
            
            if ($con->query($query1) === TRUE) {
                $new_id = $con->insert_id;
            } else {
                echo "<h2>Error: " . $con->error . "</h2>";
                exit;
            }
        }

        if (!empty($values2) && isset($new_id)) {
            if ($type === 'transaction') {
                $values2['TransactionID'] = $new_id;
            } elseif ($type === 'car') {
                $values2['CarID'] = $new_id;
            } elseif ($type === 'user') {
                $values2['UserID'] = $new_id;
            }
            
            $columns2 = implode(", ", array_keys($values2));
            $placeholders2 = implode("', '", array_values($values2));
            $query2 = "INSERT INTO $table2 ($columns2) VALUES ('$placeholders2')";
            
            if ($con->query($query2) === FALSE) {
                echo "<h2>Error: " . $con->error . "</h2>";
                exit;
            }

            if ($type === 'transaction') {
                $updateQuery = "UPDATE carrentaldetail SET Availability = 'Rented' WHERE CarID = '$values1[CarID]'";
                if ($con->query($updateQuery) === FALSE) {
                    echo "<h2>Error updating car availability: " . $con->error . "</h2>";
                    exit;
                }
            }
        }

        echo "<script>alert('Record added successfully!'); window.location.href='$redirect_page';</script>";
        exit;
    }
} else {
    echo "<h2>Invalid request.</h2>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Record</title>
    <link rel="stylesheet" href="../css/admin_styles.css">
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/logo.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/logo.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/logo.png">
</head>
<body>
    <header>
        <?php include 'admin_nav.php'; ?>
    </header>

    <main class="admin-container">
        <h2 class="title">Add New <?php echo ucfirst($type); ?></h2>
        <a href="<?php echo $redirect_page; ?>" class="action back">Back</a>
        <hr class="sep">

        <form method="POST">
            <h3 class="table-name"><?php echo ucfirst($table1); ?> Table</h3>
            <table>
                <?php foreach ($fields1 as $field) { ?>
                    <tr>
                        <th><?php echo ucfirst($field); ?></th>
                        <td><input type="text" name="<?php echo $field; ?>" required></td>
                    </tr>
                <?php } ?>
            </table>

            <?php if (!empty($fields2)) { ?>
                <h3 class="table-name"><?php echo ucfirst($table2); ?> Table</h3>
                <table>
                    <?php foreach ($fields2 as $field) { ?>
                        <tr>
                            <th><?php echo ucfirst($field); ?></th>
                            <td><input type="text" name="<?php echo $field; ?>"></td>
                        </tr>
                    <?php } ?>
                </table>
            <?php } ?>

            <button type="submit" class="action save">Create Record</button>
        </form>
    </main>
</body>
</html>
