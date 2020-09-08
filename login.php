<?php
//啟用session
session_start();

//如果沒有驗證碼
function randowverif()
{

  $_SESSION['verification1 '] = rand(0, 9);
  $_SESSION['verification2 '] = rand(0, 9);
  $_SESSION['verification3 '] = rand(0, 9);
  $_SESSION['verification4 '] = rand(0, 9);
}


if (!isset($_POST["Verif"])) {
  randowverif();
}
$_SESSION['verification '] = $_SESSION['verification1 '] * 1000 + $_SESSION['verification2 '] * 100 + $_SESSION['verification3 '] * 10 + $_SESSION['verification4 '];

$account = "";
$password = "";
$verif = "";

//如果按下回首頁
if (isset($_POST["btnLogin"])) {

  header("Location: add.php");
  exit();
}
//如果按下確認按鈕

if (isset($_POST["btnOK"])) {
  $account = $_POST["txtUserAccount"];
  $password = $_POST["txtPassword"];
  $verif = $_POST["Verif"];

  // 檢查是否輸入使用者名稱和密碼
  if ($account != "" && $password != "") {
    // 建立MySQL的資料庫連接 
    require("connDB.php");
    // 建立SQL指令字串
    $sql = "SELECT * FROM shopuser WHERE `account`='$account'";

    // 執行SQL查詢
    $result = mysqli_query($link, $sql);
    $total_records = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);

 $hash=$row["password"];

    // 是否有查詢到使用者記錄以及驗證碼是否正確
    if ($total_records > 0 && $_SESSION['verification '] == $verif && password_verify($password, $hash)) {
      if ($row["black"] != 1) {

        // && $_SESSION['verification '] == $verif
        // 成功登入, 指定Session變數
        $_SESSION['user'] =  $row["username"];
        $_SESSION['id'] =  $row["userId"];
        $_SESSION['account'] = $row["account"];
        $_SESSION["login_session"] = true;


        header("Location: index.php");
      } else {
        randowverif();

        echo "<script>alert('帳號已被黑名單')</script>";
      }
      // 登入失敗
    }   else {
      randowverif();
      //如果輸入內容錯誤
        echo "<script>alert('輸入內容錯誤')</script>";
      
      $_SESSION["login_session"] = false;
    }
    // 關閉資料庫連接  
    mysqli_close($link);
    //如果有空白
  } else {
    randowverif();
    echo "<script>alert('使用者名稱或密碼未輸入')</script>";
  }
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
              <font color="#FFFFFF" align="center">登入</font>
              <div>
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <td align="center">

            <input type="text" name="txtUserAccount" id="txtUserAccount" placeholder="帳號" onkeyup="value=value.replace(/[\W]/g,'') " required /></td>
        </tr>
        <tr>
          <td align="center">

            <input type="password" name="txtPassword" id="txtPassword" placeholder="密碼" onkeyup="value=value.replace(/[\W]/g,'') " required /></td>
        </tr>

        <tr>
          <td align="center">
            <input type="text" name="Verif" id="Verif" placeholder="驗證碼" onkeyup="value=value.replace(/[^\d]/g,'') " required /><br><br>
            <img src="<?php echo "images/" . $_SESSION['verification1 '] . '.png' ?>" />
            <img src="<?php echo "images/" . $_SESSION['verification2 '] . '.png' ?>" />
            <img src="<?php echo "images/" . $_SESSION['verification3 '] . '.png' ?>" />
            <img src="<?php echo "images/" . $_SESSION['verification4 '] . '.png' ?>" />
          </td>
        </tr>
        <tr>
          <td colspan="2" align="center">
            <hr><input type="submit" name="btnOK" id="btnOK" value="登入" />
            <a id="aurl" href="add.php " class="btn">註冊</a>
          </td>
        </tr>
        <tr bgcolor="#AE0000">
          <td>
            <div>
              <font color="#AE0000">0</font>
            </div>
          </td>


      </form>
      </tr>

  </div>
  </table>

  </div>

</body>

</html>