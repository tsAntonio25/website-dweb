<?php 
// start session
session_start();
// get email (ewan)
$_SESSION['email'] = null;
$_SESSION["password"] = null;
// cookie yum yum
setcookie('user', '', time() - 3600, '/website');
