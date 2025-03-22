<?php 
// start session
session_start();

// get email (ewan)
$_SESSION['email'];
$_SESSION["password"];

// cookie yum yum
setcookie('user', '', time() - 3600, '/website');

?>