<?php
session_start();
        //$id=清單id
       $id=$_GET["id"];
       $userid=$_SESSION['id'];
        //刪除購物車清單
       $sql = <<<multi
       delete from shoplists where shoplistID =$id
       multi;
       
       require("connDB.php");
       mysqli_query($link, $sql);
    //    echo $userid;
       header("Location:shop_car.php?id=$userid");
?>