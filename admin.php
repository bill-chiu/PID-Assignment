<?php

session_start();
require("connDB.php");

$id = $_SESSION['id'];

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
</head>

<body>

  <table width="600" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">
    <tr>

      <td align="left" bgcolor="#CCCCCC">
        <font color="#FFFFFF">購物車系統 － 管理</font>
      <td bgcolor="#CCCCCC"></td>
      <td bgcolor="#CCCCCC"></td>
      <td bgcolor="#CCCCCC"></td>
      <td align="left" bgcolor="#CCCCCC" valign="baseline">

        <?php if ($_SESSION["login_session"] == false) { ?>
    <tr>

        <?php if ($_SESSION["id"] == "1") { ?>

          <?php while ($row = mysqli_fetch_assoc($result)) { ?>

      <td><?= $row["username"] ?></td>
      <td><?= $row["phone"] ?></td>
      <td><?= $row["account"] ?></td>
      <td><?= $row["password"] ?></td>


   
        <a href="edit.php?id=<?= $row["studentsId"] ?>" class="btn btn-success btn-sm">Edit</a>
        <a href="admindelete.php?id=<?= $row["studentsId"] ?>" class="btn btn-danger btn-sm">Delete</a>
      </td>
    </tr>
  <?php  } ?>
<?php }  ?>
<a>This page for user only.</a>
</td>
</tr>


<?php } else { ?>
  <a>您好<?= $_SESSION["user"] ?> </a><br>

  <tr>


    <td>
    <a href="shop_account.php?id=<?= $row["userId"] ?>" class="btn btn-success btn-sm">修改會員資料</a>
    <a href="shop_car.php?id=<?= $row["userId"] ?>" class="btn btn-success btn-sm">購物車清單</a>
    <a href="item".php?id=<?= $row["userId"] ?>" class="btn btn-success btn-sm">商品清單</a>
    <a href="edit.php?id=<?= $row["userId"] ?>" class="btn btn-success btn-sm">修改帳戶資料</a>

    </td>
  </tr>
<?php } ?>

<tr>
  <td align="left" bgcolor="#CCCCCC"><a href="index.php " class="btn btn-primary  btn-sm">回首頁</a>
  </td>
  <td bgcolor="#CCCCCC"></td>
  <td bgcolor="#CCCCCC"></td>
  <td bgcolor="#CCCCCC"></td>
  <td bgcolor="#CCCCCC"></td>
</tr>
  </table>


</body>

</html>