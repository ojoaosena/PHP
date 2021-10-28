<?php
define('FIRSTKEY','Lk5Uz3slx3BrAghS1aaW5AYgWZRV0tIX5eI0yPchFz4=');
define('SECONDKEY','EZ44mFi3TlAey1b2w4Y7lVDuqO+SRxGXsa7nctnr/JmMrA2vN6EJhrvdVZbxaQs5jpSe34X3ejFK/o9+Y5c83w==');

require_once 'Security.php';

$security = new Security();
  // API URL
$url = 'http://localhost:8080/login';

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
  $headers[] = $header;
  return strlen($header);;
}

// Execute the POST request
$result = curl_exec($ch);

// Close cURL resource
curl_close($ch);

var_dump($result);

// apcu_add('auth', $headers['Authorization'], 1);
// while (apcu_exists('auth')) {
//   $auth = apcu_fetch('auth');
//   var_dump($auth);
// }
// echo 'Expired';
?>