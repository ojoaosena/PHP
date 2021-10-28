<?php
define('FIRSTKEY','Lk5Uz3slx3BrAghS1aaW5AYgWZRV0tIX5eI0yPchFz4=');
define('SECONDKEY','EZ44mFi3TlAey1b2w4Y7lVDuqO+SRxGXsa7nctnr/JmMrA2vN6EJhrvdVZbxaQs5jpSe34X3ejFK/o9+Y5c83w==');

require_once 'Security.php';

$security = new Security();

$data = $security->securedDecrypt(file_get_contents('php://input'));
$data = json_decode($data, TRUE);
// foreach ($data as $key => $value) {
//   error_log($key);
//   error_log($value);
// }
// foreach (getallheaders() as $key => $value) {
//   error_log($key);
//   error_log($value);
// }
$jwt = $security->jwtEncode($data['email']);
header("Authorization: Bearer $jwt");
header('Content-Type: application/json');
exit;
?>