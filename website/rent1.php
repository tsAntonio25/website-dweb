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
        <img src ="assets/carImages/mirage.jpg" alt="" />
      </div>
      <div class="details">
        <h2>Car Name</h2>
        <h3><i>Price from ₱xx,xxx,xx</i></h3>

        <div class="details-column">
          <ul>
            <li>Details</li>
            <li>Details</li>
            <li>Details</li>
          </ul>
        </div>

        <div class="details-column">
          <ul>
            <li>Details</li>
            <li>Details</li>
            <li>Details</li>
          </ul>
        </div>

        <h2>Description</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>

        <div class="rent-buttons">
          <a href = "carlisting.php"><button type="button" class="btn-secondary">Back</button></a>

          <a href = "rent2.php"><button type="button"  class="btn">Rent Now</button></a>
        </div>
        
      </div>
      

    </section>

    <footer>
        <?php include 'footer.php' ?>
    </footer>
</body>
</html>