<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - User</title>
    <?php 
        include 'connectivity.php';

        $query = "SELECT * FROM user";
        $result = $con->query($query);
    ?>
</head>
<body>
    <header>
        <?php include 'admin_nav.php'; ?>
    </header>
    
    <main class="admin-container">
        <h2 class="title">Users</h2>
        <hr class="sep">
        <table>
            <tr>
                <th>User ID</th>
                <th>Email</th>
                <th>First Name</th>
                <th>Middle Initial</th>
                <th>Last Name</th>
                <th>Suffix</th>
                <th>Address</th>
                <th>Barangay</th>
                <th>City</th>
                <th>Province</th>
                <th>Zipcode</th>
            </tr>

            <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()){
                        echo "<tr>
                                <td>{$row['userID']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['firstname']}</td>
                                <td>{$row['minitial']}</td>
                                <td>{$row['lastname']}</td>
                                <td>{$row['suffix']}</td>
                                <td>{$row['address']}</td>
                                <td>{$row['barangay']}</td>
                                <td>{$row['city']}</td>
                                <td>{$row['province']}</td>
                                <td>{$row['zipcode']}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='11'>No users found.</td></tr>";
                }
            ?>
        </table>

    <a class="arrowBtn" title="Go to top" href="#top">↑</a>
</body>
</html>