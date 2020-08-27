<?php

session_start();
require("connDB.php");

//$id等於登入帳號id
$id = $_SESSION['id'];
//如果是管理員 導向管理頁面
if ($_SESSION['id'] == 1) {
  header("location:admin.php");
}


//如果按下按鈕且不為0
if (isset($_POST["btnOK"]) && $_POST["txtQuantity"] != "0") {

  //記錄欲購買數量
  $itemid = $_POST["btn444"];
  echo $itemid;
  //加入到購物車
  $quantity = $_POST["txtQuantity"];
  $sql = <<<multi
  INSERT INTO shoplists (itemID, quantity,userId) VALUES
  ('$itemid', '$quantity','$id')

multi;

  $result = mysqli_query($link, $sql);
  header("Location:shop_car.php?id=$id");
  exit();
  //返回瀏覽介面
} else {

  $sql = <<<multi
  select * from itemlists 
  multi;
  $result = mysqli_query($link, $sql);

  echo $_SESSION['id'];
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
</head>

<body>

  <table width="600" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">


    <td align="left" bgcolor="#CCCCCC">
      <font color="#FFFFFF">商品目錄</font>
    </td>


    <td align="right" bgcolor="#CCCCCC">
      <?php if ($_SESSION["login_session"] == false) { ?>



        <a href="add.php" class="btn btn-warning  btn-sm">註冊帳號</a>
        <a href="login.php" class="btn btn-info   btn-sm">登入帳號</a>

      <?php } else { ?>
        <a>hello <?= $_SESSION["user"] ?> </a>
        <a><img src="account_image/<?= $_SESSION['account'] ?>.png" width="40" height="40"></a>
        <a href="shop_car.php?id=<?= $_SESSION['id'] ?>" class="btn btn-primary   btn-sm">購物車</a>
        <a href="sign_out.php" class="btn btn-danger   btn-sm">登出帳號</a>
        <a href="edit.php?id=<?= $_SESSION['id'] ?>" class="btn btn-success  btn-sm">修改帳號</a>

      <?php } ?>
    </td>
    </tr>

  </table>
  <table width="600" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">

    <tr>
      <td colspan="" align="center" bgcolor="#F2F2F2">

      </td>
    </tr>
    <tr>

      <td align="left" valign="baseline">

    </tr>

    <tr>
      <td>項目名稱</td>
      <td></td>
      <td>價格</td>
      <td>種類</td>
      <?php if ($_SESSION["login_session"] != false) { ?>
        <td>數量</td>

      <?php } ?>
      <td>剩餘數量</td>
    </tr>


    <tr>
      <?php while ($row = mysqli_fetch_assoc($result)) { ?>


        <form id="form1" name="form1" method="post">
          <td><?= $row["itemname"] ?> </td>
          <td><a><img src="item_image/<?= $row["itemname"] ?>.png" width="100" height="100"></a></td>


          <td><?= $row["itemprice"] ?></td>


          <td><?= $row["species"] ?></td>
          <?php if ($_SESSION["login_session"] != false) { ?>

            <td> <input type="text" name="txtQuantity" id="txtQuantity" value="0" /></td>
          <?php } ?>
          <td><?= $row["remaining"] ?> </td>

          <td>
            <?php if ($_SESSION["login_session"] == false) { ?>
              <a href="login.php" class="btn btn-danger btn-sm">新增</a>
            <?php } else { ?>

              <input type="submit" name="btnOK" id="btnOK" value="新增" class="btn btn-success btn-sm" />

              <input type="hidden" name="btn444" id="btn444" value="<?php echo $row["itemID"] ?>" />
            <?php } ?>
          </td>
        </form>
    </tr>

  <?php  } ?>


  </table>



  <table width="600" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">
    <td align="left" bgcolor="#CCCCCC">
      <font color="#CCCCCC">11</font>
    </td>
  </table>
</body>

</html>