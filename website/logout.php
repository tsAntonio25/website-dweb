<?php
// start session
session_start();

// empty session values
$_SESSION = [];

// remove session
session_destroy();

// go back to login page
header('Location: login.php');

exit;