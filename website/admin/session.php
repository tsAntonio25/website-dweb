<?php 
// session
session_start();

// json 
header('Content-Type: application/json');

$response = ['loggedin' => $_SESSION['loggedin'] ?? false];
echo json_encode($response);