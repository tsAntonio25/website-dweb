<?php 
// session
session_start();

// import connection to db
include 'connectivity.php';

// if(isset($_POST['save'])) <-- gagamitin for specific submission of form

//mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// sign up form
//pinalitan ko value sa loob ng post; nag add ako name sa submit sa sign up
 if (isset($_POST['sign_up'])){
    // get values from sign up form

    # user info table
   $firstname = trim($_POST['firstname']);
   $lastname = trim($_POST['lastname']);
   $middle = trim($_POST['minitial']);
   $suffix = trim($_POST['suffix']);
   $address = trim($_POST['address']);
   $brgy = trim($_POST['barangay']);
   $city = trim($_POST['city']);
   $province = trim($_POST['province']);
   $zipcode = trim($_POST['zipcode']);

   # user table
   $email = trim($_POST['email']);
   $password = trim($_POST['password']);

   // secure email and pass
   try {
      // hash password 
      $hash_pass = password_hash($password, PASSWORD_DEFAULT);
      // sanitize email
      $email = filter_var($email, FILTER_SANITIZE_EMAIL);

      // prepare query
      $stmt = $con->prepare("INSERT INTO user
      (email, password)
      VALUES ( '?', '?')");

      // bind parameters
      $stmt->bind_param('ss', $email, $hash_pass);

      // execute query
      $stmt->execute();

   // get userid
      $stmt = $con->prepare("SELECT userID FROM user WHERE email = ?");
      $stmt->bind_param("s", $email);
      $stmt->execute();
      $result = $stmt->get_result();
      $row = $result->fetch_assoc();
      $userID = $row['userID'];

   // secure query (user info)
      // prepare query
      $stmt = $con->prepare("INSERT into userInfo (
         userid,
         firstname,
         lastname,
         minitial,
         suffix,
         address,
         barangay,
         city,
         province,
         zipcode
      )
      VALUES (
         '?',
         '?',
         '?',
         '?',
         '?',
         '?',
         '?',
         '?',
         '?',
         '?'
      )");
      // bind parameters
      $stmt->bind_param(
         "isssssssss", 
         $userID,
         $firstname,
         $lastname,
         $middle,
         $suffix,
         $address,
         $brgy,
         $city,
         $province,
         $zipcode
     );

     // execute query
      $stmt->execute();

  } catch (Exception $e) {
   echo $e->getMessage();
  }
 

// transaction form
 } else if (isset($_POST['pay'])) {
    // get values from rental page form
    // based muna ako sa wireframe figma/ doc for db

    # transaction details
    // get user id
    // get car id
    $pickupdate;
    $returndate;
    $rentalprice;
    $additionalprice;
    // total
    $paymentmethod;

    # card method
    // card name
    // card number
    // cvv/cvc
    // expiration date

    # sql
    $query;
    $result;

    // if submitted with no error, return back to home, then update transactional status

 }

 // confirm password function
 function confirmpass($pass) {
}


// total amount
function totalAmt($rental, $addprice){

}


?>


<?php

//admin create
include 'connectivity.php';

if (isset($_GET['type'])) {
    $type = $_GET['type'];

    switch ($type) {
        case 'car':
            $table1 = "car";
            $table2 = "carrentaldetail";
            $fields1 = ['Model', 'Brand', 'Color', 'Type', 'FuelType', 'Image', 'Description'];
            $fields2 = ['Availability', 'RentalPrice'];
            $redirect_page = "admin_car.php";
            break;
        case 'transaction':
            $table1 = "transactiondetails";
            $table2 = "transactiondates";
            $fields1 = ['UserID', 'CarID', 'RentalPrice', 'AdditionalPrice', 'TotalAmount', 'PaymentMethod'];
            $fields2 = ['PickupDate', 'ReturnDate'];
            $redirect_page = "admin_transaction.php";
            break;
        case 'user':
            $table1 = "user";
            $table2 = "userinfo";
            $fields1 = ['Email', 'Password'];
            $fields2 = ['FirstName', 'LastName', 'MiddleInitial', 'Suffix', 'Address', 'Barangay', 'City', 'Province', 'ZipCode'];
            $redirect_page = "admin_user.php";
            break;
        default:
            echo "<h2>Invalid type specified.</h2>";
            exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $values1 = [];
        $values2 = [];

        foreach ($_POST as $key => $value) {
            if (in_array($key, $fields1)) {
                $values1[$key] = $con->real_escape_string($value);
            } elseif (in_array($key, $fields2)) {
                $values2[$key] = $con->real_escape_string($value);
            }
        }

        if (!empty($values1)) {
            $columns1 = implode(", ", array_keys($values1));
            $placeholders1 = implode("', '", array_values($values1));
            $query1 = "INSERT INTO $table1 ($columns1) VALUES ('$placeholders1')";
            $con->query($query1);
            $new_id = $con->insert_id;
        }

        if (!empty($values2) && isset($new_id)) {
            $values2[$table1 . "ID"] = $new_id;
            $columns2 = implode(", ", array_keys($values2));
            $placeholders2 = implode("', '", array_values($values2));
            $query2 = "INSERT INTO $table2 ($columns2) VALUES ('$placeholders2')";
            $con->query($query2);
        }

        echo "<script>alert('Record added successfully!'); window.location.href='$redirect_page';</script>";
        exit;
    }
} else {
    echo "<h2>Invalid request.</h2>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Record</title>
    <link rel="stylesheet" href="../css/admin_styles.css">
</head>
<body>
    <header>
        <?php include 'admin_nav.php'; ?>
    </header>

    <main class="admin-container">
        <h2 class="title">Add New <?php echo ucfirst($type); ?></h2>
        <a href="<?php echo $redirect_page; ?>" class="action back">Back</a>
        <hr class="sep">

        <form method="POST">
            <h3 class="table-name"><?php echo ucfirst($table1); ?> Table</h3>
            <table>
                <?php foreach ($fields1 as $field) { ?>
                    <tr>
                        <th><?php echo ucfirst($field); ?></th>
                        <td><input type="text" name="<?php echo $field; ?>" required></td>
                    </tr>
                <?php } ?>
            </table>

            <?php if (!empty($fields2)) { ?>
                <h3 class="table-name"><?php echo ucfirst($table2); ?> Table</h3>
                <table>
                    <?php foreach ($fields2 as $field) { ?>
                        <tr>
                            <th><?php echo ucfirst($field); ?></th>
                            <td><input type="text" name="<?php echo $field; ?>" required></td>
                        </tr>
                    <?php } ?>
                </table>
            <?php } ?>

            <button type="submit" class="action save">Create Record</button>
        </form>
    </main>
</body>
</html>
