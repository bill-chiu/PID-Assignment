<?php
$relode = false;
session_start();
$id = $_SESSION['id'];
require("connDB.php");
//查詢訂單最後一筆ID
$sql = "SELECT * FROM `shopdetail` ORDER BY `shopdetail`.`detailID` DESC";

$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);
//暫存新的ID
$newdetailID = $row['detailID'] + 1;


$sql = <<<multi
select quantity,od.remaining,od.itemID

from shopuser c join shoplists o on o.userId =c.userId
                join itemlists od on od.itemID =o.itemID
where c.userId=$id

multi;

$result = mysqli_query($link, $sql);
while ($row = mysqli_fetch_assoc($result)) {

    $quantity = $row['quantity'];
    $remaining = $row['remaining'];
    $remaining -= $quantity;
    $itemID = $row['itemID'];
    if ($remaining < 0) {
        $relode = true;
        $remaining += $quantity;
        $sql = <<<multi

    update shoplists set 
    quantity='$remaining'
    where userId=$id and itemID=$itemID

multi;
        mysqli_query($link, $sql);
        // echo $sql;
        // echo "<center><font color='red'>";
        // echo "物品數量有異動! 已將您的數量調整為庫存數量<br/>";
        // echo "</font>";
    }
    // exit();
}

if ($relode == true) {

    echo "<center><font color='red'>";
    echo "物品數量有異動! 已將您的數量調整為庫存數量<br/>";
    echo "</font>";
    header("Refresh:2;shop_car.php?id=$id");
} else {

    //搜尋購物車清單
    $sql = <<<multi
select username,c.userId,od.itemname,od.itemprice,od.species,quantity,od.remaining,od.itemID,itemprice*quantity as totalprice

from shopuser c join shoplists o on o.userId =c.userId
                join itemlists od on od.itemID =o.itemID
where c.userId=$id

multi;
    $result = mysqli_query($link, $sql);
    while ($row = mysqli_fetch_assoc($result)) {

        $itemname = $row['itemname'];
        $itemprice = $row['itemprice'];
        $species = $row['species'];
        $quantity = $row['quantity'];
        $remaining = $row['remaining'];
        $totalprice = $row['totalprice'];
        $userId = $row['userId'];
        $itemid = $row['itemID'];
        $remaining = $remaining - $quantity;



        //加入到訂單
        $sql = <<<multi
INSERT INTO shopdetail (detailID,itemname,itemprice,species,quantity,totalprice,userId,data) VALUES
('$newdetailID','$itemname', '$itemprice','$species','$quantity','$totalprice','$userId',current_date());
multi;
        mysqli_query($link, $sql);


        $sql = <<<multi
update itemlists set 
remaining='$remaining'
where itemlists .itemID='$itemid'
multi;
        mysqli_query($link, $sql);
  
    }

    //刪除購物車
    $sql = "DELETE FROM `shoplists` WHERE `shoplists`.`userId` = $id";
    require("connDB.php");
    mysqli_query($link, $sql);


    header("Location: index.php");
}
?>