<?php
    include 'connectivity.php';

    if (isset($_GET['type']) && isset($_GET['id'])) {
        $type = $_GET['type'];
        $id = intval($_GET['id']); 

        switch ($type) {
            case 'car':
                $table = "car";
                $id_column = "carID";
                break;
            case 'transaction':
                $table = "transaction";
                $id_column = "transactionID";
                break;
            case 'user':
                $table = "users";
                $id_column = "userID";
                break;
            default:
                echo "<h2>Invalid type.</h2>";
                exit;
        }

        $query = "SELECT * FROM $table WHERE $id_column = $id";
        $result = $con->query($query);

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
