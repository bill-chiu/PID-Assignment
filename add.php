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
<form id="form1" name="form1" method="post" enctype="multipart/form-data" action="add_account.php">
  <table width="400" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">

  
      <tr bgcolor="#AE0000">
        <td>
          <div id="title">
            <div></div>
            <font color="#FFFFFF" align="center">註冊帳號</font>
            <div>
            </div>
          </div>
        </td>
      </tr>
      <tr>
        <td align="center">
          <input type="text" name="txtUserName" id="txtUserName" placeholder="暱稱" required></td>
      </tr>
      <tr>
        <td align="center">
            大頭照: <input type="file" name="myfile" id="myfile" required/>
        </td>
      </tr>
      <td align="center"><input type="text" name="txtIdentityID" id="txtIdentityID" placeholder="身分證字號" required /></td>
      </tr>
      <tr>
        <td align="center"><input type="text" name="txtUserPhone" id="txtUserPhone" placeholder="電話" required /></td>
      </tr>
      <tr>
        <td align="center"><input type="text" name="txtUserAccount" id="txtUserAccount" placeholder="帳號" required /></td>
      </tr>
      <tr>
        <td align="center"><input type="password" name="txtPassword" id="txtPassword" placeholder="密碼" required /></td>
      </tr>
      <tr>
        <td colspan="2" align="center">

          <hr>
          <!-- <div id="aaa"> -->
          <input type="submit" name="btnOK" id="btnOK" value="註冊" />
          </form>
          <a id="aaa"href="login.php " >回首頁</a>
          <!-- </div> -->
        </td>
      </tr>
      <tr bgcolor="#AE0000">
        <td >
          <div>
            <font color="#AE0000">123</font>
          </div>

        </td>



    </tr>

    </div>
  </table>


</body>

</html>

