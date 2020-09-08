<?php
 $hash='$2y$10$PWOeDZ6o075R.K10CqYAyu2fmtLKdkUiGRrSDroDNlUzx8QcbHcx2';
echo  $hash;

if (password_verify('257', $hash)) {
  echo 'Password is valid!';
} else {
  echo 'Invalid password.';
}

?>