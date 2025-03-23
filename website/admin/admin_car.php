<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Car</title>
    <?php 
         include 'connectivity.php';
 
         $query = "SELECT c.CarID, c.Model, c.Brand, c.Type, cd.Availability, cd.RentalPrice 
                   FROM car c
                   LEFT JOIN carrentaldetail cd ON c.CarID = cd.CarID
                   ";
                   
         $result = $con->query($query);
    ?>
</head>
<body>
    <header>
        <?php include 'admin_nav.php'; ?>
    </header>
    
    <main class="admin-container">
        <h2 class="title">Cars</h2>
        <a href="add-car.php" class="action add">Add New Car</a>
        <hr class="sep">
        <table>
            <tr>
                <th>Car ID</th>
                <th>Model</th>
                <th>Brand</th>
                <th>Type</th>
                <th>Availability</th>
                <th>Rental Price</th>
                <th colspan="3">Actions</th>
            </tr>

            <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()){
                        echo "<tr>
                                <td>{$row['CarID']}</td>
                                <td>{$row['Model']}</td>
                                <td>{$row['Brand']}</td>
                                <td>{$row['Type']}</td>
                                <td>{$row['Availability']}</td>
                                <td>{$row['RentalPrice']}</td>
                                <td><a href='read.php?type=car&id=" . $row['CarID'] . "' class='action view'>View</a></td>
                                <td><a href='update.php?type=car&id=" . $row['CarID'] . "' class='action edit'>Edit</a></td>
                                <td><a href='delete.php?type=car&id=" . $row['CarID'] . "' class='action delete'>Delete</a></td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>No cars found.</td></tr>";
                }
            ?>
        </table>

        <a class="arrowBtn" title="Go to top" href="#top">↑</a>

</body>
</html>