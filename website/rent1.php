<?php
    include 'admin/connectivity.php';

    if (!isset($_GET['carID']) || !is_numeric($_GET['carID'])) {
        echo "<h2>Invalid Car ID.</h2>";
        exit;
    }

    $carID = intval($_GET['carID']);

    $query = " SELECT c.carID, c.brand, c.model, c.type, c.image, c.description, crd.availability, crd.rentalPrice
               FROM car c
               LEFT JOIN carrentaldetail crd ON c.carID = crd.carID
               WHERE c.carID = $carID
            ";

    $result = $con->query($query);

    if ($result->num_rows > 0) {
        $car = $result->fetch_assoc();
    } else {
        echo "<h2>Car not found.</h2>";
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rent Car - The Garage</title>
    <link rel="stylesheet" href="\css\styles.css">
</head>
<body>
    <header>
      <?php include 'nav.php'; ?>
    </header>

    <section class="details-container">
      <div class="details-img">
        <img src="assets/carImages/<?= htmlspecialchars($car['image']); ?>" 
             alt="<?= htmlspecialchars($car['brand'] . ' ' . $car['model']); ?>">
      </div>
      <div class="details">
        <h2><?= htmlspecialchars($car['brand'] . ' ' . $car['model']); ?></h2>
        <h3><i>Price from ₱<?= number_format($car['rentalPrice'], 2); ?></i></h3>

        <div class="details-column">
          <ul>
            <li><strong>Type:</strong> <?= htmlspecialchars($car['type']); ?></li>
            <li><strong>Availability:</strong> <?= htmlspecialchars($car['availability']); ?></li>
          </ul>
        </div>

        <h2>Description</h2>
        <p><?= nl2br(htmlspecialchars($car['description'])); ?></p>

        <div class="rent-buttons">
          <a href="carlisting.php"><button type="button" class="btn-secondary">Back</button></a>
          <a href="rent2.php?carID=<?= htmlspecialchars($car['carID']); ?>">
            <button type="button" class="btn">Rent Now</button>
          </a>
        </div>
      </div>
    </section>

    <footer>
        <?php include 'footer.php' ?>
    </footer>
</body>
</html>