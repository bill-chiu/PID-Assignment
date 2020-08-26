<?php
session_start();
$id=$_SESSION['id'];

//如果不是管理員
if ($id!=1){
//刪除自己的帳戶
$sql = <<<multi
    delete from shopuser where userId =$id
multi;

require("connDB.php");
mysqli_query($link, $sql);
}
require("sign_out.php");

?>