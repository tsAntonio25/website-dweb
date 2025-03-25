<?php
    include 'connectivity.php';

    if (isset($_GET['type']) && isset($_GET['id'])) {
        $type = $_GET['type'];
        $id = intval($_GET['id']);

        switch ($type) {
            case 'user':
                $con->query("DELETE FROM userinfo WHERE UserID = $id");
                $table = "user";
                $id_column = "UserID";
                $redirect_page = "admin_user.php";
                break;
            case 'car':
                $con->query("DELETE FROM carrentaldetail WHERE CarID = $id");
                $table = "car";
                $id_column = "CarID";
                $redirect_page = "admin_car.php";
                break;
            case 'transaction':
                $con->query("DELETE FROM transactiondates WHERE TransactionID = $id");
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
