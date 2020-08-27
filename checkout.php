<?php
session_start();
$id=$_SESSION['id'];
require("connDB.php");
//查詢訂單最後一筆ID
$sql = "SELECT * FROM `shopdetail` ORDER BY `shopdetail`.`detailID` DESC";

$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);
//暫存新的ID
$newdetailID=$row['detailID']+1;

//搜尋購物車清單
$sql = <<<multi
select username,c.userId,od.itemname,od.itemprice,od.species,quantity,itemprice*quantity as totalprice

from shopuser c join shoplists o on o.userId =c.userId
                join itemlists od on od.itemID =o.itemID
where c.userId=5

multi;
require("connDB.php");
$result = mysqli_query($link, $sql);
while ($row = mysqli_fetch_assoc($result)) {

$itemname=$row['itemname'];
$itemprice=$row['itemprice'];
$species=$row['species'];
$quantity=$row['quantity'];
$totalprice=$row['totalprice'];
$userId=$row['userId'];
//加入到訂單
$sql = <<<multi
INSERT INTO shopdetail (detailID,itemname,itemprice,species,quantity,totalprice,userId,data) VALUES
('$newdetailID','$itemname', '$itemprice','$species','$quantity','$totalprice','$userId',current_date())

multi;
require("connDB.php");
mysqli_query($link, $sql);
echo $sql;
}
//刪除購物車
$sql ="DELETE FROM `shoplists` WHERE `shoplists`.`userId` = $id";
require("connDB.php");
mysqli_query($link, $sql);


header("Location: index.php");
?>