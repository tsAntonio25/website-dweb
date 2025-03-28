<?php 
// session
session_start();

// json content
header('Content-Type: application/json');

// get response
$response = ['loggedin' => $_SESSION['loggedin'] ?? false];

// encode value to json
echo json_encode($response);


?>