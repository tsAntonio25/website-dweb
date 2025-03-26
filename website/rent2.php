<?php
    session_start();
    
    include 'admin/connectivity.php';

    if (!isset($_GET['carID']) || !is_numeric($_GET['carID'])) {
        echo "<h2>Invalid Car ID.</h2>";
        exit;
    }

    $carID = intval($_GET['carID']);

    $query = "SELECT crd.RentalPrice, c.Model, c.Brand
                FROM carrentaldetail crd 
                JOIN car c ON crd.CarID = c.CarID 
                WHERE c.CarID = ?
            ";

    //prepared statements for security
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $carID);
    $stmt->execute();
    $result = $stmt->get_result();

    $rentalPrice = 0;
    $days = 0;
    $hours = 0;
    $carModel = '';
    $carBrand = '';

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $rentalPrice = floatval($row['RentalPrice']);
        $additionalPrice = floatval($row['AdditionalPrice']);
        $carModel = htmlspecialchars($row['Model']);
        $carBrand = htmlspecialchars($row['Brand']);
    } else {
        echo "<script> alert('Car not found or rental price not available');</script>";
        exit;
    }

    $totalAmount = 0;

    // try catch
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        try {
            $pickupDate = $_POST['pickup-date'];
            $pickupTime = $_POST['pickup-time'];
            $returnDate = $_POST['return-date'];
            $returnTime = $_POST['return-time'];

            $currentDateTime = new DateTime(); 

            $pickupDateTime = new DateTime($pickupDate . ' ' . $pickupTime);
            $returnDateTime = new DateTime($returnDate . ' ' . $returnTime);
        
            if ($pickupDateTime < $currentDateTime){
                // throw exception
                throw new Exception('Error: The pick-up date cannot be in the past. Please choose a valid pick-up date.');
            } else if ($returnDateTime < $pickupDateTime) {
                // throw exception
                throw new Exception('Error: Return date must be after pickup date. Please choose a valid return date.');
            } else {
                $interval = $pickupDateTime->diff($returnDateTime);
                $days = $interval->days;
                $hours = $interval->h;
                
                if ($days === 0 && $hours > 0) {
                    $totalAmount = ($hours * ($rentalPrice / 24)); 
                } else {
                    $totalAmount = ($days * $rentalPrice);
                }   
            }

        } catch (Exception $e) {
            echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
        }
    }

    // availability

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rent and Payment - The Garage</title>
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
    <header>
      <?php include 'nav.php'; ?>
    </header>

    <div class="rent-container">

        <section class="cost">
        <form class="rent-summary" method="POST" action="">
                <h2>Rental Summary</h2>
                <h3><?= $carBrand . ' ' . $carModel; ?></h3>
                <div class="form-group">
                    <label for="pickup-date">Pick-up Date</label>
                    <input type="date" id="pickup-date" name="pickup-date">
                </div>
                <div class="form-group">
                    <label for="pickup-time">Time</label>
                    <input type="time" id="pickup-time" name="pickup-time">
                </div>
                <div class="form-group">
                    <label for="return-date">Return Date</label>
                    <input type="date" id="return-date" name="return-date">
                </div>
                <div class="form-group">
                    <label for="return-time">Time</label>
                    <input type="time" id="return-time" name="return-time">
                </div>
                <button type="submit" value="Confirm" class="btn compute">Confirm</button>
            </form>
            
            <h2>Cost Breakdown</h2>
            <div class="cost-breakdown">
                <div class="item">
                    <span>Rental Price per day</span>
                    <span><i>₱<?= number_format($rentalPrice, 2); ?></i></span>
                </div>
                <div class="item">
                    <span>Total Days</span>
                    <span><i><?= $days ?> days, <?= $hours ?> hrs.</i></span>
                </div>
                <div class="total">
                    <span>Total Amount</span>
                    <span><i>₱<?= number_format($totalAmount, 2); ?></i></span>
                </div>
            </div>
            <a href = "rent1.php?carID=<?=$carID?>" class="btn-secondary back">Back</a>
        </section>

        <section class="payment-details">
            <h2>Payment Details</h2>
            <h3>Choose your payment method: </h3>
            <form id="payment-form" method="POST" action="process_payment.php">
                <div class="form-group payment-method">
                    <label>
                        <input type="radio" name="payment-method" value="credit-debit-card" required> Credit / Debit Card
                    </label>
                    <label>
                        <input type="radio" name="payment-method" value="cash" required> Cash
                    </label>
                </div>

                <div id="card-details">
                    <div class="form-group">
                        <label for="cardholder-name">Card Holder Name</label>
                        <input type="text" id="cardholder-name" name="cardholder-name">
                    </div>
                    <div class="form-group">
                        <label for="card-number">Credit Card Number</label>
                        <input type="text" id="card-number" name="card-number">
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="cvv">CVV</label>
                            <input type="text" id="cvv" name="cvv">
                        </div>
                        <div class="form-group">
                            <label for="expiration">Expiration (MM/YY)</label>
                            <input type="text" id="expiration" name="expiration" placeholder="MM/YY">
                        </div>
                    </div>
                </div>

                <input type="hidden" name="total-amount" value="<?= htmlspecialchars($totalAmount); ?>">
                <input type="hidden" name="carID" value="<?= htmlspecialchars($carID); ?>">

                <div class="button-container">
                    <button type="submit" class="btn payconf">Confirm & Pay</button>
                </div>            
            </form>
        </section>
    </div>

    <footer>
        <?php include 'footer.php'; ?>
    </footer>
    <script src="js/payment.js"></script>
</body>
</html>
