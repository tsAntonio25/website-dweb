<?php 
// session
session_start();

// json content
header('Content-Type: application/json');

// get response
$response = ['loggedin' => $_SESSION['loggedin'] ?? false];

// check value
echo json_encode($response);

?>