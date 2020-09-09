<?php

session_start();
require("connDB.php");
$detail_total_price = 0;

if ($_SESSION['num'] > 5) {
  $_SESSION['num'] = 5;
}

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
  // echo $listid;
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
      echo "<script>alert('修改成功')</script>";
      $result = mysqli_query($link, $sql);
    } else {

      echo "<script>alert('剩餘數量不足')</script>";
    }
  }
  //顯示購物車內容
  $sql = <<<multi
  select username,c.userId,itemname,itemprice,discount,currentprice,species,od.itemID,quantity,od.remaining,shoplistID,itemprice*quantity*discount*0.01 as totalprice
  
  from shopuser c join shoplists o on o.userId =c.userId
                   join itemlists od on od.itemID =o.itemID
  where c.userId=$id
  ORDER BY shoplistID ASC
  multi;
  $result = mysqli_query($link, $sql);
} else {



  //顯示購物車內容
  $sql = <<<multi
  select username,c.userId,itemname,itemprice,discount,currentprice,species,od.itemID,quantity,od.remaining,shoplistID,currentprice*quantity as totalprice
  
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
    <table width="800" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2" id="shopcar">
      <tr>
        <td align="left" bgcolor="#CCCCCC" colspan="7">
          <font color="#FFFFFF">購物車</font>
        </td>

      </tr>


      <tr bgcolor="#ddd">
        <th colspan="2"> 項目名稱</th>
        <th>庫存</th>
        <th>數量</th>
        <th>價格</th>
        <td align="center"><b>小計</b></td>
        <td align="center"><b>變更</b></td>
      </tr>


      <tr>


        <?php while ($row = mysqli_fetch_assoc($result)) {
          $itemID = $row['itemID'];
          $quantity = $row['quantity'];
          $remaining = $row['remaining'];
          if ($row["quantity"] > $row["remaining"]) {
            $row["quantity"] = $row["remaining"];
            if ($row["remaining"] > 0) {
              $sql = <<<multi
               update shoplists set 
               quantity='$remaining'
               where userId=$id and itemID=$itemID
           multi;
              mysqli_query($link, $sql);
              echo "<script>alert('購買數量大於可販售數量,系統將自行幫您修改至可販售數量')</script>";
            } else {
              $sql = "DELETE FROM shoplists where userId=$id and itemID=$itemID";

              mysqli_query($link, $sql);
              echo "<script>alert('有商品已售完,系統將自行幫您刪除')</script>";
            }
          }
          if ($row["quantity"] > 0) {        ?>

            <td colspan="2" id="shopcar3"><?= $row["itemname"] ?></td>

            <td id="shopcar2"><?= $row["remaining"] ?></td>



            <td valign="baseline" width="0" id="shopcar2">
              <form id="form1" name="form1" method="post">

                <input type="number" name="txtQuantity" id="txtQuantity" value="<?php echo $row["quantity"]; ?>" />
            </td>

            <input type="hidden" name="btnremaining" id="btnremaining" value="<?php echo $row["remaining"] ?>" />
            <td id="shopcar2">
              <font color="#AE0000">
                <?=  $row["currentprice"]  ?>
              </font>元
            </td>


            <td align="center" id="shopcar1">
              <font color="red">
                <?php echo $row["totalprice"];

                $detail_total_price += $row["totalprice"];
                ?>
              </font>元
            </td>

            <td align="center" id="shopcar1">

              <input type="submit" name="btnOK" id="btnOK" value="修改" />
              <input type="hidden" name="btn444" id="btn444" value="<?php echo $row["shoplistID"] ?>" />
              <br><a href="delete_list.php?id=<?= $row["shoplistID"] ?>" id="aurl" class="btn">刪除</a>
            </td>

          <?php } ?>
          </form>
      </tr>

    <?php  } ?>





    <tr align="right" bgcolor="#CCCCCC">
      <td colspan="7" color="CCCCCC">
        <font color="#CCCCCC">
          1
        </font>
      </td>

    </tr>
    <tr>
      <td colspan="4"></td>
      <td align="right"> 總價:</td>
      <td align="right" colspan="2">
        <h5>
          <font color="red">
            <?= round($detail_total_price) ?>
          </font>元

        </h5>
      </td>

    </tr>
    <tr>
      <td align="right" colspan="7" bgcolor="white">
        <a href="checkout.php " class="btn btn-success  btn-sm">結帳</a>
      </td>
    </tr>
    </table>

  </div>

</body>

</html>