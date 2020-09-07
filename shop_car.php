<?php

session_start();
require("connDB.php");
$detail_total_price = 0;

$id = $_GET['id'];
//如果按下確認
if (isset($_POST["btnOK"])) {

  //記錄欲修改之物品編號
  $listid = $_POST["btn444"];

  //記錄欲修改之數量
  $quantity = $_POST["txtQuantity"];

  //記錄剩餘數量
  $remaining = $_POST["btnremaining"];

  //如果修改數量=0
  echo $listid;
  if ($_POST["txtQuantity"] <= 0) {

    header("Location: delete_list.php?id=$listid");
  } else {


    //如果剩餘數量大於修改數量
    if ($remaining >= $quantity) {

      //更新數量
      $sql = <<<multi
    UPDATE shoplists SET 
    quantity = '$quantity' 
    WHERE shoplists .shoplistID =$listid

multi;
      $result = mysqli_query($link, $sql);
    } else {

      echo "<center><font color='red'>";
      echo "剩餘數量不足!<br/>";
      echo "</font>";
    }
  }
  //顯示購物車內容
  $sql = <<<multi
  select username,c.userId,itemname,itemprice,species,od.itemID,quantity,od.remaining,shoplistID,itemprice*quantity as totalprice
  
  from shopuser c join shoplists o on o.userId =c.userId
                   join itemlists od on od.itemID =o.itemID
  where c.userId=$id
  ORDER BY shoplistID ASC
  multi;
  $result = mysqli_query($link, $sql);
} else {



  //顯示購物車內容
  $sql = <<<multi
  select username,c.userId,itemname,itemprice,species,od.itemID,quantity,od.remaining,shoplistID,itemprice*quantity as totalprice
  
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
        <a href="see_checkout.php?id=<?= $id ?>" class="btn btn-primary  btn-sm">查看訂單</a>
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

            <a>這是 <?= $id ?> 號客人的訂單</a>


          <?php } ?>
        <?php } ?>

    </tr>

    <tr>
      <td>項目名稱</td>
      <td>價格</td>
      <td>種類</td>
      <td>數量</td>
      <td>剩餘數量</td>
      <td>總價</td>
    </tr>


    <tr>


      <?php while ($row = mysqli_fetch_assoc($result)) {

      ?>

        <td><?= $row["itemname"] ?></td>
        <td><?= $row["itemprice"] ?></td>
        <td><?= $row["species"] ?></td>

        <td valign="baseline" width="0">
          <form id="form1" name="form1" method="post">
            <?php
            if ($row["quantity"] > $row["remaining"]) {
              $row["quantity"] = $row["remaining"];
              $quantity = $row['quantity'];
              $remaining = $row['remaining'];
              $itemID = $row['itemID'];
              $sql = <<<multi
                update shoplists set 
                quantity='$remaining'
                where userId=$id and itemID=$itemID
            multi;
              mysqli_query($link, $sql);

              echo "<script>alert('購買數量大於可販售數量,系統將自行幫您修改至可販售數量')</script>";
            }


            ?>
            <input type="text" name="txtQuantity" id="txtQuantity" value="<?php echo $row["quantity"]; ?>" />
        </td>

        <td><?= $row["remaining"] ?></td>
        <input type="hidden" name="btnremaining" id="btnremaining" value="<?php echo $row["remaining"] ?>" />
        <td><?php echo $row["totalprice"];

            $detail_total_price += $row["totalprice"];
            ?></td>

        <td>

          <input type="submit" name="btnOK" id="btnOK" value="修改" class="btn btn-success btn-sm" />
          <input type="hidden" name="btn444" id="btn444" value="<?php echo $row["shoplistID"] ?>" />
          <a href="delete_list.php?id=<?= $row["shoplistID"] ?>" class="btn btn-danger btn-sm">Delete</a>
        </td>


        </form>
    </tr>

  <?php  } ?>




  </table>
  <table width="800" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">


    <tr>
      <td align="right" bgcolor="#CCCCCC">
        <?= "小計:" . $detail_total_price ?>
        <a href="index.php " class="btn btn-primary  btn-sm">回首頁</a>
        <a href="checkout.php " class="btn btn-success  btn-sm">結帳</a>
      </td>

    </tr>
  </table>


</body>

</html>