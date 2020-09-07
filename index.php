<?php

session_start();
require("connDB.php");

//$id等於登入帳號id
$id = $_SESSION['id'];
//如果是管理員 導向管理頁面
if ($_SESSION['id'] == 1) {
  header("location:admin.php");
}

global $remaining;

echo $remaining;
//如果按下按鈕且不為0
if (isset($_POST["btnOK"]) && $_POST["txtQuantity"] > 0) {

  //記錄欲購買數量
  $itemid = $_POST["btn444"];
  $remaining = $_POST["btnremaining"];
  echo $itemid;
  echo $remaining;
  //加入到購物車
  $quantity = $_POST["txtQuantity"];

  $sql = "SELECT * FROM `shoplists` where userId=$id and itemID=$itemid";
  $result = mysqli_query($link, $sql);
  $total_records = mysqli_num_rows($result);


  // 是否有查詢到購買紀錄
  if ($total_records > 0) {
    $row = mysqli_fetch_assoc($result);
    //記錄原本購買數量
    $pastquantity = $row["quantity"];
    echo "購買前數量" . $pastquantity;
    //加上新購買的數量
    $quantity = $pastquantity + $quantity;
    echo "購買後數量" . $quantity;
    //如果大於庫存則更新購買數量
    if ($quantity <= $remaining) {

      $sql = <<<multi
      update shoplists set 
      quantity='$quantity'
      where shoplists .userId=$id and shoplists .itemID=$itemid
multi;
      $result = mysqli_query($link, $sql);
      header("Location:index.php");
      // header("Location:shop_car.php?id=$id");
    } else {
      echo "<center><font color='red'>";
      echo "剩餘數量不足!<br/>";
      echo "</font>";

      $sql = <<<multi
      select * from itemlists 
      multi;
      $result = mysqli_query($link, $sql);
    }
    //如果沒有購買紀錄
  } else {
    if ($quantity <= $remaining) {
      $sql = <<<multi
  INSERT INTO shoplists (itemID, quantity,userId) VALUES
  ('$itemid', '$quantity','$id')

multi;

      $result = mysqli_query($link, $sql);
      header("Location:index.php");
      // header("Location:shop_car.php?id=$id");
      exit();
    } else {
      echo "<center><font color='red'>";
      echo "剩餘數量不足!<br/>";
      echo "</font>";

      $sql = <<<multi
    select * from itemlists 
    multi;
      $result = mysqli_query($link, $sql);
    }
  }
  //返回瀏覽介面
} else {

  $sql = <<<multi
  select * from itemlists 
  multi;
  $result = mysqli_query($link, $sql);

  // echo $_SESSION['id'];
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
        <a href="#" class="navbar-brand d-flex align-items-center">
          <strong>細菌的商城</strong>
        </a>

        <!-- <form action="#" method="post">
          <a class="navbar-brand d-flex align-items-center">
            <label>商品名稱</label>
            <input type="text" class="field" />
            <label>類別</label>
            <select class="field">
              <option value="123">選擇類別</option>
            </select>

            <label>價格</label>
            <select class="field small-field">
              <option value="">$10</option>
            </select>
            <label>to:</label>
            <select class="field small-field">
              <option value="">$50</option>
            </select>

            <input type="submit" class="search-submit" value="查詢" />

        </form> -->

      <!-- </div> -->
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

      <?php } ?>
      </div>
    </div>
    </div>
  </header>

  <main role="main">

    <div class="py-5 ">

      <div class="container">

        <div class="row">
          <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="col-3 pl-2 pr-2">
              <div class="card mb-3 shadow-sm">
                <a href="item.php?id=<?= $row["itemID"] ?> "><img src="item_image/<?= $row["itemname"] ?>.png" width="100%" height="150"></a>
                <div class="card-body">
                  <a id="aurl" href="item.php?id=<?= $row["itemID"] ?> "><?= $row["itemname"] ?></a>
          


                  <font color="#AE0000">

                    <p><?= $row["itemprice"] . "元" ?></p>
                  </font>
                  <div class="d-flex justify-content-between align-items-center">

                  </div>
                </div>
              </div>
            </div>


          <?php } ?>

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
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script>
    window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')
  </script>
  <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

</html>