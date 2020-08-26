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
  <form id="form1" name="form1" method="post" enctype="multipart/form-data" action="add_account.php">
    <table width="450" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">

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
        <td>
          <p>大頭照</p>
          <p>(1*1)</p>
        </td>
        <td><input type="file" name="myfile" id="myfile" /></td>
        </td>
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
          </form>
          <input type="reset" name="btnReset" id="btnReset" value="重設" class="btn btn-success btn-sm" />
          <input type="submit" name="btnHome" id="btnHome" value="回首頁" class="btn btn-success btn-sm" />
        </td>
      </tr>

    </table>

</body>


</html>