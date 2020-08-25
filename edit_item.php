<?php

session_start();
require("connDB.php");
$id=$_GET["id"];
  $sql = <<<multi
    UPDATE shoplists SET 
    quantity = '$quantity' 
    WHERE shoplists.shoplistID =$id 
multi;
  mysqli_query($link, $sql); 


  // header("location:shop_car.php");

?>

