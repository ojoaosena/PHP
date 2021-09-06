<?php
  // API URL
$url = 'http://localhost:8080/back.php';

// Create a new cURL resource
$ch = curl_init($url);

// Setup request to send json via POST
$data = [
    'username' => 'codexworld',
    'password' => '123456'
];
$payload = json_encode($data);

// Attach encoded JSON string to the POST fields
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

// Set the content type to application/json
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type:application/json', 'Authorization:Bearer']);

// Return response instead of outputting
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

// Execute the POST request
$result = curl_exec($ch);

// Close cURL resource
curl_close($ch);

  echo '<pre>';
  var_dump($result);
  echo '</pre>';
?>