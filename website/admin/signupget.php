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

    # confirm pass
    $confirmpass = trim($_POST['confirm']);


    // secure email and pass
    try {
        // check if pass and confirm pass r the same
        if ($password !== $confirmpass) {
            throw new Exception('Password does not match. Please try again.');

        }

        // check email 
        $stmt = $con->prepare("SELECT email FROM user WHERE email = ? ");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            throw new Exception('Email already existing');
        }


        // hash password 
        $hash_pass = password_hash($password, PASSWORD_DEFAULT);
        // sanitize email
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);

        // check if email is already at the db || if so, throw error

        // prepare query
        $stmt = $con->prepare("INSERT INTO user
      (email, password)
      VALUES ( ?, ?)");

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
         middleinitial,
         suffix,
         address,
         barangay,
         city,
         province,
         zipcode
      )
      VALUES (
         ?,
         ?,
         ?,
         ?,
         ?,
         ?,
         ?,
         ?,
         ?,
         ?
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

        // go back to login
        echo "<script>
                alert('Sign up OK!'); 
                window.location.href='../login.php';
            </script>";
       

    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
        header('Location: ../signup.php');

    }
}