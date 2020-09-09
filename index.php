<?php

session_start();
require("connDB.php");

if (!isset($_SESSION['id'])) {
  $_SESSION['id'] = -1;
}

if (!isset($_SESSION['login_session'])) {
  $_SESSION['login_session'] = false;
}
if (!isset($_SESSION['num'])) {
  $_SESSION['num'] = 5;
}
//$id等於登入帳號id
$id = $_SESSION['id'];
//如果是管理員 導向管理頁面
if ($_SESSION['id'] == 1) {
  header("location:admin.php");
}
if ($_SESSION['num'] > 5) {
  $_SESSION['num'] = 5;
}

global $remaining;

echo $remaining;
//如果按下按鈕且不為0
if (isset($_POST["btnSearch"])) {
  $itemname = $_POST["txtItemname"];
  $species = $_POST["txtSpecies"];
  $sql = <<<multi
select * from itemlists 
WHERE `itemname` LIKE '%$itemname%' and species LIKE '%$species%'
multi;
  $result = mysqli_query($link, $sql);
} else {
  $sql = <<<multi
  select * from itemlists 
  multi;
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


    <table width="800" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">
      <form id="form1" name="form1" method="post">

        <tr>
          <td align="center">
            <h4>快速查詢商品</h4>
          </td>
          <td align="center">商品類別 </td>
          <td align="center">
            <select id="txtSpecies" name="txtSpecies" class="custom-select">
              <option value="">全部</option>
              <option value="eat">eat</option>
              <option value="book">book</option>
              <option value="toy">toy</option>
              <option value="wear">wear</option>
            </select>
          </td>

          <td align="right"><input type="text" name="txtItemname" id="txtItemname" placeholder="請輸入產品名稱" /></td>
          <td align="left"> <input type="submit" name="btnSearch" id="btnSearch" value="查詢" class="btn btn-danger btn-sm" /></td>
        </tr>
      </form>

    </table>
    <div class="py-5 ">
      <div class="container">

        <div class="row">
          <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="col-3 pl-2 pr-2">
              <div class="card mb-3 shadow-sm">
                <a href="item.php?id=<?= $row["itemID"] ?> "><img src="item_image/<?= $row["itemname"] ?>.png" width="100%" height="150"></a>
                <div class="card-body">

                  <a id="aurl" href="item.php?id=<?= $row["itemID"] ?> "><?= $row["itemname"] ?></a><br>



                  <?php if ($row["discount"] == 100) {            ?>
                    <br>
                    <p>
                    <?php  } else if ($row["discount"] < 100 && $row["discount"] % 10!= 0) { ?>
                      <s>原價<?= $row["itemprice"] ?>元<br></s>
                    <h6> <p>
                        <font color="red">
                          <?= $row["discount"];?>
                        </font>
                        折
                      <?php } else { ?>
                        <s>原價<?= $row["itemprice"] ?>元<br></s>
                        <h6>    <p>
                          <font color="red">
                            <?= $row["discount"] * 0.1;?>
                          </font>
                          折
                        <?php  } ?>
                        <font color="red">
                          <?= $row["currentprice"]; ?>
                        </font>元
                        </p></h6> 
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