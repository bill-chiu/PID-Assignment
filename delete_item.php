<?php

        //$id等於物品id
       $id=$_GET["id"];

        //從物品清單中刪除該物品
       $sql = <<<multi
       delete from itemlists where itemID =$id
       multi;
       
       require("connDB.php");
       mysqli_query($link, $sql);
       
       header("location:echo.php");
?>