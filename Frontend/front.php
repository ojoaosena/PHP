<?php
  // API URL
$url = 'http://localhost:8080/back.php';

// Create a new cURL resource
$ch = curl_init($url);

// Setup request to send json via POST
$data = [
    'email' => 'codexworld@universe.com',
    'password' => '123456'
];
$payload = json_encode($data);

// Set the content type to application/json
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type:application/json', 'Authorization:Bearer']);

// Attach encoded JSON string to the POST fields
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

// Return response instead of outputting
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

curl_setopt($ch, CURLOPT_HEADERFUNCTION, 'header_callback');

function header_callback($ch, $header)
{ 
  global $headers;
  $length = strlen($header);
  $header = explode(':', $header, 2);
  if (count($header) < 2)
  {
    return $length;
  }

  $headers[$header[0]] = trim($header[1]);

  return $length;
}

// Execute the POST request
$result = curl_exec($ch);

// Close cURL resource
curl_close($ch);

apcu_store('auth', $headers['Authorization'], 10);
$auth = apcu_fetch('auth');
var_dump($auth);
?>