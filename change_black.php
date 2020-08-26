<?php

session_start();

$id = $_GET["id"];
if($id==1){
    header("location:shop_account.php");
}

else{
// 執行SQL查詢
$sql = "select * from shopuser where userId =$id" ;
require("connDB.php");
$result = mysqli_query($link, $sql);

$row = mysqli_fetch_assoc($result);
    if($row["black"]==0){

    $sql = <<<multi
        update shopuser set 
        black='1'
        where shopuser .userId=$id
    multi;
    require("connDB.php");
    mysqli_query($link, $sql);
        header("location:shop_account.php");
        exit();
}

if($row["black"]==1){
        $sql = <<<multi
        update shopuser set 
        black='0'
        where shopuser .userId=$id
    multi;
    require("connDB.php");
    mysqli_query($link, $sql);
        header("location:shop_account.php");
        exit();
}}
?>