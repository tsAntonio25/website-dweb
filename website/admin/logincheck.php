<?php 
// session
include 'session.php';

//session_start();

// import connection to db
include 'connectivity.php';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); // wait

// log in
if(isset($_POST['login'])) {
    // get email and pass from form
    $email = $_POST['email'];
    $pass = $_POST['password'];

    // query 
    // bat ayaw select * from user WHERE email = '$email' AND password = '$pass'
    $query = "SELECT userID, email, password FROM user WHERE email = '$email' AND password = '$pass'";
    $result = $con->query($query);
    $row = $result->fetch_array();

    // check condition
    try {
        if ($result->num_rows === 1){
            if ($email === $row['email'] && $pass === $row['password']) {
                // assign result to session
                $_SESSION["userID"] = $row['userID']; // for showing my profile
                $_SESSION["loggedin"] = true;
    
                header('Location: ../home.php');
    
            } else {
                throw new Exception("Invalid Email or Password. Please try again.");
            } 
            
        }else {
            throw new Exception("Invalid Email/Password or No user found");
        }
    }catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage(); // catch
            header('Location: ../login.php');
    }

    // enhance security

}
   
?>

<!-- connect js script -->
 <script src="../js/script.js"></script>