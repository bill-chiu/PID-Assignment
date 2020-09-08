<?php

session_start();
require("connDB.php");
$itemid = $_GET["id"];

//$id等於登入帳號id
$id = $_SESSION['id'];
//如果是管理員 導向管理頁面
if ($_SESSION['id'] == 1) {
  header("location:admin.php");
}
global $remaining;
//如果按下按鈕且不為0
if (isset($_POST["btnOK"]) && $_POST["txtQuantity"] > 0) {
  //記錄欲購買數量
  // $itemid = $_POST["btn444"];
  $remaining = $_POST["btnremaining"];
  // echo $itemid;

  //加入到購物車
  $quantity = $_POST["txtQuantity"];

  $sql = "SELECT * FROM `shoplists` where userId=$id and itemID=$itemid";
  $result = mysqli_query($link, $sql);
  $total_records = mysqli_num_rows($result);
  //如果大於庫存則更新購買數量
  if ($quantity <= $remaining) {
    // 是否有查詢到購買紀錄
    if ($total_records > 0) {
      $row = mysqli_fetch_assoc($result);
      //記錄原本購買數量
      $pastquantity = $row["quantity"];
      //加上新購買的數量
      $quantity = $pastquantity + $quantity;
      $sql = <<<multi
      update shoplists set 
      quantity='$quantity'
      where shoplists .userId=$id and shoplists .itemID=$itemid
multi;
echo "<script>alert('新增商品成功')</script>";
      $result = mysqli_query($link, $sql);
       //刷新頁面
      $sql ="select * from itemlists where itemID =$itemid";
      $result = mysqli_query($link, $sql);
      // 是否沒有查詢到購買紀錄
    } else {
      //新增一個項目
      //刷新頁面
      $sql = <<<multi
  INSERT INTO shoplists (itemID, quantity,userId) VALUES
  ('$itemid', '$quantity','$id')
multi;
echo "<script>alert('新增商品成功')</script>";
      $result = mysqli_query($link, $sql);
      $sql ="select * from itemlists where itemID =$itemid";
      $result = mysqli_query($link, $sql);
    }
  } else {

    echo "<script>alert('剩餘數量不足')</script>";

    $sql ="select * from itemlists where itemID =$itemid";
    $result = mysqli_query($link, $sql);
  }
  //返回瀏覽介面
} else {

  $sql ="select * from itemlists where itemID =$itemid";
  $result = mysqli_query($link, $sql);
}

?>



<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">

  <title>Album example · Bootstrap</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/album/">

  <!-- Bootstrap core CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="mycss.css">
  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>

  <link href="album.css" rel="stylesheet">
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



            <a href="add.php" class="btn btn-danger  btn-sm">註冊帳號</a>
            <a href="login.php" class="btn btn-danger   btn-sm">登入帳號</a>

          <?php } else { ?>

            <a><?= $_SESSION["user"] ?>您好</a>
            <a><img src="account_image/<?= $_SESSION['account'] ?>.png" width="40" height="40"></a>
            <a href="shop_car.php?id=<?= $_SESSION['id'] ?>" class="btn btn-danger   btn-sm">購物車</a>
            <a href="sign_out.php" class="btn btn-danger   btn-sm">登出帳號</a>
            <a href="edit.php?id=<?= $_SESSION['id'] ?>" class="btn btn-danger  btn-sm">修改帳號</a>
            <a href="see_checkout.php?id=<?= $id ?>" class="btn btn-danger  btn-sm">查看訂單</a>

          <?php } ?>
    
        </div>
      </div>
    </div>
  </header>

  <main role="main">

    <div class="album py-5 bg-light">

      <div class="container">

        <div class="row">
          <?php $row = mysqli_fetch_assoc($result) ?>
          <div class="col-4">
            <div class="card shadow-sm">
              <a><img src="item_image/<?= $row["itemname"] ?>.png" width="100%" height="200"></a>
              <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">
                </div>
              </div>
            </div>
          </div>
          <div>
            <h2><?= $row["itemname"] ?></h2>
            <h3>
              <font color="#AE0000">
                <?= $row["itemprice"] ?>
              </font>
              元
            </h3>
            <form id="form1" name="form1" method="post">


              <p>數量尚餘: <?php echo $row["remaining"]; ?></p>
              <?php if ($_SESSION["login_session"] != false) { ?>

                <p> <input  type="number" name="txtQuantity" id="txtQuantity" required value="1" width="100" />
                <?php } ?>
                <input type="hidden" name="btnremaining" id="btnremaining" value="<?php echo $row["remaining"] ?>" />

                <?php if ($_SESSION["login_session"] == false) { ?>
                  <a id="aurl" href="login.php">購買</a>
                <?php } else { ?></p>

                <input type="submit" name="btnOK" id="btnOK" value="加入購物車" />

       
              <?php } ?></p>
          </div>
        </div>
      </div>
    </div>

  </main>

  <footer class="text-muted">
    <div class="container">
      <p class="float-right">
        <a href="#">Back to top</a>
      </p>

    </div>
  </footer>

</html>