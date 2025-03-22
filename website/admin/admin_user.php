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
        <a href="create.php" class="action add">Add New User</a>
        <hr class="sep">
        <table>
            <tr>
                <th>User ID</th>
                <th>Email</th>
                <th>First Name</th>
                <th>Middle Initial</th>
                <th>Last Name</th>
                <th>Suffix</th>
                <th colspan ="3">Actions</th>
            </tr>

            <?php
                if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['userID']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['firstname']}</td>
                    <td>{$row['minitial']}</td>
                    <td>{$row['lastname']}</td>
                    <td>{$row['suffix']}</td>
                    <td><a href='read.php?type=user&id=" . $row['userID'] . "' class='action view'>View</a></td>

                    <td><a href='update.php?type=user&id=" . $row['userID'] . "' class='action edit'>Edit</a></td>

                    <td><a href='delete.php?type=user&id=" . $row['userID'] . "' class='action delete'>Delete</a></td>
              </tr>";
            }
            } else {
                echo "<tr><td colspan='9'>No users found.</td></tr>";
            }
?>

            </tr>
            
        </table>

    <a class="arrowBtn" title="Go to top" href="#top">↑</a>
</body>
</html>