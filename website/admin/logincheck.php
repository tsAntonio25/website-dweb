<?php 
// session
include 'session.php';

// import connection to db
include 'connectivity.php';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if(isset($_POST['login'])) {
    // secure email
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $pass = $_POST['password'];

    try {
        // secure sql query
        $stmt = $con->prepare("SELECT userID, email, password FROM user WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if user exists
        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();

            // get hashed password to compare
            if (password_verify($pass, $row['password'])) {
                $_SESSION["userID"] = $row['userID'];
                $_SESSION["loggedin"] = true;
                
                header('Location: ../home.php');
                exit();
            } else {
                throw new Exception("Invalid email or password. Please try again.");
            }
        } else {
            throw new Exception("Invalid email or password. Please try again.");
        }
    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
        header('Location: ../login.php');
        exit();
    }
}
   
?>

<!-- connect js script -->
 <script src="../js/script.js"></script>