<?php
    session_start();

    include 'admin/connectivity.php';

    if (!isset($_SESSION['userID'])) {
        echo "<script> alert('User not logged in.'); </script>";
    }

?>
