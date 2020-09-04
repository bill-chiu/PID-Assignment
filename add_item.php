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
        <td align="center">
      </tr>

      <tr>
        <td align="center"><input type="text" name="txtItemName" id="txtItemName" placeholder="商品名稱" /></td>
      </tr>
      <tr>
        <td align="center">
          產品照片: <input type="file" name="myfile" id="myfile" />
        </td>
      </tr>
      <tr>
        <td align="center"><input type="text" name="txtItemPrice" id="txtItemPrice" placeholder="商品價格" /></td>
      </tr>
      <tr>
        <td>商品類別:
          <select id="txtSpecies" name="txtSpecies" class="custom-select">
            <option value="eat">eat</option>
            <option value="bookduck">book</option>
            <option value="toy">toy</option>
            <option value="wear">wear</option>
          </select>

        </td>
      </tr>
      <tr>
        <td colspan="2" align="center">

          <hr>
          <input type="submit" name="btnOK" id="btnOK" value="新增" />
  </form>
  <input type="submit" name="btnHome" id="btnHome" value="回首頁" />
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