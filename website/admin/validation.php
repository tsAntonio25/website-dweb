<?php 
// session
include '../session.php';

// import connection to db
include 'connectivity.php';

// log in
if(isset($_POST['Log In'])) {
    // get email and pass from form
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    // query 
    $query = "SELECT email, password FROM user WHERE email = '$email' AND password = '$pass'";

    // check condition
    if ($result = $con->query($query)) {
        // get result
        $row = $result->fetch_array();

        // assign result to session
        $_SESSION["email"] = $row['email'];
        $_SESSION["password"] = $row['password'];

    }else {
        // waiting
        echo 'incorrect email or pass';

    }
    
}
   
?>



<!-- connect js script -->
 <script src="../js/script.js"></script>