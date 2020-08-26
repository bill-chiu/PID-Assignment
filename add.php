<?php

if (isset($_POST["btnOK"])) {
  //如果都有輸入 把輸入的值post給變數
  if ($_POST["txtUserName"] != "" && $_POST["txtUserPhone"] != "" && $_POST["txtIdentityID"] != "" && $_POST["txtUserAccount"] != "" && $_POST["txtPassword"] != "") {
    $username = $_POST["txtUserName"];
    $userphone = $_POST["txtUserPhone"];
    $identityID = $_POST["txtIdentityID"];
    $account = $_POST["txtUserAccount"];
    $password = $_POST["txtPassword"];
    $black = 0;

    $sql = "SELECT * FROM shopuser WHERE `account`='$account'";

    // 執行SQL查詢
    require("connDB.php");
    $result = mysqli_query($link, $sql);
    $total_records = mysqli_num_rows($result);


    // 是否有查詢到有相同帳號
    if ($total_records > 0) {

      echo "<center><font color='red'>";
      echo "此帳戶已被註冊!<br/>";
      echo "</font>";
      //把值新增到顧客名單
    } else {

      $sql = <<<multi
    insert into shopuser (username,userphone,identityID,account,password,black)
    values ('$username','$userphone','$identityID','$account','$password',$black)
    multi;
      echo $sql;
      require("connDB.php");
      mysqli_query($link, $sql);

      header("location:index.php");
    }
  }
  //如果有沒輸入的
  else {
    echo "<center><font color='red'>";
    echo "有欄位未輸入!<br/>";
    echo "</font>";
  }
}
//如果按下回首頁
if (isset($_POST["btnHome"])) {

  header("Location: index.php");
  exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
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
          <font color="#FFFFFF">購物車系統 - 註冊帳戶</font>
        </td>
      </tr>
      <tr>
        <td width="100" align="center" valign="baseline">使用者名稱</td>
        <td valign="baseline"><input type="text" name="txtUserName" id="txtUserName" /></td>
      </tr>
      <tr>
        <td width="100" align="center" valign="baseline">身分證字號</td>
        <td valign="baseline"><input type="text" name="txtIdentityID" id="txtIdentityID" /></td>
      </tr>
      <tr>
      <tr>
        <td width="100" align="center" valign="baseline">使用者電話</td>
        <td valign="baseline"><input type="text" name="txtUserPhone" id="txtUserPhone" /></td>
      </tr>
      <tr>
      <tr>
        <td width="100" align="center" valign="baseline">使用者帳號</td>
        <td valign="baseline"><input type="text" name="txtUserAccount" id="txtUserAccount" /></td>
      </tr>
      <tr>
        <td width="100" align="center" valign="baseline">使用者密碼</td>
        <td valign="baseline"><input type="password" name="txtPassword" id="txtPassword" /></td>
      </tr>

      <tr>
        <td colspan="2" align="center" bgcolor="#CCCCCC">
          <input type="submit" name="btnOK" id="btnOK" value="新增" class="btn btn-success btn-sm" />
          <input type="reset" name="btnReset" id="btnReset" value="重設" class="btn btn-success btn-sm" />
          <input type="submit" name="btnHome" id="btnHome" value="回首頁" class="btn btn-success btn-sm" />
        </td>
      </tr>

    </table>
  </form>
</body>


</html>