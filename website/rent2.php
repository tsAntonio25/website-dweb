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
            <form class="rent-summary">
                <h2>Rental Summary</h2>
                <h3>Name & Car Model</h3>
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
                <a><input type="submit" value="Confirm" class="btn"></a>
            </form>
            
            <h2>Cost Breakdown</h2>
            <div class="cost-breakdown">
                <div class="item">
                    <span>Rental Price per day</span>
                    <span><i>₱xx,xxx.xx</i></span>
                </div>
                <div class="item">
                    <span>Additional Fees</span>
                    <span><i>₱xx,xxx.xx</i></span>
                </div>
                <div class="total">
                    <span>Total Amount</span>
                    <span><i>₱xx,xxx.xx</i></span>
                </div>
            </div>
            <a href = "rent1.php"><input type="button" class="btn-secondary back" value="Back"></button></a>
        </section>

        <section class="payment-details">
            <h2>Payment Details</h2>
            <h3>Choose your payment method: </h3>
            <form>
                <div class="form-group payment-method">
                    <label>
                        <input type="radio" name="payment-method" value="credit-debit-card"> Credit / Debit Card
                    </label>
                    <label>
                        <input type="radio" name="payment-method" value="paypal"> PayPal
                    </label>
                </div>

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

                <a><input type="submit" value="Confirm & Pay" class="btn"></a>
            </form>
        </section>
    </div>

    <footer>
        <?php include 'footer.php'; ?>
    </footer>
</body>
</html>
