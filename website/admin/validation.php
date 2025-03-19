<?php 
/* VALIDATION / ERROR HANDLING */

// import connection to db
include '/admin/connectivity.php';

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

        // assign result to vars then pass vars to js script
        $emailUser = $row['email'];
        $passUser = $row['password'];

    }else {
        // waiting
        echo 'incorrect email or pass';

    }
    ;
}
;
// availability

?>



<!-- connect js script -->
<script src="../js/script.js"></script> <!-- verify connection -->