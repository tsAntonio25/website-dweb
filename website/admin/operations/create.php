<?php 
// import connection to db
include '/admin/connectivity.php';

// if(isset($_POST['save'])) <-- gagamitin for specific submission of form

// sign up form
 if (isset($_POST['Sign Up'])){
    // get values from sign up form

    # personal info
    $firstname;
    $lastname;
    $middle;
    $suffix;
    $address;
    $brgy;
    $city;
    $province;
    $zipcode;

    # user info
    $email;
    $password;
    // confirm pass

    # sql
    $query;
    $result;

    // if submitted with no error, return back to home, then update login status 



// transaction form
 } else if (isset($_POST['Confirm & Pay'])) {
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
 function confirmpass($pass){
    // wait
 }


// total amount
function totalAmt($rental, $addprice){

}








?>