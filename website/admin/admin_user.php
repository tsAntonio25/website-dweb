<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - User</title>
    <link rel="stylesheet" href="css\styles.css">
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/logo.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/logo.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/logo.png">
    <?php 
        include 'connectivity.php';

        $query = "SELECT u.UserID, u.Email, ui.FirstName, ui.MiddleInitial, ui.LastName, ui.Suffix 
                  FROM user u 
                  LEFT JOIN userinfo ui ON u.UserID = ui.UserID
                ";

        $result = $con->query($query);
    ?>
</head>
<body>
    <header>
        <?php include 'admin_nav.php'; ?>
    </header>
    
    <main class="admin-container">
        <h2 class="title">Users</h2>
        <a href="create.php?type=user" class="action add">Add New User</a>
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
                            <td>{$row['UserID']}</td>
                            <td>{$row['Email']}</td>
                            <td>{$row['FirstName']}</td>
                            <td>{$row['MiddleInitial']}</td>
                            <td>{$row['LastName']}</td>
                            <td>{$row['Suffix']}</td>
                            <td><a href='read.php?type=user&id=" . $row['UserID'] . "' class='action view'>View</a></td>
                            <td><a href='update.php?type=user&id=" . $row['UserID'] . "' class='action edit'>Edit</a></td>
                            <td><a href='delete.php?type=user&id=" . $row['UserID'] . "' class='action delete'>Delete</a></td>
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