<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Car</title>
    <?php 
        include 'connectivity.php';

        $query = "SELECT * FROM car";
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
                <th colspan ="3">Actions</th>
            </tr>

            <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()){
                        echo "<tr>
                                <td>{$row['carID']}</td>
                                <td>{$row['model']}</td>
                                <td>{$row['brand']}</td>
                                <td>{$row['type']}</td>
                                <td><a href='view-details.php?id={$row['carID']}' class='action view'>View</a></td>
                                <td><a href='edit-details.php?id={$row['carID']}' class='action edit'>Edit</a></td>
                                <td><a href='delete-details.php?id={$row['carID']}' class='action delete'>Delete</a></td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No cars found.</td></tr>";
                }
            ?>
        </table>

        <a class="arrowBtn" title="Go to top" href="#top">↑</a>

</body>
</html>