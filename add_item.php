<?php

//如果按下確認
if (isset($_POST["btnOK"])) {
  
  //如果都有輸入 把輸入的值post給變數
    if($_POST["txtItemName"]!=""&&$_POST["txtItemPrice"]!=""&&$_POST["txtSpecies"]!=""){
    $itemname=$_POST["txtItemName"];
    $itemprice=$_POST["txtItemPrice"];
    $species=$_POST["txtSpecies"];

    //把值新增到物品清單
    $sql = <<<multi
    INSERT INTO itemlists (itemname, itemprice,species) VALUES
    ('$itemname', '$itemprice','$species')
    multi;
    echo $sql;
    require("connDB.php");
    mysqli_query($link, $sql);
    header("location:echo.php");
    //如果有未輸入
}else{
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Document</title>
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
          <font color="#FFFFFF">購物車系統 - 新增商品</font>
        </td>
      </tr>

      <tr>
        <td width="100" align="center" valign="baseline">商品名稱</td>
        <td valign="baseline"><input type="text" name="txtItemName" id="txtItemName"  /></td>
      </tr>
      <tr>
        <td width="100" align="center" valign="baseline">商品價格</td>
        <td valign="baseline"><input type="text" name="txtItemPrice" id="txtIitemPrice"  /></td>
      </tr>
      <tr>
      <td width="100" align="center" valign="baseline">商品類別</td>
    <td>
      <select id="txtSpecies" name="txtSpecies" class="custom-select">
        <option value="eat">eat</option>
        <option value="bookduck">book</option>
        <option value="toy">toy</option>
        <option value="wear">wear</option>
      </select>

    </td>
    </tr>
      <tr>
        <td colspan="2" align="center" bgcolor="#CCCCCC"><input type="submit" name="btnOK" id="btnOK" value="新增" class="btn btn-danger btn-sm"/>
          <input type="reset" name="btnReset" id="btnReset" value="重設" class="btn btn-danger btn-sm"/>
          <input type="submit" name="btnHome" id="btnHome" value="回首頁" class="btn btn-danger btn-sm"/>
        </td>
      </tr>

    </table>
  </form>
</body>


</html>