<?php

session_start();
require("connDB.php");

if(!isset($_SESSION['num'])){
  $_SESSION['num'] = 5;
}

if (($_SESSION['num'] > 5)) {
  $_SESSION['num'] = 5;
}
$id = $_SESSION['id'];
//顯示會員
$sql = <<<multi
select * from shopuser where userId =$id
multi;
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);
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
        
                        <a href="sign_out.php" class="btn btn-danger   btn-sm">登出帳號</a>
                        <a href="edit.php?id=<?= $_SESSION['id'] ?>" class="btn btn-danger  btn-sm">修改帳號</a>

                    <?php } ?>



                </div>
    </header>

    <div class="py-5 ">

        <table width="400" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">
            <tr>

                <td align="center" bgcolor="#AE0000" colspan="2" id="shopcar">
                    <font color="#FFFFFF">管理員系統</font>
                </td>
            </tr>
            <tr>
 <td>
      <?php if ($_SESSION["id"] == "1") { ?>
        <a href="shop_account.php" class="btn btn-success btn-danger">顧客資料</a>
        <a href="report.php" class="btn btn-success btn-danger">報表</a>
        <a href="adminindex.php" class="btn btn-success btn-danger">商品清單</a>
        <a href="add_item.php" class="btn btn-success btn-danger">新增商品</a>
      <?php }  ?>
   

    </td>
  </tr>
        <tr>
            <td align="center" bgcolor="#AE0000" colspan="2">              

            </td>
        </tr>
        </table>
    </div>

</body>

</html>