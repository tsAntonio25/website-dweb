<?php

// session
session_start();

// import connection to db
include 'connectivity.php';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// sign up form
//pinalitan ko value sa loob ng post; nag add ako name sa submit sa sign up
if (isset($_POST['sign_up'])) {
    // get values from sign up form

    # user info table
    $firstname = trim($_POST['fname']);
    $lastname = trim($_POST['lname']);
    $middle = trim($_POST['mi']);
    $suffix = trim($_POST['suffix']);
    $address = trim($_POST['hlzs']);
    $brgy = trim($_POST['barangay']);
    $city = trim($_POST['city']);
    $province = trim($_POST['province']);
    $zipcode = trim($_POST['zip']);

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
}