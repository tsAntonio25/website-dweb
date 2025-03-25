<?php 
// import connection to db
include '/admin/connectivity.php';

// if(isset($_POST['save'])) <-- gagamitin for specific submission of form

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

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