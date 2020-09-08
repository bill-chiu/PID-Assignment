<?php
$hash=password_hash("1234", PASSWORD_DEFAULT);
session_start();
$_SESSION['hash'] = $hash;
echo password_hash("1234", PASSWORD_DEFAULT);
// 想知道以下字符从哪里来，可参见 password_hash() 的例子
// $hash = '$2y$07$BCryptRequires22Chrcte/VlQH0piJtjXl.0t1XkA8pw9dMXTpOq';
 
header("location:test.php");  
?>