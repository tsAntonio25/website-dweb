<?php
    include 'connectivity.php';

    if (isset($_GET['type']) && isset($_GET['id'])) {
        $type = $_GET['type'];
        $id = intval($_GET['id']); 

        switch ($type) {
            case 'user':
                $query = "SELECT * FROM user u JOIN userinfo ui ON u.UserID = ui.UserID WHERE u.UserID = ?";
                break;
            case 'car':
                $query = "SELECT * FROM car c JOIN carrentaldetail cd ON c.CarID = cd.CarID WHERE c.CarID = ?";
                break;
            case 'transaction':
                $query = "SELECT * FROM transactiondetails td JOIN transactiondates tdt ON td.TransactionID = tdt.TransactionID WHERE td.TransactionID = ?";
                break;
            default:
                echo "<h2>Invalid type.</h2>";
                exit;
        }

        $stmt = $con->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
        } else {
            echo "<h2>No record found.</h2>";
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
    <title>View Details</title>
    <link rel="stylesheet" href="../css/admin_styles.css">
</head>
<body>
    <header>
        <?php include 'admin_nav.php'; ?>
    </header>

    <main class="admin-container">
        <h2 class="title">View Details</h2>
        <a href="admin_<?php echo $type; ?>.php" class="action back">Back</a>
        <hr class="sep">
        <table>
            <?php
                foreach ($data as $key => $value) {
                    echo "<tr>
                            <th>" . ucfirst($key) . "</th>
                            <td>$value</td>
                          </tr>";
                }
            ?>
        </table>
        </main>
</body>
</html>
