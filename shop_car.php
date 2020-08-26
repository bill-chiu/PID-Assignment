<?php

session_start();
require("connDB.php");


$id = $_GET['id'];
//如果按下確認
if (isset($_POST["btnOK"])) {

  //記錄欲修改之物品編號
  $listid = $_POST["btn444"];

  //記錄欲修改之數量
  $quantity = $_POST["txtQuantity"];

  //更新數量
  $sql = <<<multi
    UPDATE shoplists SET 
    quantity = '$quantity' 
    WHERE shoplists .shoplistID =$listid

multi;

  $result = mysqli_query($link, $sql);

  //顯示購物車內容
  $sql = <<<multi
  select username,c.userId,itemname,itemprice,species,quantity,shoplistID,itemprice*quantity as totalprice
  
  from shopuser c join shoplists o on o.userId =c.userId
                   join itemlists od on od.itemID =o.itemID
  where c.userId=$id
  ORDER BY shoplistID ASC
  multi;
  $result = mysqli_query($link, $sql);


} else {

  //顯示購物車內容
  $sql = <<<multi
  select username,c.userId,itemname,itemprice,species,quantity,shoplistID,itemprice*quantity as totalprice
  
  from shopuser c join shoplists o on o.userId =c.userId
                   join itemlists od on od.itemID =o.itemID
  where c.userId=$id
  ORDER BY shoplistID ASC
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
</head>

<body>

  <table width="800" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">
    <tr>

      <td align="left" bgcolor="#CCCCCC">
        <font color="#FFFFFF">會員系統 － 管理員專用</font>

      </td>

    </tr>
    </table>
    <table width="800" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">
    <tr>

      <td align="left" valign="baseline">

        <?php if ($_SESSION["login_session"] == false) { ?>

          <a href="login.php">This page for user only.</a>

        <?php } else { ?>

          <a>Ｈello <?= $_SESSION["user"] ?> </a>

          <?php if ($_SESSION["id"] == 1) { ?>
            
            <a>這是 <?=$id ?> 號客人的訂單</a>

                        
        <?php } ?>
        <?php } ?>

    </tr>

    <tr>
      <td>項目名稱</td>
      <td>價格</td>
      <td>總累</td>
      <td>數量</td>
      <td>總價</td>
    </tr>


    <tr>


      <?php while ($row = mysqli_fetch_assoc($result)) { ?>
       
        <td><?= $row["itemname"] ?></td>
        <td><?= $row["itemprice"] ?></td>
        <td><?= $row["species"] ?></td>
        <?php if ($_SESSION['id'] != 1) { ?>

          <td valign="baseline" width="0">

            <form id="form1" name="form1" method="post">
              <input type="text" name="txtQuantity" id="txtQuantity" value="<?php echo $row["quantity"]; ?>" />

          </td>
        <?php } else { ?>
          <td><?= $row["quantity"] ?></td>
        <?php } ?>
        <td><?= $row["totalprice"] ?></td>

        <?php if ($_SESSION['id'] != 1) { ?>
          <td>

            <input type="submit" name="btnOK" id="btnOK" value="修改" class="btn btn-success btn-sm" />
            <input type="hidden" name="btn444" id="btn444" value="<?php echo $row["shoplistID"] ?>" />
            <a href="delete_list.php?id=<?= $row["shoplistID"] ?>" class="btn btn-danger btn-sm">Delete</a>
          </td>


        <?php } ?>
        </form>
    </tr>

  <?php  } ?>




  </table>
  <table width="800" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">


  <tr>
    <td align="left" bgcolor="#CCCCCC">
    <a href="checkout.php " class="btn btn-success  btn-sm">結帳</a>
      <a href="index.php " class="btn btn-primary  btn-sm">回首頁</a>
    </td>

  </tr>
  </table>


</body>

</html>