<?php
session_start();
$id=$_SESSION['id'];

//查詢訂單最後一筆ID
$sql = "SELECT * FROM `shopdetail` ORDER BY `shopdetail`.`detailID` DESC";
require("connDB.php");
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);
//暫存新的ID
$newdetailID=$row['detailID']+1;

//搜尋購物車清單
$sql = "SELECT * FROM `shoplists` WHERE `shoplists`.`userId` = $id";
require("connDB.php");
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);

//加入到訂單
$sql = <<<multi
INSERT INTO itemlists (itemname, itemprice,species) VALUES
('$itemname', '$itemprice','$species')
multi;
echo $sql;
require("connDB.php");
mysqli_query($link, $sql);
// header("location:index.php");


//刪除購物車
$sql ="DELETE FROM `shoplists` WHERE `shoplists`.`userId` = $id";
require("connDB.php");
mysqli_query($link, $sql);


// header("Location: index.php");

?>
