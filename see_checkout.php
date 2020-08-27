<?php

session_start();
require("connDB.php");


$id = $_GET['id'];

global $detail_total_price;
global $detailID;
$sql = "select * FROM shopdetail where userId=5";
$result = mysqli_query($link, $sql);

//顯示清單內容
$sql = <<<multi
    SELECT * FROM `shopdetail`  
    WHERE userId =5
    ORDER BY `shopdetail`.`detailID` ASC
  multi;
$result = mysqli_query($link, $sql);
?>




<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Lag - Member Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>

    <table width="800" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">
        <tr>

            <td align="left" bgcolor="#CCCCCC">
                <font color="#FFFFFF">查詢訂單</font>

            </td>

        </tr>
    </table>
    <table width="800" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#CCCCCC">
        <tr>

            <td align="left" valign="baseline">


                <a>Ｈello <?= $_SESSION["user"] ?> </a>

                <?php if ($_SESSION["id"] == 1) { ?>
                    <a>這是 <?= $id ?> 號客人的訂單</a>
                <?php } ?>

            </td>
        </tr>
    </table>
    <table width="800" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">
        <tr>
            <td>訂單編號</td>
            <td>項目名稱</td>
            <td>價格</td>
            <td>種類</td>
            <td>數量</td>
            <td>總價</td>
            <!-- <td>小計</td> -->
        </tr>


        <tr>


            <?php while ($row = mysqli_fetch_assoc($result)) { ?>

                <?php


                if ($detailID != $row["detailID"]) { ?>
        </tr>


        <td> <?php if ($detail_total_price != "") {
                        echo "小計:" . $detail_total_price;
                    } ?></td>



        <!-- <table width="800" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2"> -->

        <!-- </table>  -->

        <tr>
            <?php $detail_total_price += $row["totalprice"]; ?>

            <td><?php

                    echo $row["detailID"] . "     ";


                    $detail_total_price = 0;


                    $detailID = $row["detailID"];   ?></td>

        <?php  } else { ?>
            <td><?php } ?></td>
            <td><?= $row["itemname"] ?></td>
            <td><?= $row["itemprice"] ?></td>
            <td><?= $row["species"] ?></td>

            <td><?= $row["quantity"] ?></td>
            <td><?= $row["totalprice"] ?></td>

            <!-- <?php if ($detailID == $row["detailID"]) {

                        $detail_total_price += $row["totalprice"]; ?>
                <td><?= $detail_total_price ?></td>

            <?php  } else {

                        $detail_total_price = 0;

            ?>

            <?php  } ?> -->
        </tr>
        <tr>
        </tr>


    <?php  } ?>





    <tr>
        <td><?php echo "小計:" . $detail_total_price; ?></td>



    </tr>
    </table>

    <table width="800" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">
        <tr>
            <td align="left" bgcolor="#CCCCCC">
                
                <a href="index.php " class="btn btn-primary  btn-sm">回首頁</a>
            </td>

        </tr>
    </table>


</body>

</html>