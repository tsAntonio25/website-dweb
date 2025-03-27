<?php
    include 'connectivity.php';

    if (isset($_GET['type']) && isset($_GET['id'])) {
        $type = $_GET['type'];
        $id = intval($_GET['id']);

        switch ($type) {
            case 'user':
                $checkUser  = $con->query("SELECT * FROM userinfo WHERE UserID = $id");
                if ($checkUser ->num_rows > 0) {
                    $con->query("DELETE FROM userinfo WHERE UserID = $id");
                }
                $table = "user";
                $id_column = "UserID";
                $redirect_page = "admin_user.php";
                break;
            case 'car':
                $checkCarRental = $con->query("SELECT * FROM carrentaldetail WHERE CarID = $id");
                if ($checkCarRental->num_rows > 0) {
                    $con->query("DELETE FROM carrentaldetail WHERE CarID = $id");
                }
                $table = "car";
                $id_column = "CarID";
                $redirect_page = "admin_car.php";
                break;
            case 'transaction':
                $checkCreditCard = $con->query("SELECT * FROM creditcard WHERE TransactionID = $id");
                if ($checkCreditCard->num_rows > 0) {
                    $con->query("DELETE FROM creditcard WHERE TransactionID = $id");
                }

                $checkTransactionDates = $con->query("SELECT * FROM transactiondates WHERE TransactionID = $id");
                if ($checkTransactionDates->num_rows > 0) {
                    $con->query("DELETE FROM transactiondates WHERE TransactionID = $id");
                }

                $table = "transactiondetails";
                $id_column = "TransactionID";
                $redirect_page = "admin_transaction.php";
                break;
            default:
                die("<h2>Invalid type specified.</h2>");
        }

        if (isset($_GET['confirm']) && $_GET['confirm'] === 'yes') {
            $stmt = $con->prepare("DELETE FROM $table WHERE $id_column = ?");
            $stmt->bind_param("i", $id);

            if ($stmt->execute()) {
                echo "<script>
                        alert('Record deleted successfully!');
                        window.location.href='$redirect_page';
                      </script>";
                exit;
            } else {
                die("<h2>Error deleting record: " . $con->error . "</h2>");
            }
        }
    } else {
        die("<h2>Invalid request.</h2>");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Confirmation</title>
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
        <h2 class="title">Are you sure you want to delete this record?</h2>
        <hr class="sep">
        <div class="buttons">
            <a href="delete.php?type=<?php echo $type; ?>&id=<?php echo $id; ?>&confirm=yes" class="action delete">Yes, Delete</a>
            <a href="<?php echo $redirect_page; ?>" class="action back">Cancel</a>
        </div>
    </main>
</body>
</html>
