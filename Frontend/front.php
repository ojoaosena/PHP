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
//   function($curl, $header) use (&$headers)
//   {
//     $len = strlen($header);
//     $header = explode(':', $header, 2);
//     if (count($header) < 2) // ignore invalid headers
//       return $len;

//     $headers[strtolower(trim($header[0]))][] = trim($header[1]);

//     return $len;
//   }
// );

function header_callback($ch, $header_line)
{ 
  global $headers;
  $headers[] = $header_line;
  return strlen($header_line);
}

// Execute the POST request
$result = curl_exec($ch);

// Close cURL resource
curl_close($ch);

var_dump($headers);
?>