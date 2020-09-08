<?php

session_start();
require("connDB.php");


$id = $_GET['id'];

global $detail_total_price;
global $detailID;
$sql = "select * FROM shopdetail where userId=$id";
$result = mysqli_query($link, $sql);

//顯示清單內容
$sql = <<<multi
    SELECT * FROM `shopdetail`  
    WHERE userId =$id 
    ORDER BY `shopdetail`.`detailID` DESC 
  multi;
$result = mysqli_query($link, $sql);

$max = $_SESSION['num'];
if (isset($_POST["btnOK"])) {
    $_SESSION['num'] = $_SESSION['num'] + 5;
    $max = $_SESSION['num'];
}

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
                        <a href="see_checkout.php?id=<?= $id ?>" class="btn btn-danger  btn-sm">查看訂單</a>
                    <?php } ?>



                </div>
    </header>

    <div class="py-5 ">

        <table width="400" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">
            <tr>

                <td align="center" bgcolor="#AE0000" colspan="2" id="shopcar">
                    <font color="#FFFFFF">查詢訂單</font>
                </td>
            </tr>
            <?php if ($_SESSION["id"] == 1) { ?>
                <tr>
                    <td align="left" valign="baseline">
                        <a>這是 <?= $id ?> 號客人的訂單</a>
                    </td>
                </tr>
            <?php } ?>
            <tr>
                <td id="shopcar">訂單編號</td>
                <td id="shopcar">日期</td>
            </tr>
            <tr>
                <?php
                $i = 0;
                while ($row = mysqli_fetch_assoc($result)) { ?>
                    <?php

                    if ($i < $max) {
                        if ($detailID != $row["detailID"]) { ?>
            </tr>
            <tr>
                <td id="shopcar">
                    <a href="detial.php?id=<?= $row["detailID"] ?>" class="btn btn-info"> <?= $row["detailID"] ?></a>
                    <?php $detailID = $row["detailID"];   ?></td>
                <td id="shopcar"><?= $row["data"];
                                    $i++;  ?></td>
        <?php  }
                    } ?>
            </tr>
        <?php  } ?>
        <tr>
            <form id="form1" name="form1" method="post">
                <td align="center" colspan="2" id="shopcar">
                    <?php if ($max == $i) { ?>
                    <input type="submit" name="btnOK" id="btnOK" value="查看更多" id="btn btn-danger" />
                <?php } else { ?>
                    <a href="index.php" class="btn btn-danger  btn-sm">回首頁</a>
                <?php } ?>
                </td>
            </form>
        </tr>
        <tr>
            <td align="center" bgcolor="#AE0000" colspan="2"> 

            </td>
        </tr>
        </table>
    </div>

</body>

</html>