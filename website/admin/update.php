<?php 
/*
// availability
function checkAvail($id) {
    include '../connectivity.php';

    // get system time
    $currentTime = date('Y/m/d');

    // query
    $query = "SELECT returnDate FROM transaction WHERE id = $id";
    
    // compare
    if ($currentTime >= ($result = $con->query($query))) {
        // update db
        $update = "UPDATE car SET availability = 'Available' WHERE id = $id";
        $con->query($update);

        // stop check || not sure
        return false;
    }

} */
?>


<?php
   include 'connectivity.php';

   if (isset($_GET['type']) && isset($_GET['id'])) {
       $type = $_GET['type'];
       $id = intval($_GET['id']);
   
       switch ($type) {
           case 'car':
               $table1 = "car";
               $table2 = "carrentaldetail";
               $fields1 = ['Model', 'Brand', 'Color', 'Type', 'FuelType', 'Image', 'Description'];
               $fields2 = ['Availability', 'RentalPrice'];
               $id_column = "CarID";
               break;
           case 'transaction':
               $table1 = "transactiondetails";
               $table2 = "transactiondates";
               $fields1 = ['UserID', 'CarID', 'RentalPrice', 'TotalAmount', 'PaymentMethod'];
               $fields2 = ['PickupDate', 'ReturnDate'];   
               $id_column = "TransactionID";
               break;
           case 'user':
               $table1 = "user";
               $table2 = "userinfo";
               $fields1 = ['Email', 'Password'];
               $fields2 = ['FirstName', 'LastName', 'MiddleInitial', 'Suffix', 'Address', 'Barangay', 'City', 'Province', 'ZipCode'];
               $optionalField = ['Suffix'];   
               $id_column = "UserID";
               break;
           default:
               echo "<h2>Invalid type.</h2>";
               exit;
       }
   
       $query1 = "SELECT " . implode(", ", $fields1) . " FROM $table1 WHERE $id_column = $id";
       $result1 = $con->query($query1);
   
       if ($result1->num_rows > 0) {
           $data1 = $result1->fetch_assoc();
       } else {
           echo "<h2>No record found.</h2>";
           exit;
       }
   
       $query2 = "SELECT " . implode(", ", $fields2) . " FROM $table2 WHERE $id_column = $id";
       $result2 = $con->query($query2);
       $data2 = $result2->num_rows > 0 ? $result2->fetch_assoc() : [];
   
       if ($_SERVER['REQUEST_METHOD'] === 'POST') {
           $updates1 = [];
           $updates2 = [];
   
           foreach ($_POST as $key => $value) {
               if (array_key_exists($key, $data1)) {
                   $updates1[] = "$key = '" . $con->real_escape_string($value) . "'";
               } elseif (array_key_exists($key, $data2)) {
                   $updates2[] = "$key = '" . $con->real_escape_string($value) . "'";
               }
           }
   
           if (!empty($updates1)) {
               $update_query1 = "UPDATE $table1 SET " . implode(", ", $updates1) . " WHERE $id_column = $id";
               $con->query($update_query1);
           }
   
           if (!empty($updates2)) {
               $update_query2 = "UPDATE $table2 SET " . implode(", ", $updates2) . " WHERE $id_column = $id";
               $con->query($update_query2);
           }
   
           echo "<script>alert('Record updated successfully!'); window.location.href='admin_$type.php';</script>";
       }
   }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Record</title>
    <link rel="stylesheet" href="../css/admin_styles.css">
</head>
<body>
    <header>
        <?php include 'admin_nav.php'; ?>
    </header>

    <main class="admin-container">
        <h2 class="title">Edit Record</h2>
        <a href="admin_<?php echo $type; ?>.php" class="action back">Back</a>
        <hr class="sep">
            <form method="POST">
                <h3 class="table-name"><?php echo ucfirst($table1); ?> Table</h3>

                <table>
                    <?php
                        foreach ($data1 as $key => $value) {
                            echo "<tr>
                                    <th>" . ucfirst($key) . "</th>
                                    <td><input type='text' name='$key' value='$value' required></td>
                                </tr>";
                        }
                    ?>
                </table>

            <?php if (!empty($data2)) { ?>
                <h3 class="table-name"><?php echo ucfirst($table2); ?> Table</h3>
                <table>
                    <?php
                        foreach ($data2 as $key => $value) {
                            $isOptional = ($key === 'suffix');

                            echo "<tr>
                                    <th>" . ucfirst($key) . "</th>
                                    <td><input type='text' name='$key' value='$value'" . ($isOptional ? "" : " required") . "></td>
                                </tr>";
                        }
                    ?>
                </table>
            <?php } ?>
            <button type="submit" class="action save">Save Changes</button>
        </form>
    </main>
</body>
</html>


