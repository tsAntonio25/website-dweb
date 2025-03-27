<?php
    session_start();

    include 'admin/connectivity.php';

    if (!isset($_SESSION['userID'])) {
        echo "<script> alert('User not logged in.'); </script>";
    }

    // get values
    $userID = $_SESSION['userID'];

    $carID = $_POST['carID'];
    $totalAmount = $_POST['total-amount'];
    $paymentMethod = $_POST['payment-method'];

    $pickupDate = $_POST['pickupDateTime'];
    $returnDate = $_POST['returnDateTime'];

    // catch errors
    try {
        // start
        $con->begin_transaction();
        $rentalPrice = $_POST['rentalPrice'];
        
        // insert transaction details values
        $stmt = $con->prepare("INSERT INTO transactiondetails (UserID, CarID, RentalPrice, TotalAmount, PaymentMethod) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("iidds", $userID, $carID, $rentalPrice, $totalAmount, $paymentMethod); 
    
        if (!$stmt->execute()) {
            throw new Exception('SQL Error: ' . $stmt->error);
        }
    
        $transactionID = $stmt->insert_id; 
    
        if ($transactionID <= 0) {
            throw new Exception('Failed to insert into transactiondetails table.');
        }

        // insert transaction date values
        $stmt = $con->prepare("INSERT INTO transactiondates (TransactionID, UserID, CarID, PickupDate, ReturnDate) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("iiiss", $transactionID, $userID, $carID, $pickupDate, $returnDate); 
    
        if (!$stmt->execute()) {
            throw new Exception('SQL Error: ' . $stmt->error);
        }
        
        // update availability to rented
        $stmt = $con->prepare("UPDATE carrentaldetail SET Availability = 'Rented' WHERE CarID = ?");
        $stmt->bind_param("i", $carID);
    
        if (!$stmt->execute()) {
            throw new Exception('SQL Error: ' . $stmt->error);
        }

        // set an event to update availability
        $eventname = "updateCarAvail" . time();
        $query = "CREATE EVENT $eventname
            ON SCHEDULE EVERY 1 HOUR
            STARTS CURRENT_TIMESTAMP
            DO
            BEGIN
                DECLARE done INT DEFAULT 0;

                -- update availability
                UPDATE carrentaldetail crd
                INNER JOIN transactiondates t ON crd.CarID = t.CarID
                SET crd.Availability = 'Available'
                WHERE t.ReturnDate <= CURDATE();

                -- check rows if affected
                IF ROW_COUNT() = 0 THEN
                    SET done = 1;
                END IF;

                -- drop the event 
                IF done = 1 THEN
                    SET @sql = CONCAT('DROP EVENT IF EXISTS ', '$eventname');
                    PREPARE stmt FROM @sql;
                    EXECUTE stmt;
                    DEALLOCATE PREPARE stmt;
                END IF;
            END;
        ";
        $result = $con->query($query);

        // credit card
        if ($paymentMethod === 'credit') {
            $cardholderName = $_POST['cardholder-name'];
            $cardNumber = $_POST['card-number'];
            $cvv = $_POST['cvv'];
            $expiration = $_POST['expiration'];
    
            $stmt = $con->prepare("INSERT INTO creditcard (TransactionID, UserID, CardName, CardNumber, CVV_CVC, ExpirationDate) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("iissss", $transactionID, $userID, $cardholderName, $cardNumber, $cvv, $expiration);
            
            if (!$stmt->execute()) {
                throw new Exception('SQL Error: ' . $stmt->error);
            }
        }
    
        $con->commit();
        echo "<script>alert('Payment processed successfully!'); window.location.href='home.php';</script>";
    } catch (Exception $e) {
        $con->rollback();
        echo "<script>alert('Error processing payment: " . htmlspecialchars($e->getMessage()) . "'); window.location.href='rent1.php?carID=$carID';</script>";
    }
?>