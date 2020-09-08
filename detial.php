<?php

session_start();
require("connDB.php");

$userid = $_SESSION["id"];
$id = $_GET['id'];

global $detail_total_price;
global $detailID;
$sql = "select * FROM shopdetail where userId=5";
$result = mysqli_query($link, $sql);

//顯示清單內容
$sql = <<<multi
    SELECT * FROM `shopdetail`  
    WHERE detailID =$id
    ORDER BY `shopdetail`.`detailID` DESC
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
    <link rel="stylesheet" href="mycss.css">
</head>

<body>
    <header>
        <div class="navbar navbar-dark bg-danger shadow-sm">
            <div class="container d-flex justify-content-between">
                <a href="index.php" class="navbar-brand d-flex align-items-center">
                    <strong>細菌的商城</strong>
                </a>
                <div>
                    <?php if ($_SESSION["login_session"] == false) { ?>
                        <a href="add.php" class="btn btn-warning  btn-sm">註冊帳號</a>
                        <a href="login.php" class="btn btn-info   btn-sm">登入帳號</a>

                    <?php } else { ?>

                        <a><?= $_SESSION["user"] ?>您好</a>
                        <a><img src="account_image/<?= $_SESSION['account'] ?>.png" width="40" height="40"></a>
                        <a href="shop_car.php?id=<?= $_SESSION['id'] ?>" class="btn btn-danger   btn-sm">購物車</a>
                        <a href="sign_out.php" class="btn btn-danger   btn-sm">登出帳號</a>
                        <a href="edit.php?id=<?= $_SESSION['id'] ?>" class="btn btn-danger  btn-sm">修改帳號</a>
                        <a href="see_checkout.php?id=<?= $userid ?>" class="btn btn-danger  btn-sm">查看訂單</a>
                    <?php } ?>



                </div>
    </header>
    <div class="py-5 ">
        <table width="800" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">

            <tr>
                <td align="left" bgcolor="#CCCCCC" colspan="5">
                    <font color="#FFFFFF">訂單明細</font>
                </td>
                <td align="left" bgcolor="#CCCCCC" valign="baseline">
                    <?php if ($_SESSION["id"] == 1) { ?>
                        <a>這是 <?= $id ?> 號客人的訂單</a>
                    <?php } ?>

                </td>
            </tr>


            <tr bgcolor="#ddd">
                <th colspan="2"> 項目名稱</th>


                <td align="center"><b>價格</b></td>
                <td align="center"><b>數量</b></td>
                <td align="center"><b>小計</b></td>
                <th>日期</td>

            </tr>


            <tr>

                <?php
                $detail_total_price = 0;
                while ($row = mysqli_fetch_assoc($result)) { ?>



                    <td colspan="2" id="shopcar3"><?= $row["itemname"] ?></td>
                    <td align="center" id="shopcar1"><?= $row["itemprice"] ?></td>

                    <td align="center" id="shopcar1"><?= $row["quantity"] ?></td>
                    <td align="center" id="shopcar1">
                        <font color="red">
                            <?php echo $row["totalprice"];

                            $detail_total_price += $row["totalprice"];
                            ?>
                        </font>元
                    </td>
                    <?php $detail_total_price = $detail_total_price + $row["totalprice"]; ?>
                    <td id="shopcar3"><?= $row["data"] ?></td>


            </tr>
            <tr>
            </tr>


        <?php  } ?>
        <tr>
            <td colspan="4"></td>
            <td align="right"> 總價:</td>
            <td align="right" colspan="2">
                <h5>
                    <font color="red">
                        <?= $detail_total_price ?>
                    </font>元

                </h5>
            </td>

        </tr>
        </table>

        <table width="800" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">
            <tr>
                <td align="left" bgcolor="#CCCCCC">
                    <?php if ($_SESSION["id"] != 1) { ?>
                    <a href="see_checkout.php?id=<?= $userid ?>" class="btn btn-danger  btn-sm">回訂單</a>

                <?php } else { ?>
                    <a href="shop_account.php" class="btn btn-danger  btn-sm">回顧客資料</a>
                <?php } ?>
                </td>

            </tr>
        </table>


</body>

</html>