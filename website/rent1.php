  <?php
    session_start();

    include 'admin/connectivity.php';

    if (!isset($_GET['carID']) || !is_numeric($_GET['carID'])) {
          echo "<h2>Invalid Car ID.</h2>";
          exit;
      }

      $carID = intval($_GET['carID']);

      $query = " SELECT c.carID, c.brand, c.model, c.type, c.image, c.color, c.description, c.fueltype, crd.availability, crd.rentalPrice
                FROM car c
                LEFT JOIN carrentaldetail crd ON c.carID = crd.carID
                WHERE c.carID = ?
              ";

      //prepared statements for security
      $stmt = $con->prepare($query);
      $stmt->bind_param("i", $carID);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows > 0) {
          $car = $result->fetch_assoc();
      } else {
          echo "<h2>Car not found.</h2>";
          exit;
      }

      $isAvailable = (strtolower($car['availability']) === 'available');

      $notification = "";
        if (isset($_SESSION['rent_error'])) {
        $notification = $_SESSION['rent_error'];
        unset($_SESSION['rent_error']);
    }
  ?>

  <!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Rent Car - The Garage</title>
      <link rel="stylesheet" href="css/styles.css">
      <link rel="apple-touch-icon" sizes="180x180" href="assets/logo.png">
      <link rel="icon" type="image/png" sizes="32x32" href="assets/logo.png">
      <link rel="icon" type="image/png" sizes="16x16" href="assets/logo.png">
  </head>
  <body>
      <header>
        <?php include 'nav.php'; ?>
      </header>

      <div id="notification" class="notification">
          <?php if (!empty($notification)) : ?>
              <p><?= htmlspecialchars($notification); ?></p>
          <?php endif; ?>
      </div>

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
              <li><strong>Color:</strong> <?= htmlspecialchars($car['color']); ?></li>
              <li><strong>Fuel Type:</strong> <?= htmlspecialchars($car['fueltype']); ?></li>

            </ul>
          </div>

          <h2>Description</h2>
          <p><?= nl2br(htmlspecialchars($car['description'])); ?></p>

          <div class="rent-now">
            <?php if (!$isAvailable): ?>
              <p class="unavailable">This car is currently unavailable for rent.</p>
            <?php endif; ?>
            <div class="rent-buttons">
            <a href="#" onclick="goBack(<?= isset($_SESSION['from_rent2']) ? 'true' : 'false'; ?>)" class="btn-secondary">Back</a>
            <?php if ($isAvailable): ?>
                <?php if (isset($_SESSION['userID'])) : ?>
                  <a href="rent2.php?carID=<?= htmlspecialchars($car['carID']); ?>">
                    <button type="button" class="btn">Rent Now</button>
                  </a>
                <?php else : ?>
                    <button type="button" class="btn" onclick="redirectToLogin()">Rent Now</button>
                <?php endif; ?>
              <?php else: ?>
                <button type="button" class="btn not" disabled>Unavailable</button>
              <?php endif; ?>
            </div>
          </div>
      </section>

      <footer>
          <?php include 'footer.php' ?>
      </footer>
      <script src="js/redirectLogin.js"></script>
  </body>
  </html>