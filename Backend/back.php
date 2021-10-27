<?php
require_once 'Security.php';

$security = new Security();

$data = json_decode(file_get_contents('php://input'), TRUE);
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