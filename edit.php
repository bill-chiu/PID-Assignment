<?php




session_start();
//如果是遊客
if ($_SESSION["user"] == "Guest") {
  header("location:admin.php");
  exit();
}
if (isset($_POST["btnHome"])) {

  header("Location: index.php");
  exit();
}
if (isset($_POST["btnDelete"])) {

  header("Location: delete.php");
  exit();
}

if (!isset($_GET["id"])) {
  die("id not found.");
}
$id = $_GET["id"];
if (!is_numeric($id)) {
  die("id is not a number");
}
require("connDB.php");

//如果都有輸入 把輸入的值post給變數
if (isset($_POST["btnOK"]) && $_POST["txtUserPhone"] != "" && $_POST["txtPassword"] != "") {
  $username = $_POST["txtUserName"];
  $userphone = $_POST["txtUserPhone"];
  $account = $_POST["txtUserAccount"];
  $password = $_POST["txtPassword"];

  //查詢帳號資料
  $sql = "SELECT * FROM shopuser WHERE `account`='$account'";

  // 執行SQL查詢
  require("connDB.php");
  $result = mysqli_query($link, $sql);
  $total_records = mysqli_num_rows($result);


  // 是否有查詢到有相同帳號

  $sql = <<<multi
    update shopuser set 
    username='$username',
    userphone='$userphone',
    password='$password'
    where shopuser .userId=$id
multi;
  $result = mysqli_query($link, $sql);
  $_SESSION['user'] = $username;

  header("location:index.php");
  exit();

  //把數值放進空格裡面 方便檢視
} else {

  $sql = "select * from shopuser where userId =$id";
  $result = mysqli_query($link, $sql);
  $row = mysqli_fetch_assoc($result);
}

?>

<!DOCTYPE html>
<html lang="en">

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
            <a href="add.php" class="btn btn-danger  btn-sm">註冊帳號</a>
            <a href="login.php" class="btn btn-danger   btn-sm">登入帳號</a>

          <?php } else { ?>

            <a><?= $_SESSION["user"] ?>您好</a>
            <a><img src="account_image/<?= $_SESSION['account'] ?>.png" width="40" height="40"></a>
            <a href="shop_car.php?id=<?= $_SESSION['id'] ?>" class="btn btn-danger   btn-sm">購物車</a>
            <a href="sign_out.php" class="btn btn-danger   btn-sm">登出帳號</a>
            <a href="edit.php?id=<?= $_SESSION['id'] ?>" class="btn btn-danger  btn-sm">修改帳號</a>
          <?php } ?>
          <a href="see_checkout.php?id=<?= $id ?>" class="btn btn-danger  btn-sm">查看訂單</a>
        </div>

      </div>
  </header>
  <div class="py-5 ">
    <table width="400" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">

      <form id="form1" name="form1" method="post">
        <tr bgcolor="#AE0000">
          <td>
            <div id="title">
              <div></div>
              <font color="#FFFFFF" align="center">修改帳號</font>
   
            </div>
          </td>

        </tr>
        <tr>
          <td align="center">使用者名稱<br>

            <input type="text" name="txtUserName" id="txtUserName" value="<?= $row["username"] ?>"></td>
        </tr>

        <tr>
          <td align="center">使用者電話<br>

            <input type="text" name="txtUserPhone" id="txtUserPhone" value="<?= $row["userphone"] ?>" /></td>
        </tr>

        <tr>
          <td align="center">使用者密碼<br>

            <input type="password" name="txtPassword" id="txtPassword" value="<?= $row["password"] ?>" /></td>
        </tr>
        <tr>
          <td align="center">
            <hr><input type="submit" name="btnOK" id="btnOK" value="修改" />

            <input type="submit" name="btnDelete" id="btnDelete" value="刪除帳號" />
          </td>
        </tr>
        <tr bgcolor="#AE0000">
          <td>
            <div>
              <font color="#AE0000">123</font>
            </div>
          </td>


      </form>
      </tr>

  </div>
  </table>

  </div>
</body>

</html>