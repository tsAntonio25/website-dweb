<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Rental Summary</h2>
    <h3>Name & Car Model</h3>

    <form class="rent-summary">
        <label for="pickup">Pick-up Date</label><br>
        <input type="date" id = "pickup" name = "pickup"><br>
        <label for="time">Time</label><br>
        <input type="time" id = "pickup" name = "pickup"> <br>

        <label for="return">Return Date</label><br>
        <input type="date" id = "return" name = "return"><br>
        <label for="time">Time</label><br>
        <input type="time" id = "return" name = "return"><br>

        <input type="submit" value="Confirm">
    </form>
    
    <section class="cost">
        <h2>Cost Breakdown</h2>
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
    </section>

    <section class="payment-details">
        <h2>Payment Details</h2>
        <form>
            <div class="method">
                <label>
                <input type="radio" name="payment-method" value="credit-debit-card">Credit / Debit Card</label>
            </div>
            <div class="payment-method">
                <label>
                <input type="radio" name="payment-method" value="paypal">PayPal</label>
            </div>
        </form>
    </section>

     <form>
        <label for="chname">Car Holder Name</label><br>
        <input type="text" id = "chname" name = "chname"><br>

        <label for="ccname">Credit Card Number</label><br>
        <input type="text" id = "chname" name = "chname"><br>

        <label for="cvv">CVV</label><br>
        <input type="text" id = "cvv" name = "cvv"><br>

        <label for="expiration">Expiration (MM/YY)</label><br>
        <input type="date" id = "expiration" name = "expiration"><br>

        <input type="submit" value="Confirm & Pay">
    </form>
</body>
</html>