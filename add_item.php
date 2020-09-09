<?php
session_start();
require("connDB.php");


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="mycss.css">
  <title>Document</title>
  <style>
    .box {
      padding-left: 100px;
      padding-right: 100px;
    }
  </style>
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
    <form id="form1" name="form1" method="post" enctype="multipart/form-data" action="do_add_item.php">
      <table width="400" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">

        <tr bgcolor="#AE0000">
          <td>
            <div id="title">
              <div></div>
              <font color="#FFFFFF" align="center">新增商品</font>
              <div>
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <td>
        </tr>

        <tr>
          <td>
            <div class="form-group row col-8">
              <label for="textarea" class="col-4 col-form-label">名稱:</label>
              <div class="col-8">
                <input type="text" name="txtItemName" placeholder="輸入商品名稱" id="txtItemName" required />
              </div </div> </td> </tr> <tr>
          <td>
            <div class="form-group row col-8">
              <label for="textarea" class="col-4 col-form-label">照片:</label>
              <div class="col-8">
                <input type="file" name="myfile" id="myfile" required />
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <td>
            <div class="form-group row col-8">
              <label for="textarea" class="col-4 col-form-label">價格:</label>
              <div class="col-8">
                <input type="text" name="txtItemPrice" placeholder="輸入商品價格" id="txtItemPrice" required onkeyup="value=value.replace(/[^\d]/g,'') " />
              </div>
            </div>
          </td>
        </tr>

        <tr>
          <td>
            <div class="form-group row">
              <label for="textarea" class="col-3 col-form-label ml-3"> 類別:</label>
              <div class="col-8">
                <select id="txtSpecies" name="txtSpecies" class="custom-select">
                  <option value="eat">eat</option>
                  <option value="book">book</option>
                  <option value="toy">toy</option>
                  <option value="wear">wear</option>

                </select>
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <td>
            <div class="form-group row">
              <label for="textarea" class="col-3 col-form-label ml-3">描述:</label>
              <div class="col-8">
                <textarea id="txtItemAbout" name="txtItemAbout" placeholder="輸入商品內容" cols="40" rows="5" class="form-control"></textarea>
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <td colspan="2" align="center">

            <hr>
            <input type="submit" name="btnOK" id="btnOK" value="新增" />
    </form>
    <a id="aurl" href="index.php " class="btn">回首頁</a>
    </td>
    </tr>
    <tr bgcolor="#AE0000">
      <td>
        <div>
          <font color="#AE0000">123</font>
        </div>

      </td>

    </tr>

  </div>
  </table>

</body>


</html>