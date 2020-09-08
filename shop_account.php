<?php

session_start();
require("connDB.php");

$id = $_SESSION['id'];
global $maxpreson;
$sql = <<<multi
select * from shopuser ORDER BY `shopuser`.`userId` DESC
multi;
$i = 0;
$result = mysqli_query($link, $sql);
while ($row = mysqli_fetch_assoc($result)) {
  $i++;
}
$maxpreson = $i++;;

//顯示會員清單
if (isset($_POST["btnUP"])) {
  $_SESSION['num'] = $_SESSION['num'] + 5;
  $num = $_SESSION['num'];
  $sql = <<<multi
  select * from shopuser  limit $num,5
  multi;
  $result = mysqli_query($link, $sql);
} else if (isset($_POST["btnDown"])) {
  $_SESSION['num'] = $_SESSION['num'] - 5;
  $num = $_SESSION['num'];
  $sql = <<<multi
  select * from shopuser  limit $num,5
  multi;
  $result = mysqli_query($link, $sql);
} else {
  $_SESSION['num'] = 1;
  $num = $_SESSION['num'];
  $sql = <<<multi
  select * from shopuser  limit $num,5
multi;
  $result = mysqli_query($link, $sql);
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
<form id="form1" name="form1" method="post">
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

            <a href="sign_out.php" class="btn btn-danger   btn-sm">登出帳號</a>
            <a href="edit.php?id=<?= $_SESSION['id'] ?>" class="btn btn-danger  btn-sm">修改帳號</a>

          <?php } ?>



        </div>
  </header>
  <div class="py-5 ">
    <table width="800" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2" id="shopcar"> 

      <tr>
        <td align="left" bgcolor="#CCCCCC" colspan="5">
          <font color="#FFFFFF">會員清單</font>
        </td>

      </tr>
      <tr bgcolor="#ddd">
      <td align="center"><b>會員編號</b></td>
        <td align="center"><b>會員名稱</b></td>
        <td align="center"><b>會員手機</b></td>
        <td align="center"><b>會員帳號</b></td>
        <td align="center"><b>會員管理</b></td>

      </tr>


      <tr>

        <?php
        $detail_total_price = 0;
        while ($row = mysqli_fetch_assoc($result)) { ?>


          <td align="center" id="shopcar1"><?= $row["userId"] ?></td>
          <td align="center" id="shopcar3"><?= $row["username"] ?></td>
          <td align="center" id="shopcar1"><?= $row["userphone"] ?></td>


          <td align="center" id="shopcar1"><?= $row["account"] ?></td>
          <td align="center" id="shopcar1">

            <a href="see_checkout.php?id=<?= $row["userId"] ?>" class="btn btn-info btn-sm">看購買清單</a>

            <?php if ($row["black"] == 0) { ?>

              <a href="change_black.php?id=<?= $row["userId"] ?>" class="btn btn-danger btn-sm">加入黑名單</a>
            <?php } else { ?>
              <a href="change_black.php?id=<?= $row["userId"] ?>" class="btn btn-success btn-sm">取消黑名單</a>
            <?php } ?>

          </td>

      </tr>
      <tr>
      </tr>


    <?php  } ?>


      <tr>
        <?php if ($num > 5) { ?>
          <td align="center" colspan="2"><input type="submit" name="btnDown" id="btnDown" value="上一頁" /></td>
        <?php } else { ?>
          <td align="center" colspan="2"></td>
        <?php } ?>
        <?php if ($maxpreson - 5 > $num) { ?>
          <td align="center" colspan="2"><input type="submit" name="btnUP" id="btnUP" value="下一頁" /></td>
        <?php } else { ?>
          <td align="center" colspan="2"></td>
        <?php } ?>
        <td align="center" ><a href="index.php " class="btn btn-danger  btn-sm">回首頁</a>
        </td>

      </tr>
    </table>
    </form>
</body>

</html>