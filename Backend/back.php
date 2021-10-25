<?php
$data = json_decode(file_get_contents('php://input'), TRUE);
foreach ($data as $key => $value) {
  error_log($key);
  error_log($value);
}
foreach (getallheaders() as $key => $value) {
  error_log($key);
  error_log($value);
}
header("Authorization: Bearer");
exit;
?>