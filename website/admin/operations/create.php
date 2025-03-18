<?php 
// import connection to db
include '/admin/connectivity.php';

// if(isset($_POST['save'])) <-- gagamitin for specific submission of form

// sign up form
//pinalitan ko value sa loob ng post; nag add ako name sa submit sa sign up
 if (isset($_POST['sign_up'])){
    // get values from sign up form

    # personal info
    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    $middle = $_POST['mi'];
    $suffix = $_POST['suffix'];
    $address = $_POST['hlzs'];
    $brgy = $_POST['barangay'];
    $city = $_POST['city'];
    $province = $_POST['province'];
    $zipcode = $_POST['zip'];

    # user info
    $email = $_POST['email'];
    $password = $_POST['password'];
    // confirm pass

    # sql
    $query = "INSERT into user (
               email,
               password,
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
               '$email',
               '$password',
               '$firstname',
               '$lastname',
               '$middle',
               '$suffix',
               '$address',
               '$brgy',
               '$city',
               '$province',
               '$zipcode'
            )";
   
    $result = $con->query($query);

   //wala pa verification
    echo "<script> location.replace('index.php') </script>";

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