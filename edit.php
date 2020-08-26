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
if (isset($_POST["btnOK"]) && $_POST["txtUserPhone"] != ""&& $_POST["txtPassword"] != "") {
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

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="css/jquery.toast.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style>
    .box {

      padding-left: 100px;
      padding-right: 100px;


    }
  </style>
</head>

<body>
  <form id="form1" name="form1" method="post">
    <table width="300" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">

      <tr>
        <td colspan="2" align="center" bgcolor="#CCCCCC">
          <font color="#FFFFFF">購物車系統 - 編輯帳戶</font><br>
          <a>hello <?= $_SESSION["user"] ?> </a>
        </td>

      </tr>

      <tr>
        <td width="100" align="center" valign="baseline">使用者名稱</td>
        <td valign="baseline"><input type="text" name="txtUserName" id="txtUserName" value="<?= $row["username"] ?>"></td>
      </tr>

      <tr>
        <td width="100" align="center" valign="baseline">使用者電話</td>
        <td valign="baseline"><input type="text" name="txtUserPhone" id="txtUserPhone" value="<?= $row["userphone"] ?>" /></td>
      </tr>


      <tr>
        <td width="100" align="center" valign="baseline">使用者密碼</td>
        <td valign="baseline"><input type="password" name="txtPassword" id="txtPassword" value="<?= $row["password"] ?>" /></td>
      </tr>

      <tr>
        <td colspan="2" align="center" bgcolor="#CCCCCC">
          <input type="submit" name="btnOK" id="btnOK" value="修改" class="btn btn-success btn-sm" />
          <input type="reset" name="btnReset" id="btnReset" value="重設" class="btn btn-success btn-sm" />
          <input type="submit" name="btnHome" id="btnHome" value="回首頁" class="btn btn-success btn-sm" />
          <input type="submit" name="btnDelete" id="btnDelete" value="刪除帳號" class="btn btn-danger btn-sm" />
        </td>
      </tr>

    </table>
  </form>
</body>

</html>